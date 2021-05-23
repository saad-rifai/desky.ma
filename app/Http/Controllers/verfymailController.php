<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tokens;
use App\User;
use Illuminate\Support\Facades\DB;


class verfymailController extends Controller
{
    public  function verfylink(Request $request){
        $UID = $request->UID;
        $token = $request->token;
      $check = tokens::all()->where('token' , $token)->where('UID', $UID);
      $count = $check->count();
      if($count > 0){
        $editdata = [
            'email_verified_at' => date("Y-m-d H:i:s"),
        ];

          $stmt = User::where("id" , $UID)->update($editdata);
          if($stmt){
            return view("desky.verfymail")->with(['succes' => true]);

          }else{
            return view("desky.verfymail")->with(['succes' => false]);
          }
      }else{
        return abort(404);
      }
    }
}
