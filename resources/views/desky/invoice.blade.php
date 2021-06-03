@extends('desky.panel.headform')
@section('title', 'طلب رقم #4878741215721245')
@section('description', 'منصة مقاولة توفر لك العديد من الخدمات لمساعدتك على بدء و تطوير نشاطك التجاري')

@section('content')
<br>
<br>
    <div>

        <div class="wd-80 uk-margin-small-top uk-margin-small-bottom">

            <div class="uk-text-center " uk-grid>

                <div class="uk-width-1-3@m">
                    <div class="uk-card uk-card-default uk-card-body" uk-sticky="bottom: true">
                        <h4 class="uk-card-title uk-text-right">
                            معلومات
                        </h4>
                        <hr class="uk-divider-icon">
                        <div id="cartLoad_" class="cartLoad_">
                            <div class=" uk-position-cover uk-overlay uk-overlay-default uk-flex uk-flex-center uk-flex-middle div-load">
                            <span uk-spinner="ratio: 1.5"></span>

                            </div>
                            </div>
                        <cart :oid="'{{$oid}}'"></cart>

                        <br>

                    </div>
                </div>
                <div class="uk-width-expand@m">
                    <div class="uk-card uk-card-default uk-card-body">
                        <h4 class="uk-card-title uk-text-right">
                            معلومات صاحب الطلب</h4>
                        <hr>
                        <div dir="rtl" class="uk-text-right">
                            <div dir="rtl" class="uk-grid-small" uk-grid>

                                <div class="uk-width-1-2@s">
                                    <input class="uk-input" type="text" disabled value="{{ Auth::user()->fname }} ">
                                </div>
                                <div class="uk-width-1-2@s">
                                    <input class="uk-input" type="text" disabled value=" {{ Auth::user()->lname }} ">
                                </div>
                                <div class="uk-width-1-1@s">
                                    <input class="uk-input" type="text" disabled value=" {{ Auth::user()->email }} ">
                                </div>
                                <div class="uk-width-1-2@s">
                                    <input class="uk-input" type="text" disabled value=" {{ Auth::user()->phonenumb }} ">
                                </div>
                                <div class="uk-width-1-2@s">
                                    <input class="uk-input" type="text" disabled
                                        placeholder=" {{ Auth::user()->company }} ">
                                </div>
                                <div class="uk-width-1-2@s">
                                    <select disabled class="uk-select" id="form-stacked-select">
                                        <option value="">-- اختيار --</option>
                                        @foreach ($jsondatas['countries'] as $item)

                                            <option value="{{ $item['code'] }}">{{ $item['name'] }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="uk-width-1-2@s">
                                    <input class="uk-input" disabled type="text" value=" {{ Auth::user()->city }} ">
                                </div>


                                <div class="uk-width-1-1@s uk-text-right">
                                    <p> <a href="{{ asset('u/setting') }}"><span uk-icon="cog"></span> تعديل
                                            المعلومات</a>
                                    </p>
                                </div>
                            </div>

                            <h4 class="uk-card-title uk-text-right"> الدفع و الأداء</h4>
                            <hr class="uk-divider-icon">

                            <payment-methods ref='componentOne' :oid="'{{$oid}}'"></payment-methods>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
@endsection
