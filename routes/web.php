<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;

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

//Route::get('api/OAuth/register/google/call', 'Auth\RegisterController@RequesGoogle')->name('google_register');
//Route::get('/backend/google/callback', 'Auth\RegisterController@handleProviderCallback__Google');

Route::get('GeoLocationData', 'GeoLocationController@index');
//Route::get('api/OAuth/register/facebook/call', 'Auth\RegisterController@RequesFacebook')->name('facebook_register');
//Route::get('/backend/facebook/callback', 'Auth\RegisterController@handleProviderCallback__Facebook');

Route::prefix('ajax')->group(function () {
    ///ajax/security/get/captcha/image
    Route::post('security/get/captcha/image', 'WebController@refreshCaptcha');
    Route::post('new/user', 'Auth\RegisterController@RegisterUser');
    Route::post('login/user', 'Auth\LoginController@LoginUser');
    Route::post('reset/user/password', 'Auth\ResetPasswordController@ResetPassword');
    Route::post('ResetPassword/reset', 'Auth\ResetPasswordController@UpdatePassword');


    //Route::post('/user/request/portfolio/edit/{id}/save', 'UserPortFolioController@edit')->middleware("auth");
    Route::get('user/request/user/portfolio', 'UserPortFolioController@index');
    Route::get('user/check/portfolio/liked/{portfolio_id}', 'PortFolioLikesController@CheckWorkLike');
    Route::post('user/request/portfolio/like/{portfolio_id}', 'PortFolioLikesController@likePortfolio');

    Route::post('public/request/aelist/all', 'AeAccountController@AelistAll');
    Route::post('public/request/aelist/search', 'AeAccountController@SearchInAeList');
    Route::get('public/request/ae/ratings', 'WebController@UserRatingList');

    /* Orders Route */

    Route::get('orders/all', 'OrdersController@all');
    Route::post('orders/search', 'OrdersController@search');
     Route::get('order/{OID}/json', 'OrdersController@MyOrderJson');

    /***** */

    /* Offers Routes */
    Route::post('orders/offers/new', 'OffersController@NewOffers');
    Route::post('order/offer/status', 'OffersController@offerStatus');
    Route::post('orders/offers/hired', 'OffersController@hired');
    Route::get('order/{OID}/myoffer/', 'OffersController@getMyOffer');

    /********/

    /*****************/
    Route::group(['middleware' => ['auth']], function () {
        /* USER */
        Route::get('user/aeaccount/check', 'AeAccountController@AeCheck');
        Route::get('user/documentation_center/check', 'DocumentationCenterController@DocumentationCenterCheck');
        Route::post('user/update/avatar', 'UserAccountController@UpdateAvatar');
        Route::post('user/update/profile', 'UserAccountController@UpdateProfile');
        Route::post('user/update/account', 'UserAccountController@UpdateAccount');
        Route::post('user/request/verification', 'DocumentationCenterController@RequestVerification');
        Route::post('user/request/aeaccount', 'AeAccountController@RequestAccount');

        /* Rating */
        Route::post('user/rate', 'UserRatingController@create');
        /* Rating */

        /* Support Route */
        Route::post('support/report', 'UserReportController@CreateReport');
        /* Support Route */


        Route::post('user/portfolio/create', 'UserPortFolioController@create');
        Route::post('user/portfolio/create', 'UserPortFolioController@create');
        Route::post('user/portfolio/delete/{id}', 'UserPortFolioController@delete');
        Route::get('/user/request/portfolio/infos/{id}', 'UserPortFolioController@PortfolioInfos');

        /* Orders Route */

        Route::post('user/order/create', 'OrdersController@create');
        Route::post('user/order/delete', 'OrdersController@deleteOrder');
        Route::post('user/order/update', 'OrdersController@update');
        Route::post('order/remove/file', 'OrdersController@removeFile');
        Route::post('order/hire/user', 'OrdersController@hire');
        Route::post('order/status', 'OrdersController@status');
        Route::get('order/status/get/{OID}', 'OrdersController@GetStatus');
        Route::post('order/status/update', 'OrdersController@UserUpdateStatus');
        Route::get('MyOrders/all', 'OrdersController@allMyOrders');
        Route::post('MyOrders/search', 'OrdersController@MyOrdersSearch');


        /* Offers Routes */
        Route::post('user/offer/create', 'OffersController@create');
        Route::post('order/offer/update/', 'OffersController@UpdateOffer');

        Route::get('MyOffers/all', 'OffersController@allMyOffers');
        Route::post('MyOffers/search', 'OffersController@MyOffersSearch');
        /* Notification */
        Route::get('user/menu/notification', 'UserNotificationController@NotificationForMenu');
        Route::post('user/menu/notification/click', 'UserNotificationController@AllNotificationReaded');

        /* Chat System */
        Route::post('project/chat/send', 'ChatSystemController@NewMessageInsideProject');

        Route::post('project/chatList/get', 'ChatSystemController@ProjectGetChatList');
        Route::post('project/chatroom/get', 'ChatSystemController@ProjectChatRoom');

        Route::get('messages/chatList/get', 'ChatSystemController@MessagesChatList');
        Route::get('messages/conversation/get/{room_id}/{paginate}', 'ChatSystemController@GetConversation');
        Route::post('user/message/send', 'ChatSystemController@SendMessage');
        Route::post('user/new/message', 'ChatSystemController@NewMessage'); /* Need {to} and {message} */
        Route::get('messages/new/notification', 'ChatSystemController@Notification');

        /* Chat System */


        /* USER CONTRACTS */

        Route::post('user/contract/cancel', 'OrdersContractsController@cancel');

        /* USER CONTRACTS */

        /* Deals  */
        Route::post('deal/messages', 'ChatSystemController@DealChatRoom');
        Route::post('deal/delivery', 'OrdersController@dealDelivery');

        /* Help Center */
        Route::post('/help-center/new/ticket', 'HelpCenterController@NewTicket');
    });
});


