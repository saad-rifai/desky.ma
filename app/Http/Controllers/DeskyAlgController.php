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
use Illuminate\Support\Carbon;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Cache;
class DeskyAlgController extends Controller
{
    use HasApiTokens;

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getpoints()
    {

    }
    public function GetLastDevisNumber(){
        $stmt = desky_user_devis::where("email", Auth::user()->email)->max("OID");
        return response()->json($stmt);
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
    public function CreateDevis(Request $request)
    {
        $data = file_get_contents('database/data.json');
        $json = json_decode($data, true);

        $this->validate($request, [
            'c_name' => 'required|min:5|max:20|regex:/^[\p{L} ]+$/u',
            'c_email' => 'required|string|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|max:80',
            'c_phone' => 'required|regex:/[0-9]{9}/',
            'c_ice' => 'nullable|min:15|max:17|regex:/[0-9]/',
            'c_type' => 'required|regex:/[0-9]/',
            'p_method' => 'nullable|regex:/[0-9]/',
            'p_condition' => 'nullable|regex:/[0-9]/',
            'OID' => 'required|min:8|max:10|regex:/[0-9]/',
            'remise' => 'nullable|integer|min:0|max:1000000',
            'status' => 'required|integer',
            'notes' => 'nullable|max:700',
            'c_country' => 'nullable|max:6',
            'c_city' => 'nullable|min:4|max:25|regex:/^[\p{L} ]+$/u',
            'c_adresse' => 'nullable|min:7|max:25|regex:/^[\p{L}° ,0-9]+$/u'
        ], $message = [
            'required' => 'هذا الحقل مطلوب *',
            'regex' => 'يرجى التحقق من المدخلات *',
            'max' => 'يرجى التحقق من المدخلات *',
            'min' => 'يرجى التحقق من المدخلات *'

        ]);
        if(!isset($json['type_clients'][$request->c_type])){
            return response()->json(['errors' => ['c_type' => ['يرجى تحديد نوع العميل']]], 422);

        }

        if(isset($request->status) && $request->status != '' && !isset($json['devis_status'][$request->status])){
            return response()->json(['errors' => ['status' => ['يرجى تحديد الحالة']]], 422);

        }
        if(isset($request->p_method) && $request->p_method != '' && !isset($json['p_method'][$request->p_method])){
            return response()->json(['errors' => ['p_method' => ['يرجى تحديد وسيلة الدفع']]], 422);

        }if(isset($request->p_condition) && $request->p_condition != '' && !isset($json['condition'][$request->p_condition])){
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
        foreach ($products as $product) {
            if ($product->pack_id == 1) {
                $olddate = $product->created_at;
                $exdate = $olddate->addDays(31);
                $timenow = date("Y-m-d H:i:s");
                if ($timenow < $exdate) {
                    $points = ($points + $product->point);
                }
            } elseif ($product->pack_id == 2) {
                $olddate = $product->created_at;
                $exdate = $olddate->addDays(121);
                $timenow = date("Y-m-d H:i:s");
                if ($timenow < $exdate) {
                    $points = + ($points + $product->point);
                }
            } elseif ($product->pack_id == 3) {
                $olddate = $product->created_at;
                $exdate = $olddate->addDays(365);
                $timenow = date("Y-m-d H:i:s");
                if ($timenow < $exdate) {
                    $points = + ($points + $product->point);
                    $unlimited = true;
                }
            }
        }
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
            if ($success == true) {
                $email = Auth::user()->email;
                $products = Subscriptions::all()->where('email', $email);
                $stop_minus = false;

                foreach ($products as $product) {
                    if ($product->pack_id == 1) {
                        if ($product->point > 0) {
                            $olddate = $product->created_at;
                            $exdate = $olddate->addDays(31);
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
                    } elseif ($product->pack_id == 2) {
                        if ($product->point > 0) {

                            $olddate = $product->created_at;
                            $exdate = $olddate->addDays(121);
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
                    } elseif ($product->pack_id == 3) {
                        $olddate = $product->created_at;
                        $exdate = $olddate->addDays(365);
                        $timenow = date("Y-m-d H:i:s");
                        if ($timenow < $exdate) {
                            $unlimited = true;
                        }
                    }
                }


                // DB::table('products')->where('email', Auth::user()->email)->update($editdata);


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
                            'adresse' => $request->c_adresse
                            ]);
                            if($stmt){
                                foreach($countclients as $countclient);
                                $stmt = desky_user_devis::create([
                                    'OID' => $request->OID,
                                    'email' => Auth::user()->email,
                                    'CID' => $countclient->CID,
                                    'items' => $request->items,
                                    'remise' => $request->remise,
                                    'p_method' => $request->p_method,
                                    'p_condition' => $request->p_condition,
                                    'status' => $request->status,
                                    'notes' => $request->notes
                                ]);
                                if($stmt){
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
                                $stmt = desky_user_devis::create([
                                    'OID' => $request->OID,
                                    'email' => Auth::user()->email,
                                    'CID' => $CID,
                                    'items' => $request->items,
                                    'remise' => $request->remise,
                                    'p_method' => $request->p_method,
                                    'p_condition' => $request->p_condition,
                                    'status' => $request->status,
                                    'notes' => $request->notes
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


                    //return response()->json(['errors' => ['items' => ['حصل خطأ ما يرجى اعادة تحميل الصفحة']]], 422);


            }
        } else {
            return response()->json(['errors' => ['items' => ['رصيدك غير كاف لانشاء عرض الاسعار يرجى تجديد اشتراكك']]], 422);
        }
    }
    public function ShowDevis(Request $request)
    {
        if ($request->OID != "") {
            if (is_numeric($request->OID)) {
                $OID = $request->OID;
                $DevisInfos = DB::table('desky_user_devis')
                ->join('desky_user_clients', 'desky_user_devis.CID', '=', 'desky_user_clients.CID')
                ->select('desky_user_devis.*', 'desky_user_clients.*')
                ->where('OID', $OID)
                ->get();

                $db_deskys = desky_db::all()->where("email", Auth::user()->email);
                $count = $DevisInfos->count();
                if ($count > 0) {
                    foreach ($DevisInfos as $DevisInfo);
                    foreach ($db_deskys as $db_desky);
                    return view("desky.panel.view-devis", ['infos' => $DevisInfo, 'db_desky' => $db_desky]);
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
    public function ListDevis(Request $request)
    {

            if (isset($request->search) && $request->search == true) {
                $term = $request->s_oid;
                $filterData = DB::table('desky_user_devis')
                ->join('desky_user_clients', 'desky_user_devis.CID', '=', 'desky_user_clients.CID')
                ->select('desky_user_devis.*', 'desky_user_clients.c_name', 'desky_user_clients.c_email', 'desky_user_clients.c_phone')
                ->where('desky_user_clients.c_name', 'LIKE', '%' . $request->s_name . '%')
                ->where('desky_user_clients.c_email', 'LIKE', '%' . $request->s_email . '%')
                ->where('desky_user_devis.OID', 'LIKE', '%' . $request->s_oid . '%')
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
                $infos = DB::table('desky_user_devis')
                ->join('desky_user_clients', 'desky_user_devis.CID', '=', 'desky_user_clients.CID')
                ->select('desky_user_devis.*', 'desky_user_clients.c_name', 'desky_user_clients.c_email', 'desky_user_clients.c_phone')
                    ->where("email", Auth::user()->email)
                    ->where('OID', 'LIKE', '%' . $request->s_oid . '%')
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
                $count = desky_user_devis::all()->where('email', Auth::user()->email)->count();
                if (isset($request->page) && $request->page != "") {
                    $pagenow = intval($request->page);
                } else {
                    $pagenow = 1;
                }
                return  response()->json([$stmt, 'count' => $count, 'pagenow' => $pagenow], 200);
            }



    }
    public function index()
    {
        $infos = desky_db::all()->where("email", Auth::user()->email);
        $count = $infos->count();
        if ($count > 0) {
            $products = Subscriptions::all()->where("email", Auth::user()->email);
            $points = 0;
            $currentMonth = date("m");
            $devis = DB::table('desky_user_devis')->where("email", Auth::user()->email)->whereMonth('created_at', Carbon::now()->month);
            $n_devis_t_m = $devis->count();
            $product = null;
            foreach($products as $product){
                $points += $product->point;
            }
            return view("desky.panel.index", ["points" => $points, "pr_infos" => $product, "n_devis_t_m" => $n_devis_t_m]);
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
                'slogan' => 'required|min:8|max:35|regex:/^[\w\d\s.,-]*$/',
                'description' => 'required|min:20|max:500',
                'recaptcha_token' => 'required|recaptcha'
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
                'slogan.regex' => 'يرجى التحقق من المدخلات يجب ان يكون الشعار بالغة الفرسية (مثال: Graphic Designer) *',
                'slogan.max' => 'الشعار أطول من اللازم *',
                'slogan.min' => 'الشعار أقصر من اللازم *',
                /* description */
                'description.max' => 'الوصف أطول من اللازم *',
                'description.min' => 'الوصف أقصر من اللازم *',


            ]
        );
        $sector = $request->sector;

        if ($sector > 0 && $sector < 5) {
            if($sector == 1){
                $tva = 0.5;
            }elseif($sector == 2){
                $tva = 1;

            }elseif($sector == 3){
                $tva = 0.5;

            }elseif($sector == 4){
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
                $destinationPath_i = 'image/desky/users/' . date("Y") . '/logos';
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
                        'model_facture' => 0


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
                    'model_facture' => 0


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
                'slogan' => 'required|min:8|max:35|regex:/^[\w\d\s.,-]*$/',
                'description' => 'required|min:15|max:500',
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


            ]
        );


        $sector = $request->sector;

        if ($sector > 0 && $sector < 5) {
            if($sector == 1){
                $tva = 0.5;
            }elseif($sector == 2){
                $tva = 1;

            }elseif($sector == 3){
                $tva = 0.5;

            }elseif($sector == 4){
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
                $destinationPath_i = 'image/desky/users/' . date("Y") . '/logos';
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
                        'model_devis' => $request->model_devis

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
                    'description' => $request->description,
                    'model_devis' => $request->model_devis


                ]);
                if ($stmt) {
                    $clearCache = Cache::forget('user_desky_infos_'.Auth::user()->id);
                    if($clearCache){
                        return response()->json(['success' =>  ['قد تحديث البيانات بنجاح !']], 201);
                    }else{
                        return response()->json(['error' => ['قد حصل خطأ أثناء محاولة تحديث البيانات رقم الخطأ fx00738']], 418);

                    }
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
