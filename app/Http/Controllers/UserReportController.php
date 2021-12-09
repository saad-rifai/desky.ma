<?php

namespace App\Http\Controllers;

use App\User;
use App\UserReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserReportController extends Controller
{
   public function CreateReport(Request $request){
       $this->validate($request, [
           'about' => 'required|integer|max:3|min:0',
           'category' => 'required|integer|max:2|min:0',
           'description' => 'required|min:30|max:700',
           'from_url' => 'max:500',
       ], $messages = [
           'required' => 'هذا الحقل مطلوب',
           'about.integer' => 'Bad Request',
           'about.max' => 'Bad Request',
           'about.min' => 'Bad Request',

           'category.integer' => 'يرجى تحديد الموضوع',
           'category.max' => 'يرجى تحديد الموضوع',
           'category.min' => 'يرجى تحديد الموضوع',

           'description.min' => 'الوصف الذي ادخلته أقصر من اللازم',
           'description.max' => 'الوصف اللذي أدخلته أطول من اللازم الحد الأقصى 700 حرف'
       ]);
       if(isset($request->to) && $request->to != null){
          $CeckToUser = User::where('Account_number', $request->to)->count();
          if($CeckToUser > 0){
              $claimant = $request->to;
             $stmt = UserReport::create([
                 'claimant' => Auth::user()->Account_number,
                 'defendant' => $claimant,
                 'about' => $request->about,
                 'category' => $request->category,
                 'description' => $request->description,
                 'from_url' => $request->from_url,
                 'status' => "0",
             ]);
             if($stmt){
                return response()->json(['success', 'تم تسجيل شكواك'], 200);

             }else{
                return response()->json(['error', 'حصل خطأ ما يرجى اعادة المحاولة'], 500);

             }
          }else{
              return response()->json(['error', 'Bad Request'], 400);
          }
       }else{

        $stmt = UserReport::create([
            'claimant' => Auth::user()->Account_number,
            'defendant' => null,
            'about' => $request->about,
            'category' => $request->category,
            'description' => $request->description,
            'from_url' => $request->from_url,
            'status' => "0",
        ]);
        if($stmt){
           return response()->json(['success', 'تم تسجيل شكواك'], 200);

        }else{
           return response()->json(['error', 'حصل خطأ ما يرجى اعادة المحاولة'], 500);

        }
       }


    }
}
