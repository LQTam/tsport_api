<?php

namespace App\Http\Controllers;

use App\Mail\NotifyOrderOutOfStockMail;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class OrderOutOfStockController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Order $order)
    {
        if (Gate::denies('order_out_of_stock')) abort(401);
        $order->load(['detail', 'detail.product', 'detail.product.supplier', 'customer']);
        Mail::to($order->customer->email)->send(new NotifyOrderOutOfStockMail($order));
        return response()->json(['message' => 'Success sent notify order out of stock mail to customer.']);

    }
}
