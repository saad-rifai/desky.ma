<?php

namespace App\Http\Middleware\admin;

use App\admin\AdminUsers;
use App\AdminAuthToken;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

use Closure;

class AdminAuth
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
            $checkAdminUser = AdminUsers::where('Account_number', Auth::user()->Account_number)->where('status', '0')->count();
            if($checkAdminUser > 0){
                if(Cookie::get('admin_token')){
                    $admin_token = Cookie::get('admin_token');
                    $decrypted = Crypt::decryptString($admin_token);
                    $stmt = AdminAuthToken::where("Account_number", Auth::user()->Account_number)->where('token', $decrypted)->count();
                    if($stmt < 1){
                        return redirect("admin/check/otp");
        
                    }else{
                        return $next($request);
                    }
                }else{
                    return redirect("admin/check/otp");
        
                }
            }else{
                abort(403);
            }
        }else{
            abort(403);

        }

    }
}
