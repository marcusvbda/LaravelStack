<?php

namespace marcusvbda\laravelstack\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use marcusvbda\laravelstack\Services\SendMail;
use App\User;

class AuthController extends Controller
{
    public function login()
    {
        Auth::logout();
        return view("laravelstack::auth.login");
    }

    public function signin(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, (@$request['remember'] ? true : false))) {
            if (!Auth::user()->email_verified_at) {
                return $this->redirectWithMessage("laravelstack.signin", "danger", "<b class='mr-2'>Warning !</b>Unverified account, please check your email inbox!", $request->only("email", "remember"));
            }
            return $this->redirectWithMessage("laravelstack.home", "success", "<b class='mr-2'>Welcome !</b>" . Auth::user()->name);
        }
        return $this->redirectWithMessage("laravelstack.signin", "danger", "<b class='mr-2'>Warning !</b>Incorrect email or Password!", $request->only("email", "remember"));
    }

    private function redirectWithMessage($route, $type, $message, $params = [])
    {
        return redirect(route($route))->with(['type' => $type, 'message' => $message])->withInput($params);
    }

    public function signup()
    {
        Auth::logout();
        return view("laravelstack::auth.signup");
    }

    public function createUser(Request $request)
    {
        Auth::logout();
        $this->validate($request, [
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);
        $data = $request->except(["_token", "password_confirmation"]);
        $data["password"] = bcrypt($data["password"]);
        $user = User::create($data);
        $this->sendConfirmationEmail($user);
        return redirect(route("laravelstack.login"))->with(['type' => "success", 'message' => "<b  class='mr-2'>Thank you</b>User created succesfully, check your email and confirm it to access !!"])->withInput(["email" => $user->email]);
    }

    private function sendConfirmationEmail($user)
    {
        $user->confirmation_token = md5($user->created_at . "_" . $user->id);
        $link = route("laravelstack.confirmAccount", ["token" => $user->confirmation_token]);
        $appName = Config("app.name");
        $html = "
            <p>Hello {$user->name},</p>
            <p>Thank you for sign up. Your account has been created and it is pending verification.</p>
            <p>To activate it, please click in the link below</p>
            <a href='{$link}' target='_BLANK'>{$link}</a>
            <p style='margin-top:30px'>Thank you, {$appName}";
        SendMail::to($user->email, "Confirm your account", $html);
        $user->save();
    }

    public function confirmAccount($token)
    {
        $user = User::where("confirmation_token", $token)->firstOrFail();
        $user->confirmation_token = null;
        $user->email_verified_at = date("Y-m-d H:i:s");
        $user->save();
        return redirect(route("laravelstack.login"))->with(['type' => "success", 'message' => "<b  class='mr-2'>Thank you</b>Your account was successfully activated !!"])->withInput(["email" => $user->email]);
    }

    public function forgetMyPassword()
    {
        Auth::logout();
        return view("laravelstack::auth.forgetMyPassword");
    }

    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email|exists:users',
        ]);
        $user = User::where("email", $request["email"])->first();
        $this->sendRecoveryEmail($user);
        return redirect(route("laravelstack.login"))->with(['type' => "success", 'message' => "An email has been sent, check your inbox"])->withInput(["email" => $user->email]);
    }

    private function sendRecoveryEmail($user)
    {
        $user->recovery_token = md5($user->created_at . "_" . $user->id);
        $link = route("laravelstack.renewPassword", ["token" => $user->recovery_token]);
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

    public function renewPassword($token)
    {
        Auth::logout();
        $user = User::where("recovery_token", $token)->firstOrFail();
        return view("laravelstack::auth.renewPassword", compact("user", "token"));
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
        return redirect(route("laravelstack.login"))->with(['type' => "success", 'message' => "Your password was changed succesfully !!"])->withInput(["email" => $user->email]);
    }
}
