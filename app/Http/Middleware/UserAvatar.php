<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserAvatar
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
        if(Auth::check()){
            $avatar = Auth::user()->avatar;
            if($avatar == NULL){
                $request->merge(array("Avatar" => "img/icons/avatar.png"));

            }else{
                $request->merge(array("Avatar" => Auth::user()->avatar));
 
            }

        }

        return $next($request);
    }
}
