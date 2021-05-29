@extends('layouts.layout')
@section('title', 'خدماتي')
@section('description', 'منصة مقاولة توفر لك العديد من الخدمات لمساعدتك على بدء و تطوير نشاطك التجاري')
@section('ogimage', asset('image/moqawala.ma.jpg'))
@section('content')
@php
$i=0;
$datajson = file_get_contents('database/data.json');
$jsondatas = json_decode($datajson, true);
$email = Auth::user()->email;

$OrderServiceLinks = DB::table('demande_service_links')->orderBy('created_at', 'DESC')->where('user_email', $email)->get();

@endphp
<div class="wd-80 uk-margin-small-top uk-margin-small-bottom">
    <style>
    </style>
    <div dir="rtl" class="uk-text-center " uk-grid>

        <div class="uk-width-1-4@m">
            <div class="uk-card uk-card-default uk-card-body" uk-sticky="bottom: true">
                <h4 class="uk-card-title uk-text-right">
                    مرحبا Saad Rifai !</h4>
                <hr>


                <ul dir="rtl" class="uk-list uk-list-divider uk-text-right user-menu">
                    <li><a href="./"><span uk-icon="user"></span> حسابي </a></li>
                    <li class="active"><a href="./services"><span uk-icon="list"></span> خدماتي</a></li>
                    <li><a href="./products"><span uk-icon="grid"></span> منتجاتي</a></li>
                    <li><a href="./history"><span uk-icon="history"></span> سجل المدفوعات</a></li>
                    <li><a href="./setting"><span uk-icon="cog"></span> الاعدادات </a></li>
 
                </ul>
                <br>

            </div>
        </div>
        <div class="uk-width-expand@m ">
            <div class="uk-card uk-card-default uk-card-body uk-overflow-auto">
                <h4 class="uk-card-title uk-text-right">
                    <span uk-icon="list"></span> خدماتي  </h4>
                <hr>
  
                
                <table dir="rtl" class="uk-table uk-table-hover uk-table-divider uk-text-right">
                    <thead>
                        <tr>
                            <th>رقم الطلب (OID)</th>
                            <th>اسم الخدمة</th>
                            <th>سعر الخدمة</th>
                            <th>الحالة</th>
                            <th>تاريخ الطلب</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        
             @foreach($OrderServiceLinks as $OrderServiceLink) 
           
            @php
            $i++;
            $service = $OrderServiceLink->service; 
            $OID = $OrderServiceLink->OID;
            $servicenames =  DB::table('services')->where('SID', $service)->get();

            foreach ($servicenames as $servicename);
   
            if($service == '1'){
            $ServiceInfos =  DB::table('brandings')->where('OID', $OID)->get();
            foreach($ServiceInfos as $ServiceInfo);
            $OIDN =  $ServiceInfo->OID;
            $linkOID = explode('#',$OIDN);


            echo '<tr>';
            echo'<td>'.$ServiceInfo->OID.'</td>';
            echo'<td>'.$servicename->name.'</td>';
            echo'<td>'.($payinfo->amount-$coupon_cost).' </td>';
            echo '<td><span class="uk-label  uk-label-danger">في انتضار الدفع</span></td>';
            echo'<td>'.$ServiceInfo->created_at.'</td>';
            echo'<td><a href="'.asset('pay/'.$linkOID[1].'').'"><button class="btn-small-act green"><span uk-icon="credit-card"></span> الدفع</button></a></td>';
            echo '</tr>';
            }elseif ($service == '2') {
            $ServiceInfos =  DB::table('consultation_controllers')->where('OID', $OID)->get();
            foreach($ServiceInfos as $ServiceInfo);
            echo '<tr>';
            echo'<td>'.$ServiceInfo->OID.'</td>';
            echo'<td>'.$servicename->name.'</td>';
            echo'<td>'.($payinfo->amount-$coupon_cost).' </td>';
            if($ServiceInfo->status == 0){
                echo '<td><span class="uk-label  uk-label-primary">جديد</span></td>';
            }elseif ($ServiceInfo->status == 1) {
                echo '<td><span class="uk-label  uk-label-info">تم التواصل</span></td>';
            }elseif ($ServiceInfo->status == 2) {
                echo '<td><span class="uk-label  uk-label-warning">في انتضار الدفع</span></td>';
            }elseif ($ServiceInfo->status == 3) {
                echo '<td><span class="uk-label  uk-label-warning">معلومات ناقصة</span></td>';
            }elseif ($ServiceInfo->status == 4) {
                echo '<td><span class="uk-label  uk-label-success">مكتمل</span></td>';
            }elseif ($ServiceInfo->status == 5) {
                echo '<td><span class="uk-label  uk-label-danger">ملغى</span></td>';
            }elseif ($ServiceInfo->status == 6) {
                echo '<td><span class="uk-label  uk-label-info">جاري الانجاز</span></td>';
            }elseif ($ServiceInfo->status == 7) {
                echo '<td><span class="uk-label  uk-label-danger">فشل الاتصال</span></td>';
            }elseif ($ServiceInfo->status == 8) {
                echo '<td><span class="uk-label  uk-label-info">تم ارسال عرض الاسعار </span></td>';
            }elseif ($ServiceInfo->status == 9) {
                echo '<td><span class="uk-label  uk-label-danger">بدون رد</span></td>';
            }elseif ($ServiceInfo->status == 10) {
                echo '<td><span class="uk-label  uk-label-info">جاري تجهيز عرض الأسعار</span></td>';
            }
            echo'<td>'.$ServiceInfo->created_at.'</td>';
            echo '</tr>';
            }elseif ($service == '3') {
            $ServiceInfos =  DB::table('creation_socites')->where('OID', $OID)->get();
            foreach($ServiceInfos as $ServiceInfo);
            echo '<tr>';
            echo'<td>'.$ServiceInfo->OID.'</td>';
            echo'<td>'.$servicename->name.'</td>';
            echo'<td>'.($payinfo->amount-$coupon_cost).' </td>';
            if($ServiceInfo->status == 0){
                echo '<td><span class="uk-label  uk-label-primary">جديد</span></td>';
            }elseif ($ServiceInfo->status == 1) {
                echo '<td><span class="uk-label  uk-label-info">تم التواصل</span></td>';
            }elseif ($ServiceInfo->status == 2) {
                echo '<td><span class="uk-label  uk-label-warning">في انتضار الدفع</span></td>';
            }elseif ($ServiceInfo->status == 3) {
                echo '<td><span class="uk-label  uk-label-warning">معلومات ناقصة</span></td>';
            }elseif ($ServiceInfo->status == 4) {
                echo '<td><span class="uk-label  uk-label-success">مكتمل</span></td>';
            }elseif ($ServiceInfo->status == 5) {
                echo '<td><span class="uk-label  uk-label-danger">ملغى</span></td>';
            }elseif ($ServiceInfo->status == 6) {
                echo '<td><span class="uk-label  uk-label-info">جاري الانجاز</span></td>';
            }elseif ($ServiceInfo->status == 7) {
                echo '<td><span class="uk-label  uk-label-danger">فشل الاتصال</span></td>';
            }elseif ($ServiceInfo->status == 8) {
                echo '<td><span class="uk-label  uk-label-info">تم ارسال عرض الاسعار </span></td>';
            }elseif ($ServiceInfo->status == 9) {
                echo '<td><span class="uk-label  uk-label-danger">بدون رد</span></td>';
            }elseif ($ServiceInfo->status == 10) {
                echo '<td><span class="uk-label  uk-label-info">جاري تجهيز عرض الأسعار</span></td>';
            }
            echo'<td>'.$ServiceInfo->created_at.'</td>';
            echo '</tr>';
            }elseif ($service == '4') {
                $payinfos =  DB::table('payment_systems')->where('OID', $OID)->get();
            foreach ($payinfos as $payinfo);
            $code_coupon = $payinfo->coupon_code;
            $coupon_infos =  DB::table('coupons')->where('code', $code_coupon)->get();
            if($coupon_infos->count() > 0){
              foreach ($coupon_infos as $coupon_info);
              $coupon_cost = ($payinfo->amount*$coupon_info->percentage/100);
            }else{
               $coupon_cost = 0;
            }

            $ServiceInfos =  DB::table('demande_cardauotos')->where('OID', $OID)->get();
            foreach($ServiceInfos as $ServiceInfo);
            $OIDN =  $ServiceInfo->OID;
            $linkOID = explode('#',$OIDN);
            echo '<tr>';
            echo'<td>'.$ServiceInfo->OID.'</td>';
            echo'<td>'.$servicename->name.'</td>';
            echo'<td>'.number_format($payinfo->amount-$coupon_cost).' MAD </td>';
            if($ServiceInfo->status == 0){
                echo '<td><span class="uk-label  uk-label-warning">غير مكتمل</span></td>';
            }elseif ($ServiceInfo->status == 1) {
                echo '<td><span class="uk-label  uk-label-info">تم التواصل</span></td>';
            }elseif ($ServiceInfo->status == 2) {
                echo '<td><span class="uk-label  uk-label-warning">في انتضار الدفع</span></td>';
            }elseif ($ServiceInfo->status == 3) {
                echo '<td><span class="uk-label  uk-label-warning">معلومات ناقصة</span></td>';
            }elseif ($ServiceInfo->status == 4) {
                echo '<td><span class="uk-label  uk-label-success">مكتمل</span></td>';
            }elseif ($ServiceInfo->status == 5) {
                echo '<td><span class="uk-label  uk-label-danger">ملغى</span></td>';
            }elseif ($ServiceInfo->status == 6) {
                echo '<td><span class="uk-label  uk-label-info">جاري الانجاز</span></td>';
            }elseif ($ServiceInfo->status == 7) {
                echo '<td><span class="uk-label  uk-label-danger">فشل الاتصال</span></td>';
            }elseif ($ServiceInfo->status == 8) {
                echo '<td><span class="uk-label  uk-label-info">تم ارسال عرض الاسعار </span></td>';
            }elseif ($ServiceInfo->status == 9) {
                echo '<td><span class="uk-label  uk-label-danger">بدون رد</span></td>';
            }elseif ($ServiceInfo->status == 10) {
                echo '<td><span class="uk-label  uk-label-info">جاري تجهيز عرض الأسعار</span></td>';
            }
            echo'<td>'.$ServiceInfo->created_at.'</td>';
            if($ServiceInfo->status == 0){
                echo'<td><a href="'.asset('pay/'.$payinfo->transaction_id.'/'.$linkOID[1]).'"><button class="btn-small-act green"><span uk-icon="credit-card"></span> اتمام الطلب</button></a></td>';

            }elseif($ServiceInfo->status == 2) {
                echo'<td><a href="'.asset('pay/'.$payinfo->transaction_id.'/'.$linkOID[1]).'"><button class="btn-small-act green"><span uk-icon="credit-card"></span> الدفع</button></a></td>';

            }else {
                echo '<td></td>';
            }
            echo '</tr>';
            }
            elseif ($service == '5') {

            $payinfos =  DB::table('payment_systems')->where('OID', $OID)->get();
            foreach ($payinfos as $payinfo);
            $code_coupon = $payinfo->coupon_code;
            $coupon_infos =  DB::table('coupons')->where('code', $code_coupon)->get();
            if($coupon_infos->count() > 0){
              foreach ($coupon_infos as $coupon_info);
              $coupon_cost = ($payinfo->amount*$coupon_info->percentage/100);
            }else{
               $coupon_cost = 0;
            }



            $ServiceInfos =  DB::table('demande_etudes')->where('OID', $OID)->get();
            foreach($ServiceInfos as $ServiceInfo);
            $OIDN =  $ServiceInfo->OID;
            $linkOID = explode('#',$OIDN);
            echo '<tr>';
            echo'<td>'.$ServiceInfo->OID.'</td>';
            echo'<td>'.$servicename->name.'</td>';
            echo'<td>'.number_format($payinfo->amount-$coupon_cost,2).' MAD </td>';
            if($ServiceInfo->status == 0){
                echo '<td><span class="uk-label  uk-label-warning">غير مكتمل</span></td>';
            }elseif ($ServiceInfo->status == 1) {
                echo '<td><span class="uk-label  uk-label-info">تم التواصل</span></td>';
            }elseif ($ServiceInfo->status == 2) {
                echo '<td><span class="uk-label  uk-label-warning">في انتضار الدفع</span></td>';
            }elseif ($ServiceInfo->status == 3) {
                echo '<td><span class="uk-label  uk-label-warning">معلومات ناقصة</span></td>';
            }elseif ($ServiceInfo->status == 4) {
                echo '<td><span class="uk-label  uk-label-success">مكتمل</span></td>';
            }elseif ($ServiceInfo->status == 5) {
                echo '<td><span class="uk-label  uk-label-danger">ملغى</span></td>';
            }elseif ($ServiceInfo->status == 6) {
                echo '<td><span class="uk-label  uk-label-info">جاري الانجاز</span></td>';
            }elseif ($ServiceInfo->status == 7) {
                echo '<td><span class="uk-label  uk-label-danger">فشل الاتصال</span></td>';
            }elseif ($ServiceInfo->status == 8) {
                echo '<td><span class="uk-label  uk-label-info">تم ارسال عرض الاسعار </span></td>';
            }elseif ($ServiceInfo->status == 9) {
                echo '<td><span class="uk-label  uk-label-danger">بدون رد</span></td>';
            }elseif ($ServiceInfo->status == 10) {
                echo '<td><span class="uk-label  uk-label-info">جاري تجهيز عرض الأسعار</span></td>';
            }
            echo'<td>'.$ServiceInfo->created_at.'</td>';
            if($ServiceInfo->status == 0){
                echo'<td><a href="'.asset('pay/'.$payinfo->transaction_id.'/'.$linkOID[1]).'"><button class="btn-small-act green"><span uk-icon="credit-card"></span> اتمام الطلب</button></a></td>';

            }elseif($ServiceInfo->status == 2) {
                echo'<td><a href="'.asset('pay/'.$payinfo->transaction_id.'/'.$linkOID[1]).'"><button class="btn-small-act green"><span uk-icon="credit-card"></span> الدفع</button></a></td>';

            }else {
                echo'<td></td>';

            }
            echo '</tr>';
            }elseif ($service == '6') {
            $ServiceInfos =  DB::table('development_informatiques')->where('OID', $OID)->get();
            foreach($ServiceInfos as $ServiceInfo);
            echo '<tr>';
            echo'<td>'.$ServiceInfo->OID.'</td>';
            echo'<td>'.$servicename->name.'</td>';
            echo'<td>'.($payinfo->amount-$coupon_cost).' </td>';
            if($ServiceInfo->status == 0){
                echo '<td><span class="uk-label  uk-label-primary">جديد</span></td>';
            }elseif ($ServiceInfo->status == 1) {
                echo '<td><span class="uk-label  uk-label-info">تم التواصل</span></td>';
            }elseif ($ServiceInfo->status == 2) {
                echo '<td><span class="uk-label  uk-label-warning">في انتضار الدفع</span></td>';
            }elseif ($ServiceInfo->status == 3) {
                echo '<td><span class="uk-label  uk-label-warning">معلومات ناقصة</span></td>';
            }elseif ($ServiceInfo->status == 4) {
                echo '<td><span class="uk-label  uk-label-success">مكتمل</span></td>';
            }elseif ($ServiceInfo->status == 5) {
                echo '<td><span class="uk-label  uk-label-danger">ملغى</span></td>';
            }elseif ($ServiceInfo->status == 6) {
                echo '<td><span class="uk-label  uk-label-info">جاري الانجاز</span></td>';
            }elseif ($ServiceInfo->status == 7) {
                echo '<td><span class="uk-label  uk-label-danger">فشل الاتصال</span></td>';
            }elseif ($ServiceInfo->status == 8) {
                echo '<td><span class="uk-label  uk-label-info">تم ارسال عرض الاسعار </span></td>';
            }elseif ($ServiceInfo->status == 9) {
                echo '<td><span class="uk-label  uk-label-danger">بدون رد</span></td>';
            }elseif ($ServiceInfo->status == 10) {
                echo '<td><span class="uk-label  uk-label-info">جاري تجهيز عرض الأسعار</span></td>';
            }
            echo'<td>'.$ServiceInfo->created_at.'</td>';
            echo '</tr>';
            }elseif ($service == '7') {
            $ServiceInfos =  DB::table('emarketings')->where('OID', $OID)->get();
            foreach($ServiceInfos as $ServiceInfo);
            echo '<tr>';
            echo'<td>'.$ServiceInfo->OID.'</td>';
            echo'<td>'.$servicename->name.'</td>';
            echo'<td>'.($payinfo->amount-$coupon_cost).' </td>';
            if($ServiceInfo->status == 0){
                echo '<td><span class="uk-label  uk-label-primary">جديد</span></td>';
            }elseif ($ServiceInfo->status == 1) {
                echo '<td><span class="uk-label  uk-label-info">تم التواصل</span></td>';
            }elseif ($ServiceInfo->status == 2) {
                echo '<td><span class="uk-label  uk-label-warning">في انتضار الدفع</span></td>';
            }elseif ($ServiceInfo->status == 3) {
                echo '<td><span class="uk-label  uk-label-warning">معلومات ناقصة</span></td>';
            }elseif ($ServiceInfo->status == 4) {
                echo '<td><span class="uk-label  uk-label-success">مكتمل</span></td>';
            }elseif ($ServiceInfo->status == 5) {
                echo '<td><span class="uk-label  uk-label-danger">ملغى</span></td>';
            }elseif ($ServiceInfo->status == 6) {
                echo '<td><span class="uk-label  uk-label-info">جاري الانجاز</span></td>';
            }elseif ($ServiceInfo->status == 7) {
                echo '<td><span class="uk-label  uk-label-danger">فشل الاتصال</span></td>';
            }elseif ($ServiceInfo->status == 8) {
                echo '<td><span class="uk-label  uk-label-info">تم ارسال عرض الاسعار </span></td>';
            }elseif ($ServiceInfo->status == 9) {
                echo '<td><span class="uk-label  uk-label-danger">بدون رد</span></td>';
            }elseif ($ServiceInfo->status == 10) {
                echo '<td><span class="uk-label  uk-label-info">جاري تجهيز عرض الأسعار</span></td>';
            }
            echo'<td>'.$ServiceInfo->created_at.'</td>';
            echo '</tr>';
            }
            @endphp
            
            
    
                            @endforeach
                            
      
                        </tr>
  
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection