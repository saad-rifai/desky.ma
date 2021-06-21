<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\desky_user_devis;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\desky_db;
use App\desky_user_clients;
use App\Subscriptions;
use Illuminate\Support\Carbon;
class DeskyUserDevisController extends Controller
{
    public function index(Request $request){
        if(isset($request->OID) && isset($request->UID) && $request->OID != "" && $request->UID !="" && is_numeric($request->OID) && is_numeric($request->UID)){
            $OID = $request->OID;
            $UID = $request->UID;
            $DevisInfos = Cache::remember('desky_user_devis'.Auth::user()->id.'oid_'.$OID, 60*24*2, function() use($OID, $UID){
                return DB::table('desky_user_devis')
                ->join('desky_user_clients', 'desky_user_devis.CID', '=', 'desky_user_clients.CID')
                ->select('desky_user_devis.*', 'desky_user_clients.CID', 'desky_user_clients.from', 'desky_user_clients.c_email', 'desky_user_clients.c_phone', 'desky_user_clients.c_name', 'desky_user_clients.c_type', 'desky_user_clients.c_ice', 'desky_user_clients.notes', 'desky_user_clients.country', 'desky_user_clients.city', 'desky_user_clients.adresse', 'desky_user_clients.id')
                ->where('OID', $OID)
                ->where('desky_user_devis.email', Auth::user()->email)
                ->get();
            });

            if($DevisInfos->count() > 0){
                if(isset($request->datajson)){
                    return response()->json($DevisInfos, 200);
                }else{
                    return view('desky.panel.devis.edit-devis', ['OID' => strval($request->OID)]);
                }
            }else{
                return abort(404);
            }
        }else{
           return abort(404);
        }
    }
    public function update(Request $request){
        $data = file_get_contents('database/data.json');
        $json = json_decode($data, true);

        $this->validate($request, [
            'p_method' => 'nullable|regex:/[0-9]/',
            'p_condition' => 'nullable|regex:/[0-9]/',
            'OID' => 'required|min:8|max:10|regex:/[0-9]/',
            'remise' => 'nullable|regex:/[0-9]/',
            'status' => 'required|integer',
            'notes' => 'nullable|max:700',
        ], $message = [
            'required' => 'هذا الحقل مطلوب *',
            'regex' => 'يرجى التحقق من المدخلات *',
            'max' => 'يرجى التحقق من المدخلات *',
            'min' => 'يرجى التحقق من المدخلات *'

        ]);


        if(isset($request->status) && $request->status != '' && !isset($json['devis_status'][$request->status])){
            return response()->json(['errors' => ['status' => ['يرجى تحديد الحالة']]], 422);

        }
        if(isset($request->p_method) && $request->p_method != '' && !isset($json['p_method'][$request->p_method])){
            return response()->json(['errors' => ['p_method' => ['يرجى تحديد وسيلة الدفع']]], 422);

        }if(isset($request->p_condition) && $request->p_condition != '' && !isset($json['condition'][$request->p_condition]) && $request->p_condition != 0){
            return response()->json(['errors' => ['p_condition' => ['يرجى تحديد شروط الدفع']]], 422);

        }
        $success = false;
        $items = $request->items;
        $itemsen = json_decode($items);
        //echo $itemsen[0]->article;
        $article_c = count($itemsen);

        foreach ($itemsen as $itm) {
            $article = $itm->article;


            if ($itm->article == "") {
                return response()->json(['errors' => ['items' => ['يرجى التحقق من اسماء العناصر']]], 422);
            } elseif ($article < 3 && $article > 25) {
                return response()->json(['errors' => ['items' => ['يجب ان يتكون اسم العنصر من 3 أحرف على الأقل و 25 حرف كحد  أقصى ']]], 422);
            } elseif (!preg_match('/^[a-zàâçéèêëîïôûùüÿñæœ A-Z 0-9 ,. ]*$/', $itm->article)) {
                return response()->json(['errors' => ['items' => ['يرجى ادخال اسماء العناصر بالحروف اللاتينية']]], 422);
            } elseif (!is_numeric($itm->price)) {
                return response()->json(['errors' => ['items' => ['يجب أن يكون السعر عبارة عن رقم']]], 422);
            } elseif (!is_numeric($itm->quantity)) {
                return response()->json(['errors' => ['items' => ['يجب أن تكون الكمية عبارة عن رقم']]], 422);
            } elseif ($itm->quantity < 1) {
                return response()->json(['errors' => ['items' => ['لايمكن أن تكون الكمية 0']]], 422);
            } else {
                $success = true;
            }
        }

        /* UPDATE DATA */
        if ($success == true) {
            $OID = $request->OID;
            $stmt = desky_user_devis::where("OID", $request->OID)->where("email", Auth::user()->email)->update([
                'items' => $request->items,
                'remise' => $request->remise,
                'p_method' => $request->p_method,
                'p_condition' => $request->p_condition,
                'status' => $request->status,
            ]);
            if($stmt){
             $cache =  Cache::forget('desky_user_devis'.Auth::user()->id.'oid_'.$OID);
             if($cache){
                 return response()->json('تم تحديث البيانات', 201);
             }else{
                $cache =  Cache::forget('desky_user_devis'.Auth::user()->id.'oid_'.$OID);
                if($cache){
                    return response()->json('تم تحديث البيانات', 201);

                }else{
                    return response()->json('تم تحديث البيانات', 201);
                }
             }
            }else{
                return response()->json(['error' => 'فشل تحديث البيانات يرجى اعادة المحاولة'],417);

            }
        }
    }


