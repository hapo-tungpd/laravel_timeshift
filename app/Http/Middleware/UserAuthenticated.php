<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class UserAuthenticated
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
        if (!Auth::guard('web')->check()) {
            return redirect()->route('user.login-form');
        }
        return $next($request);
    }
}
