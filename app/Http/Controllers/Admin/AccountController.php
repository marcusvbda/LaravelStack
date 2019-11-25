<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Http\Request;


class AccountController extends Controller
{
    public function profile(User $user)
    {
        $user = Auth::user()->only(["name", "email"]);
        return view("admin.account.index", compact("user"));
    }

    public function editProfile(Request $request)
    {
        $this->validate($request, [
            'name'    => 'required'
        ]);
        $user = Auth::user();
        $data = $request->all();
        $user->name = $data["name"];
        $user->save();
        return ["success" => true];
    }
}
