<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product\Product;
use Illuminate\Http\Request;

class UpdateProductAvailableController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Product $product)
    {
        if (Gate::denies('edit_product')) abort(401);
        $product->update(['product_available' => $request->product_available]);
        return response()->json(['message' => "Successfully update product status!"]);
    }
}
