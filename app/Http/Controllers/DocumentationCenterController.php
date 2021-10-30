<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentationCenterController extends Controller
{
    public function RequestVerification(Request $request){
    $this->validate($request, [
        'document_type' => 'required|integer|min:0|max:3',
        'document_id' => 'required|string|min:4|max:20',
        'document_file.*' => 'required|mimes:jpg,jpeg,png|max:1000'
    ], $message =[
        'required' => 'هذا الحقل مطلوب *',
        'integer' => 'يرجى تحديد نوع الوثيقة *',
        'string' => 'يرجى ادخال معلومات صالحة *',
        'document_type.min' => 'يرجى تحديد نوع الوثيقة *',
        'document_type.max' => 'يرجى تحديد نوع الوثيقة *',
        'document_id.max' => 'يرجى ادخال معلومات صالحة الرمز الذي ادخلته أطول من اللازم *',
        'document_id.min' => 'يرجى ادخال معلومات صالحة الرمز الذي ادخلته أقصر من اللازم *',
    ]);

    }
}
