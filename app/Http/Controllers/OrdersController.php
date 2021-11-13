<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function create(Request $request){
       $this->validate($request, [
           'title' => 'required|string|max:180|min:10',
           'description' => 'required|string|max:2000|min:100',
           'sector' => 'required|integer|max:4|min:1',
           'activite'=> 'nullable|integer|max:1',
           'onlineCeck' => 'required|integer|max:2|min:1',
           'budget' => 'required|integer|max:500000|min:150',
           'time' => 'required|integer|max:90|min:1',
       ], $messages = [
        'required' => 'هذا الحقل مطلوب *',
        'sector.min' => 'يرجى تحديد القطاع *',
        'sector.max' => 'يرجى تحديد القطاع *',
        'sector.integer' => 'يرجى تحديد القطاع *',
        'activite.integer' => 'يرجى تحديد تصنيف صالح *',

        'title.min' => 'يرجى ادخال عنوان صالح العنوان الذي ادخلته أقصر من اللازم  *',
        'title.max' => 'يرجى ادخال عنوان صالح العنوان الذي ادخلته أطول من اللازم  *',

        'description.min' => 'الوصف الذي ادخلته أقصر من اللازم  *',
        'description.max' => 'الوصف الذي ادخلته أطول من اللازم الحد الأقصى 2000 حرف  *',

        'onlineCeck' => 'يرجى تحديد خيار *',

        'budget.min' => 'أقل مبلغ مسموح به هو 150 درهم مغربي *',
        ]);
    }
}
