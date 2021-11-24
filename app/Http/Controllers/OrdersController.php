<?php

namespace App\Http\Controllers;

use App\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function GuzzleHttp\json_decode;
use Illuminate\Support\Facades\DB;
class OrdersController extends Controller
{
    public function create(Request $request){
       $this->validate($request, [
           'title' => 'required|string|max:180|min:10',
           'description' => 'required|string|max:2000|min:100',
           'sector' => 'required|integer|max:4|min:1',
           'activite'=> 'nullable|integer',
           'onlineCeck' => 'required|integer|max:2|min:1',
           'budget' => 'required|integer|max:500000|min:150',
           'time' => 'required|integer|max:180|min:1',
           'keywords' => 'nullable'
       ], $messages = [
        'required' => 'هذا الحقل مطلوب *',
        'sector.min' => 'يرجى تحديد القطاع *',
        'sector.max' => 'يرجى تحديد القطاع *',
        'sector.integer' => 'يرجى تحديد القطاع *',
        'activite.integer' => 'يرجى تحديد تصنيف صالح *',



        'title.min' => 'يرجى ادخال عنوان صالح العنوان الذي ادخلته أقصر من اللازم  *',
        'title.max' => 'يرجى ادخال عنوان صالح العنوان الذي ادخلته أطول من اللازم  *',

        'description.min' => 'الوصف الذي ادخلته أقصر من اللازم  *',
        'description.max' => 'الوصف الذي ادخلته أطول من اللازم الحد الأقصى 2000 حرف  *',

        'onlineCeck' => 'يرجى تحديد خيار *',

        'budget.min' => 'أقل مبلغ مسموح به هو 150 درهم مغربي *',
        'budget.max' => 'الحد الأقصى للميزانية المسموح بها 500 الف درهم مغربي *',

        'time.min' => 'يرجى تحديد عدد الأيام المتوقعة *',
        'time.max' => 'الحد الأقصى 180 يوم (6 أشهر) *',
        ]);
        /* Place Validation */
        if($request->onlineCeck  == 2){
            $datajson = file_get_contents('data/json/list-moroccan-cities.json');
            $jsondata = json_decode($datajson, true);
            $resultcheck = false;
            $cityid = $request->place;
            foreach ($jsondata as $item) {
                if ($item['id'] == $cityid) {
                    $resultcheck = true;
                }
            }
            if($resultcheck == false){
                $error = response()->json(['errors' => ['place' => [0 => 'يرجى اختيار مدينة صالحة']]], 422);

            }
        }else{
            $cityid = null;
        }
        if(!isset($error)){
            $Activite = $request->activite;
            if ($request->sector != 1 && $Activite > 149 || $request->sector > 1 && $Activite > 66) {
                return response()->json(['errors' => ['activite' => [0 => 'يرجى تحديد نشاط صالح من خلال القائمة *']]], 422);
            } elseif ($request->file('files_u')) {
                $files = $request->file('files_u');
                $count = count($files);
                $error = null;
                if ($count <= 5) {
                    foreach ($files as $file) {
                        if ($file->getSize() > 1000000) {
                            $error = response()->json(['errors' => ['files_u' => [0 => '(' . $file->getClientOriginalName() . ') هذا الملف أكبر من اللازم الحد الأقصى 1MB']]], 422);
                        } else {
    
                            if (
                            $file->getMimeType() != "image/jpg" &&
                            $file->getMimeType() != "image/jpeg" &&
                            $file->getMimeType() != "video/x-msvideo" &&
                            $file->getMimeType() != "application/msword" &&
                            $file->getMimeType() !=
                              "application/vnd.openxmlformats-officedocument.wordprocessingml.document" &&
                            $file->getMimeType() != "image/gif" &&
                            $file->getMimeType() != "image/vnd.microsoft.icon" &&
                            $file->getMimeType() != "application/json" &&
                            $file->getMimeType() != "audio/mpeg" &&
                            $file->getMimeType() != "video/mpeg" &&
                            $file->getMimeType() != "application/pdf" &&
                            $file->getMimeType() != "image/svg+xml" &&
                            $file->getMimeType() != "text/plain" &&
                            $file->getMimeType() != "application/vnd.ms-excel" &&
                            $file->getMimeType() != "application/zip" &&
                            $file->getMimeType() !=
                              "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" &&
                            $file->getMimeType() != "application/vnd.rar" &&
                            $file->getMimeType() != "application/x-rar-compressed" &&
                            $file->getMimeType() != "application/x-zip-compressed" &&
                            $file->getMimeType() != "application/x-7z-compressed" &&
                            $file->getMimeType() != "application/octet-stream" &&
                            $file->getMimeType() != "multipart/x-zip" &&
                            $file->getMimeType() != "video/mp4" &&
                            $file->getMimeType() != "application/psd" &&
                            $file->getMimeType() != "image/png"
                            ) {
                                $error = response()->json(['errors' => ['files_u' => [0 => '(' . $file->getClientOriginalName() . ') هذا الملف غير مدعوم مسومح فقط بي (PNG, JPG,JPEG, GIF, SVG, AVI, DOC, DOCX, ICO, JSON, MP3, MPEG, PDF, TXT, XLS, XSLX, ZIP, RAR, MP4) *']]], 422);
                            }
                        }
                    }
                    if ($error == null) {
                        $uploads =  $request->files_u;
                        $fullfilesUrl = [];
                        $index = 0;
                        $uploaded_count = 0;
                        foreach ($uploads as $upload) {
                            $image_type = $upload->extension();
                            $folderPath = "img/users/orders/" . date("Y") . '/' . Auth::user()->Account_number . '/';
                            $filname =  Auth::user()->Account_number . '-' . uniqid() . '.' . $image_type;
                            $file = $upload;
                            $upload_success = $file->move($folderPath, $filname);
                            $fullfilesUrl[$index] = $folderPath . $filname;
                            $index++;
                            if ($upload_success) {
                                $uploaded_count++;
                            } else {
                                return response()->json(['errors' => ['files_u' => [0 => 'حدث خطأ اثناء محاولة رفع الملف يرجى اعادة المحاولة ']]], 422);
                            }
                        }
                        $filesjson = json_encode($fullfilesUrl);
    
                        if ($uploaded_count == $count) {
                            /**
                             * Send Data To DATABASE
                             */
                            $filesjson = json_encode($fullfilesUrl);
                            $OID = random_int(100000, 9999999999);
                            $stmt = Orders::create([
                                'OID' => $OID,
                                'Account_number' => Auth::user()->Account_number,
                                'title' => $request->title,
                                'description' => $request->description,
                                'activite' => $request->activite,
                                'sector' => $request->sector,
                                'files' => $filesjson,
                                'place' => $cityid,
                                'time' => $request->time,
                                'budget' => $request->budget,
                                'keywords' => $request->keywords,
                                'status' => 0
                            ]);
                            if ($stmt) {
    
    
                                return response()->json(['success' => 'تم اضافة طلبك بنجاح !', 'oid' => $OID]);
                            } else {
                                return response()->json(['error' => 'فشل ارسال طلبك'], 500);
                            }
                            return response()->json('sucs', 200);
                        } else {
                            return response()->json(['errors' => ['files_u' => [0 => 'حدث خطأ اثناء محاولة رفع الملفات يرجى اعادة المحاولة']]], 422);
                        }
                    } else {
                        return $error;
                    }
                } else {
                    return response()->json(['errors' => ['files_u' => [0 => 'مسموح فقط بـ 5 ملفات']]], 422);
                }
            } else{
                $OID = random_int(100000, 9999999999);
                $stmt = Orders::create([
                    'OID' => $OID,
                    'Account_number' => Auth::user()->Account_number,
                    'title' => $request->title,
                    'description' => $request->description,
                    'activite' => $request->activite,
                    'sector' => $request->sector,
                    'files' => null,
                    'place' => $cityid,
                    'time' => $request->time,
                    'budget' => $request->budget,
                    'keywords' => $request->keywords,

                    'status' => 0
                ]);
                if ($stmt) {


                    return response()->json(['success' => 'تم اضافة طلبك بنجاح !', 'oid' => $OID]);
                } else {
                    return response()->json(['error' => 'فشل ارسال طلبك'], 500);
                }
            }
        }else{
            return $error;
        }
   
   
    }
    public function show(Request $request){
        if(isset($request->OID)){
            $infos = Orders::all()->where('OID', $request->OID);
            if($infos->count() > 0){
                foreach($infos as $info);
                $info->AllowedToAddOffer = false;
                if($info->files != null){
                    $info->files = json_decode($info->files, true);
                }
                if(Auth::check()){
                    if(auth::user()->verified_account == 2){
                        if(Auth::user()->Account_number != $info->Account_number){
                            if(count(Auth::user()->Offers->where('OID', $request->OID)) < 1 && count(Auth::user()->Orders->where('OID', $request->OID)) < 1){
                                $info->AllowedToAddOffer = true;
                            }
                        }
                    }
                }
                /* Get City Name */
                if(isset($info->place) && $info->place != null){
                $datajson = file_get_contents('data/json/list-moroccan-cities.json');
                $jsondata = json_decode($datajson, true);
                
                $resultcheck = "";
                foreach ($jsondata as $item) {
                    if ($item['id'] == $info->place) {
                        $resultcheck = $item['ville'];
                    }
                }
                $info->place = $resultcheck;

            }else{
                $info->place = null;
            }
            /* Get User City */
            if(isset($info->user->city) && $info->user->city != null){
                $datajson = file_get_contents('data/json/list-moroccan-cities.json');
                $jsondata = json_decode($datajson, true);
                $resultcheck2 = "";
                foreach ($jsondata as $item) {
                    if ($item['id'] == $info->user->city) {
                        $resultcheck2 = $item['ville'];
                    }
                }
                $info->userCity = $resultcheck2;
            }else{
                $info->userCity = 'غير محدد';
            }
            /* Get User City */

            /* Add Keywords to array */
            if($info->keywords != null && $info->keywords != ""){
            $info->keywords = explode(",",$info->keywords);
                
            }else{
                $info->keywords = null;
            }
            /* Add Keywords to array */
                /* Get Activite And Sector NAme */
                $Activites = $info->activite;
                $sector = $info->sector;
                if($Activites != null){
                    if ($sector == 1) {
                        $listActivites = file_get_contents('data/json/activite-ae-2.json');
                        $listActivitesdata = json_decode($listActivites, true);
                    } elseif ($sector == 2 || $sector == 3 || $sector == 4) {
                        $listActivites = file_get_contents('data/json/activite-ae-1.json');
                        $listActivitesdata = json_decode($listActivites, true);
                    }
                    $activite = $listActivitesdata[$Activites];
                    $info->activite = $activite;
                }
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
                $info->sector = $sectorName;
                $info->budget= number_format((float)$info->budget, 2, '.', '');
                switch($info->time){
                    case(1);
                    $info->time = 'يوم واحد';
                    break;
                    case(2);
                    $info->time = ' يومان';
                    break;
                    case(3);
                    $info->time = ' 3 أيام';
                    break;
                    case(7);
                    $info->time = ' اسبوع';
                    break;
                    case(30);
                    $info->time = ' شهر';
                    break;
                    case(60);
                    $info->time = ' 2 أشهر';
                    break;
                    case(90);
                    $info->time = ' 3 أشهر';
                    break;
                    default:
                    $info->time = $info->time. ' يوم';
                }
                return view('orders.order-page', ['data' => $info]);
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
    }
    public function all(Request $request){
        $infos = Orders::where('status', 1)->orderBy("created_at", "DESC")->paginate(10);
        for($i=0; count($infos) > $i; $i++){
            $infos[$i]->user_sector = $infos[$i]->user->sector;
            $infos[$i]->OffersCount = $infos[$i]->Offers->count();
        }
        return response()->json($infos, 200);

    }
    public function search(Request $request){
        /* Search values */
        $query = $request->q;
        $sector = $request->s;
        $activite = $request->a;
        $city = $request->c;
    if($city == null || $city == ""){
            $cityquery = "%%";
        }else if($city == "remotely"){
            $cityquery = "remotely";
        }else{
            $cityquery = "%".$city."%";
        }
        $budget = explode(",", $request->b);
        $time = $request->t;
        
        /*  Search values */
        
            $data = Orders::where('status', 1)
                ->where('activite', 'LIKE', '%' . $activite . '%')
                ->where('sector', 'LIKE', '%' . $sector . '%')
                ->where("place","LIKE", $cityquery)
                ->where('time', '<', intval($time) )
                ->where('budget', '>', intval($budget[0]) )
                ->where('budget', '<',intval($budget[1]) )

                ->where(function ($qu) use ($query) {
                    $qu->where('title', 'LIKE', '%' . $query . '%')
                        ->orWhere('description', 'LIKE', '%' . $query . '%')
                        ->orWhere('keywords', 'LIKE', '%' . $query . '%');
                })->orderBy("created_at", "DESC")->paginate(10);
               
                for($i=0; $data->count() > $i; $i++){
                    $data[$i]->user_sector = $data[$i]->user->sector;
                    $data[$i]->OffersCount = $data[$i]->Offers->count();
                }
                    return response()->json($data, 200);
            
   

    }
    
}
