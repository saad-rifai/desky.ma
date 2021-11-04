<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\AeAccount;
use App\User;
use Illuminate\Support\Facades\File;

use function GuzzleHttp\json_decode;

class AeAccountController extends Controller
{
    public function RequestAccount(Request $request)
    {
        $this->validate($request, [
            'cin' => 'required|min:4|max:20',
            'job_title' => 'required|max:30|min:4',
            'cin_date_expiration' => 'required|date',
            'join_date' => "required|date",
            'ae_number' => 'required|min:10|max:20',
            'sector' => 'required|integer|min:1|max:4',
            'activite' => 'required',
            'terms' => 'required|in:true',


        ], $message = [
            'required' => 'هذا الحقل مطلوب *',
            'sector.min' => 'يرجى تحديد القطاع *',
            'sector.max' => 'يرجى تحديد القطاع *',
            'terms.in' => 'هذا الحقل مطلوب *',

            'job_title.min' => 'يرجى ادخال مسمى وظيفي صالح الاسم اللذي ادخلته أقصر من اللازم  *',
            'job_title.max' => 'يرجى ادخال مسمى وظيفي صالح الاسم اللذي ادخلته أطول من اللازم *',


            'cin.max' => 'يرجى ادخال معلومات صالحة الرمز الذي ادخلته أطول من اللازم *',
            'cin.min' => 'يرجى ادخال معلومات صالحة الرمز الذي ادخلته أقصر من اللازم *',

            'ae_number.max' => 'يرجى ادخال معلومات صالحة الرقم الذي ادخلته أطول من اللازم *',
            'ae_number.min' => 'يرجى ادخال معلومات صالحة الرقم الذي ادخلته أقصر من اللازم *',

            'cin_date_expiration.date' => 'يرجى ادخال تاريخ صالح *',

            'join_date.date' => 'يرجى ادخال تاريخ صالح *',
        ]);
        $pattern = '/[0-9a-z\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';

        if (!preg_match($pattern, $request->job_title)) {

            $ActiviteSelected = explode(',', $request->activite);
            if (count($ActiviteSelected) > 3) {
                return response()->json(['errors' => ['activite' => [0 => 'مسموح بـ 3 أنشطة فقط *']]], 422);
            } else {

                foreach ($ActiviteSelected as $Activite) {
                    if ($request->sector != 1 && $Activite > 149 || $request->sector > 1 && $Activite > 66 || count($ActiviteSelected) < 1) {
                        return response()->json(['errors' => ['activite' => [0 => 'يرجى تحديد نشاط صالح من خلال القائمة *']]], 422);
                    } elseif ($request->file('document_file')) {
                        $files = $request->file('document_file');
                        $count = count($files);
                        $error = null;
                        if ($count <= 3) {
                            foreach ($files as $file) {
                                if ($file->getSize() > 1000000) {
                                    $error = response()->json(['errors' => ['document_file' => [0 => '(' . $file->getClientOriginalName() . ') هذا الملف أكبر من اللازم الحد الأقصى 1MB']]], 422);
                                } else {

                                    if ($file->getMimeType() != "application/pdf" && $file->getMimeType() != "image/jpg" && $file->getMimeType() != "image/jpeg"  && $file->getMimeType() != "image/png") {
                                        $error = response()->json(['errors' => ['document_file' => [0 => '(' . $file->getClientOriginalName() . ') هذا الملف غير مدعوم مسموح فقط بي (PNG, JPG, JPEG, PDF)']]], 422);
                                    }
                                }
                            }
                            if ($error == null) {
                                $uploads =  $request->document_file;
                                $fullfilesUrl = [];
                                $index = 0;
                                $uploaded_count = 0;
                                foreach ($uploads as $upload) {
                                    $image_type = $upload->extension();
                                    $folderPath = "files/users/AeAccount/" . date("Y") . '/';
                                    $filname =  Auth::user()->Account_number . '-' . uniqid() . '.' . $image_type;
                                    $file = $upload;
                                    $upload_success = $file->move($folderPath, $filname);
                                    $fullfilesUrl[$index] = $folderPath . $filname;
                                    $index++;
                                    if ($upload_success) {
                                        $uploaded_count++;
                                    } else {
                                        return response()->json(['errors' => ['document_file' => [0 => 'حدث خطأ اثناء محاولة رفع الملفات يرجى اعادة المحاولة 0']]], 422);
                                    }
                                }
                                $filesjson = json_encode($fullfilesUrl);

                                if ($uploaded_count == $count) {
                                    /**
                                     * Send Data To DATABASE
                                     * Statut [1 => 'قيد المراجعة', 2 => 'تم قبول الطلب' 3 => 'تم رفض الطلب' 4 => ,'تم رفض الطلب نهائيا']
                                     */
                                    $alredyCounts = AeAccount::where('Account_number', auth::user()->Account_number)->get();
                                    if ($alredyCounts->count() > 0) {
                                        foreach ($alredyCounts as $alredyCount);
                                        $status = $alredyCount->status;
                                        if ($status == 3) {
                                            $stmt = AeAccount::where('Account_number', auth::user()->Account_number)->update([
                                                'cin' => "$request->cin",
                                                'ae_number' => "$request->ae_number",
                                                'cin_date_expiration' => $request->cin_date_expiration,
                                                'ae_join_date' => $request->join_date,
                                                'sector' => $request->sector,
                                                'activite' => "$request->activite",
                                                'job_title' => "$request->job_title",
                                                'files' => $filesjson,
                                                'status' => 1
                                            ]);
                                            if ($stmt) {
                                                $filesUploaded = json_decode($alredyCount->files);
                                                foreach ($filesUploaded as $fullfileUrl) {
                                                    File::delete($fullfileUrl);
                                                }
                                                return response()->json(['success' => 'تم ارسال طلبك'], 200);
                                            } else {
                                                return response()->json(['error' => 'فشل ارسال طلبك'], 500);
                                            }
                                        } else if ($status == 4) {
                                            foreach ($fullfilesUrl as $fullfileUrl) {
                                                File::delete($fullfileUrl);
                                            }
                                            return response()->json(['errors' => 'تم رفض طلبك بشكل نهائي ولايمكنك تقديم طلب أخر'], 400);
                                        } else {
                                            foreach ($fullfilesUrl as $fullfileUrl) {
                                                File::delete($fullfileUrl);
                                            }
                                            return response()->json(['errors' => 'لايمكنك تقديم طلب أخر حتى يتم الانتهاء من مراجعة طلبك'], 400);
                                        }
                                    } else {
                                        $filesjson = json_encode($fullfilesUrl);
                                        $stmt = AeAccount::where('Account_number', auth::user()->Account_number)->insert([
                                            'Account_number' => auth::user()->Account_number,
                                            'cin' => "$request->cin",
                                            'ae_number' => "$request->ae_number",
                                            'cin_date_expiration' => $request->cin_date_expiration,
                                            'ae_join_date' => $request->join_date,
                                            'sector' => $request->sector,
                                            'activite' => "$request->activite",
                                            'job_title' => "$request->job_title",
                                            'files' => $filesjson,
                                            'status' => 1
                                        ]);
                                        if ($stmt) {
                                            return response()->json(['success' => 'تم ارسال طلبك'], 200);
                                        } else {
                                            return response()->json(['error' => 'فشل ارسال طلبك'], 500);
                                        }
                                    }
                                } else {
                                    return response()->json(['errors' => ['document_file' => [0 => 'حدث خطأ اثناء محاولة رفع الملفات يرجى اعادة المحاولة']]], 422);
                                }
                            } else {
                                return $error;
                            }
                        } else {
                            return response()->json(['errors' => ['document_file' => [0 => 'مسموح فقط بـ 3 ملفات']]], 422);
                        }
                    } else {
                        return response()->json(['errors' => ['document_file' => [0 => 'يرجى تحميل الوثائق المطلوبة *']]], 422);
                    }
                }
            }
        } else {
            return response()->json(['errors' => ['job_title' => [0 => 'يرجى ادخال مسمى وظيفي صالح يجب أن يتكون من الأحرف العربية فقط *']]], 422);
        }
    }
    public function AelistAll(Request $request){
        $data = User::join('ae_accounts', 'users.Account_number', '=', 'ae_accounts.Account_number')->where('ae_accounts.status',2)
        ->where('users.verified_account', 2)->paginate(5, ['users.frist_name','users.last_name','users.country','users.city','users.username','users.description','users.avatar','ae_accounts.ae_number','ae_accounts.sector','ae_accounts.activite', 'ae_accounts.job_title']);

        return response()->json($data, 200);
    }
}
