<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;

class AppController extends Controller
{
    public function login(Request $request)
    {
        $user = $request->getUser();
        $password = $request->getPassword();
        $_user = Auth::attempt(["email"=>$user,"password"=>$password]);
        if(!Auth::attempt(["email"=>$user,"password"=>$password])) abort(403);
        $user = Auth::user();
        return $user;
    }
}
