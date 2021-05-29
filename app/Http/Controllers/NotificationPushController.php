<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NotificationPushController extends Controller
{
    public function SendPush($to,$from,$status,$subject,$message,$link){
        /*
         Status Notifications
         0 = Notification Not read with Sound !
         1 = Notification Not read without Sound ! 
         2 = Notification already read
         */
        if(isset($to) && isset($from) && isset($status) && isset($subject) && isset($message) && is_numeric($status) && $message != "" && isset($link)){


        $date =  date("Y-m-d H:i:s");
        $stmt = DB::table('notification_pushes')->insert([
            'to' => $to,
            'from' => $from,
            'status' => $status,
            'subject' => $subject,
            'message' => $message,
            'link' => $link, 
            'created_at' => $date
            ]);
            if($stmt){
                return response('La notification a été envoyée avec succès', 200);
            }else{
                return response('La notification na pas pu être envoyée', 500);
            }
        }else{
            return response('La notification na pas pu être envoyée else', 500);
        }

    }
    public function apishow(Request $request){
        if($request->highlight && $request->highlight == true){
            $editdata = [
                'status' => 2,
            ];

            DB::table('notification_pushes')
                ->where("to", Auth::user()->email)
                ->where("status", 0)
                ->orWhere("status", 1)
                ->update($editdata);
                $notifications = DB::table('notification_pushes')->where("to", Auth::user()->email)->orderBy('created_at', 'desc')->limit('15')->get();
                $highlight = DB::table('notification_pushes')->where("to", Auth::user()->email)->where("status" , 0)->get()->count();
                return response()->json([$notifications, "highlight" => $highlight], 200);
        }else{
            $notifications = DB::table('notification_pushes')->where("to", Auth::user()->email)->orderBy('created_at', 'desc')->limit('15')->get();
            $highlight = DB::table('notification_pushes')->where("to", Auth::user()->email)->where("status" , 1)->orWhere("status", 0)->get()->count();
            $soundPush = DB::table('notification_pushes')->where("to", Auth::user()->email)->where("status" , 0)->get()->count();
            $editdata = [
                'status' => 1,
            ];

            DB::table('notification_pushes')
                ->where("to", Auth::user()->email)
                ->where("status", 0)
                ->update($editdata);
            return response()->json([$notifications, "highlight" => $highlight, "soundPush"=> $soundPush], 200);
        }



    }
}
