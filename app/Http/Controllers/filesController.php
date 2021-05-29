<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class filesController extends Controller
{
    public function download($filename = '')
    {
        // Check if file exists in storage directory 
        $file_path = storage_path() . $filename;

        if (file_exists($file_path)) {
            // Send Download  
            return \Response::download($file_path, $filename);
        } else {
            exit('Requested file does not exist on our server!');
        }
    }
}