<?php

namespace App\Http\Controllers;

use App\AeAccount;
use App\User;
use App\UserRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class WebController extends Controller
{
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
            $ratingInfos = UserRating::join('users', 'user_ratings.from', 'users.Account_number')->where('for', $request->ac)
                    ->join('ae_accounts', 'users.Account_number', '=', 'ae_accounts.Account_number')
                    ->paginate(
                        2,
                        [
                            'user_ratings.*',
                            'users.Account_number', 'users.last_name',  'users.frist_name', 'users.country', 'users.city', 'users.username', 'users.description',
                            'users.avatar', 'users.created_at', 'users.type', 'users.gender', 'users.verified_account',
                            'ae_accounts.ae_number', 'ae_accounts.sector', 'ae_accounts.activite', 'ae_accounts.job_title'
                        ]
                    );
           

            return response()->json($ratingInfos, 200);
        } else {
            return response()->json('Bad Request !', 400);
        }
    }
}
