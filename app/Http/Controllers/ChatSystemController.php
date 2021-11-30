<?php

namespace App\Http\Controllers;

use App\chat_system;
use App\Offers;
use App\Orders;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatSystemController extends Controller
{
    public function NewMessageInsideProject(Request $request)
    {
        $this->validate($request, [
            'OID' => 'required|integer',
            'to' => 'required|integer',
            'message' => 'required|max:1500|min:1',
        ], $messages = [
            'OID.required' => 'طلب خاطئ يرجى اعادة تحميل الصفحة',
            'to.required' => 'طلب خاطئ يرجى اعادة تحميل الصفحة',

            'OID.integer' => 'طلب خاطئ يرجى اعادة تحميل الصفحة',
            'to.integer' => 'طلب خاطئ يرجى اعادة تحميل الصفحة',

            'message.required' => 'يرجى كتابة رسالة',
            'message.min' => 'يرجى كتابة رسالة',
            'message.max' => 'الرسالة أطول من اللازم الحد الأقصى 1500 حرف',
        ]);

        $destinationCeck = User::where("Account_number", $request->to)->count();
        $oidCeck = Orders::where('OID', $request->OID)->where('status', '!=', '5')->count();
        $oidOwnerCeck = Orders::where('OID', $request->OID)->where('Account_number', Auth::user()->Account_number)->where('status', '!=', '5')->count();

        if ($oidCeck > 0 && $destinationCeck > 0) {
            if ($oidOwnerCeck > 0) {
                $destinationCeck2 = Offers::where('OID', $request->OID)->where('Account_number', $request->to)->whereIn('status', ['1', '2'])->count();
                if ($destinationCeck2 > 0) {
                    $stmt = chat_system::create([
                        'OID' => $request->OID,
                        'from' => Auth::user()->Account_number,
                        'to' => $request->to,
                        'type' => "1",
                        'message' => $request->message,
                        'status' => "0"
                    ]);
                } else {
                    return response()->json(['error' => 'لايمكنك ارسال الرسالة لهذا المقاول لأنك لم توظفه على هذا المشروع.'], 400);
                }
            } else {

                /* If Is hired in Project */
                $destinationCeck2 = Offers::where('OID', $request->OID)->where('Account_number', Auth::user()->Account_number)->whereIn('status', ['1', '2'])->count();
                if ($destinationCeck2 > 0) {
                    $stmt = chat_system::create([
                        'OID' => $request->OID,

                        'from' => Auth::user()->Account_number,
                        'to' => $request->to,
                        'type' => "1",
                        'message' => $request->message,
                        'status' => "0"
                    ]);
                } else {
                    return response()->json(['error' => 'لايمكنك ارسال الرسالة لهذا الحساب لانه لم يقم بتوظيفك.'], 400);
                }
            }
        } else {
            return response()->json(['error' => 'طلب خاطئ لا يمكن ارسال الرسالة !'], 400);
        }
    }
    public function ProjectGetChatList(Request $request){
        if(isset($request->OID)){
            $OrderOwnerCeck = Orders::where('OID', $request->OID)->where('Account_number', Auth::user()->Account_number)->count();
            if($OrderOwnerCeck > 0){
                $Destination = Offers::where('OID', $request->OID)->whereIn('status', ['1', '2'])->get();
                
                /* Count New Messages */
              //  foreach($GetDestinations as $Destination);
                for($i=0; $i < $Destination->count(); $i++){
                    $NewMessagesSended = chat_system::where('from', $Destination[$i]->Account_number)->whereIn('status', ['0','1'])->count();
                    $Destination[$i]->NewMessages = $NewMessagesSended;
                    $LastMessage = chat_system::where('OID', $request->OID)->where('type', "1")->where(function ($qu) use ($Destination,$i){
                        $qu->where('from', $Destination[$i]->Account_number)
                        ->where('to', Auth::user()->Account_number);

                    })->orWhere(function ($qu) use ($Destination,$i){
                        $qu->where('to', $Destination[$i]->Account_number)
                        ->where('from', Auth::user()->Account_number);
                    })->first();
                    $Destination[$i]->LastMessage = $LastMessage;

                }
                return response()->json(['data' => $Destination], 200);

            }else{
                return response()->json(['error' => 'طلب خاطئ !'], 400);
            }
        }else{
           return response()->json(['error' => 'bad request'], 400);
        }
    }
}
