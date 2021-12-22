<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Mail\NewTicketCreated;
use App\Tickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HelpCenterController extends Controller
{
    public function NewTicket(Request $request){
        $this->validate($request, [
            'category' => 'required|integer|max:4|min:0',
            'message' => 'required|min:25|max:850',
            'subject' => 'required|min:8|max:150',
        ], $messages = [
            'required' => 'هذا الحقل مطلوب',
      
            'subject.max' =>  'عنوان الموضوع الذي أدخلته أطول من اللازم',
            'subject.min' =>  'عنوان الموضوع الذي أدخلته قصير',
 
            'category.integer' => 'يرجى تحديد الصنف',
            'category.max' =>  'يرجى تحديد الصنف',
            'category.min' => 'يرجى تحديد الصنف',
 
            'message.min' => 'الوصف الذي ادخلته أقصر من اللازم',
            'message.max' => 'الوصف اللذي أدخلته أطول من اللازم الحد الأقصى 850 حرف'
        ]);
        $TID = random_int(100000, 9999999999);

        $stmt = Tickets::create([
            'TID' => $TID,
            'Account_number' => Auth::user()->Account_number,
            'subject' => $request->subject,
            'category' => $request->category,
            'message' => $request->message,
            'status' => '0',
        ]);
        if($stmt){
            $dataEmail = [
                'fname' => Auth::user()->frist_name,
                'TID' => $TID,
            ];
            $datajob = [
                'to' => Auth::user()->email,
                'emailData' => new NewTicketCreated($dataEmail)
            ];
            dispatch(new SendEmail($datajob));
            return response()->json(['success' => 'تم انشاء تذكرتك رقم #'.$TID.' سوف تتوصل برد في أقرب وقت'], 200);
        }else{
            return response()->json(['error', 'system error'], 500);
        }
    }
}
