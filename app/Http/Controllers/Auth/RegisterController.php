<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\vStack\Services\SendMail;
use App\User;
use App\vStack\Services\Messages;
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
        $user->assignRole("user");
        $this->sendConfirmationEmail($user);
        Messages::send("success", "Usuário cadastrado com sucesso, verifique seu email e confirme-o para poder acessar");
        return ["success" => true, "route" => route("admin.home")];
    }

    private function sendConfirmationEmail($user)
    {
        Auth::logout();
        $user->confirmation_token = md5($user->created_at . "_" . $user->id);
        $user->save();
        $user->refresh();
        $link = route("auth.signup.confirm", ["token" => $user->confirmation_token]);
        $appName = Config("app.name");

        dispatch(function () use ($user, $link, $appName) {
            $html = "
                <p>Olá {$user->name},</p>
                <p>Obrigado por cadastrar-se. Sua conta foi criada com successo e está pendente de confirmação.</p>
                <p>Para ativa-la, basta clicar no link abaixo</p>
                <a href='{$link}' target='_BLANK'>{$link}</a>
                <p style='margin-top:30px'>Obrigado, {$appName}";
            SendMail::to($user->email, "Confirme sua conta", $html);
        })->onQueue("mail");
    }

    public function confirmAccount($token)
    {
        Auth::logout();
        $user = User::where("confirmation_token", $token)->firstOrFail();
        $user->confirmation_token = null;
        $user->email_verified_at = date("Y-m-d H:i:s");
        $user->save();
        Messages::send("success", "Obrigado, sua conta foi ativada !!");
        return redirect(route("auth.login.index"));
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
        return redirect(route("laravelstack.login"))->with(['type' => "success", 'message' => "Sua senha foi alterada com sucesso !!"]);
    }

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
