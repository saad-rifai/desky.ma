<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('is_image', function ($attribute, $value, $parameters, $validator) {
            preg_match_all('/([^\.]+)\.([a-zA-Z]+)/',$value,$matchedExt);
            if (isset($matchedExt[2][0]) && in_array($matchedExt[2][0],$parameters)) return true;
            preg_match_all('/data\:image\/([a-zA-Z]+)\;base64/',$value,$matched);
            $ext = isset($matched[1][0]) ? $matched[1][0] : false;
           // print_r($value);
            return in_array($ext,$parameters) ? true : false;
    });
    }
}
