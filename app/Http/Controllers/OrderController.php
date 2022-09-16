<?php

namespace App\Http\Controllers;

use App\Http\Resources\Order\OrderCollection;
use App\Mail\NotifyOrderOutOfStockMail;
use App\Mail\OrderConfirmed;
use App\Mail\OrderShipped;
use App\Models\Order;
use App\Notifications\OrderSuccessNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if (Gate::denies('access_order_manager')) abort(401);
        $orders = Order::all();
        $orders->load([
            'detail',
            'detail.product', 'detail.product.supplier', 'customer', 'payment'
        ]);
        return new OrderCollection($orders);
    }

    public function confirmOrder(Request $request, $madh)
    {
        if (Gate::denies('confirm_order')) abort(401);
        $order = Order::where('madh', $madh)->first();
        $order->load(['detail', 'detail.product', 'detail.product.supplier', 'customer']);
        Log::warning("AAA", [$order->customer]);
        Mail::to($order->customer->email)->send(new OrderConfirmed($order));
        return response()->json(['message' => 'Success sent confirm order email to customer.']);
    }
    public function outOfStock(Request $request, $madh)
    {
        if (Gate::denies('order_out_of_stock')) abort(401);
        $order = Order::where('madh', $madh)->first();
        $order->load(['detail', 'detail.product', 'detail.product.supplier', 'customer']);
        Mail::to($order->customer->email)->send(new NotifyOrderOutOfStockMail($order));
        return response()->json(['message' => 'Success sent notify order out of stock mail to customer.']);
    }

    public function fetchOrdersByUserID($uid)
    {
        $orders = Order::where('user_id', $uid)->get();
        $response = [];
        foreach ($orders as $key => $item) {
            foreach ($item['detail'] as $key => $detail) {
                $data['prodID'] =  $detail['product']['id'];
                $img = $detail['product']['pictures'][0];
                $colorID =  $detail['color1']['id'];
                $data['orderCode'] = $item['madh'];
                $data['prodCode'] = $detail['product']['masp'];
                $data['prodName'] = $detail['product']['product_name'];
                $data['prodPrice'] = $detail['price'];
                $data['quantity'] = $detail['quantity'];
                $data['color'] = $detail['color'];
                $data['size'] = $detail['size'];
                if (strpos('//', $img['src']) != -1) $data['image'] = 'https' . $img['src'];
                else $data['image'] = asset(
                    'storage/products/' . $data['prodID'] . '/colors/' .
                        $colorID . '/' . $img['type'] . '/' . $img['src']
                );
                array_push($response, $data);
            }
        }
        return response()->json(['orders' => $response]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('create_order')) abort(401);
        $data = $request->all();
        $order = \App\Models\Order::create([
            'madh' => strtoupper(substr(md5(microtime()), rand(0, 26), 2)) . substr(md5(microtime()), rand(0, 26), 5),
            'user_id' => $data['user_id'],
            'payment_id' => $data['payment_method']['id'],
            'order_date' =>  Carbon::now()->toDateString(),
        ]);
        $mailData = [];
        array_push($mailData, $order);
        array_push($mailData, $data);
        foreach ($data['products'] as $prod) {
            $orderDetails = \App\Models\OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $prod['id'],
                'price' => $prod['product_price'],
                'quantity' => $prod['color']['sizes']['quantity'],
                'discount' => $prod['discount'],
                'total' => $data['total'],
                'size' => $prod['color']['sizes']['name'],
                'color' => $prod['color']['name'],
            ]);
            DB::table("color_sizes")->where('color_id', $prod['color']['id'])
                ->where('name', $prod['color']['sizes']['name'])
                ->where('quantity', '>', 0)
                ->decrement('quantity', $prod['color']['sizes']['quantity']);
            array_push($mailData, $orderDetails);
        }
        $data['order_date'] = $order->created_at;
        $data['madh'] = $order->madh;
        Mail::to($data['email'])->send(new OrderShipped($data));
        // broadcast(new OrderSuccess($order))->toOthers();
        $users = \App\Models\User::role(['admin', 'sell employee'])->get();
        Notification::locale('vi_VN')->send($users, new OrderSuccessNotification($order));
        return response()->json(['message' => 'Successful order. Check your mail.', 'order_id' => $order->id]);
    }
    public function destroy(Order $order)
    {
        if (Gate::denies('delete_order')) abort(401);
        $order->delete();
        return response()->json(['message' => 'Success delete order.']);
    }
}
