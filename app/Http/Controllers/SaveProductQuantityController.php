<?php

namespace App\Http\Controllers;

use App\Models\ColorSize;
use Illuminate\Http\Request;

class SaveProductQuantityController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, ColorSize $colorSize)
    {
        if (Gate::denies('edit_product')) abort(401);
        $colorSize->updateOrCreate(['color_id' => $request->color_id, 'name' => $request->name], ['quantity' => $request->quantity]);
        return response()->json(['message' => "Successfully update quantity!"]);
    }
}
