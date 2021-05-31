<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\CaptchaServiceController;
use App\Mail\verfymail_desky;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


Route::get('print/devis/{OID}/{UID}/{token_share}', 'pdfGeneretor@devis');
Route::get('print/facture/{OID}/{UID}/{token_share}', 'pdfGeneretor@facture');
Route::middleware(['auth'])->group(function () {

    Route::get('/exportClients', 'exportExcle@exportClients');
    Route::post('api/v1/user/ListClients', 'DeskyUserClientsController@ListClients');

    Route::post('/api/v1/getClientsNotes', 'DeskyUserClientsController@GetNotes');
    Route::post('/api/v1/UpdateClientsNotes', 'DeskyUserClientsController@UpdateNotes');
    Route::post('api/v1/user/GetUserPrivacy', 'UserPrivacyController@GetUserPrivacy');
    Route::post('api/v1/user/UpdateUserPrivacy', 'UserPrivacyController@UpdateUserPrivacy');
    Route::get('api/v1/user/CheckSubscriptions', 'PaymentSystemController@CheckSubscriptions');
    Route::get('api/v1/getOfDocument/notes', 'DeskyAlgController@getnotes');
    Route::post('api/v1/UpdateOfDocument/notes', 'DeskyAlgController@UpdateNotes');
    Route::post('api/v1/UpdateOfDocument/status', 'DeskyAlgController@changeStatus');
    Route::post('api/v1/deleteDocumment', 'DeskyAlgController@deleteDocumment');
    Route::post('api/v1/getOfDocument/status', 'DeskyAlgController@StatusOfDocument');
    Route::get('/download/{filename}', 'filesController@download');
    Route::post('api/notifications', 'NotificationPushController@apishow');
    Route::post(
        'api/notifications/counter',
        'NotificationPushController@counter'
    );
    Route::post('api/user/update', 'Auth\RegisterController@update');
    Route::post(
        'api/user/credit_card',
        'ListCreditCardController@UserCardInfo'
    );
    Route::post(
        'api/creer/desky/user',
        'DeskyAlgController@c_more_desky_infos'
    );
    Route::post('api/get/desky/user', 'DeskyAlgController@GetDeskyUser');
    Route::post(
        'api/update/desky/user',
        'DeskyAlgController@update_user_infos'
    );
    Route::get('api/bingapay', 'PaymentSystemController@bingapay');
    Route::any('verfymail/{UID}/{token}', 'verfymailController@verfylink');
    Route::any(
        'api/v1/user/desky/clients/getSearch',
        'DeskyAlgController@UserDeskyCleantsSearchGet'
    );
    Route::post(
        'api/v1/user/desky/devis/maxNumber',
        'DeskyUserDevisController@GetLastDevisNumber'
    );
    Route::post(
        'api/v1/user/desky/facture/maxNumber',
        'DeskyUserFactureController@GetLastFactureNumber'
    );
});
/* API ROUTES */

/* Account Routes */
Route::group(
    ['domain' => 'account.' . env('APP_URL'), 'middleware' => 'guest'],
    function () {
        Route::post('/auth/register', 'Auth\RegisterController@create');
        Route::post('/auth/login', 'Auth\LoginController@login');

        Route::get('login', function () {
            if (Auth::check()) {
                return redirect('/');
            } else {
                return view('user-espace/login');
            }
        });
        Route::get('/', function () {
            return redirect('login');
        });

        Route::get('register', function () {
            if (Auth::check()) {
                return redirect('/');
            } else {
                return view('user-espace/register');
            }
        });
        Route::get('reset_password', function () {
            return view('user-espace/reset_password');
        });
    }
);

/* Account Routes */

/* start Session */
Route::get('setcookie', function () {
    Session::setId($_GET['s_token']);
    Session::start();
    if (isset($_GET['ref']) && $_GET['ref'] != '') {
        return redirect($_GET['ref']);
    } else {
        return redirect('u/account');
    }
})->middleware('guest');
/* start Session */

/* Logout Route */
Route::post('logout', function () {
    Auth::logout();
    return redirect('/');
})
    ->name('logout')
    ->middleware('auth');
/* Logout Route */

/* Verfy Email Route */
Route::get('/vftoken', function () {
    return view('desky/verfymail');
});
/* Verfy Email Route */

