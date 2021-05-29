@extends('desky.steps.app')

@section('title', 'معلومات الحساب')
@section('description', 'منصة مقاولة توفر لك العديد من الخدمات لمساعدتك على بدء و تطوير نشاطك التجاري')
@section('ogimage', asset('image/moqawala.ma.jpg'))
@section('content')
<div id="ae-info" uk-modal dir="rtl">
    <div class="uk-modal-dialog uk-modal-body">
        <h2 class="uk-modal-title">كيف أجلب هذه المعلومات</h2>
        <p>يمكنك ايجاد هذه المعلومات في شهادة التسجيل في السجل الوطني للمقاول الذاتي أو في الموقع الالكتروني الخاص بالمقاول الذاتي</p>
       <div class="img-modal"> <img src="{{ asset('image/icon/ae-info.png') }}" alt=""> </div>
        <p class="uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">حسناََ</button>
        </p>
    </div>
</div>
    @php
    $datajson = file_get_contents('database/data.json');
    $jsondatas = json_decode($datajson, true);
    @endphp
    <div class="form-border wd-80 uk-margin-top uk-margin-bottom uk-card-default uk-padding">
        <h2 class="uk-card-title uk-text-right"></h2>
        <div class="logo-form"> <img src="{{ asset('image/logo-desky.png') }}" alt=" Desky.ma"> </div>
        @if (\Session::has('error'))

    <div class="uk-alert-danger" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <p>{!! \Session::get('error') !!}</p>
    </div>
@endif
        <form dir="rtl" method="POST" action="{{ route('register') }}" class="uk-grid-small" uk-grid>
            @csrf
    
            <input type="hidden" name="ref_alg" value="{{ $_GET['ref'] ?? '' }}">
    
       
            <div class="uk-width-1-2@s">
                <label for="">رقم بطاقة الوطنية <span class="red">*</span></label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="fname" placeholder="" value="{{ old('fname') }}" required>
                </div>
                @error('fname')
                <span class="uk-text-danger">
                    {{ $message }}
                </span>
            @enderror
            </div>
            <div class="uk-width-1-2@s">
                <label for="">رقم التعريف الضريبي (IF) <span class="red">*</span>             </label>

                <div class="uk-form-controls">
                    <input class="uk-input" name="lname" type="text" placeholder="" value="{{ old('lname') }}" required>
                    <small><a href="#ae-info" class="uk-link-reset" uk-toggle> <span class="uk-margin-small-right" uk-icon="info"  > </span>  أين أجد هذه المعلومة</a></small>
                </div>
                @error('lname')
                <span class="uk-text-danger" >
                    {{ $message }}
                </span>
            @enderror
            </div>
            <div class="uk-width-1-2@s">
                <label for=""> رقم الضريبة المهنية (TP)<span class="red">*</span> </label>

                <div class="uk-form-controls">
                    <input class="uk-input" name="phonenumb" type="text" placeholder="" value="{{ old('phonenumb') }}" required>
                    <small><a href="#ae-info" class="uk-link-reset" uk-toggle> <span class="uk-margin-small-right" uk-icon="info"  > </span>  أين أجد هذه المعلومة</a></small>

                </div>
                @error('phonenumb')
                <span class="uk-text-danger" >
                    {{ $message }}
                </span>
            @enderror
            </div>

            <div class="uk-width-1-2@s">
                <label for=""> الرقم التعريفي للمقاول الذاتي (identifiant AE)<span class="red">*</span> </label>

                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="company" value="{{ old('company') }}" placeholder="">
                    <small><a href="#ae-info" class="uk-link-reset" uk-toggle> <span class="uk-margin-small-right" uk-icon="info"  > </span>  أين أجد هذه المعلومة</a></small>

                </div>
                @error('company')
                <span class="uk-text-danger" >
                    {{ $message }}
                </span>
            @enderror
            </div>
            <div class="uk-width-1-2@s">
                <label for=""> رقم الهاتف الخاص بالعمل <span class="red">*</span></label>

                <div class="uk-form-controls">
                    <input class="uk-input" name="phonenumb" type="text" placeholder="" value="{{ old('phonenumb') }}" required>
                </div>
                @error('phonenumb')
                <span class="uk-text-danger" >
                    {{ $message }}
                </span>
            @enderror
            </div>

            <div class="uk-width-1-2@s">
                <label for=""> البريد الالكتروني الخاص بالعمل <span class="red">*</span></label>

                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="company" value="{{ old('company') }}" placeholder="">
                </div>
                @error('company')
                <span class="uk-text-danger" >
                    {{ $message }}
                </span>
            @enderror
            </div>
        
            <div class="uk-width-1-2@s">
                <label for=""> قطاع النشاط <span class="red">*</span></label>
                <div class="uk-form-controls">
                    <select name="country" class="uk-select" id="form-stacked-select" required>
                        <option value="">-- اختيار --</option>
                        @foreach ($jsondatas['countries'] as $item)

                            <option value="{{ $item['code'] }}">{{ $item['name'] }}</option>
                        @endforeach

                    </select>
                </div>
                @error('country')
                <span class="uk-text-danger" >
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="uk-width-1-2@s">
                <label for=""> النشاط المهني <span class="red">*</span></label>
                <div class="uk-form-controls">
                    <input class="uk-input" name="city" type="text" placeholder="" value="{{ old('city') }}" required>
                </div>
                @error('city')
                <span class="uk-text-danger" >
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="uk-width-1-1@s">
                <label for=""> موقع الكتروني (اختياري)</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="password" placeholder="" value="{{ old('password') }}" required>
                </div>
                @error('password')
                <span class="uk-text-danger" >
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="uk-width-1-1@s">
                <label for=""> صف نفسك <span class="red">*</span></label>
                <div class="uk-form-controls">
                    <textarea class="uk-textarea" rows="3" placeholder=""></textarea>
                </div>
  
            </div>
           <!--div class="uk-width-1-1@s">
            <div class="captcha">
                <span></span>
                <button type="button" onclick="namecaller()" class="reload">
                    &#x21bb;
                </button>
                <div><input id="captcha" type="text" class="form-captcha" placeholder="أدخل الكابتشا" name="captcha"></div>

            </div>
            <script>
           /*     function namecaller(){
                    $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });

}*/
            </script>
           </div-->


            <div class="uk-width-1-1@s">
                <button class="uk-button uk-button-primary"> المتابعة</button>

            </div>
            <div class="uk-width-1-1@s uk-text-center">
                

            </div>
        </form>
    </div>
<script>

       /* $('#reloaded_captcha').click(function () {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
        alert('relaod');
    });*/
</script>


<script>
function aeinfo(){
 
}
</script>

@endsection
