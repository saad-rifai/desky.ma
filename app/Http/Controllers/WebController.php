<?php

namespace App\Http\Controllers;

use App\AeAccount;
use App\Offers;
use App\User;
use App\UserRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class WebController extends Controller
{
    public function AllUsersSiteMapsList(){
        $Infos = User::paginate('50', ['username']);
       
        return response()->view('seo.sitemap-2', $data = ['pages' =>  $Infos->lastPage()])->header('Content-Type', 'text/xml');

    }
    public function AllUsersSiteMapList(Request $request){
        $Infos = User::paginate('50', ['username', 'created_at', 'updated_at']);
       
        return response()->view('seo.sitemap-users', $data = ['users' =>  $Infos])->header('Content-Type', 'text/xml');

    }
    public function publicProfile(Request $request)
    {
        if ($request->username) {
            /* GET USER INFOS */
            $stmts = Cache::remember($request->username . 'PP', 86400, function () use ($request) {
                $stmts = User::where('username', $request->username)->get(
                    [
                        'users.frist_name',
                        'users.Account_number',
                        'users.last_name',
                        'users.country',
                        'users.city',
                        'users.username',
                        'users.description',
                        'users.avatar',
                        'users.email_verified_at',
                        'users.created_at',
                        'users.verified_account',
                    ]
                );
                $count = $stmts->count();
                if ($count > 0) {
                    foreach ($stmts as $stmt);
                    /* Get Ae Account Infos */
                    $aeInfos = AeAccount::all()->where('Account_number', $stmt->Account_number);
                    if ($aeInfos->count() > 0) {
                        $stmts->aeInfos = $aeInfos;
                    } else {
                        $stmts->aeInfos = null;
                    }
                    return $stmts;
                } else {
                    return $stmts;
                }
            });


            $count = $stmts->count();
            /* If exist User do this */
            if ($count > 0) {
                /* */
                foreach ($stmts as $stmt);

                /* Get Number Of Offers Deals Done */
                $DealsDone = Offers::where('Account_number', $stmt->Account_number)->where('status', '2')->count();
                $stmt->DealsDone = $DealsDone;
                /* Get City Name */

                $datajson = file_get_contents('data/json/list-moroccan-cities.json');
                $jsondata = json_decode($datajson, true);
                
                $resultcheck = "";
                foreach ($jsondata as $item) {
                    if ($item['id'] == $stmt->city) {
                        $resultcheck = $item['ville'];
                    }
                }
                /* Get User Rating */
                $rating = DB::select('SELECT ROUND(AVG(rating),1) as numRating FROM user_ratings WHERE `for` =' . "$stmt->Account_number");


                foreach ($rating as $rating);
                /* Ceck If Exist Ae Infos */
                if ($stmts->aeInfos != null) {
                    /* If Exist Ae Infos */
                    foreach ($stmts->aeInfos as $aeInfos);
                } else {
                    /* If Is not Exist Infos */
                    $aeInfos = null;
                }
                /* Add Data To Object */
                $stmt->aeInfos = $aeInfos;
                $stmt->cityName = $resultcheck;
                $stmt->rating = $rating->numRating;
                $activite = null;
                if (isset($aeInfos) && $aeInfos != null && $aeInfos != "") {
                    
                    $Activites = $aeInfos->activite;
                    $sector = $aeInfos->sector;
                    $Activites = explode(',', $Activites);
                    if ($sector == 1) {
                        $listActivites = file_get_contents('data/json/activite-ae-2.json');
                        $listActivitesdata = json_decode($listActivites, true);
                    } elseif ($sector == 2 || $sector == 3 || $sector == 4) {
                        $listActivites = file_get_contents('data/json/activite-ae-1.json');
                        $listActivitesdata = json_decode($listActivites, true);
                    }
                    for ($i = 0; count($Activites) > $i; $i++) {
                        $activite .= " " . $listActivitesdata[$i] . '،';
                    }
                    $Activites = $activite;
                } else {
                    $Activites = null;
                }
                $stmt->activite = $activite;
                return view('user-public-profile')->with('data', $stmt);
            } else {
                return  abort(404, $message = 'لم يتم ايجاد الحساب');
            }
        } else {
            abort(404);
        }
    }
    public function UserRatingList(Request $request)
    {
        if (isset($request->ac) && $request->ac != "") {
            $ratingInfos = UserRating::where('for', $request->ac)->paginate(1);
           for($i =0; count($ratingInfos) > $i; $i++){
            $ratingInfos[$i]->UserInfos = $ratingInfos[$i]->Auther;
    
           }

            return response()->json($ratingInfos, 200);
        } else {
            return response()->json('Bad Request !', 400);
        }
    }
    public function Dashboard(){
        /* Order Infos */
        $UserOrders = Auth::user()->Orders;
        $OrdersNumber = count($UserOrders);
        $OrdersPending = count($UserOrders->where('status', '0'));
        $OrdersOpen = count($UserOrders->where('status', '1'));
        $OrdersImplementationPhase= count($UserOrders->where('status', '2'));
        $OrdersDone = count($UserOrders->where('status', '3'));
        $OrdersClosed = count($UserOrders->where('status', '4'));
        $OrdersRejected = count($UserOrders->where('status', '5'));
        /* Order Infos */

        /* Offers Infos */
        $UserOffers = Auth::user()->Offers;
        $OffersNumber = count($UserOffers);
        $OffersPending = count($UserOffers->where('status', '0'));
        $OffersOpen = count($UserOffers->where('status', '1'));
        $OffersDone = count($UserOffers->where('status', '2'));
        $OffersCancelled = count($UserOffers->where('status', '3'));
        /* Offers Infos */
        $data = [
            /* Orders Infos */
            'OrdersNumber' => $OrdersNumber,
            'OrdersPending' => $OrdersPending,
            'OrdersOpen' => $OrdersOpen,
            'OrdersImplementationPhase' => $OrdersImplementationPhase,
            'OrdersDone' => $OrdersDone,
            'OrdersClosed' => $OrdersClosed,
            'OrdersRejected' => $OrdersRejected,

            /* Orders Infos */

            /* Offers Infos */
            'OffersNumber' => $OffersNumber,
            'OffersPending' => $OffersPending,
            'OffersOpen' => $OffersOpen,
            'OffersDone' => $OffersDone,
            'OrdersCancelled' => $OffersCancelled,



            /* Offers Infos */

        ];
        if($OrdersNumber > 0){
            $data += [
                'OrdersPendingPer' => ($OrdersPending*100/$OrdersNumber),
                'OrdersOpenPer' => ($OrdersOpen*100/$OrdersNumber),
                'OrdersImplementationPhasePer' => ($OrdersImplementationPhase*100/$OrdersNumber),
                'OrdersDonePer' => ($OrdersDone*100/$OrdersNumber),
                'OrdersClosedPer' => ($OrdersClosed*100/$OrdersNumber),
                'OrdersRejectedPer' => ($OrdersRejected*100/$OrdersNumber)
            ];
        }else{
            $data += [
                'OrdersPendingPer' => 0,
                'OrdersOpenPer' => 0,
                'OrdersImplementationPhasePer' => 0,
                'OrdersDonePer' => 0,
                'OrdersClosedPer' => 0,
                'OrdersRejectedPer' => 0
            ];
        }
        if($OffersNumber > 0){
            $data += [
                'OffersPendingPer' => ($OffersPending*100/$OffersNumber),
                'OffersOpenPer' => ($OffersOpen*100/$OffersNumber),
                'OffersDonePer' => ($OffersDone*100/$OffersNumber),
                'OffersCancelledPer' => ($OffersCancelled*100/$OffersNumber),
            ];
        }else{
            $data += [

                'OffersPendingPer' => 0,
                'OffersOpenPer' => 0,
                'OffersDonePer' => 0,
                'OffersCancelledPer' => 0,
            ];
        }
       return view('user.dashboard')->with($data);
    }
}
