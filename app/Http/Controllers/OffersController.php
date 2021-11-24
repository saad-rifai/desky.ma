<?php

namespace App\Http\Controllers;

use App\Offers;
use App\Orders;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class OffersController extends Controller
{
    public function create(Request $request){
        if(isset($request->OID) && $request->OID != null && $request->OID != ""){
            $infos = Orders::all()->where('OID', $request->OID);
            if(count($infos) > 0){
                foreach($infos as $info);
                $this->validate($request, [
                    'description' => 'required|min:50|max:700|string',
                    'price' => 'required|integer|min:150|max:500000',
                    'time' => 'required|integer|min:1|max:120'
                ], $messages = [
                    'required' => 'هذا الحقل مطلوب *',

                    'description.string' => 'يرجى ادخال وصف صالح *',
                    'description.min' => 'يرجى ادخال وصف كافي لعرضك الحد الأدنى 50 حرف *',
                    'description.max' => 'الوصف اللذي ادخلته أطول من اللازم الحد الأقصى 700 حرف *',
                    
                    'price.integer' => 'يرجى تحديد التكلفة *',
                    'price.max' => 'الحد الأقصى 500 الف درهم *',
                    'price.min' => 'الحد الأدنى 150 درهم *',

                    'time.integer' => 'يرجى تحديد مدة التنفيذ *',
                    'time.max' => 'الحد الأقصى 120 يوم *',
                    'time.min' => 'يرجى تحديد مدة التنفيذ *',

                ]);
                if(Auth::check()){
                    if(auth::user()->verified_account == 2){
                        if(Auth::user()->Account_number != $info->Account_number){
                            if(count(Auth::user()->Offers->where('OID', $request->OID)) < 1 && count(Auth::user()->Orders->where('OID', $request->OID)) < 1){
                      
                                /** INSERT DATA */
                                $stmt = Offers::create([
                                    'OID' => $request->OID,
                                    'Account_number' => Auth::user()->Account_number,
                                    'description' => $request->description,
                                    'price' => $request->price,
                                    'time' => $request->time,
                      
                                ]);
                                if($stmt){
                                    return response()->json(['success' => 'تم اضافة عرضك بنجاح !', 'offer_id' => $stmt->id], 200);
                                }else{
                                    return response()->json(['error' => 'حدث خطأ ما اثناء محاولة اضافة عرضك يرجى اعادة المحاولة'], 500);

                                }
                               /** INSERT DATA */
        
                            }else{
                                return response()->json(['error' => 'Bad Request !'], 400);
                
                            }
        
                        }else{
                            return response()->json(['error' => 'Bad Request !'], 400);
            
                        }
                    }else{
                         return response()->json(['error' => 'لايمكنك تقديم عرضك لأن حساب المقاول الذاتي الخاص بك غير مفعل *'], 403);
                        
                    }
                }
            }else{
                return response()->json(['error' => 'Bad Request !'], 400);

            }
        }else{
            return response()->json(['error' => 'Bad Request !'], 400);
        }


    }
    public function NewOffers(Request $request){
        if(isset($request->OID) && $request->OID != null && $request->OID != ""){
            if(Auth::check()){
                $CeckIfOrderByUser = Auth::user()->Orders->where('OID', $request->OID)->count();
                if($CeckIfOrderByUser != null && $CeckIfOrderByUser > 0){
                    $OrderCreator=true;
                }else{
                    $OrderCreator=false;
                }   
            }else{
                $OrderCreator=false;
            } 


            $infos = Offers::where('OID', $request->OID)->where("status", "0")->paginate(6);
            for($i=0; $i < count($infos); $i++){
                $rating = DB::select('SELECT ROUND(AVG(rating),1) as numRating FROM user_ratings WHERE `for` =' .$infos[$i]->Account_number);
                foreach ($rating as $rating);
                $infos[$i]->userRating = $rating->numRating;
                $infos[$i]->user = $infos[$i]->user;
                $infos[$i]->AeAccount = $infos[$i]->user->AeAccount;
                $infos[$i]->isOnline = User::isOnline($infos[$i]->Account_number);
                if($OrderCreator == false){
                    $infos[$i]->time = null;
                    $infos[$i]->price = null;
                }

                /* Get Activite Name */
                $Activites = $infos[$i]->AeAccount->activite;
                $sector = $infos[$i]->AeAccount->sector;
                if ($sector == 1) {
                    $listActivites = file_get_contents('data/json/activite-ae-2.json');
                    $listActivitesdata = json_decode($listActivites, true);
                } elseif ($sector == 2 || $sector == 3 || $sector == 4) {
                    $listActivites = file_get_contents('data/json/activite-ae-1.json');
                    $listActivitesdata = json_decode($listActivites, true);
                }
                $activite = $listActivitesdata[$Activites];

                /* Set Sector Name */

                if ($sector == 1) {
                    $sectorName = "الخدمات";
                } elseif ($sector == 2) {
                    $sectorName = "التجارة";
                } elseif ($sector == 3) {
                    $sectorName = "الصناعة";
                } elseif ($sector == 4) {
                    $sectorName = "الحرفية";
                } else {
                    $sectorName = "";
                }



                /* Get City Name */

                $datajson = file_get_contents('data/json/list-moroccan-cities.json');
                $jsondata = json_decode($datajson, true);

                $resultcheck = "";
                foreach ($jsondata as $item) {
                    if ($item['id'] == $infos[$i]->user->city) {
                        $resultcheck = $item['ville'];
                    }
                }
                $infos[$i]->activite = $activite;
                $infos[$i]->city = $resultcheck;
                $infos[$i]->sector = $sectorName;
                $infos[$i]->verified_account = $infos[$i]->user->verified_account;
            }

            return response()->json(['data'=>$infos, 'OrderCreator' => $OrderCreator], 200);

       
    
        }else{
            return response()->json(['error' => 'Bad Request !'], 400);
        }
    }
    public function hired(Request $request){
        if(isset($request->OID) && $request->OID != null && $request->OID != ""){
            if(Auth::check()){
                $CeckIfOrderByUser = Auth::user()->Orders->where('OID', $request->OID)->count();
                if($CeckIfOrderByUser != null && $CeckIfOrderByUser > 0){
                    $OrderCreator=true;
                }else{
                    $OrderCreator=false;
                }   
            }else{
                $OrderCreator=false;
            } 
            $infos = Offers::where('OID', $request->OID)->where("status", "1")->paginate(6);
            for($i=0; $i < count($infos); $i++){
                $rating = DB::select('SELECT ROUND(AVG(rating),1) as numRating FROM user_ratings WHERE `for` =' .$infos[$i]->Account_number);
                foreach ($rating as $rating);
                $infos[$i]->userRating = $rating->numRating;
                $infos[$i]->user = $infos[$i]->user;
                $infos[$i]->AeAccount = $infos[$i]->user->AeAccount;
                $infos[$i]->isOnline = User::isOnline($infos[$i]->Account_number);
                if($OrderCreator == false){
                    $infos[$i]->time = null;
                    $infos[$i]->price = null;
                }

                /* Get Activite Name */
                $Activites = $infos[$i]->AeAccount->activite;
                $sector = $infos[$i]->AeAccount->sector;
                if ($sector == 1) {
                    $listActivites = file_get_contents('data/json/activite-ae-2.json');
                    $listActivitesdata = json_decode($listActivites, true);
                } elseif ($sector == 2 || $sector == 3 || $sector == 4) {
                    $listActivites = file_get_contents('data/json/activite-ae-1.json');
                    $listActivitesdata = json_decode($listActivites, true);
                }
                $activite = $listActivitesdata[$Activites];

                /* Set Sector Name */

                if ($sector == 1) {
                    $sectorName = "الخدمات";
                } elseif ($sector == 2) {
                    $sectorName = "التجارة";
                } elseif ($sector == 3) {
                    $sectorName = "الصناعة";
                } elseif ($sector == 4) {
                    $sectorName = "الحرفية";
                } else {
                    $sectorName = "";
                }
                /* Get City Name */
                $datajson = file_get_contents('data/json/list-moroccan-cities.json');
                $jsondata = json_decode($datajson, true);

                $resultcheck = "";
                foreach ($jsondata as $item) {
                    if ($item['id'] == $infos[$i]->user->city) {
                        $resultcheck = $item['ville'];
                    }
                }
                $infos[$i]->activite = $activite;
                $infos[$i]->city = $resultcheck;
                $infos[$i]->sector = $sectorName;
                $infos[$i]->verified_account = $infos[$i]->user->verified_account;
            }

            return response()->json(['data'=>$infos, 'OrderCreator' => $OrderCreator], 200);

       
    
        }else{
            return response()->json(['error' => 'Bad Request !'], 400);
        }
    }
}
