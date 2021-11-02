<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('api/OAuth/register/google/call', 'Auth\RegisterController@RequesGoogle')->name('google_register');
Route::get('/backend/google/callback', 'Auth\RegisterController@handleProviderCallback__Google');


Route::get('api/OAuth/register/facebook/call', 'Auth\RegisterController@RequesFacebook')->name('facebook_register');
Route::get('/backend/facebook/callback', 'Auth\RegisterController@handleProviderCallback__Facebook');

Route::prefix('ajax')->group(function () {
    Route::post('new/user', 'Auth\RegisterController@RegisterUser');
    Route::post('login/user', 'Auth\LoginController@LoginUser');
    Route::post('reset/user/password', 'Auth\ResetPasswordController@ResetPassword');
    Route::post('ResetPassword/reset', 'Auth\ResetPasswordController@UpdatePassword');
    Route::post('user/update/avatar', 'UserAccountController@UpdateAvatar');
    Route::post('user/update/profile', 'UserAccountController@UpdateProfile');
    Route::post('user/update/account', 'UserAccountController@UpdateAccount');
    Route::post('user/request/verification', 'DocumentationCenterController@RequestVerification');
    Route::post('user/request/aeaccount', 'AeAccountController@RequestAccount');

});
Route::get('ResetPassword/reset/{hashToken}', 'Auth\ResetPasswordController@VerifyToken');
Route::get('account/verifiyEmail/{AccountNumber}/{token}', 'Auth\VerificationController@verifiyEmail');
Route::get('try', function(){

});

/** 
 * Route Auth Groupe
 * **/


Route::group(['middleware' => ['auth', 'avatar', 'verified_account']], function () {


    Route::get('/account/settings', function () {
        return view('user.settings');
    })->middleware("request_verification");


    Route::get('/new/order', function () {
        return view('actions.add-order');
    });

 
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    });
    

});

Route::group(['middleware' => 'avatar'], function () {
    Route::get('/', function () {
        if(Auth::check()){
            return view('user.dashboard');
    
        }else{
            return view('index');
    
        }
    });
    Route::get('/orders', function () {
        return view('orders');
    });
    Route::get('/order/{OID}', function () {
        return view('order-page');
    });
    Route::get('/auto-entrepreneurs', function() {
        return view('list-of-self-contractors');
    });
    Route::get('/conditions', function () {
        return view('pages.terms');
    });
    Route::get('/politique-de-confidentialite', function () {
        return view('pages.privacy');
    });
    
    
    Route::get('/@{username}', 'WebController@publicProfile');
});





Route::get('/login', function () {

    return view('auth.login');

})->name('login')->middleware('guest');

Route::get('/reset', function () {

    return view('auth.passwords.reset');

})->name('reset');

Route::get('/register', function () {

    return view('auth.register');

})->name('register')->middleware('guest');

Route::get('logout', function () {
    if(Auth::logout()){
      return  redirect('/');
    }else{
        return redirect('/?return=true__logout');

    }
})->name('logout');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

