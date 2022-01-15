<?php

namespace App\Http\Middleware;

use Closure;

class maintenance
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
        if($request->ip() != '196.121.106.231'){
           // return view("errors.maintenance");
            return response()->view('errors.maintenance')->setStatusCode(503); 

        }else{
            return $next($request);

        }
    }
}
