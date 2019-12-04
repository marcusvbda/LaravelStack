<?php
namespace App\vStack\Controllers;

use App\Http\Controllers\Controller;
use App\Notifications\Alert;
use App\User;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function get(User $user)
    {
        $notifications = $user->notifications->where("read_at",null);
        $user->notifications->markAsRead();
        return ["success"=>true,"notifications"=>$notifications];
    }

    public function setAsReaded(User $user,Request $request)
    {
        $id= $request["id"];
        if($id) $user->notifications->where("id",$id)->markAsRead();
        return ["success"=>true];
    }
}
