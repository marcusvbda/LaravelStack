<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use marcusvbda\vstack\Services\SendMail;
use App\User;
use App\Http\Models\Tenant;
use marcusvbda\vstack\Services\Messages;
use Auth;
use Illuminate\Validation\Rule;

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
            'email'    =>  ['required', 'email', Rule::unique('users')->whereNull('deleted_at')],
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);
        $data = $request->except(["_token", "password_confirmation"]);
        $data["tenant_id"] = $this->createTenant()->id;
        $user = User::create($data);
        $user->assignRole("user");
        $this->sendConfirmationEmail($user);
        Messages::send("success", "Usuário cadastrado com sucesso, verifique seu email e confirme-o para poder acessar");
        return ["success" => true, "route" => route("admin.home")];
    }

    private function createTenant()
    {
        $tenant = Tenant::create([
            "name" => uniqid()
        ]);
        return $tenant;
    }

    private function sendConfirmationEmail($user)
    {
        Auth::logout();
        $user->confirmation_token = md5($user->created_at . "_" . $user->id);
        $user->save();
        $user->refresh();
        $link = route("auth.signup.confirm", ["token" => $user->confirmation_token]);
        $appName = Config("app.name");

        $html = "
                <p>Olá {$user->name},</p>
                <p>Obrigado por cadastrar-se. Sua conta foi criada com successo e está pendente de confirmação.</p>
                <p>Para ativa-la, basta clicar no link abaixo</p>
                <a href='{$link}' target='_BLANK'>{$link}</a>
                <p style='margin-top:30px'>Obrigado, {$appName}";
        SendMail::to($user->email, "Confirme sua conta", $html);
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

    public function profile(User $user)
    {
        $user = Auth::user()->only(["name", "email", "avatar"]);
        return view("admin.account.index", compact("user"));
    }

    public function editProfile(Request $request)
    {
        $this->validate($request, [
            'name'    => 'required'
        ]);
        $user = Auth::user();
        $data = $request->all();
        $user->fill($data);
        $user->save();
        return ["success" => true];
    }
}
