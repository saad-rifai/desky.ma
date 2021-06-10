<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UserFeedback;
use Illuminate\Support\Facades\Auth;
class UserFeedbackController extends Controller
{
    public function CheckFeedBack(){
        $infos = UserFeedback::all()->where("email", Auth::user()->email);
        $count = $infos->count();
        if($count > 0){
            return response()->json(['status' => 1], 200);
        }else{
            return response()->json(['status' => 0], 200);

        }

    }
    public function SendFeedBack(Request $request){
        $this->validate($request, [
            'rating' =>  'required|integer|min:1|max:5',
            'feedback' => 'required|string|min:10|max:350',
        ],
        $message = [
            'rating.required' => 'يرجى تقييم المنصة *',
            'rating.min' => 'يرجى تقييم المنصة *',
             'rating.max' => 'يرجى تقييم المنصة *',
             'feedback.string' => 'يرجى ادخال تعليق صالح *',
             'feedback.required' => 'يرجى ادخال تعليق صالح *',
             'feedback.min' => 'التعلق أقصر من اللازم *',
             'feedback.max' => 'التعلق أطول من اللازم *'
             ]
        );
        $stmt = UserFeedback::create([
            'email' => Auth::user()->email,
            'UID' => Auth::user()->id,
            'ip_addr' => request()->ip(),
            'USER_CLIENT' => request()->userAgent(),
            'rating' => $request->rating,
            'feedback' => $request->feedback
        ]);
        if($stmt){
            return response()->json(['تم ارسال التقييم'], 200);
        }else{
            return response()->json(['error' => 'حدث خطأ ما يرجى اعادة المحاولة !'], 500);

        }
    }
}