Route::get('ResetPassword/reset/{hashToken}', 'Auth\ResetPasswordController@VerifyToken');
Route::get('account/verifiyEmail/{AccountNumber}/{token}', 'Auth\VerificationController@verifiyEmail');
Route::get('/try', function () {
    //dd(Cookie::get("admin_token"),Crypt::decryptString(Cookie::get("admin_token")));
  
});

/** 
 * Route Auth Groupe
 * **/


Route::group(['middleware' => ['auth', 'avatar', 'verified_account']], function () {

    /* Deals */
    Route::get('deal/{OID}/manage', 'OrdersController@ManageDeal');


    /* Messages */

    Route::get('messages', function () {
        return view('chat/messages');
    });

    /* Messages */

    Route::get('order/{OID}/edit', 'OrdersController@editPage');

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
    Route::get('/MyOrders', function () {
        return view('orders.myorders');
    });
    Route::get('/MyOffers', function () {
        return view('offers.my-offers');
    });
    Route::get('/myorder/{OID}', 'OrdersController@MyOrderShow');

    Route::get('/dashboard', 'WebController@Dashboard');
});

Route::group(['middleware' => 'avatar'], function () {
    Route::get('/order/{OID}', 'OrdersController@show');

    Route::get('/portfolio/{id}/{title}', 'UserPortFolioController@show');
    Route::get('/portfolio/{id}/', 'UserPortFolioController@redirect');

    Route::get('/', function () {
        if (Auth::check()) {

            return  redirect('/dashboard?authCheck=true');
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
    Route::get('/about', function () {
        return view('pages.about');
    });
    Route::get('/q&a', function () {
        return view('pages.q&a');
    });
    Route::get('/help-center', function () {
        return view('support.help-center');
    });
    Route::get('/@{username}', 'WebController@publicProfile');
});





Route::get('/login', function () {

    if (isset($_GET['s_token'])) {
        Session::setId($_GET['s_token']);
        Session::start();
        return  redirect('/dashboard?set_session.do&route');
    } elseif (isset($_GET['redirect'])) {
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
    if (isset($_GET['redirect'])) {
        Cookie::queue('redirect', $_GET['redirect'], 60);
        return view('auth.login');
    } else {
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

/* SiteMaps */
Route::get('/sitemap.xml', function () {
    return response()->view('seo.sitemap')->header('Content-Type', 'text/xml');

});
Route::get('/sitemap-1.xml', function () {
    return response()->view('seo.sitemap-1')->header('Content-Type', 'text/xml');

});
Route::get('/sitemap-2.xml', 'WebController@AllUsersSiteMapsList');
Route::get('/sitemap-users.xml', 'WebController@AllUsersSiteMapList');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
