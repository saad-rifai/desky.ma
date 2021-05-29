<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ApiAuth
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


       $request_host = $request->getHost();

      if($request_host && env('APP_URL') == $request_host){
            return $next($request);
        }else{

        }
        return abort(403);

    }
}
