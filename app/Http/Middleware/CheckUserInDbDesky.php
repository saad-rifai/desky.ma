<?php

namespace App\Http\Middleware;

use Closure;
use App\desky_db;
use Illuminate\Support\Facades\Auth;

class CheckUserInDbDesky
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
        $stmt = desky_db::all()->where('email', Auth::user()->email);
        $count = $stmt->count();
        if($count > 0){
            return $next($request);
        }else{
            return redirect(asset('u'));
        }

    }
}
