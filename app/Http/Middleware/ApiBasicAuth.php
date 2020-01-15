<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ApiBasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->getUser();
        $password = $request->getPassword();
        $_user = Auth::attempt(["email"=>$user,"password"=>$password]);
        if(!Auth::attempt(["email"=>$user,"password"=>$password])) abort(403);
        return $next($request);
    }
}
