@extends('layouts.layout')
@extends('user-espace.layout')
@section('title', 'سجل المدفوعات')
@section('description', 'منصة مقاولة توفر لك العديد من الخدمات لمساعدتك على بدء و تطوير نشاطك التجاري')
@section('ogimage', asset('image/moqawala.ma.jpg'))
@section('content')
@php
$datajson = file_get_contents('database/data.json');
$jsondatas = json_decode($datajson, true);
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
                    <li class=""><a href="./services"><span uk-icon="list"></span> خدماتي</a></li>
                    <li ><a  href="./products"><span uk-icon="grid"></span> منتجاتي</a></li>
                    <li class="active"><a href="./history"><span uk-icon="history"></span> سجل المدفوعات</a></li>
                    <li><a href="./setting"><span uk-icon="cog"></span> الاعدادات </a></li>
 
                </ul>
                <br>

            </div>
        </div>
        <div class="uk-width-expand@m ">
            <div class="uk-card uk-card-default uk-card-body uk-overflow-auto">
                <h4 class="uk-card-title uk-text-right">
                    <span uk-icon="history"></span> سجل المدفوعات  </h4>
                <hr>
  
                
                <table dir="rtl" class="uk-table uk-table-hover uk-table-divider uk-text-right">
                    <thead>
                        <tr>
                            <th>رقم الطلب (OID)</th>
                            <th>رقم الفاتورة </th>
                            <th>المنتج أو الخدمة</th>
                            <th>المبلغ</th>
                            <th>الحالة</th>
                            <th>تاريخ الانشاء</th>
                            <th>تاريخ الدفع</th>
                            <th> وسيلة الدفع</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#987024512545</td>
                            <td>240147</td>
                            <td>390 Dhs</td>
                            <td><span class="uk-label  uk-label-success">تم الدفع</span></td>
                            <td>2021/04/14</td>
                            <td>2021/04/14</td>
                            <td>البطاقة البنكية</td>
                            <td><a href="#"><button class="btn-small-act">استخراج الفاتورة</button></a></td>
                        </tr>
  
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection