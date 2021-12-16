<?php

namespace App\Http\Controllers;

use App\UserPortFolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use function GuzzleHttp\json_decode;

class UserPortFolioController extends Controller
{
    public function index(Request $request)
    {
        if (isset($request->account_number) && $request->account_number != null) {
            $stmts = UserPortFolio::where('Account_number', $request->account_number)->where('status', 0)->paginate(6, ['id', 'title', 'files', 'created_at']);

            return response()->json($stmts, 200);
        } else {
            return response()->json('Bad Request ! ', 400);
        }
    }
    public function show(Request $request)
    {
        $data = Cache::remember('portfolio-work-' . $request->id, 172800, function () use ($request) {
            $infos = UserPortFolio::where('id', $request->id)->first();
            if ($infos != null && $infos != "" && $infos != []) {
                // dd($infos->user->AeAccount);
                /* Get Activite Name */
                $Activites = $infos->activite;
                $sector = $infos->sector;
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
                    if ($item['id'] == $infos->user->city) {
                        $resultcheck = $item['ville'];
                    }
                }
                $infos->activite = $activite;
                $infos->city = $resultcheck;
                $infos->sector = $sectorName;

                if (isset($infos->user->AeAccount->job_title)) {
                    $infos->job_title =  $infos->user->AeAccount->job_title;
                }
                return $infos;
            } else {
                return null;
            }
        });

