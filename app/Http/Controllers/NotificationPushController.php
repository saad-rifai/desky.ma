<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NotificationPushController extends Controller
{
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
                $notifications = DB::table('notification_pushes')->where("to", Auth::user()->email)->get();
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
