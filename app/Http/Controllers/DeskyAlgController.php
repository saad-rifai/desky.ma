<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscriptions;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Environment\Console;
use App\desky_user_devis;
use Illuminate\Support\Facades\DB;
use App\desky_db;
use App\desky_user_clients;
use App\DeskyUserFacture;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\PaymentSystemController;
use App\MyCart;
use Devis;

class DeskyAlgController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getUserTvaPercentage(){
        $datas = desky_db::where('email', Auth::user()->email)->get(['tva']);
        if(count($datas) > 0){
            foreach($datas as $data);
            return response()->json(['tva'=> floatval($data->tva)], 200);
        }else{
            return response()->json(['tva' => 0], 202);
        }

    }

    public function UpdateNotes(Request $request){

        if(isset($request->token) && $request->token != ""){
            if((isset($request->d) && $request->d != "" && isset($request->oid) && $request->oid != "" && isset($request->notes) && $request->notes != "")){
                if($request->d == "d" || $request->d == "f"){
                    $d=$request->d;
                    $OID=$request->oid;
                    $notes= htmlspecialchars($request->notes);
                    if( mb_strlen($notes, 'UTF-8') <= 1500){


                    if($d == "d"){
                       $stmt = desky_user_devis::where('email' , Auth::user()->email)->where('OID', $OID)->update(['notes' => $notes]);
                       if($stmt){
                        $cach = Cache::forget('desky_user_devis'.Auth::user()->id.'oid_'.$OID);
                        if($cach){
                            return response()->json(['success' => 'تم تحديث الملاحظات'], 200);
                        }else{
                        $cach = Cache::forget('desky_user_devis'.Auth::user()->id.'oid_'.$OID);
                            if($cach){
                                return response()->json(['success' => 'تم تحديث الملاحظات'], 200);
                            }else{
                                return response()->json(['success' => ' تم تحديث البيانات لكن لم ينجح النظام في تفريغ الذاكرة المؤقة'], 200);
                            }
                        }
                       }else{
                           return response()->json(['error' => 'حصل خطأ في تحديث الملاحظات fx0054'], 500);
                       }

                       return response()->json($stmt);
                    }elseif($d == "f"){

                        $stmt = DeskyUserFacture::where('email' , Auth::user()->email)->where('OID', $OID)->update(['notes' => $notes]);
                        if($stmt){
                         $cach = Cache::forget('desky_user_facture'.Auth::user()->id.'oid_'.$OID);
                         if($cach){
                             return response()->json(['success' => 'تم تحديث الملاحظات'], 200);
                         }else{
                         $cach = Cache::forget('desky_user_facture'.Auth::user()->id.'oid_'.$OID);
                             if($cach){
                                 return response()->json(['success' => 'تم تحديث الملاحظات'], 200);
                             }else{
                                 return response()->json(['success' => ' تم تحديث البيانات لكن لم ينجح النظام في تفريغ الذاكرة المؤقة'], 200);
                             }
                         }
                        }else{
                            return response()->json(['error' => 'حصل خطأ في تحديث الملاحظات fx0054'], 500);
                        }

                        return response()->json($stmt);

                    }
                }else{
                    return response()->json(['error' => 'الملاحظات أطول من اللازم الحد الأقصى المسموح به 1500 حرف'], 402);

                }
                }else{
                    return response()->json(['error' => 'forbidden'], 403);

                }
            }else{
                return response()->json(['error' => 'forbidden'], 403);

            }

        }else{
            return response()->json(['error' => 'forbidden '], 403);
        }
    }





    public function getnotes(Request $request){
        if(isset($request->t) && $request->t != "" && isset($request->OID) && $request->OID != "" && is_numeric($request->OID)){
            if(isset($request->d) && $request->d != ""){
                if($request->d == "d"){
                    $OID=$request->OID;
                    $stmt = DB::table('desky_user_devis')->where('email' , Auth::user()->email)->where('OID', $OID)->get('notes');
                    return response()->json($stmt);
                }elseif($request->d == "f"){
                    $OID=$request->OID;
                    $stmt = DB::table('desky_user_factures')->where('email' , Auth::user()->email)->where('OID', $OID)->get('notes');
                    return response()->json($stmt);
                }

            }



        }else{
            abort(400);
        }
        //return response()->json(['error' => 'تم الاتصال ولكن النظام غير جاهز'],402);
    }
    public function deleteDocumment(Request $request){

        if(isset($request->token) && $request->token != ""){
            if((isset($request->d) && $request->d != "" && isset($request->oid) && $request->oid != "")){
                if($request->d == "d" || $request->d == "f"){
                    $d=$request->d;
                    $OID=$request->oid;
                    $ns=$request->ns;
                    if($d == "d"){
                       $stmt = desky_user_devis::where('email' , Auth::user()->email)->where('OID', $OID)->delete();
                       if($stmt){
                        $cach = Cache::forget('desky_user_devis'.Auth::user()->id.'oid_'.$OID);
                        if($cach){
                            return response()->json(['success' => 'تم تحديث البيانات'], 200);
                        }else{
                            $cach = Cache::forget('desky_user_devis'.Auth::user()->id.'oid_'.$OID);
                            if($cach){
                                return response()->json(['success' => 'تم تحديث البيانات'], 200);
                            }else{
                                return response()->json(['success' => ' تم تحديث البيانات لكن لم ينجح النظام في تفريغ الذاكرة المؤقة'], 200);
                            }
                        }
                       }else{
                           return response()->json(['error' => 'حصل خطأ في تحديث البيانات fx0043'], 500);
                       }

                       return response()->json($stmt);
                    }elseif($d == "f"){

                        $stmt = DeskyUserFacture::where('email' , Auth::user()->email)->where('OID', $OID)->delete();
                        if($stmt){
                         $cach = Cache::forget('desky_user_facture'.Auth::user()->id.'oid_'.$OID);
                         if($cach){
                             return response()->json(['success' => 'تم تحديث البيانات'], 200);
                         }else{
                             $cach = Cache::forget('desky_user_facture'.Auth::user()->id.'oid_'.$OID);
                             if($cach){
                                 return response()->json(['success' => 'تم تحديث البيانات'], 200);
                             }else{
                                 return response()->json(['success' => ' تم تحديث البيانات لكن لم ينجح النظام في تفريغ الذاكرة المؤقة'], 200);
                             }
                         }
                        }else{
                            return response()->json(['error' => 'حصل خطأ في تحديث البيانات fx0043'], 500);
                        }

                        return response()->json($stmt);



                    }

                }else{
                    return response()->json(['error' => 'forbidden'], 403);

                }
            }else{
                return response()->json(['error' => 'forbidden'], 403);

            }

        }else{
            return response()->json(['error' => 'forbidden '], 403);
        }
    }
    public function changeStatus(Request $request){

        if(isset($request->token) && $request->token != "" && isset($request->ns)){
            if((isset($request->d) && $request->d != "" && isset($request->oid) && $request->oid != "")){
                if($request->d == "d" || $request->d == "f"){
                    $d=$request->d;
                    $OID=$request->oid;
                    $ns=$request->ns;
                    if($d == "d"){
                       $stmt = desky_user_devis::where('email' , Auth::user()->email)->where('OID', $OID)->update(['status' => $ns]);
                       if($stmt){
                        $cach = Cache::forget('desky_user_devis'.Auth::user()->id.'oid_'.$OID);
                        if($cach){
                            return response()->json(['success' => 'تم تحديث البيانات'], 200);
                        }else{
                        $cach = Cache::forget('desky_user_devis'.Auth::user()->id.'oid_'.$OID);
                            if($cach){
                                return response()->json(['success' => 'تم تحديث البيانات'], 200);
                            }else{
                                return response()->json(['success' => ' تم تحديث البيانات لكن لم ينجح النظام في تفريغ الذاكرة المؤقة'], 200);
                            }
                        }
                       }else{
                           return response()->json(['error' => 'حصل خطأ في تحديث البيانات fx0043'], 500);
                       }

                       return response()->json($stmt);
                    }elseif($d == "f"){
                        $stmt = DeskyUserFacture::where('email' , Auth::user()->email)->where('OID', $OID)->update(['status' => $ns]);
                        if($stmt){
                         $cach = Cache::forget('desky_user_facture'.Auth::user()->id.'oid_'.$OID);
                         if($cach){
                             return response()->json(['success' => 'تم تحديث البيانات'], 200);
                         }else{
                         $cach = Cache::forget('desky_user_facture'.Auth::user()->id.'oid_'.$OID);
                             if($cach){
                                 return response()->json(['success' => 'تم تحديث البيانات'], 200);
                             }else{
                                 return response()->json(['success' => ' تم تحديث البيانات لكن لم ينجح النظام في تفريغ الذاكرة المؤقة'], 200);
                             }
                         }
                        }else{
                            return response()->json(['error' => 'حصل خطأ في تحديث البيانات fx0043'], 500);
                        }

                        return response()->json($stmt);
                    }

                }else{
                    return response()->json(['error' => 'forbidden'], 403);

                }
            }else{
                return response()->json(['error' => 'forbidden'], 403);

            }

        }else{
            return response()->json(['error' => 'forbidden '], 403);
        }
    }
    public function StatusOfDocument(Request $request){
        if(isset($request->_token) && $request->_token != ""){
            if((isset($request->d) && $request->d != "" && isset($request->oid) && $request->oid != "")){
                if($request->d == "d" || $request->d == "f"){
                    /*
                    d = Devis
                    f = Facture
                    */
                    $d=$request->d;
                    $OID=$request->oid;
                    if($d == "d"){
                       $stmt = desky_user_devis::where('email' , Auth::user()->email)->where('OID', $OID)->get(['status', 'token_share']);

                       return response()->json($stmt);

                    }elseif($d == "f"){

                        $stmt = DeskyUserFacture::where('email' , Auth::user()->email)->where('OID', $OID)->get(['status', 'token_share']);

                        return response()->json($stmt);
                    }

                }else{
                    return response()->json(['error' => 'forbidden'], 403);

                }
            }else{
                return response()->json(['error' => 'forbidden'], 403);

            }

        }else{
            return response()->json(['error' => 'forbidden '], 403);
        }
    }

    public function GetDeskyUser(){
        $infos = Cache::remember('user_desky_infos_'.Auth::user()->id, 60*24*15, function(){
            return desky_db::all()->where("email" , Auth::user()->email);

        });
        $count = $infos->count();
        if($count > 0){
            foreach($infos as $info);
        }else{
            $info = [];
        }
        return response()->json($info, 200);
    }


    public function index()
    {
        $infos = desky_db::all()->where("email", Auth::user()->email);
        $count = $infos->count();
        if ($count > 0) {
          //  $products = Subscriptions::all()->where("email", Auth::user()->email);
          //  $points = 0;
            $currentMonth = date("m");
           // $devis = DB::table('desky_user_devis')->where("email", Auth::user()->email)->whereMonth('created_at', Carbon::now()->month);
            //$n_devis_t_m = $devis->count();
//$product = null;

            return view("desky.panel.index");
        } else {
            return view("desky/panel/register-infos");
        }
    }
    public function c_more_desky_infos(Request $request)
    {
        $this->validate(
            $request,
            [
                'b_email' => 'required|email',
                'b_phone' => 'required|regex:/[0-9]{9}/',
                'bank_account_name' => 'required|max:35|min:6|regex:/^[\w\d\s.,-]*$/',
                'bank_name' => 'required|min:3|max:35|regex:/^[\w\d\s.,-]*$/',
                'bank_rib' => 'required|min:24|max:24|regex:/^[0-9]+$/',
                'brand_color' => 'required|min:3|max:10|regex:/^[\p{L} 0-9 #]+$/u',
                'ice' => 'required|regex:/^[0-9]+$/|min:15|max:17',
                'logo' => 'nullable|mimes:jpg,jpeg,png|max:120',
                'sector' => 'required|min:1|max:1|regex:/[0-9]/',
                'siteweb' => "nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/",
                'u_if' => 'required|min:6|max:11|regex:/^[0-9]+$/',
                'u_tp' => 'required|min:6|max:11|regex:/^[0-9]+$/',
                'cni' => 'required|min:4|max:8|regex:/^[\w\d\s0-9]*$/',
                'slogan' => 'nullable|min:8|max:35|regex:/^[\w\d\s.,-]*$/',
                'description' => 'nullable|min:20|max:500',
                'recaptcha_token' => 'required|recaptcha',
                'adresse' => 'nullable|min:5|max:45|regex:/^[\w\d\s ,°]*$/'

            ],
            $message = [
                'recaptcha_token.required' => 'يرجى التحقق من الكابشا *',
                'required' => 'هذا الحقل مطلوب *',
                'b_phone.regex' => 'يرجى ادخال رقم هاتف صالح Ex: 0600000000 *',
                'email.email' => 'يرجى ادخال بريد الكتروني صالح exmple@exmple.com *',
                /* */
                'bank_account_name.regex' => 'يرجى ادخال اسم حساب صالح *',
                'bank_account_name.min' => 'الاسم المدخل أقصر من اللازم *',
                'bank_account_name.max' => 'الاسم المدخل أطول من اللازم *',
                /* BANK ACCOUNT */
                'bank_name.regex' => 'يرجى ادخال اسم بنك صالح *',
                'bank_name.min' => 'الاسم المدخل أقصر من اللازم *',
                'bank_name.max' => 'الاسم المدخل أطول من اللازم *',
                /* RIB */
                'bank_rib.regex' => 'يرجى ادخال رقم تعريف بنكي صالح *',
                'bank_rib.max' => 'رقم التعريف البنكي أطول من اللازم يجب أن يتكون من 24 رقم *',
                'bank_rib.min' => 'رقم التعريف البنكي أقصر من اللازم يجب أن يتكون من 24 رقم *',
                /* ICE */
                'ice.regex' => 'يرجى ادخال رقم موحد للمقاول الذاتي صالح يجب أن يتكون من الأرقام فقط *',
                'ice.max' => 'رقم الموحد للمقاول الذاتي أطول من اللازم *',
                'ice.min' => 'رقم الموحد للمقاول الذاتي أقصر من اللازم *',
                /* logofile */
                'logo.mimes' => 'هذا الملف غير مدعوم يسمح فقط بي (jpg, png, jpeg) *',
                'logo.max' => 'هذا الملف أكبر من اللازم الحد الأقصى 100KB *',
                /* siteweb */
                'siteweb.regex' => 'يرجى ادخال موقع الكتروني صالح (مثال: www.desky.ma) *',
                /* IF */
                'u_if.regex' => 'يجب أن يتكون رقم التعريف التضريبي من الأرقام فقط *',
                'u_if.max' => 'رقم التعريف الضريبي أطول من اللازم *',
                'u_if.min' => 'رقم التعريف الضريبي أقصر من اللازم *',
                /* TP */
                'u_tp.regex' => 'يجب أن يتكون رقم الضريبة المهينة من الأرقام فقط *',
                'u_tp.max' => 'رقم الضريبة المهينة أطول من اللازم *',
                'u_tp.min' => 'رقم الضريبة المهينة أقصر من اللازم *',
                /* CNI */
                'cni.regex' => 'يرجى التحقق من رقم بطاقة الهوية *',
                'cni.max' => 'رقم بطاقة الهوية أطول من اللازم *',
                'cni.min' => 'رقم بطاقة الهوية أقصر من اللازم *',
                /* CNI */
                'slogan.regex' => 'يرجى التحقق من المدخلات يجب ان يكون اسم المهنة باللغة الفرسية (مثال: Graphic Designer) *',
                'slogan.max' => 'اسم المهنة أطول من اللازم *',
                'slogan.min' => 'اسم المهنة أقصر من اللازم *',
                /* description */
                'description.max' => 'الوصف أطول من اللازم *',
                'description.min' => 'الوصف أقصر من اللازم *',


            ]
        );
        $sector = $request->sector;

        if ($sector >= 0 && $sector < 4) {
            if($sector == 0){
                $tva = 0.5;
            }elseif($sector == 1){
                $tva = 1;

            }elseif($sector == 2){
                $tva = 0.5;

            }elseif($sector == 3){
                $tva = 0.5;

            }
            function generateRandomString($length)
            {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }

                return $randomString;
            }
            if ($request->logo) {
                /** ID IMAGE UPLOAD */
                $destinationPath_i = 'storage/desky/users/logo' . date('Y');
                $file = $request->logo;
                // GET THE FILE EXTENSION
                $extension_i = $file->getClientOriginalExtension();
                // RENAME THE UPLOAD WITH RANDOM NUMBER
                $idfile = generateRandomString(25) . '.' . $extension_i;
                // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
                $upload_success = $file->move($destinationPath_i, $idfile);
                $logofilename = $destinationPath_i . '/' . $idfile;
                if ($upload_success) {
                    $stmt = desky_db::create([
                        'email' => Auth::user()->email,
                        'b_email' => $request->b_email,
                        'b_phone' => $request->b_phone,
                        'compte_bank_username' => $request->bank_account_name,
                        'compte_bank_name' => $request->bank_name,
                        'compte_bank_rib' => $request->bank_rib,
                        'brandcolor' => $request->brand_color,
                        'ice' => $request->ice,
                        'logo' => $logofilename,
                        'sector' => $request->sector,
                        'siteweb' => $request->siteweb,
                        'if' => $request->u_if,
                        'tp' => $request->u_tp,
                        'cni' => $request->cni,
                        'tva' => $tva,
                        'slogon' => $request->slogan,
                        'description' => $request->description,
                        'model_devis' => 0,
                        'model_facture' => 0,
                        'adresse' => $request->adresse



                    ]);
                    if ($stmt) {
                        return response()->json(['success' => ['logo' => ['قد فشل تحميل الملف يرجى اعادة تحميل الصفحة اذا استمر معك المشكل يرجى التواصل معنا']]], 201);
                    } else {
                        return response()->json(['errors' => ['form' => ['قد فشل حفظ المعطيات يرجى اعادة المحاولة لاحقاَ اذا استمر معك المشكل يرجى التواصل معنا']]], 422);
                    }
                } else {
                    return response()->json(['errors' => ['logo' => ['قد فشل تحميل الملف يرجى اعادة تحميل الصفحة اذا استمر معك المشكل يرجى التواصل معنا']]], 422);
                }
            } else {
                $stmt = desky_db::create([
                    'email' => Auth::user()->email,
                    'b_email' => $request->b_email,
                    'b_phone' => $request->b_phone,
                    'compte_bank_username' => $request->bank_account_name,
                    'compte_bank_name' => $request->bank_name,
                    'compte_bank_rib' => $request->bank_rib,
                    'brandcolor' => $request->brand_color,
                    'ice' => $request->ice,
                    'sector' => $request->sector,
                    'siteweb' => $request->siteweb,
                    'if' => $request->u_if,
                    'tp' => $request->u_tp,
                    'cni' => $request->cni,
                    'tva' => $tva,
                    'slogon' => $request->slogan,
                    'description' => $request->description,
                    'model_devis' => 0,
                    'model_facture' => 0,
                    'adresse' => $request->adresse



                ]);
                if ($stmt) {
                    return response()->json(['success' => ['logo' => ['قد فشل تحميل الملف يرجى اعادة تحميل الصفحة اذا استمر معك المشكل يرجى التواصل معنا']]], 201);
                } else {
                    return response()->json(['errors' => ['form' => ['قد فشل حفظ المعطيات يرجى اعادة المحاولة لاحقاَ اذا استمر معك المشكل يرجى التواصل معنا']]], 422);
                }
            }
        } else {
            return response()->json(['errors' => ['sector' => ['لقد حصل خطأ ما يرجى اعادة تحميل الصفحة']]], 422);
        }
    }
    public function update_user_infos(Request $request){

        $datajson = file_get_contents('database/data.json');
        $jsondata = json_decode($datajson, true);
        $this->validate(
            $request,
            [
                'b_email' => 'required|email',
                'b_phone' => 'required|regex:/[0-9]{9}/',
                'bank_account_name' => 'required|max:35|min:6|regex:/^[\w\d\s.,-]*$/',
                'bank_name' => 'required|min:3|max:35|regex:/^[\w\d\s.,-]*$/',
                'bank_rib' => 'required|min:24|max:24|regex:/^[0-9]+$/',
                'brand_color' => 'required|min:3|max:10|regex:/^[\p{L} 0-9 #]+$/u',
                'ice' => 'required|regex:/^[0-9]+$/|min:15|max:17',
                'logo' => 'nullable|mimes:jpg,jpeg,png|max:120',
                'sector' => 'required|min:1|max:1|regex:/[0-9]/',
                'siteweb' => "nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/",
                'u_if' => 'required|min:6|max:11|regex:/^[0-9]+$/',
                'u_tp' => 'required|min:6|max:11|regex:/^[0-9]+$/',
                'cni' => 'required|min:4|max:8|regex:/^[\w\d\s0-9]*$/',
                'slogan' => 'nullable|min:8|max:35|regex:/^[\w\d\s.,-]*$/',
                'description' => 'nullable|min:15|max:500',
                'adresse' => 'nullable|min:5|max:45|regex:/^[\w\d\s ,°]*$/'
            ],
            $message = [
                'recaptcha_token.required' => 'يرجى التحقق من الكابشا *',
                'required' => 'هذا الحقل مطلوب *',
                'b_phone.regex' => 'يرجى ادخال رقم هاتف صالح Ex: 0600000000 *',
                'email.email' => 'يرجى ادخال بريد الكتروني صالح exmple@exmple.com *',
                /* */
                'bank_account_name.regex' => 'يرجى ادخال اسم حساب صالح *',
                'bank_account_name.min' => 'الاسم المدخل أقصر من اللازم *',
                'bank_account_name.max' => 'الاسم المدخل أطول من اللازم *',
                /* BANK ACCOUNT */
                'bank_name.regex' => 'يرجى ادخال اسم بنك صالح *',
                'bank_name.min' => 'الاسم المدخل أقصر من اللازم *',
                'bank_name.max' => 'الاسم المدخل أطول من اللازم *',
                /* RIB */
                'bank_rib.regex' => 'يرجى ادخال رقم تعريف بنكي صالح *',
                'bank_rib.max' => 'رقم التعريف البنكي أطول من اللازم يجب أن يتكون من 24 رقم *',
                'bank_rib.min' => 'رقم التعريف البنكي أقصر من اللازم يجب أن يتكون من 24 رقم *',
                /* ICE */
                'ice.regex' => 'يرجى ادخال رقم موحد للمقاول الذاتي صالح يجب أن يتكون من الأرقام فقط *',
                'ice.max' => 'رقم الموحد للمقاول الذاتي أطول من اللازم *',
                'ice.min' => 'رقم الموحد للمقاول الذاتي أقصر من اللازم *',
                /* logofile */
                'logo.mimes' => 'هذا الملف غير مدعوم يسمح فقط بي (jpg, png, jpeg) *',
                'logo.max' => 'هذا الملف أكبر من اللازم الحد الأقصى 80KB *',
                /* siteweb */
                'siteweb.regex' => 'يرجى ادخال موقع الكتروني صالح (مثال: www.desky.ma) *',
                /* IF */
                'u_if.regex' => 'يجب أن يتكون رقم التعريف التضريبي من الأرقام فقط *',
                'u_if.max' => 'رقم التعريف الضريبي أطول من اللازم *',
                'u_if.min' => 'رقم التعريف الضريبي أقصر من اللازم *',
                /* TP */
                'u_tp.regex' => 'يجب أن يتكون رقم الضريبة المهينة من الأرقام فقط *',
                'u_tp.max' => 'رقم الضريبة المهينة أطول من اللازم *',
                'u_tp.min' => 'رقم الضريبة المهينة أقصر من اللازم *',
                /* CNI */
                'cni.regex' => 'يرجى التحقق من رقم بطاقة الهوية *',
                'cni.max' => 'رقم بطاقة الهوية أطول من اللازم *',
                'cni.min' => 'رقم بطاقة الهوية أقصر من اللازم *',
                /* CNI */
                'slogan.regex' => 'يرجى التحقق من المدخلات يجب ان يكون الشعار بالغة الفرسية (مثال: Graphic Designer) *',
                'slogan.max' => 'الشعار أطول من اللازم *',
                'slogan.min' => 'الشعار أقصر من اللازم *',
                /* description */
                'description.max' => 'الوصف أطول من اللازم *',
                'description.min' => 'الوصف أقصر من اللازم *',
                /* Adresse */
                'adresse.min' => 'العنوان أقصر من اللازم *',
                'adresse.max' => 'العنوان أطول من اللازم *',
                'adresse.regex' => 'يرجى التحقق من المدخلات مسموح فقط بالأحرف الفرسية *',


            ]
        );


        $sector = $request->sector;

        if ($sector >= 0 && $sector < 4) {
            if($sector == 0){
                $tva = 0.5;
            }elseif($sector == 1){
                $tva = 1;

            }elseif($sector == 2){
                $tva = 0.5;

            }elseif($sector == 3){
                $tva = 0.5;

            }
            if(!isset($jsondata['devis_template'][$request->model_devis])){
                return response()->json(['erorr' => ['model_devis' => ['نموذج عرض الاسعار غير موجود حطأ رقم fx0024789']]], 500);

            }
            function generateRandomString($length)
            {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }

                return $randomString;
            }
            if ($request->logo && $request->logo != '' && $request->logo != null) {
                /** ID IMAGE UPLOAD */
                $destinationPath_i = 'storage/desky/users/logo' . date('Y');
                $file = $request->logo;
                // GET THE FILE EXTENSION
                $extension_i = $file->getClientOriginalExtension();
                // RENAME THE UPLOAD WITH RANDOM NUMBER
                $idfile = generateRandomString(25) . '.' . $extension_i;
                // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
                $upload_success = $file->move($destinationPath_i, $idfile);
                $logofilename = $destinationPath_i . '/' . $idfile;
                if ($upload_success) {
                    $stmt = desky_db::where("email", Auth::user()->email)->update([
                        'email' => Auth::user()->email,
                        'b_email' => $request->b_email,
                        'b_phone' => $request->b_phone,
                        'compte_bank_username' => $request->bank_account_name,
                        'compte_bank_name' => $request->bank_name,
                        'compte_bank_rib' => $request->bank_rib,
                        'brandcolor' => $request->brand_color,
                        'ice' => $request->ice,
                        'logo' => $logofilename,
                        'sector' => $request->sector,
                        'siteweb' => $request->siteweb,
                        'if' => $request->u_if,
                        'tp' => $request->u_tp,
                        'cni' => $request->cni,
                        'tva' => $tva,
                        'slogon' => $request->slogan,
                        'description' => $request->description,
                        'model_devis' => $request->model_devis,
                        'model_facture' => $request->model_facute,
                        'adresse' => $request->adresse

                    ]);
                    if ($stmt) {
                        $clearCache = Cache::forget('user_desky_infos_'.Auth::user()->id);
                        if($clearCache){
                            return response()->json(['success' =>  ['قد تحديث البيانات بنجاح !']], 201);
                        }else{
                            return response()->json(['error' => ['قد حصل خطأ أثناء محاولة تحديث البيانات رقم الخطأ fx00701']], 418);

                        }
                        return response()->json(['success' =>  ['قد تحديث البيانات بنجاح !']], 201);
                    } else {
                        return response()->json(['error' => ['form' => ['قد فشل حفظ المعطيات يرجى اعادة المحاولة لاحقاَ اذا استمر معك المشكل يرجى التواصل معنا']]], 418);
                    }
                } else {
                    return response()->json(['error' => ['logo' => ['قد فشل تحميل الملف يرجى اعادة تحميل الصفحة اذا استمر معك المشكل يرجى التواصل معنا']]], 418);
                }
            }elseif(isset($request->removeLogo) && $request->removeLogo == true) {
                $stmt = desky_db::where("email", Auth::user()->email)->update([
                    'email' => Auth::user()->email,
                    'b_email' => $request->b_email,
                    'b_phone' => $request->b_phone,
                    'compte_bank_username' => $request->bank_account_name,
                    'compte_bank_name' => $request->bank_name,
                    'compte_bank_rib' => $request->bank_rib,
                    'brandcolor' => $request->brand_color,
                    'ice' => $request->ice,
                    'sector' => $request->sector,
                    'siteweb' => $request->siteweb,
                    'if' => $request->u_if,
                    'tp' => $request->u_tp,
                    'cni' => $request->cni,
                    'tva' => $tva,
                    'slogon' => $request->slogan,
                    'description' => $request->description,
                    'model_devis' => $request->model_devis,
                    'model_facture' => $request->model_facute,
                    'adresse' => $request->adresse,
                    'logo' => null


                ]);
                if ($stmt) {
                    $clearCache = Cache::forget('user_desky_infos_'.Auth::user()->id);

                        return response()->json(['success' =>  ['قد تحديث البيانات بنجاح !']], 201);

                } else {
                    return response()->json(['errors' => ['form' => ['قد فشل حفظ المعطيات يرجى اعادة المحاولة لاحقاَ اذا استمر معك المشكل يرجى التواصل معنا']]], 422);
                }
            } else {
                $stmt = desky_db::where("email", Auth::user()->email)->update([
                    'email' => Auth::user()->email,
                    'b_email' => $request->b_email,
                    'b_phone' => $request->b_phone,
                    'compte_bank_username' => $request->bank_account_name,
                    'compte_bank_name' => $request->bank_name,
                    'compte_bank_rib' => $request->bank_rib,
                    'brandcolor' => $request->brand_color,
                    'ice' => $request->ice,
                    'sector' => $request->sector,
                    'siteweb' => $request->siteweb,
                    'if' => $request->u_if,
                    'tp' => $request->u_tp,
                    'cni' => $request->cni,
                    'tva' => $tva,
                    'slogon' => $request->slogan,
                    'model_devis' => $request->model_devis,
                    'model_facture' => $request->model_facute,
                    'adresse' => $request->adresse,



                ]);
                if ($stmt) {
                    $clearCache = Cache::forget('user_desky_infos_'.Auth::user()->id);

                        return response()->json(['success' =>  ['قد تحديث البيانات بنجاح !']], 201);

                } else {
                    return response()->json(['errors' => ['form' => ['قد فشل حفظ المعطيات يرجى اعادة المحاولة لاحقاَ اذا استمر معك المشكل يرجى التواصل معنا']]], 422);
                }
            }
        } else {
            return response()->json(['errors' => ['sector' => ['لقد حصل خطأ ما يرجى اعادة تحميل الصفحة']]], 422);
        }








    }
    public function UserDeskyCleantsSearchGet(Request $request){
        if($request->method == 'n'){
            $key = $request->q;
            $stmt = DB::table('desky_user_clients')
            ->where('from', Auth::user()->email)
            ->where(function($qe) use ($key){
                $qe->where('c_name', 'LIKE', '%' . $key. '%')
                ->Orwhere('c_email', 'LIKE', '%' . $key . '%')
                ->Orwhere('c_phone', 'LIKE', '%' . $key. '%');

            })->orderBy('created_at', 'DESC')->get();


            return response()->json($stmt);
        }
    }



}
