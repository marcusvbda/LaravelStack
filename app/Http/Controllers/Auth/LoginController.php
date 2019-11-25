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
            $user = Auth::user();
            if (!$user->email_verified_at) {
                return ["success" => false, "message" => ["type" => "error", "text" => "Conta não verificada, por favor acesse seu email e clique no link de confirmação"]];
            }
            return ["success" => true, "route" => route("admin.home")];
        }
        return ["success" => false, "message" => ["type" => "error", "text" => "Credenciais de acesso incorretas, verifique ..."]];
    }
}
