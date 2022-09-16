<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboard extends Controller
{
    public function index()
    {
        $data = [];
        $data['products'] = Product::count();
        $data['orders'] = Order::count();
        $data['customers'] = Customer::count();
        $data['suppliers'] = Supplier::count();
        return response()->json(['data' => $data]);
    }
    public function filterCustomerBtwDate(Request $request)
    {
        $customers = DB::table('customers')
            ->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()]);
        if ($request->from && $request->to) {
            $customers = DB::table('customers')
                ->whereBetween('created_at', [$request->from, $request->to]);
        }
        $customers = $customers->paginate($request->length);
        return response()->json(['customers' => $customers]);
    }
    public function filterSupplierBtwDate(Request $request)
    {
        $suppliers = DB::table('suppliers')
            ->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()]);
        if ($request->from && $request->to) {
            $suppliers = DB::table('suppliers')
                ->whereBetween('created_at', [$request->from, $request->to]);
        }
        $suppliers = $suppliers->paginate($request->length);
        return response()->json(['suppliers' => $suppliers]);
    }
    public function filterOrderBtwDate(Request $request)
    {
        $orders = DB::table('orders')
            ->join('customers', 'customers.id', '=', 'orders.user_id')
            ->whereBetween('orders.created_at', [$request->from, $request->to])
            ->select('orders.*', 'customers.email as customer_email');
        $orders = $orders->paginate($request->length);
        return response()->json(['orders' => $orders]);
    }
}
