<?php

namespace App\Http\Middleware;

use Closure;
use App\AeAccount;
use Illuminate\Support\Facades\Auth;

class RequestAeAccount
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
        $stmts = AeAccount::where('Account_number', auth::user()->Account_number)->get();
        if ($stmts->count() > 0) {
            foreach ($stmts as $stmt);
            if ($stmt->status == 3) {
                $request->merge(array("request_ae_account" => $stmt->status));
                $request->merge(array("request_ae_account_error" => $stmt->message));
            } else {
                $request->merge(array("request_ae_account" => $stmt->status));
            }
        } else {
            $request->merge(array("request_ae_account" => null));
        }
        return $next($request);
    }
}
