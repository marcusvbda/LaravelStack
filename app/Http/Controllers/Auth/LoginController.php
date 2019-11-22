<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Services\Messages;

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
                return ["success" => false, "message" => ["type" => "error", "text" => "Conta não verificada, por favor acesse seu email e clique no link de confirmação"]];
            }
            Messages::send("success", "<b class='mr-2'>Bem-Vindo");
            return ["success" => true, "route" => route("admin.home")];
        }
        return ["success" => false, "message" => ["type" => "error", "text" => "Credenciais de acesso incorretas, verifique ..."]];
    }
}
