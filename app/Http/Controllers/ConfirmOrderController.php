<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmed;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ConfirmOrderController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Order $order)
    {
        if (Gate::denies('confirm_order')) abort(401);
        $order->load(['detail', 'detail.product', 'detail.product.supplier', 'customer']);
        Log::warning("AAA", [$order->customer]);
        Mail::to($order->customer->email)->send(new OrderConfirmed($order));
        return response()->json(['message' => 'Success sent confirm order email to customer.']);
    }
}
