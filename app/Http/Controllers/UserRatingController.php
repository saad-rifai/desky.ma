<?php

namespace App\Http\Controllers;

use App\Offers;
use App\Orders;
use App\UserRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UserNotification;
use Illuminate\Support\Facades\Cache;
class UserRatingController extends Controller
{
    public function create(Request $request){
        if(isset($request->OID) && isset($request->to)){
            $this->validate($request, [
                'description' => 'required|min:15|max:350|string',
                'rating' => 'required|integer|min:0|max:5',
    
            ], $message = [
                'required' => 'هذا الحقل مطلوب *',
                'rating.min' => 'يرجى تحديد التقييم *',
                'rating.max' => 'يرجى تحديد التقييم  *',
                'rating.integer' => 'يرجى تحديد التقييم *',

                'description.min' => 'يجب أن يتكون الوصف من 15 حرف على الأقل  *',
                'description.max' => 'الوصف أطول من اللازم الحد الأقصى 350 حرف *',
            ]);




            $checkOrder = Orders::where('OID', $request->OID)->where('Account_number', Auth::user()->Account_number)->count();
            if($checkOrder > 0){
                $checkOffer = Offers::where('OID', $request->OID)->where('Account_number', $request->to)->whereIn('status', ['2','3'])->count();
                if($checkOffer > 0){
                    $checkRating = UserRating::where('order_id', $request->OID)->where('for', $request->to)->where('from', Auth::user()->Account_number)->count();
                    if($checkRating > 0){
                        return response()->json(['error' => 'لقد قمت بتقييم هذا المقاول من قبل'], 403);


                    }else{
                        $stmt = UserRating::create([
                            'for' => $request->to,
                            'from' => Auth::user()->Account_number,
                            'text' => $request->description,
                            'rating' => $request->rating,
                            'order_id' => $request->OID,
                        ]);
                        if($stmt){
                            UserNotification::create([
                                'to' => $request->to,
                                'from', Auth::user()->Account_number,
                                'message' => 'قام <a href="/@'.Auth::user()->username.'">'.Auth::user()->frist_name.' </a> بتقييم عملك على طلب رقم <a href="/order/'.$request->OID.'/manage">#'.$request->OID.'</a>',
                                'notifybyemail' => "0",
                                'email_status' => "0"
                            ]);
                            return response()->json(['success' => 'تمت العملية بنجاح'], 200);
                        }else{
            return response()->json(['error' => 'حصل خطأ اثناء محاولة معالجة طلبك يرجى اعادة المحاولة'], 500);

                        }
                    }

                }else{
            return response()->json(['error' => 'لايمكنك تقييم هذا المستخدم'], 403);

                }
            }else{
            return response()->json(['error' => 'Bad Request'], 400);

            }






        }else{
            return response()->json(['error' => 'Bad Request'], 400);
        }
    }
}
