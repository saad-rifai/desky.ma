<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

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
            $server_name = $_SERVER['SERVER_NAME'];
            $desky_server_name = 'desky.'.env("APP_NAME");
            if($server_name = $desky_server_name){
                return redirect('u/account');
            }else{
                return redirect(RouteServiceProvider::HOME);
            }
           //
        }

        return $next($request);
    }
}
