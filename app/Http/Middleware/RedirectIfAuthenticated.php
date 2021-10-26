<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if(Cookie::get('redirect')){
                $redirect = Cookie::get('redirect');
                Cookie::queue(Cookie::forget('redirect'));
                return redirect($redirect);

            }else{
                return redirect(RouteServiceProvider::HOME);

            }
        }

        return $next($request);
    }
}
