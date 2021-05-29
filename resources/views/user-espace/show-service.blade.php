@extends('layouts.layout')
@section('title', 'خدماتي')
@section('description', 'منصة مقاولة توفر لك العديد من الخدمات لمساعدتك على بدء و تطوير نشاطك التجاري')
@section('ogimage', asset('image/moqawala.ma.jpg'))
@section('content')
<div  class="form-border wd-80 uk-margin-top uk-margin-bottom uk-card-default uk-padding">
    <h2 class="uk-card-title uk-text-right">انشاء حساب</h2>
    <form dir="rtl" class="uk-grid-small" uk-grid>

        <div class="uk-width-1-2@s">
            <label for="">الاسم الأول <span class="red">*</span></label>
            <div class="uk-form-controls">
            <input class="uk-input" type="text" placeholder="">
        </div>
    </div>
        <div class="uk-width-1-2@s">
            <label for="">الاسم الأخير <span class="red">*</span></label>

            <div class="uk-form-controls">
            <input class="uk-input" type="text" placeholder="">
        </div>
    </div>
        <div class="uk-width-1-1@s">
            <label for=""> البريد الالكتروني <span class="red">*</span></label>
            <div class="uk-form-controls">
            <input class="uk-input" type="text" placeholder="">
        </div>
    </div>
        <div class="uk-width-1-2@s">
            <label for=""> رقم الهاتف<span class="red">*</span></label>

            <div class="uk-form-controls">
            <input class="uk-input" type="text" placeholder="">
        </div>
    </div>

        <div class="uk-width-1-2@s">
            <label for="">  الشركة (اختياري)</label>

            <div class="uk-form-controls">
            <input class="uk-input" type="text" placeholder="">
        </div>
    </div>

        <div class="uk-width-1-2@s">
            <label for="">   المدينة <span class="red">*</span></label>
            <div class="uk-form-controls">
            <input class="uk-input" type="text" placeholder="">
        </div>
    </div>
        <div class="uk-width-1-1@s">
            <label for="">   كلمة المرور <span class="red">*</span></label>
            <div class="uk-form-controls">
            <input class="uk-input" type="password" placeholder=" ">
        </div>
    </div>
        <div class="uk-width-1-1">
            <label><input class="uk-checkbox" type="checkbox"> أقر بأني اطلعت وقد وافقت على
                <a href="#">شروط الاستخدام</a> و <a href="#">سياية الخصوصية</a></label>
            <br>
            <small>عند الإشارة إلى حماية البيانات الشخصية. وفقا للقانون 09-08، لديك الحق في
                الوصول، والتصحيح والمعارضة على معالجة بياناتك الشخصية.</small>
        </div>
        <div class="uk-width-1-1@s">
            <button class="uk-button uk-button-primary">انشاء حساب</button>

        </div>
        <div class="uk-width-1-1@s uk-text-center">
            <p>لديك حساب بالفعل ؟ <a href="{{ URL::asset('login') }}">سجل الدخول</a></p>
                    </div>
    </form>
</div>
@endsection