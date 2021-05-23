
@extends('desky.panel.app')
@section('title', 'حسابي')
@section('description', 'منصة مقاولة توفر لك العديد من الخدمات لمساعدتك على بدء و تطوير نشاطك التجاري')
@section('ogimage', asset('image/moqawala.ma.jpg'))
<style>.l1 a {
    color: #f98a13 !important;
}</style>
@section('content')
<div>
    @php
    $datajson = file_get_contents('database/data.json');
    $jsondatas = json_decode($datajson, true);
    @endphp
    <div class="wd-80 uk-margin-small-top uk-margin-small-bottom">

        <div dir="rtl" class="uk-text-center " uk-grid>

            <div class="uk-width-1-4@m">
                <div class="uk-card uk-card-default uk-card-body " uk-sticky="bottom: true">
                    <h4 class="uk-card-title uk-text-right">
                        مرحبا {{ Auth::user()->fname  }} {{ Auth::user()->lname  }} !</h4>
                    <hr>

                    @include('desky.layouts.right-bar-user')


                    <br>

                </div>
            </div>
            <div class="uk-width-expand@m">
                <div class="uk-card uk-card-default uk-card-body">
                    <h4 class="uk-card-title uk-text-right">
                        <span uk-icon="user"></span> حسابي
                    </h4>
                    <hr>
                    <h4 class="uk-card-title uk-text-right">
                        خطتي</h4>
                        @include('desky.layouts.plans-infos')


                    <hr>
                    <h4 class="uk-card-title uk-text-right">
                        معلوماتي الشخصية </h4>
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
                            <input class="uk-input" type="text" disabled placeholder=" {{ Auth::user()->company }} ">
                        </div>
                        <div class="uk-width-1-2@s">
                            <select disabled class="uk-select" id="form-stacked-select">
                                <option value="">-- اختيار --</option>
                                @foreach ($jsondatas['countries'] as $item)

                                    <option value="{{ $item['code'] }}"  @if($item['code'] == Auth::user()->country) selected @endif>{{ $item['name'] }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="uk-width-1-2@s">
                            <input class="uk-input" disabled type="text" value=" {{ Auth::user()->city }} ">
                        </div>


                        <div class="uk-width-1-1@s uk-text-right">
                            <p> <a href="{{asset('u/settings')}}"><span uk-icon="cog"></span> تعديل المعلومات</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
