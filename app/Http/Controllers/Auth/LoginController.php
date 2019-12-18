<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Socialite;
use App\User;
use App\Http\Models\Tenant;

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
        if(User::where("email",$credentials["email"])->where("provider",null)->count()>0)
        {
            if (Auth::attempt($credentials, (@$request['remember'] ? true : false))) {
                $user = Auth::user();
                if (!$user->email_verified_at) {
                    return ["success" => false, "message" => ["type" => "error", "text" => "Conta não verificada, por favor acesse seu email e clique no link de confirmação"]];
                }
                return ["success" => true, "route" => route("admin.home")];
            }
        }
        return ["success" => false, "message" => ["type" => "error", "text" => "Credenciais de acesso incorretas, verifique ..."]];
    }

    public function redirectToProvider($provider)
    {
        $this->checkSocialProviders($provider);
        return Socialite::driver($provider)->redirect();
    }


    public function handleProviderCallback($provider)
    {
        $this->checkSocialProviders($provider);
        $providerUser = Socialite::driver($provider)->stateless()->user();
        $user = User::where("provider",$provider)->where("email",$providerUser->email)->first();
        if(!$user) 
        {
            $tenant = Tenant::create(["name"=>uniqid()]);
            $user = User::create([
                "name"     =>  $providerUser->name,
                "email"    =>  $providerUser->email,
                "avatar"   =>  $providerUser->avatar,
                "password" =>  bcrypt(@$providerUser->id),
                "provider" =>  $provider,
                "email_verified_at" => date("Y-m-d H:i:s"),
                "tenant_id" => $tenant->id
            ]);
            $user->assignRole("user");
        }
        else Auth::loginUsingId($user->id, true);
        return redirect(route("admin.home"));
    }

    private function checkSocialProviders($provider)
    {
        if(!in_array($provider,['github','google','facebook'])) abort(404);
    }
}
