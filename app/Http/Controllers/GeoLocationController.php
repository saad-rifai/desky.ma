<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeoLocationController extends Controller
{
    public function index(Request $request)
    {
            $ip = "105.155.23.155";
            $data = \Location::get($ip);
         echo intval($data->areaCode);
    }
}
