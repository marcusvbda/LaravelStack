<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function index()
    {
        Auth::logout();
        return view("auth.login");
    }

    public function signin(Request $request)
    {
        Auth::logout();
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, (@$request['remember'] ? true : false))) {
            if (!Auth::user()->email_verified_at) {
                return redirect(route("signin"))->with(['type' => "danger", 'message' => "<b class='mr-2'>Warning !</b>Unverified account, please check your email inbox!"])->withInput($request->only("email", "remember"));
            }
            return redirect(route("admin.home"))->with(['type' => "success", 'message' => "<b class='mr-2'>Welcome !</b>" . Auth::user()->name]);
        }
        return redirect(route("auth.login.index"))->with(['type' => "danger", 'message' => "<b class='mr-2'>Warning !</b>Incorrect email or Password!"])->withInput($request->only("email", "remember"));
    }
}
