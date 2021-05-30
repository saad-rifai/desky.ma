<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\desky_user_clients;
use App\Exports\ExportUserClients;
use Excel;
class exportExcle extends Controller
{
    public function saerchCliets(){

    }
   public function exportClients(Request $request){
       if(isset($request->from) && isset($request->to) && $request->from != "" && $request->to != ""){
        $request->validate([
            'from' => 'date',
            'to' => 'date'
        ]);
        $from =$request->from;
        $to=$request->to;

        return Excel::download(new ExportUserClients($from,$to), 'Liste-des-clients-'.date("Y-m-d").'.xlsx');


       }else{
           return 'searc';
       }
   }
}
