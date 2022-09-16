<?php

namespace App\Http\Controllers;

use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UpdateUserDetailController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request,UserDetail $userDetail)
    {
        if(Gate::denies('edit_user')) abort(401);
        $credentials = $this->validate($request,[
            'contact_fname' => 'required',
            'contact_lname' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'phone' => 'required'
        ]);
        $userDetail->update($credentials);
        return response()->json(['message' => 'Successful update profile']);
    }
}
