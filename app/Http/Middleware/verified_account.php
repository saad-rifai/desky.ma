<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class verified_account
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
            $verified_account = Auth::user()->verified_account;
            if($verified_account == 1){
           

                $request->merge(array("verified_account" => '<span data-bs-toggle="tooltip" data-bs-placement="top" title="حساب تم التحقق منه"   class="verified-icon verified-1"  dir="rtl"></span>'));
            }elseif($verified_account == 2){
                $request->merge(array("verified_account" => '<span data-bs-toggle="tooltip" data-bs-placement="top" title="حساب مقاول ذاتي تم التحقق منه"   class="verified-icon verified-2"  dir="rtl"></span>'));

            }else{
                echo '';
            }
        }
        return $next($request);
    }
}
