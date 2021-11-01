<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function publicProfile(Request $request){
        if($request->username){
            $stmts = User::where('username', $request->username)->get();
            $count = $stmts->count();
            if($count > 0){
                foreach($stmts as $stmt);
                return view('user-public-profile')->with('data', $stmt);
            }else{
                abort(404,$message='لم يتم ايجاد الحساب');
            }

        }else{
            abort(404);
        }

    }
}
