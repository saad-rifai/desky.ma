<?php

namespace App\Http\Controllers;

use App\AeAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DocumentationCenter;

class DocumentationCenterController extends Controller
{
    public function DocumentationCenterCheck(){
        $AccountStatus = Auth::user()->verified_account;
        $Request = DocumentationCenter::where('Account_number', Auth::user()->Account_number)->get(['status', 'message', 'document_id', 'created_at']);
        $RequestAe = AeAccount::where('Account_number', Auth::user()->Account_number)->get(['status']);
        $Request = $Request->makeVisible([ 'document_id']);
        $RequestAe = $RequestAe->makeVisible(['status']);
        $RequestAePending = null;
        if(count($RequestAe) > 0){
            foreach($RequestAe as $RequestAeStatus);
            switch ($RequestAeStatus->status) {
                case 1:
                    $RequestAePending = true;
                    break;
                case 2:
                    $RequestAePending = true;
                    break;
                default:
                $RequestAePending = null;
                    break;
            }
        }else{
            $RequestAePending = null;
        }

        if(count($Request) < 1){
            $Request = null;
        }else{
            foreach($Request as $Request);
        }
        return response()->json(['account_status' => $AccountStatus, 'request' => $Request, 'request_ae_account_pending' => $RequestAePending], 200);
    }
    public function RequestVerification(Request $request)
    {
        $this->validate($request, [
            'document_type' => 'required|integer|min:0|max:3',
            'document_id' => 'required|string|min:4|max:20',
            'expiration_date' => 'date|required',

            //'document_file.*' => 'required|mimes:jpg,jpeg,png|max:1000'
        ], $message = [
            'required' => 'هذا الحقل مطلوب *',
            'integer' => 'يرجى تحديد نوع الوثيقة *',
            'string' => 'يرجى ادخال معلومات صالحة *',
            'document_type.min' => 'يرجى تحديد نوع الوثيقة *',
            'document_type.max' => 'يرجى تحديد نوع الوثيقة *',
            'document_id.max' => 'يرجى ادخال معلومات صالحة الرمز الذي ادخلته أطول من اللازم *',
            'document_id.min' => 'يرجى ادخال معلومات صالحة الرمز الذي ادخلته أقصر من اللازم *',
            'expiration_date.date' => 'يرجى ادخال تاريخ انتهاء الصلاحية'
        ]);

        if ($request->file('document_file')) {
            $files = $request->file('document_file');
            $count = count($files);
            $error = null;
            if ($count <= 2) {
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
                        $folderPath = "files/users/documentaion_center/" . date("Y") . '/';
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
                        $alredyCounts = DocumentationCenter::where('Account_number', auth::user()->Account_number)->get();
                        if ($alredyCounts->count() > 0) {
                            foreach ($alredyCounts as $alredyCount);
                            $status = $alredyCount->status;
                            if ($status == 3) {
                                $stmt = DocumentationCenter::where('Account_number', auth::user()->Account_number)->update([
                                    'file_type' => $request->document_type,
                                    'document_id' => $request->document_id,
                                    'expiration_date' => $request->expiration_date,
                                    'files' => $filesjson,
                                    'status' => '0'
                                ]);
                                if ($stmt) {
                                    return response()->json(['success' => 'تم ارسال طلبك'], 200);
                                } else {
                                    return response()->json(['error' => 'فشل ارسال طلبك'], 500);
                                }
                            } else if ($status == 4) {
                                return response()->json(['errors' => 'تم رفض طلبك بشكل نهائي ولايمكنك تقديم طلب أخر'], 400);
                            } else {
                                return response()->json(['errors' => 'لايمكنك تقديم طلب أخر حتى يتم الانتهاء من مراجعة طلبك'], 400);
                            }
                        } else {
                            $filesjson = json_encode($fullfilesUrl);
                            $stmt = DocumentationCenter::create([
                                'Account_number' => auth::user()->Account_number,
                                'file_type' => $request->document_type,
                                'document_id' => $request->document_id,
                                'expiration_date' => $request->expiration_date,
                                'files' => $filesjson,
                                'status' => '0'
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
                return response()->json(['errors' => ['document_file' => [0 => 'مسموح فقط بملفين']]], 422);
            }
        } else {
            return response()->json(['errors' => ['document_file' => [0 => 'يرجى تحميل الوثائق المطلوبة *']]], 422);
        }
    }
}
