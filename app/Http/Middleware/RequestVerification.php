<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\DocumentationCenter;
class RequestVerification
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
        $stmts = DocumentationCenter::where('Account_number', auth::user()->Account_number)->get();
        if($stmts->count() > 0){
            foreach($stmts as $stmt);
       if($stmt->status == 3){
        $request->merge(array("request_verification" => $stmt->status));
        $request->merge(array("request_verification_error" => $stmt->message));
       }else{
        $request->merge(array("request_verification" => $stmt->status));

       }
        }else{
            $request->merge(array("request_verification" => null));


        }
        return $next($request);
    }
}
