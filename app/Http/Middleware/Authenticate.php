<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Cookie;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            $url = str_replace('/','-', $_SERVER['REQUEST_URI']);
           $str = '79354128'.'ref'.$url.'15'.'login';
           $Token = md5($str);
            return 'http://account.'.env('APP_URL').'/setusercookie/'.$Token.'/79354128/ref/'.$url.'/15/login';
        }
    }
}
