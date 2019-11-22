<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SendMail;
use App\User;
use Auth;

class RegisterController extends Controller
{
    public function index()
    {
        Auth::logout();
        return view("auth.signup");
    }

    public function store(Request $request)
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
        return redirect(route("auth.login.index"))->with(['type' => "success", 'message' => "<b  class='mr-2'>Thank you</b>User created succesfully, check your email and confirm it to access !!"])->withInput(["email" => $user->email]);
    }

    private function sendConfirmationEmail($user)
    {
        Auth::logout();
        $user->confirmation_token = md5($user->created_at . "_" . $user->id);
        $link = route("auth.signup.confirm", ["token" => $user->confirmation_token]);
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
        Auth::logout();
        $user = User::where("confirmation_token", $token)->firstOrFail();
        $user->confirmation_token = null;
        $user->email_verified_at = date("Y-m-d H:i:s");
        $user->save();
        return redirect(route("auth.login.index"))->with(['type' => "success", 'message' => "<b  class='mr-2'>Thank you</b>Your account was successfully activated !!"])->withInput(["email" => $user->email]);
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
