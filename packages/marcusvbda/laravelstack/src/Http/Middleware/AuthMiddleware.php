<?php

namespace marcusvbda\laravelstack\Http\Middleware;

use Closure;
use Auth;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param string|null              $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::check()) {
            return redirect(route('laravelstack.login'));
        }
        return $next($request);
    }
}