Route::group(['domain' => env('APP_URL')], function () {

/* Any Route */
Route::get('/politique-de-confidentialite', function () {
    return view('desky.pages.privacy');

});
/* Any Route */

    /* Auth Routes */
    Route::middleware(['auth'])->group(function () {
        Route::get('/creer/facture', function(){
            return view('desky.panel.facture.c-facture');
        });

        Route::get('/desk/settings', function () {
            return view('desky.user-espace.desk-settings');
        })->middleware('desky_user');

        Route::get('/u/settings', function () {
            return view('desky/user-espace/user-settings');
        });

        Route::get('/devis/list', function () {
            return view('desky.panel.devis.list-devis');
        });
        Route::get('/clients/list', function () {
            return view('desky.panel.list-clients');
        });
        Route::get('/facture/list', function () {
            return view('desky.panel.facture.list-facture');
        });
        Route::post('api/list-devis', 'DeskyUserDevisController@ListDevis');
        Route::post('api/list-facture', 'DeskyUserFactureController@ListFacture');

        Route::post('api/creer_devis', 'DeskyUserDevisController@CreateDevis');
        Route::post('api/creer_facture', 'DeskyUserFactureController@CreateFacture');
        Route::get('print/devis/{OID}/{UID}', 'pdfGeneretor@devis');
        Route::get('print/facture/{OID}/{UID}', 'pdfGeneretor@facture');
        Route::get('/creer/devis', function () {
            return view('desky.panel.devis.c-devis');
        });
        Route::get('devis/{OID}/{UID}', 'DeskyUserDevisController@ShowDevis');
        Route::get('clients/{CID}/{UID}', 'DeskyUserClientsController@ShowClient');
        Route::get('facture/{OID}/{UID}', 'DeskyUserFactureController@ShowFacture');
        Route::get('devis/{OID}/{UID}/edit', 'DeskyUserDevisController@index');
        Route::get('facture/{OID}/{UID}/edit', 'DeskyUserFactureController@index');
        Route::post('devis/update', 'DeskyUserDevisController@update');
        Route::post('facture/update', 'DeskyUserFactureController@update');
        Route::post('devis/{OID}/{UID}/{datajson}', 'DeskyUserDevisController@index');
        Route::post('facture/{OID}/{UID}/{datajson}', 'DeskyUserFactureController@index');

        Route::get('/devis/sample', function () {
            return view('desky/models/sample');
        });
        Route::get('/u/account', function () {
            return view('desky/user-espace/account');
        });
        Route::get('/u/privacy', function () {
            return view('desky.user-espace.user-privacy-setting');
        });
        /*mes-abonnements */
        Route::get('/u/abonnement', function () {
            return view('desky/user-espace/mes-abonnements');
        });
        Route::get('/u', 'DeskyAlgController@index');

        Route::get('/ae-info', function () {
            return view('desky/steps/step-1');
        });
    });

    /* Auth Routes */

    /* Guest Routes */
    Route::middleware(['guest'])->group(function () {
        Route::get('/login', function () {
            return redirect('http://account.' . env('APP_URL'));
        });

        Route::get('/register', function () {
            return redirect('http://account.' . env('APP_URL'));
        });
        Route::get('/', function () {
            return view('desky/index');
        })->name('homepage');

        Route::get('/tarifs', function () {
            return view('desky/tarif');
        });

        Route::get('/ae-network', function () {
            return view('desky/ae-network');
        });
    });
    /* Guest Routes  */
});

/* SUBDEOMAINS */

Route::any('dev_test', function () {
   $str =
    'PAY' .
    '200.00' .
    '4010' .
    '673973737936743' .
    'rifaisaad3@gmail.com' .
    '4010653ddd7e9b8cece2779bbed423ce';
    $hash = md5($str);
    return $hash;
    //return date("Y-m-d\TH:i:s");
  //  return var_dump(validateDate('2020-03-12'));
});

Route::any('verfymail', function () {
    // Setup your gmail mailer
    $backup = Mail::getSwiftMailer();

    $transport = new Swift_SmtpTransport('desky.ma', 587, 'tls');
    $transport->setUsername('support@desky.ma');
    $transport->setPassword('uGrtY8jl2jKc');
    $gmail = new Swift_Mailer($transport);

    // Set the mailer as gmail
    Mail::setSwiftMailer($gmail);
    $valueArray = [
        'token' => '00245887',
    ];
    Mail::to('rifaisaad3@gmail.com')->send(new verfymail_desky($valueArray));
});
Route::post('/pay/{id}/{OID}/api', 'PaymentSystemController@api');
Route::any('/coupons/api/checker', 'CouponsController@checker');

Route::any('/pay/{id}/{OID}', 'PaymentSystemController@index');
Route::get('/successmessage', function () {
    return view('successmessage');
});

Route::group(['prefix' => 'AD32020121103@2121'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
});
Route::get('/contact-form', [CaptchaServiceController::class, 'index']);
Route::post('/captcha-validation', [
    CaptchaServiceController::class,
    'capthcaFormValidate',
]);
Route::get('/reload-captcha', [
    CaptchaServiceController::class,
    'reloadCaptcha',
]);



/* */
Route::post('/contact/store', 'ContactController@store');
