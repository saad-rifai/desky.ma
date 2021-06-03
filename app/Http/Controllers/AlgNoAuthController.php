<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MyCart;

class AlgNoAuthController extends Controller
{
    public function generateOrderID(){
        $OID = date('ymdh').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 9);
        $stmt = MyCart::where('OID', $OID)->count();
        if($stmt > 0){
           while($stmt > 0){
               $OID = date('ymdh').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 9);
               $stmt = MyCart::where('OID', $OID)->count();
           }
           return $OID;

        }else{
            return $OID;
        }
    }
}
