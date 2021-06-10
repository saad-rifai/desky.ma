@extends('desky.layouts.app')

@section('title', 'تواصل معنا')
@section('content')
<header style="height: 400px">
    <div class="uk-child-width-1-1@s uk-light" uk-grid>
        <div>
            <div  class="uk-background-cover uk-height-large uk-panel uk-flex uk-flex-center uk-flex-middle"
                style="background-image: linear-gradient(rgb(255 175 33), rgb(255 111 44)); height: 400px !important">
                <div  class="wd-90 uk-text-center">
                    <div class="content-header uk-text-center">
                        <h1 class="uk-title header">تواصل معنا</h1>
                        </p>


                    </div>
                </div>
            </div>
        </div>
</header>
<div style="">
    <br>
    <br>

    <div id="facture" class="wd-90 uk-margin-top ">

        <div uk-grid>
            <div class="uk-width-1-3@s">
                <h3 class="uk-text-right">معلومات التواصل</h3>
                <table class="uk-table  cart-info cart-table-moqawala uk-text-right min-p" dir="rtl">
                    <tbody>
                      <tr>
                        <td> <i class="fas fa-envelope icon-cart-info"> </td>
                        <td class="labelcart">
                            <h3 class="text-cart-info">contact@desky.ma</h3>
                        </td>
                      </tr>
                      <tr>
                        <td> <i class="far fa-clock  icon-cart-info"></i> </td>
                        <td class="labelcart">
                            <h3 style="line-height: 2 !important" class="text-cart-info"> من الاثنين الى الجمعة <br>
                                 من الساعة 9 صباحا الى 7 مساءا</h3>
                        </td>
                      </tr>
                            @php
$datajson = file_get_contents('database/data.json');
$jsondata = json_decode($datajson, true);
@endphp

                    </tbody>
                  </table>
                  <h4 class="uk-text-right uk-margin">تابعنا على</h4>
                  <div class="socialmedia-container uk-text-right">
                    <a href="{{ $jsondata['socialmedia']['twitter'] }}" class="uk-icon-button"
                        uk-icon="twitter"></a>
                    <a href="{{ $jsondata['socialmedia']['facebook'] }}"
                        class="uk-icon-button  uk-margin-small-right" uk-icon="facebook"></a>
                    <a href="{{ $jsondata['socialmedia']['instagram'] }}"
                        class="uk-icon-button uk-margin-small-right" uk-icon="instagram"></a>
                    <a href="{{ $jsondata['socialmedia']['youtube'] }}"
                        class="uk-icon-button uk-margin-small-right" uk-icon="youtube"></a>

                </div>
            </div>
            <div class="uk-width-expand@m">
                <h3 class="uk-text-right">ارسال رسالة</h3>
                <form class="uk-grid-small uk-text-right" dir="rtl" uk-grid>
                    <div class="uk-width-1-2@s">
                        <input class="uk-input" type="text" placeholder="الاسم الأول">
                    </div>
                    <div class="uk-width-1-2@s">
                        <input class="uk-input" type="text" placeholder="الاسم الاخير">
                    </div>
                <div class="uk-width-1-1">
                    <input class="uk-input" type="text" placeholder="البريد الالكتروني">
                </div>

                <div class="uk-width-1-2@s">
                   <select name="" class="uk-select" id="">
                       <option value="">التصنيف</option>
                       <option value="">عميل </option>
                       <option value="">صحافي</option>
                       <option value="">مستثمر</option>
                       <option value="">أخر</option>
                   </select>
                </div>
                <div class="uk-width-1-2@s">
                    <input class="uk-input" type="text" placeholder="الموضوع">
                </div>
                <div class="uk-width-1-1@s">
                   <textarea name="" class="uk-textarea" id="" cols="30" placeholder="الرسالة" rows="6"></textarea>
                </div>
                <div class="uk-width-1-1@s">
                 <button type="submit" class="uk-button uk-button-primary">ارسال</button>
                 </div>
            </form>
        </div>
        </div>
    </div>
</div>



<br>
<br>

@endsection
