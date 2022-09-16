<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListNotificationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $notifications = auth('api')->user()->notifications;
        $unread = auth('api')->user()->unreadNotifications;
        $data['notifications'] = $notifications;
        $data['unreadNotifications'] = $unread;
        return response()->json($data);
    }
}