    public function ShowDevis(Request $request)
    {
        if (isset($request->OID) && isset($request->UID) && $request->OID != "" && $request->UID != "") {
            if (is_numeric($request->OID) && is_numeric($request->UID)) {

                $OID = $request->OID;
                $DevisInfos = Cache::remember('desky_user_devis'.Auth::user()->id.'oid_'.$OID, 60*24*2, function() use($OID){
                    return DB::table('desky_user_devis')
                    ->join('desky_user_clients', 'desky_user_devis.CID', '=', 'desky_user_clients.CID')
                    ->select('desky_user_devis.*', 'desky_user_clients.CID', 'desky_user_clients.from', 'desky_user_clients.c_email', 'desky_user_clients.c_phone', 'desky_user_clients.c_name', 'desky_user_clients.c_type', 'desky_user_clients.c_ice', 'desky_user_clients.notes', 'desky_user_clients.country', 'desky_user_clients.city', 'desky_user_clients.adresse')
                    ->where('OID', $OID)
                    ->get();
                });
                $db_deskys = desky_db::all()->where("email", Auth::user()->email);
                $count = $DevisInfos->count();
                if ($count > 0) {
                    foreach ($DevisInfos as $DevisInfo);
                    foreach ($db_deskys as $db_desky);
                    return view("desky.panel.devis.view-devis", ['infos' => $DevisInfo, 'db_desky' => $db_desky]);
                } else {
                   abort(404);

                }

            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }
    public function CreateDevis(Request $request)
    {
        $PaymentSystemController = new PaymentSystemController;
        $data = file_get_contents('database/data.json');
        $json = json_decode($data, true);

        $this->validate($request, [
            'c_name' => 'required|min:5|max:20|regex:/^[\w\d\s ]*$/',
            'c_email' => 'required|string|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|max:220',
            'c_phone' => 'required|regex:/[0-9]{9}/',
            'c_ice' => 'nullable|min:15|max:17|regex:/[0-9]/',
            'c_type' => 'required|regex:/[0-9]/',
            'p_method' => 'nullable|regex:/[0-9]/',
            'p_condition' => 'nullable|regex:/[0-9]/',
            'OID' => 'required|min:8|max:10|regex:/[0-9]/',
            'remise' => 'nullable|integer|min:0|max:1000000|regex:/[0-9]/',
            'status' => 'required|integer',
            'notes' => 'nullable|max:700',
            'c_country' => 'nullable|max:6',
            'c_city' => 'nullable|min:4|max:25|regex:/^[\p{L} ]+$/u',
            'c_adresse' => 'nullable|min:7|max:40|regex:/^[\p{L}° ,0-9]+$/u'
        ], $message = [
            'required' => 'هذا الحقل مطلوب *',
            'regex' => 'يرجى التحقق من المدخلات *',
            'max' => 'المدخلات أطول من اللازم *',
            'min' => 'المدخلات أقصر من اللازم *',
            'email' => 'يرجى ادخال بريد الكتروني صالح *',
            'notes.max' => 'الحد الأقصى للملاحظات 700 حرف *'


        ]);
        if(!isset($json['type_clients'][$request->c_type])){
            return response()->json(['errors' => ['c_type' => ['يرجى تحديد نوع العميل']]], 422);

        }

        if(isset($request->status) && $request->status != '' && !isset($json['devis_status'][$request->status])){
            return response()->json(['errors' => ['status' => ['يرجى تحديد الحالة']]], 422);

        }
        if(isset($request->p_method) && $request->p_method != '' && !isset($json['p_method'][$request->p_method])){
            return response()->json(['errors' => ['p_method' => ['يرجى تحديد وسيلة الدفع']]], 422);

        }if(isset($request->p_condition) && $request->p_condition != '' && !isset($json['condition'][$request->p_condition]) && $request->p_condition != 0){
            return response()->json(['errors' => ['p_condition' => ['يرجى تحديد شروط الدفع']]], 422);

        }if(isset($request->country) && $request->country != ''){
            $countiesCheck = false;
            foreach($json['countries'] as $item){
               if($item['code'] == $request->c_country){
                   $countiesCheck = true;
               }
            }
            if($countiesCheck != true){
                return response()->json(['errors' => ['country' => ['يرجى تحديد بلد صالح']]], 422);

            }

        }

        $success = false;
        $email = Auth::user()->email;
        $products = Subscriptions::all()->where('email', $email);
        $points = 0;
        $unlimited = false;
        $PaymentSystemController = new PaymentSystemController;
        $CheckSubscriptions = $PaymentSystemController->CheckSubscriptions();
        $points = $CheckSubscriptions['points'];
        $unlimited = $CheckSubscriptions['unlimited'];
        if ($unlimited == true || $points > 0) {
            // return response()->json(['errors' => ['items' => ['يرجى التحقق من الحقول']]],422);
            $items = $request->items;
            $itemsen = json_decode($items);
            //echo $itemsen[0]->article;
            $article_c = count($itemsen);

            foreach ($itemsen as $itm) {
                $article = $itm->article;


                if ($itm->article == "") {
                    return response()->json(['errors' => ['items' => ['يرجى التحقق من اسماء العناصر']]], 422);
                } elseif ($article < 3 && $article > 25) {
                    return response()->json(['errors' => ['items' => ['يجب ان يتكون اسم العنصر من 3 أحرف على الأقل و 25 حرف كحد  أقصى ']]], 422);
                } elseif (!preg_match("/^[a-zA-ZÀÂÉÊÈËÌÏÎÔÙÛÇÆŒàâéêèëìïîôùûçæœ0-9 '-]{3,100}$/", $itm->article)) {
                    return response()->json(['errors' => ['items' => ['يرجى ادخال اسماء العناصر بالحروف اللاتينية']]], 422);
                } elseif (!is_numeric($itm->price)) {
                    return response()->json(['errors' => ['items' => ['يجب أن يكون السعر عبارة عن رقم']]], 422);
                } elseif (!is_numeric($itm->quantity)) {
                    return response()->json(['errors' => ['items' => ['يجب أن تكون الكمية عبارة عن رقم']]], 422);
                } elseif ($itm->quantity < 1) {
                    return response()->json(['errors' => ['items' => ['لايمكن أن تكون الكمية 0']]], 422);
                } else {
                    $success = true;
                }
            }
            if ($success == true) {
                $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
               $token_share = substr(str_shuffle($permitted_chars), 0, 24);

                $email = Auth::user()->email;
                $products = $products = DB::table('subscriptions')
                ->join(
                    'payment_systems',
                    'payment_systems.OID',
                    '=',
                    'subscriptions.OID'
                )
                ->select(
                    'subscriptions.*',
                    'payment_systems.status',
                    'payment_systems.code'
                )
                ->where('email', Auth::user()->email)
                ->where('payment_systems.buyer_email', Auth::user()->email)
                ->where('payment_systems.status', 1)
                ->get();
                $stop_minus = false;

                foreach ($products as $product) {
                    if ($product->pack_id == 1 && $product->type == "m") {
                        if ($product->point > 0) {
                            $olddate = $product->start_at;
                            $exdate = Carbon::parse($olddate)->addDays(31);
                            $timenow = date("Y-m-d H:i:s");
                            if ($timenow < $exdate) {
                                if ($stop_minus == false) {
                                    $points = $product->point;
                                    $editdata = array(
                                        'point' => ($points - 1)

                                    );
                                    DB::table('subscriptions')->where('id', $product->id)->update($editdata);
                                    $stop_minus = true;
                                }
                            }
                        }
                    }elseif ($product->pack_id == 1 && $product->type == "y") {
                        if ($product->point > 0) {
                            $olddate = $product->start_at;
                            $exdate = Carbon::parse($olddate)->addDays(366);
                            $timenow = date("Y-m-d H:i:s");
                            if ($timenow < $exdate) {
                                if ($stop_minus == false) {
                                    $points = $product->point;
                                    $editdata = array(
                                        'point' => ($points - 1)

                                    );
                                    DB::table('subscriptions')->where('id', $product->id)->update($editdata);
                                    $stop_minus = true;
                                }
                            }
                        }
                    } elseif ($product->pack_id == 2 && $product->type == "m") {
                        if ($product->point > 0) {

                            $olddate = $product->start_at;
                            $exdate = Carbon::parse($olddate)->addDays(31);
                            $timenow = date("Y-m-d H:i:s");
                            if ($stop_minus == false) {
                                $points = $product->point;
                                $editdata = array(
                                    'point' => ($points - 1)

                                );
                                DB::table('subscriptions')->where('id', $product->id)->update($editdata);
                                $stop_minus = true;
                            }
                        }
                    }elseif ($product->pack_id == 2 && $product->type == "y") {
                        if ($product->point > 0) {

                            $olddate = $product->start_at;
                            $exdate = Carbon::parse($olddate)->addDays(366);
                            $timenow = date("Y-m-d H:i:s");
                            if ($stop_minus == false) {
                                $points = $product->point;
                                $editdata = array(
                                    'point' => ($points - 1)

                                );
                                DB::table('subscriptions')->where('id', $product->id)->update($editdata);
                                $stop_minus = true;
                            }
                        }
                    } elseif ($product->pack_id == 3 && $product->type == "m") {
                        $olddate = $product->start_at;
                        $exdate = Carbon::parse($olddate)->addDays(31);
                        $timenow = date("Y-m-d H:i:s");
                        if ($timenow < $exdate) {
                            $unlimited = true;
                        }
                    }elseif ($product->pack_id == 3 && $product->type == "y") {
                        $olddate = $product->start_at;
                        $exdate = Carbon::parse($olddate)->addDays(366);
                        $timenow = date("Y-m-d H:i:s");
                        if ($timenow < $exdate) {
                            $unlimited = true;
                        }
                    }
                }
                    $countclients = DB::table('desky_user_clients')
                    ->where("from", Auth::user()->email)
                    ->where(function($qe) use ($request){
                        $qe->where("c_email", $request->c_email)
                        ->orWhere("c_phone", $request->c_phone);
                    })->get();

                    $countclientsCount = $countclients->count();
                    if($countclientsCount > 0){
                        $stmt = DB::table('desky_user_clients')
                        ->where("from", Auth::user()->email)
                        ->where(function($qe) use ($request){
                            $qe->where("c_email", $request->c_email)
                            ->orWhere("c_phone", $request->c_phone);
                        })->update([
                            'c_email' => $request->c_email,
                            'c_name' => $request->c_name,
                            'c_phone' => $request->c_phone,
                            'c_ice' => $request->c_ice,
                            'c_type' => $request->c_type,
                            'country' => $request->c_country,
                            'city' => $request->c_city,
                            'adresse' => $request->c_adresse,

                            ]);
                            $go = 1;
                            if($go == 1){
                                foreach($countclients as $countclient);

                                $stmt = desky_user_devis::create([
                                    'OID' => $request->OID,
                                    'email' => Auth::user()->email,
                                    'UID' => Auth::user()->id,
                                    'CID' => $countclient->CID,
                                    'items' => $request->items,
                                    'remise' => $request->remise,
                                    'p_method' => $request->p_method,
                                    'p_condition' => $request->p_condition,
                                    'status' => $request->status,
                                    'notes' => $request->notes,
                                    'token_share' => $token_share
                                ]);
                                if($stmt){
                                   // Cache::forget('desky_user_devis'.Auth::user()->id);
                                    return response()->json(['sucess' => 'تم انشاء عرض الأسعار'], 220);
                                }else{
                                    return response()->json(['error' => 'fx0241 تعذر انشاء عرض الاسعار يرجى اعادة المحاولة'], 500);

                                }


                            }else{
                                return response()->json(['error' => 'fx0247 تعذر انشاء حساب للعميل يرجى اعادة المحاولة'], 500);

                            }
                    }else{
                        $CID = rand(111111111, 999999999);
                        $stmt = desky_user_clients::create([
                            'CID' => $CID,
                            'from' => Auth::user()->email,
                            'UID' => Auth::user()->id,

                            'c_email' => $request->c_email,
                            'c_name' => $request->c_name,
                            'c_phone' => $request->c_phone,
                            'c_ice' => $request->c_ice,
                            'c_type' => $request->c_type,
                            'country' => $request->c_country,
                            'city' => $request->c_city,
                            'adresse' => $request->c_adresse
                            ]);
                            if($stmt){
                                foreach($countclients as $countclient);


                                $stmt = desky_user_devis::create([
                                    'OID' => $request->OID,
                                    'email' => Auth::user()->email,
                                    'UID' => Auth::user()->id,
                                    'CID' => $CID,
                                    'items' => $request->items,
                                    'remise' => $request->remise,
                                    'p_method' => $request->p_method,
                                    'p_condition' => $request->p_condition,
                                    'status' => $request->status,
                                    'notes' => $request->notes,
                                    'token_share' => $token_share

                                ]);
                                if($stmt){
                                    return response()->json(['sucess' => 'تم انشاء عرض الأسعار'], 220);

                                }else{
                                    return response()->json(['error' => 'تعذر انشاء عرض الاسعار يرجى اعادة المحاولة'], 500);

                                }

                            }else{
                                return response()->json(['error' => 'تعذر انشاء حساب للعميل يرج اعادة المحاولة'], 500);

                            }
                    }

            }
        } else {
            return response()->json(['errors' => ['items' => ['رصيدك غير كاف لانشاء عرض الاسعار يرجى تجديد اشتراكك']]], 422);
        }
    }

    public function ListDevis(Request $request)
    {

            if (isset($request->search) && $request->search == true) {
                $term = $request->s_oid;
                $filterData = DB::table('desky_user_devis')
                ->join('desky_user_clients', 'desky_user_devis.CID', '=', 'desky_user_clients.CID')
                ->select('desky_user_devis.*', 'desky_user_clients.c_name', 'desky_user_clients.c_email', 'desky_user_clients.c_phone')
                ->where("desky_user_devis.email", Auth::user()->email)

                ->where('desky_user_clients.c_name', 'LIKE', '%' . $request->s_name . '%')
                ->where('desky_user_clients.c_email', 'LIKE', '%' . $request->s_email . '%')
                ->where('desky_user_devis.OID', 'LIKE', '%' . $request->s_oid . '%')
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
                $infos = DB::table('desky_user_devis')
                ->join('desky_user_clients', 'desky_user_devis.CID', '=', 'desky_user_clients.CID')
                ->select('desky_user_devis.*', 'desky_user_clients.c_name', 'desky_user_clients.c_email', 'desky_user_clients.c_phone')
                    ->where("desky_user_devis.email", Auth::user()->email)
                    ->where('desky_user_devis.OID', 'LIKE', '%' . $request->s_oid . '%')
                    ->where('desky_user_clients.c_name', 'LIKE', '%' . $request->s_name . '%')
                    ->where('desky_user_clients.c_email', 'LIKE', '%' . $request->s_email . '%')
                    ->get();
                $count = $infos->count();
                if (isset($request->page) && $request->page != "") {
                    $pagenow = intval($request->page);
                } else {
                    $pagenow = 1;
                }
                return  response()->json([ $filterData, 'count' => $count, 'pagenow' => $pagenow], 200);
            } else {
                $stmt = DB::table('desky_user_devis')
                ->join('desky_user_clients', 'desky_user_devis.CID', '=', 'desky_user_clients.CID')
                ->select('desky_user_devis.*', 'desky_user_clients.c_name', 'desky_user_clients.c_email', 'desky_user_clients.c_phone')
                ->where('email', Auth::user()->email)
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
              //  ;
                $count = DB::table('desky_user_devis')
                ->join('desky_user_clients', 'desky_user_devis.CID', '=', 'desky_user_clients.CID')
                ->select('desky_user_devis.*', 'desky_user_clients.c_name', 'desky_user_clients.c_email', 'desky_user_clients.c_phone')
                ->where('email', Auth::user()->email)->count();
                if (isset($request->page) && $request->page != "") {
                    $pagenow = intval($request->page);
                } else {
                    $pagenow = 1;
                }
                return  response()->json([$stmt, 'count' => $count, 'pagenow' => $pagenow], 200);
            }



    }
    public function GetLastDevisNumber(){
        $stmt = desky_user_devis::where("email", Auth::user()->email)->max("OID");
        return response()->json($stmt);
    }
}
