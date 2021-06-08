<?php

namespace App\Http\Controllers;

use App\Subscriptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionsController extends Controller
{
    public function getTheBigPack(Request $request){
        if(isset($request->json)){
            $infos = Subscriptions::all()->where('email', Auth::user()->email);
        }else{

        }
    }
}
