<?php 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;

/* Auth */
Route::post('auth/check/otp', 'auth\OtpCheck@OtpVerifiy');
/* Auth */
Route::group(['middleware' => ['auth']], function () {
    Route::get('check/otp', 'auth\OtpCheck@sendOtp')->middleware('needotp');
});

/* Admin Auth Routes */
Route::group(['middleware' => ['AdminAuth']], function () {
    Route::get('/try', function () {
        dd(auth::user()->permissions->view_orders_pending_review);
    }); 
    Route::get('/', function () {
        return view("auth.admin.dashboard.index");
    });
    Route::get('/orders/pending', function () {
        if(auth::user()->permissions->view_orders_pending_review){
        return view("auth.admin.dashboard.orders.orders-pending-review");
        }else{
            abort(403);
        }
    });
    Route::prefix("ajax")->group(function (){
        Route::get('/orders/pending/get', "Orders@PendingOrdersJson");
        Route::post('/order/pending/new/decision', "Orders@ReviewDecision");
    });
});
?>
