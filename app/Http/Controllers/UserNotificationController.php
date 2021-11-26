<?php

namespace App\Http\Controllers;

use App\User;
use App\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserNotificationController extends Controller
{
    public function NotificationForMenu(){
        if(Auth::check()){
            $stmt = Auth::user()->notification->take(20);
            for($i=0; $i < $stmt->count(); $i++){
                $stmt[$i]->date = date("Y-m-d H:i:s", strtotime($stmt[$i]->created_at));
                $stmt[$i]->message1 = html_entity_decode($stmt[$i]->message);
            }
            $NotReadNotification = Auth::user()->notification->whereIn('status',['0','1'])->count();
            $NotSoundCount = Auth::user()->notification->where('status', '=', '0')->count();
            if($NotSoundCount > 0){
                $NotSound = true;
            }else {
                $NotSound = false;
            }
            UserNotification::where('to', Auth::user()->Account_number)->where('status', "0")->update([
                'status' => "1"
            ]);
            $date = date("Y-m-d H:i:s");
            return response()->json(['data' => $stmt, 'NotReadNotification' => $NotReadNotification, 'NotSound' => $NotSound, 'date' => $date], 200);
        }else{
            return response()->json(['error' => 'bad Request'], 400);
        }
    }
    public function AllNotificationReaded(){
        if(Auth::check()){
           $stmt = UserNotification::where('to', Auth::user()->Account_number)->update([
                'status' => "2"
            ]);
            if($stmt){
                return response()->json(['success' => true], 200);
            }else{
                return response()->json(['success' => false], 500);

            }
        }else{
            return response()->json(['error' => 'bad Request'], 400);
        }
    }
}