        if ($data != null && $data != "") {
            $data->likes_number = $data->Likes->count();
            return view('portfolio-show', ['data' => $data]);
        } else {
            abort(404);
        }
    }
    public function redirect(Request $request)
    {
        $datas = UserPortFolio::where('id', $request->id)->get('title');
        if ($datas->count() > 0) {
            foreach ($datas as $data);
            $title = str_replace(' ', '-', $data->title);
            return redirect('portfolio/' . $request->id . '/' . $title);
        } else {
            abort(404);
        }
    }
    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:80|min:10',
            'description' => 'required|min:15|max:700|string',
            'sector' => 'required|integer|min:1|max:4',
            'activite' => 'required|integer',


        ], $message = [
            'required' => 'هذا الحقل مطلوب *',
            'sector.min' => 'يرجى تحديد القطاع *',
            'sector.max' => 'يرجى تحديد القطاع *',
            'sector.integer' => 'يرجى تحديد القطاع *',
            'activite.integer' => 'يرجى تحديد التصنيف *',

            'title.min' => 'يرجى ادخال عنوان صالح العنوان الذي ادخلته أقصر من اللازم  *',
            'title.max' => 'يرجى ادخال عنوان صالح العنوان الذي ادخلته أطول من اللازم  *',

            'description.min' => 'الوصف الذي ادخلته أقصر من اللازم  *',
            'description.max' => 'الوصف الذي ادخلته أطول من اللازم  *',
        ]);
        $Activite = $request->activite;
        if ($request->sector != 1 && $Activite > 149 || $request->sector > 1 && $Activite > 66 || $Activite < 1) {
            return response()->json(['errors' => ['activite' => [0 => 'يرجى تحديد نشاط صالح من خلال القائمة *']]], 422);
        } elseif ($request->file('image')) {
            $files = $request->file('image');
            $count = count($files);
            $error = null;
            if ($count <= 5) {
                foreach ($files as $file) {
                    if ($file->getSize() > 1000000) {
                        $error = response()->json(['errors' => ['image' => [0 => '(' . $file->getClientOriginalName() . ') هذا الملف أكبر من اللازم الحد الأقصى 1MB']]], 422);
                    } else {

                        if ($file->getMimeType() != "image/jpg" && $file->getMimeType() != "image/jpeg"  && $file->getMimeType() != "image/png") {
                            $error = response()->json(['errors' => ['image' => [0 => '(' . $file->getClientOriginalName() . ') هذا الملف غير مدعوم مسموح فقط بي (PNG, JPG, JPEG)']]], 422);
                        }
                    }
                }
                if ($error == null) {
                    $uploads =  $request->image;
                    $fullfilesUrl = [];
                    $index = 0;
                    $uploaded_count = 0;
                    foreach ($uploads as $upload) {
                 
                        
                        $upload_success = $upload->store('users/'.Auth::user()->Account_number.'/portfolio', 's3');
                        $fullfilesUrl[$index] = Storage::disk('s3')->url($upload_success);
                        $index++;
                        if ($upload_success) {
                            $uploaded_count++;
                        } else {
                            return response()->json(['errors' => ['image' => [0 => 'حدث خطأ اثناء محاولة رفع الصور يرجى اعادة المحاولة 0']]], 422);
                        }
                    }
                    $filesjson = json_encode($fullfilesUrl);

                    if ($uploaded_count == $count) {
                        /**
                         * Send Data To DATABASE
                         */
                        $filesjson = json_encode($fullfilesUrl);

                        $stmt = UserPortFolio::create([
                            'Account_number' => Auth::user()->Account_number,
                            'title' => $request->title,
                            'description' => $request->description,
                            'activite' => $request->activite,
                            'sector' => $request->sector,
                            'files' => $filesjson,
                            'status' => 0
                        ]);
                        if ($stmt) {


                            return response()->json(['success' => 'تم اضافةالعمل بنجاح !', 'portfolio_id' => $stmt->id]);
                        } else {
                            return response()->json(['error' => 'فشل ارسال طلبك'], 500);
                        }
                        return response()->json('sucs', 200);
                    } else {
                        return response()->json(['errors' => ['image' => [0 => 'حدث خطأ اثناء محاولة رفع الصور يرجى اعادة المحاولة']]], 422);
                    }
                } else {
                    return $error;
                }
            } else {
                return response()->json(['errors' => ['image' => [0 => 'مسموح فقط بـ 5 ملفات']]], 422);
            }
        } else {
            return response()->json(['errors' => ['image' => [0 => 'يرجى تحميل الصور  *']]], 422);
        }
    }
    public function ShowForEdit(Request $request)
    {
        if (isset($request->id)) {
            $stmt = UserPortFolio::where('id', $request->id)->where('Account_number', Auth::user()->Account_number)->get();
            if ($stmt->count() > 0) {
                foreach ($stmt as $stmt);

                return view('actions.edit-portfolio', ['data' => $stmt]);
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }
    public function delete(Request $request)
    {
        if (isset($request->id)) {
            $stmt = UserPortFolio::where('id', $request->id)->where('Account_number', Auth::user()->Account_number)->delete();
            if ($stmt) {
                Cache::forget('portfolio-work-' . $request->id);
                return response()->json('success', 200);
            } else {
                return response()->json('error', 500);
            }
        } else {
            return response()->json('error', 500);
        }
    }
    public function PortfolioInfos(Request $request)
    {
        if (isset($request->id)) {
            $infos = UserPortFolio::all()->where('id', $request->id)->where('Account_number', auth::user()->Account_number);
            if ($infos->count() > 0) {
                foreach ($infos as $info);
                $files = json_decode($info->files, true);

                $filesArray = [];
                foreach ($files as $key => $file) {
                    $filesArray[$key] = [$file, 'server_id' => ['server_id' => $key]];
                }

                $info->files = $filesArray;
                return response()->json($info, 200);
            } else {
                return response()->json(['Bad Request'], 400);
            }
        } else {
            return response()->json(['Bad Request'], 400);
        }
    }
    public function edit(Request $request)
    {
        if (isset($request->image) || isset($request->images_id)) {
            $files = UserPortFolio::where('id', $request->id)->where('Account_number', auth::user()->Account_number)->get(['files']);
            if ($files->count() > 0) {
                foreach ($files as $files);
                $filesArray = json_decode($files->files);
                $filesArrayToRemove = $filesArray;

                /* Add New Images */
        
                foreach ($request->images_id as $image_id) {
                    if ($request->images_id != null) {
                        unset($filesArrayToRemove[intval($image_id)]);
                    }
                }
             
                foreach ($filesArrayToRemove as $idFile => $removeFile) {
                    unset($filesArray[$idFile]);
                }
                if ($request->image) {

                    /* Check New Images */
                    $files = $request->file('image');
                    $count = count($files);
                    $error = null;
                   // dd($filesArray);
                    if ((count($filesArray) + $count) <= 5) {
                        foreach ($files as $file) {
                            if ($file->getSize() > 1000000) {
                                $error = response()->json(['errors' => ['image' => [0 => '(' . $file->getClientOriginalName() . ') هذا الملف أكبر من اللازم الحد الأقصى 1MB']]], 422);
                            } else {

                                if ($file->getMimeType() != "image/jpg" && $file->getMimeType() != "image/jpeg"  && $file->getMimeType() != "image/png") {
                                    $error = response()->json(['errors' => ['image' => [0 => '(' . $file->getClientOriginalName() . ') هذا الملف غير مدعوم مسموح فقط بي (PNG, JPG, JPEG)']]], 422);
                                }
                            }
                        }
                        if($error == null){
                            /* Upload New Images */



                            $uploads =  $request->image;
                            $fullfilesUrl = [];
                         
                            $uploaded_count = 0;
                            foreach ($uploads as $upload) {
                                $image_type = $upload->extension();
                                $folderPath = "img/users/portfolios/" . date("Y") . '/' . Auth::user()->Account_number . '/';
                                $filname =  Auth::user()->Account_number . '-' . uniqid() . '.' . $image_type;
                                $file = $upload;
                                $upload_success = $file->move($folderPath, $filname);
                                $fileFullName=$folderPath . $filname;
                                array_push($filesArray, $fileFullName);
                     
                                if ($upload_success) {
                                    $uploaded_count++;
                                } else {
                                    return response()->json(['errors' => ['image' => [0 => 'حدث خطأ اثناء محاولة رفع الصور يرجى اعادة المحاولة 0']]], 422);
                                }
                            }
                            
                            if ($uploaded_count == !$count) {
                                $error = response()->json(['errors' => ['image' => [0 => 'حدث خطأ اثناء محاولة رفع الصور يرجى اعادة المحاولة 0']]], 422);

                            }
                           // $filesjson = json_encode($filesArray);



                        }else{
                            return $error;
                        }
                    } else {
                        return response()->json(['errors' => ['image' => [0 => 'مسموح فقط بـ 5 ملفات']]], 422);
                    }
          
                }

                /* Update Data */
                $filesArrayData = [];

                dd($filesArray);
                foreach($filesArray as $key=>$filesArray){
                    $filesArrayData[$key] = $filesArray;
                }
                $filesjson = json_encode($filesArrayData);
                $stmt = UserPortFolio::where('id', $request->id)->where('Account_number', auth::user()->Account_number)->update([
                    'files' => $filesjson,
                ]);
                if($stmt){
                    Cache::forget('portfolio-work-' . $request->id);
                    return response()->json(['success'], 200);
                }else{
                    return response()->json(['error' => 'فشل ارسال طلبك'], 500);

                }
            } else {
                return response()->json(['error', 'Bad Request :'], 400);
            }
        } else {
            return response()->json(['error', ['image' => 'يرجى تحميل الصور *']], 422);
        }
    }
}
