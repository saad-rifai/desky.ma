<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CapchaSampleController extends Controller
{
    public function getcaptcha(){
        $num1 = rand(1,10);
        $num2 = rand(1,10);
        
    }
}
