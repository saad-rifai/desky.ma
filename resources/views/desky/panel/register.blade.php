@extends('desky.panel.headform')
@section('title', 'انشاء حساب')
@section('description', 'منصة مقاولة توفر لك العديد من الخدمات لمساعدتك على بدء و تطوير نشاطك التجاري')
@section('ogimage', asset('image/moqawala.ma.jpg'))
@section('content')
    </div>
    @php
    $datajson = file_get_contents('database/data.json');
    $jsondatas = json_decode($datajson, true);
    @endphp
    <div class="form-border wd-80 uk-margin-top uk-margin-bottom uk-card-default uk-padding">
        <h2 class="uk-card-title uk-text-right">انشاء حساب</h2>
        @if (\Session::has('error'))

            <div class="uk-alert-danger" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>{!! \Session::get('error') !!}</p>
            </div>
        @endif
        <form dir="rtl" method="POST" action="/auth/register" class="uk-grid-small" uk-grid>
            @csrf

            <input type="hidden" name="ref_alg" value="{{ $_GET['ref'] ?? '' }}">


            <div class="uk-width-1-2@s">
                <label for="">الاسم الأول <span class="red">*</span></label>
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
                <label for="">الاسم الأخير <span class="red">*</span></label>

                <div class="uk-form-controls">
                    <input class="uk-input" name="lname" type="text" placeholder="" value="{{ old('lname') }}" required>
                </div>
                @error('lname')
                    <span class="uk-text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="uk-width-1-1@s">
                <label for=""> البريد الالكتروني <span class="red">*</span></label>
                <div class="uk-form-controls">
                    <input class="uk-input" name="email" type="text" placeholder="" value="{{ old('email') }}" required>
                </div>
                @error('email')
                    <span class="uk-text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="uk-width-1-2@s">
                <label for=""> رقم الهاتف<span class="red">*</span></label>

                <div class="uk-form-controls">
                    <input class="uk-input" name="phonenumb" type="text" placeholder="" value="{{ old('phonenumb') }}"
                        required>
                </div>
                @error('phonenumb')
                    <span class="uk-text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="uk-width-1-2@s">
                <label for=""> الشركة (اختياري)</label>

                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="company" value="{{ old('company') }}" placeholder="">
                </div>
                @error('company')
                    <span class="uk-text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="uk-width-1-2@s">
                <label for=""> الدولة <span class="red">*</span></label>
                <div class="uk-form-controls">
                    <select name="country" class="uk-select" id="form-stacked-select" required>
                        <option value="">-- اختيار --</option>
                        @foreach ($jsondatas['countries'] as $item)

                            <option value="{{ $item['code'] }}">{{ $item['name'] }}</option>
                        @endforeach

                    </select>
                </div>
                @error('country')
                    <span class="uk-text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="uk-width-1-2@s">
                <label for=""> المدينة <span class="red">*</span></label>
                <div class="uk-form-controls">
                    <input class="uk-input" name="city" type="text" placeholder="" value="{{ old('city') }}" required>
                </div>
                @error('city')
                    <span class="uk-text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="uk-width-1-1@s">
                <label for=""> كلمة المرور <span class="red">*</span></label>
                <br>
                <!--div class="uk-form-controls">
                            <button class="show-btn"><span uk-icon="icon: eye"></span></button>
                        </div-->
                <div class="uk-inline uk-width-1-1">
                    <a id="ShowPass" class="uk-form-icon uk-form-icon-flip"><i class="fas fa-eye"></i></a>
                    <input class="uk-input" type="password" id="pass" name="password" placeholder=""
                        value="{{ old('password') }}" required>
                </div>
                <script>
                    $('#ShowPass').click(function() {
                        if ('password' == $('#pass').attr('type')) {
                            $('#pass').prop('type', 'text');
                        } else {
                            $('#pass').prop('type', 'password');
                        }
                    });

                </script>
                <br>
                @error('password')
                    <span class="uk-text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>


            <div class="uk-width-1-1">
                <label><input class="uk-checkbox" type="checkbox" required> أقر بأني اطلعت وقد وافقت على
                    <a href="#">شروط الاستخدام</a> و <a href="#">سياية الخصوصية</a></label>
                <br>
                <small>عند الإشارة إلى حماية البيانات الشخصية. وفقا للقانون 09-08، لديك الحق في
                    الوصول، والتصحيح والمعارضة على معالجة بياناتك الشخصية.</small>
            </div>
            <div class="uk-width-1-1@s">
                <button class="uk-button uk-button-primary">انشاء حساب</button>

            </div>
            <div class="uk-width-1-1@s uk-text-center">


                <p>لديك حساب بالفعل ؟ <a href="{{ URL::asset('login') }}?ref={{ $_GET['ref'] ?? 'false' }}">سجل
                        الدخول</a></p>
            </div>
        </form>
    </div>

@endsection