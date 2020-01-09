<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function login(Request $request)
    {
        $user = $request->getUser();
        $password = $request->getPassword();
        return [$user, $password];
    }
}
