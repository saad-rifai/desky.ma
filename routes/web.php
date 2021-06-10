<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\CaptchaServiceController;
use App\Mail\verfymail_desky;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Mail\NewOrder;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;
//ResetPassword
Route::get('sitemap.xml', 'AlgNoAuthController@sitemap');
Route::any('verfymail/{UID}/{token}', 'verfymailController@verfylink');
Route::post(
    'ResetPassword/{sendMail}',
    'Auth\ResetPasswordController@ResetPassword'
);

//SendMessage
Route::post('api/v1/SendMessage', 'ContantUsController@SendMessage');
//ResetPass
Route::get(
    'ResetPassword/{ResetPass}/{token}',
    'Auth\ResetPasswordController@ResetPassword'
);
//NewPass
Route::post(
    'ResetPassword/{NewPass}/new/{token}',
    'Auth\ResetPasswordController@ResetPassword'
);

// print invoice
Route::get('print/recu/{OID}', 'pdfGeneretor@invoice');

Route::group(['domain' => 'account.' . env('APP_URL')], function () {
    Route::get('register', function () {
        if (Auth::check()) {
            Auth::logout();
            return view('user-espace/register');

        } else {
            return view('user-espace/register');
        }
    });
    Route::get('login', function () {
        if (Auth::check()) {
           Auth::logout();
           return view('user-espace/login');

        } else {
            return view('user-espace/login');
        }
    });
    // Set Cookie In Account.domain.ma
    Route::get(
        '/setusercookie/{token}/{random}/{name}/{content}/{time}/{redirect}',
        function ($token, $random, $name, $content, $time, $redirect) {
            if (isset($token)) {
                $str = $random . $name . $content . $time . $redirect;
                $checkToken = md5($str);
                if ($checkToken == $token) {
                    Cookie::queue($name, $content, $time);
                    //  $url = urldecode($redirect);
                    return redirect()->to($redirect);
                } else {
                    abort(400);
                }
            } else {
                abort(404);
            }
        }
    );
    Route::get('/u/account', function () {
        return redirect()->to(
            'http://' . env('APP_URL') . '/u/account?AccountRef&Home.do'
        );
    });
});
Route::group(
    ['domain' => 'account.' . env('APP_URL'), 'middleware' => 'guest'],
    function () {}
);
Route::get('print/devis/{OID}/{UID}/{token_share}', 'pdfGeneretor@devis');
Route::get('print/facture/{OID}/{UID}/{token_share}', 'pdfGeneretor@facture');
//AddToCart
Route::get(
    'api/v1/user/AddToCart/{p_id}/{pk_id}/{token}/{type}',
    'MyCartController@AddToCart'
);
//PaymentProcessing
Route::post(
    'api/v1/user/PaymentProcessing',
    'PaymentSystemController@PaymentProcessing'
);
//generateOrderID
Route::get('api/v1/generateOrderID', 'DeskyAlgController@generateOrderID');
Route::middleware(['auth'])->group(function () {

    //CheckFeedBack

    Route::post("api/v1/CheckFeedBack", "UserFeedbackController@CheckFeedBack");
    //SendFeedBack
    Route::post("api/v1/SendFeedBack", "UserFeedbackController@SendFeedBack");

    ///api/v1/Statistiques/TurnoverLast5years
    Route::post(
        'api/v1/Statistiques/TurnoverLast5years/json/{json}',
        'UserStatiquesController@TurnoverLast5years'
    );
    Route::post(
        'api/v1/Statistiques/TurnoverLast5years/print/{print}',
        'UserStatiquesController@TurnoverLast5years'
    );
    //api/v1/user/statistiques/impot/json/
    Route::post(
        'api/v1/user/statistiques/impot/{json}/{year}',
        'UserStatiquesController@InmpotInfos'
    );

    //getUserTvaPercentage

    Route::get(
        'api/v1/getUserTvaPercentage',
        'DeskyAlgController@getUserTvaPercentage'
    );
    //LastClientsList
    Route::post(
        'api/v1/user/getCartInfos/{OID}',
        'MyCartController@getCartInfos'
    );
    //updateCart
    Route::post('api/v1/user/updateCart', 'MyCartController@updateCart');
    //UploadRecu
    Route::post(
        'api/v1/payment/UploadRecu',
        'PaymentSystemController@UploadRecu'
    );
    Route::post(
        'api/v1/user/LastClientsList',
        'DeskyUserClientsController@LastClientsList'
    );
    Route::get(
        'api/v1/user/statistiques/general/{json}/{year}',
        'UserStatiquesController@UserStatistiquesGeneral'
    );
    Route::post(
        'api/v1/user/statistiques/general/{json}/{year}/{SA}',
        'UserStatiquesController@UserStatistiquesGeneral'
    );
    Route::post(
        'api/v1/user/statistiques/line/{json}/{year}',
        'UserStatiquesController@UserStatistiquesGeneralLine'
    );
    Route::post(
        'api/v1/user/statistiques/{print}/{year}',
        'UserStatiquesController@UserStatistiquesGeneralLine'
    );
    Route::post(
        'api/v1/user/statistiques/ventes/{json}/{year}',
        'UserStatiquesController@UserStatistiquesVentesAnnuel'
    );
    Route::post(
        'api/v1/user/statistiques/CasDeFacturation/{json}/{year}',
        'UserStatiquesController@CasDeFacturation'
    );
    Route::post(
        'api/v1/user/desky/edit/Clients',
        'DeskyUserClientsController@EditClients'
    );
    Route::post(
        'api/v1/user/desky/creer/Clients',
        'DeskyUserClientsController@CreerClients'
    );
    Route::get('/exportClients', 'exportExcle@exportClients');
    Route::post(
        'api/v1/user/ListClients',
        'DeskyUserClientsController@ListClients'
    );
    Route::post(
        'api/v1/user/deleteClients',
        'DeskyUserClientsController@deleteClients'
    );

    Route::post(
        '/api/v1/getClientsNotes',
        'DeskyUserClientsController@GetNotes'
    );
    Route::post(
        '/api/v1/UpdateClientsNotes',
        'DeskyUserClientsController@UpdateNotes'
    );
    Route::post(
        'api/v1/user/GetUserPrivacy',
        'UserPrivacyController@GetUserPrivacy'
    );
    Route::post(
        'api/v1/user/UpdateUserPrivacy',
        'UserPrivacyController@UpdateUserPrivacy'
    );
    Route::get(
        'api/v1/user/CheckSubscriptions',
        'PaymentSystemController@CheckSubscriptions'
    );
    Route::get('api/v1/getOfDocument/notes', 'DeskyAlgController@getnotes');
    Route::post(
        'api/v1/UpdateOfDocument/notes',
        'DeskyAlgController@UpdateNotes'
    );
    Route::post(
        'api/v1/UpdateOfDocument/status',
        'DeskyAlgController@changeStatus'
    );
    Route::post('api/v1/deleteDocumment', 'DeskyAlgController@deleteDocumment');
    Route::post(
        'api/v1/getOfDocument/status',
        'DeskyAlgController@StatusOfDocument'
    );
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

    Route::any(
        'api/v1/user/desky/clients/getSearch',
        'DeskyAlgController@UserDeskyCleantsSearchGet'
    );
    Route::post(
        'api/v1/user/desky/devis/maxNumber',
        'DeskyUserDevisController@GetLastDevisNumber'
    );
    Route::post(
        'api/v1/user/desky/clients/maxNumber',
        'DeskyUserClientsController@GetLastCIDNumber'
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


        Route::get('/', function () {
            return redirect('login');
        });


        Route::get('reset_password', function () {
            return view('user-espace.reset_password');
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
        return redirect('u?Dashboard.do&ref=start_session');
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
    Route::get('/À-propos-du-service', function () {
        return view('desky.pages.about-service');
    });
    Route::get('/tarifs', function () {
        return view('desky/tarif');
    });
    Route::get('/q&a', function () {
        return view('desky.pages.q&a');
    });
    //a-propos-de-nous
    Route::get('/a-propos-de-nous', function () {
        return view('desky.pages.a-propos-de-nous');
    });
    Route::get('/Contactez-nous', function () {
        return view('desky.pages.Contactez-nous');
    });
    /*  Route::get('/ae-network', function () {
        return view('desky/ae-network');
    });*/
    /* Any Route */

    /* Auth Routes */
    Route::middleware(['auth'])->group(function () {

        Route::get('register/pack', function(){
            return view('desky.user-espace.register-pack');
        });
        Route::any('/pay/{id}/{OID}', 'PaymentSystemController@index');
        //statistique
        Route::get('/statistique/annee', function () {
            return view('desky.panel.statistics.statistique-de-annee');
        });
        //statistique-de-mois.blade
        Route::get('/statistique/mois', function () {
            return view('desky.panel.statistics.statistique-de-mois');
        });
        //tax-quarterly.blade.php
        Route::get('/statistique/impot', function () {
            return view('desky.panel.statistics.tax-quarterly');
        });
        Route::get('/recu/{OID}', 'PaymentSystemController@RecuShow');
        Route::get('/creer/client', function () {
            return view('desky.panel.clients.c-client');
        });
        Route::get('/creer/facture', function () {
            return view('desky.panel.facture.c-facture');
        });

        Route::get('/desk/settings', function () {
            return view('desky.user-espace.desk-settings');
        })->middleware('desky_user');

        Route::get('/u/settings', function () {
            return view('desky/user-espace/user-settings');
        });
        Route::get('/u/payments/history', function () {
            return view('desky/user-espace/payments-history');
        });

        Route::get('/devis/list', function () {
            return view('desky.panel.devis.list-devis');
        });
        Route::get('/clients/list', function () {
            return view('desky.panel.clients.list-clients');
        });
        Route::get('/facture/list', function () {
            return view('desky.panel.facture.list-facture');
        });
        Route::post('api/list-devis', 'DeskyUserDevisController@ListDevis');
        Route::post(
            'api/list-facture',
            'DeskyUserFactureController@ListFacture'
        );
        Route::post('api/list-recu', 'PaymentSystemController@ListRecu');

        Route::post('api/creer_devis', 'DeskyUserDevisController@CreateDevis');
        Route::post(
            'api/creer_facture',
            'DeskyUserFactureController@CreateFacture'
        );
        Route::get('print/devis/{OID}/{UID}', 'pdfGeneretor@devis');
        Route::get('print/facture/{OID}/{UID}', 'pdfGeneretor@facture');
        Route::get('/creer/devis', function () {
            return view('desky.panel.devis.c-devis');
        });
        Route::get('devis/{OID}/{UID}', 'DeskyUserDevisController@ShowDevis');
        Route::get(
            'clients/{CID}/{UID}',
            'DeskyUserClientsController@ShowClient'
        );
        Route::get(
            'facture/{OID}/{UID}',
            'DeskyUserFactureController@ShowFacture'
        );
        Route::get('devis/{OID}/{UID}/edit', 'DeskyUserDevisController@index');
        Route::get(
            'facture/{OID}/{UID}/edit',
            'DeskyUserFactureController@index'
        );

        Route::get('clients/{CID}/{UID}/edit', function ($CID, $UID) {
            return view('desky.panel.clients.edit-clients', [
                'CID' => $CID,
                'UID' => $UID,
            ]);
        });

        Route::post(
            'clients/{CID}/{UID}/edit/{datajson}',
            'DeskyUserClientsController@ShowClient'
        );

        Route::post('devis/update', 'DeskyUserDevisController@update');
        Route::post('facture/update', 'DeskyUserFactureController@update');
        Route::post(
            'devis/{OID}/{UID}/{datajson}',
            'DeskyUserDevisController@index'
        );
        Route::post(
            'facture/{OID}/{UID}/{datajson}',
            'DeskyUserFactureController@index'
        );

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
        Route::get('/', function () {
            return view('desky.index');
        });
        Route::get('/login', function () {
            return redirect('http://account.' . env('APP_URL'));
        });

        Route::get('/register', function () {
            return redirect('http://account.' . env('APP_URL') . '/register');
        });
    });
    /* Guest Routes  */
});

/* SUBDEOMAINS */

Route::any('dev_test', function () {
    return view('desky.models.recu-print');
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
