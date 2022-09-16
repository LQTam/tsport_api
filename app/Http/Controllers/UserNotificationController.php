<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserNotificationController extends Controller
{
    public function markAsRead(User $user, $notifyID)
    {
        $user->unreadNotifications->where('id',$notifyID)->markAsRead();
        return $this->notifications();
    }
    public function delete(User $user,$notifyID)
    {
        DB::raw("delete from notifications where notifications.id = '".$notifyID."'");
        return response()->json(['message'=>"Successful delete notify"]);
    }
}
