<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SendMail;
use App\User;
use Auth;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        Auth::logout();
        return view("auth.forgetMyPassword");
    }

    private function sendRecoveryEmail($user)
    {
        Auth::logout();
        $user->recovery_token = md5($user->created_at . "_" . $user->id);
        $link = route("auth.forgot_my_password.renew", ["token" => $user->recovery_token]);
        $appName = Config("app.name");
        $html = "
            <p>Hello {$user->name},</p>
            <p>Forgot your password ? No problem! </p>
            <pClick the link below to register a new password.</p>
            <a href='{$link}' target='_BLANK'>{$link}</a>
            <p style='margin-top:30px'>Thank you, {$appName}";
        SendMail::to($user->email, "Renew your password", $html);
        $user->save();
    }

    public function resetPassword(Request $request)
    {
        Auth::logout();
        $this->validate($request, [
            'email'    => 'required|email|exists:users',
        ]);
        $user = User::where("email", $request["email"])->first();
        $this->sendRecoveryEmail($user);
        return redirect(route("auth.login.index"))->with(['type' => "success", 'message' => "An email has been sent, check your inbox"])->withInput(["email" => $user->email]);
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
        return redirect(route("auth.login.index"))->with(['type' => "success", 'message' => "Your password was changed succesfully !!"])->withInput(["email" => $user->email]);
    }
}
