<?php

use App\User;
use App\UserRating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\UserPortFolio;
use Illuminate\Support\Facades\Cookie;


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

Route::get('GeoLocationData', 'GeoLocationController@index');
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
    Route::post('user/portfolio/create', 'UserPortFolioController@create')->middleware("auth");
    Route::post('user/portfolio/create', 'UserPortFolioController@create')->middleware("auth");
    Route::post('user/portfolio/delete/{id}', 'UserPortFolioController@delete')->middleware("auth");
    Route::get('/user/request/portfolio/infos/{id}', 'UserPortFolioController@PortfolioInfos')->middleware("auth");
    //Route::post('/user/request/portfolio/edit/{id}/save', 'UserPortFolioController@edit')->middleware("auth");
    Route::get('user/request/user/portfolio', 'UserPortFolioController@index');
    Route::get('user/check/portfolio/liked/{portfolio_id}', 'PortFolioLikesController@CheckWorkLike');
    Route::post('user/request/portfolio/like/{portfolio_id}', 'PortFolioLikesController@likePortfolio');

    Route::post('public/request/aelist/all', 'AeAccountController@AelistAll');
    Route::post('public/request/aelist/search', 'AeAccountController@SearchInAeList');
    Route::get('public/request/ae/ratings', 'WebController@UserRatingList');
   
    /* Orders Route */

    Route::post('user/order/create', 'OrdersController@create')->middleware("auth");
    Route::get('orders/all', 'OrdersController@all');
    Route::post('orders/search', 'OrdersController@search');

    /***** */

    /* Offers Routes */
    Route::post('user/offer/create', 'OffersController@create')->middleware("auth");
    Route::post('orders/offers/new', 'OffersController@NewOffers');
    Route::post('orders/offers/hired', 'OffersController@hired');

    /********/
});
Route::get('ResetPassword/reset/{hashToken}', 'Auth\ResetPasswordController@VerifyToken');
Route::get('account/verifiyEmail/{AccountNumber}/{token}', 'Auth\VerificationController@verifiyEmail');
Route::get('/try', function () {
    dd(auth::user()->Offers->where('OID', "1708519923"));
});

/** 
 * Route Auth Groupe
 * **/


Route::group(['middleware' => ['auth', 'avatar', 'verified_account']], function () {

    Route::get('/portfolio/create', function () {
        return view('actions.add-to-portfolio');
    });
    // Route::get('/portfolio/edit/{id}', 'UserPortFolioController@ShowForEdit');

    Route::get('/account/settings', function () {
        return view('user.settings');
    })->middleware("request_verification", "request_ae_account");


    Route::get('/new/order', function () {
        return view('actions.add-order');
    });


    Route::get('/dashboard', function () {
        return view('user.dashboard');
    });
});

Route::group(['middleware' => 'avatar'], function () {
    Route::get('/order/{OID}', 'OrdersController@show');

    Route::get('/portfolio/{id}/{title}', 'UserPortFolioController@show');
    Route::get('/portfolio/{id}/', 'UserPortFolioController@redirect');

    Route::get('/', function () {
        if (Auth::check()) {
            return view('user.dashboard');
        } else {
            return view('index');
        }
    });
    Route::get('/orders', function () {
        return view('orders.orders');
    });

    Route::get('/auto-entrepreneurs', function () {

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

    if (isset($_GET['s_token'])) {
        Session::setId($_GET['s_token']);
        Session::start();
        return  redirect('/dashboard?set_session.do&route');
    }elseif(isset($_GET['redirect'])){
        Cookie::queue('redirect', $_GET['redirect'], 60);
        return view('auth.login');

    } else {
        return view('auth.login');
    }
})->name('login')->middleware('guest');

Route::get('/reset', function () {

    return view('auth.passwords.reset');
})->name('reset');

Route::get('/register', function () {
    if(isset($_GET['redirect'])){
        Cookie::queue('redirect', $_GET['redirect'], 60);
        return view('auth.login');

    }else{
        return view('auth.register');

    }
})->name('register')->middleware('guest');

Route::get('logout', function () {
    if (Auth::logout()) {
        return  redirect('/');
    } else {
        return redirect('/?return=true__logout');
    }
})->name('logout');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
