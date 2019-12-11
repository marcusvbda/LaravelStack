<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use marcusvbda\vstack\Services\SendMail;
use marcusvbda\vstack\Services\Messages;
use App\User;
use Auth;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        Auth::logout();
        return view("auth.forgotMyPassword");
    }

    private function sendRecoveryEmail($user)
    {
        Auth::logout();
        $user->recovery_token = md5($user->created_at . "_" . $user->id);
        $link = route("auth.forgot_my_password.renew", ["token" => $user->recovery_token]);
        $appName = Config("app.name");
        $user->save();
        $user->refresh();
        dispatch(function () use ($user, $link, $appName) {
            $html = "
                <p>Olá {$user->name},</p>
                <p>Esqueceu sua senha ? Sem problemas! </p>
                <p>Clique no link abaixo e renove-a</p>
                <a href='{$link}' target='_BLANK'>{$link}</a>
                <p style='margin-top:30px'>Obrigado, {$appName}";
            SendMail::to($user->email, "Renove sua senha", $html);
        })->onQueue("mail");
    }

    public function resetPassword(Request $request)
    {
        Auth::logout();
        $this->validate($request, [
            'email'    => 'required|email|exists:users',
        ]);
        $user = User::where("email", $request["email"])->first();
        $this->sendRecoveryEmail($user);
        Messages::send("success", "Um email com o processidemento de renovação de senha foi enviado, verifique seu inbox");
        return ["success" => true, "route" => route("auth.login.index")];
    }

    public function renewPassword($token)
    {
        Auth::logout();
        $user = User::where("recovery_token", $token)->firstOrFail();
        return view("auth.renewPassword", compact("user", "token"));
    }

    public function setPassword($token, Request $request)
    {
        Auth::logout();
        $this->validate($request, [
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);
        $user = User::where("recovery_token", $token)->firstOrFail();
        $user->recovery_token = null;
        $user->password = bcrypt($request["password"]);
        $user->save();
        Messages::send("success", "Sua senha foi alterada com sucesso !!");
        return ["success" => true, "route" => route("auth.login.index")];
    }
}
