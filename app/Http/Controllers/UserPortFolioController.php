<?php

namespace App\Http\Controllers;

use App\UserPortFolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserPortFolioController extends Controller
{
    public function index(Request $request){
        if(isset($request->account_number) && $request->account_number != null){
           $stmts = Cache::remember('user-portfolio-'.$request->account_number, 86400, function () use($request) {
               return  UserPortFolio::where('Account_number', $request->account_number)->where('status', 0)->paginate(5,['title', 'description', 'files', 'created_at']);   
           });
           return response()->json($stmts, 200);

        }else{
            return response()->json('Bad Request ! ', 400);
        }
    }
}
