@extends('desky.panel.app')
@section('title', 'عميل رقم ' . $infos->CID)
@section('content')
    <div class="wd-90 uk-margin ">
        <br>
        <div class="uk-grid-small uk-child-width-1-2@s" uk-grid>
            <div class="uk-text-left">
                <span class="uk-text-muted" dir="ltr">
                    اخر تحديث: {{ $infos->updated_at }}
                </span>
            </div>
            <div class="uk-text-right">
                <ul class="uk-breadcrumb " dir="rtl">
                    <li><a href="{{ asset('u') }}">لوحة التحكم</a></li>
                    <li><a href="{{ asset('clients/list') }}">قائمة العملاء</a></li>
                    <li class="uk-disabled"><a> العميل رقم #{{ $infos->CID }}</a></li>

                </ul>
            </div>


        </div>
        <br>
        <div>
            <div id="loading" class="form-loading"></div>

            <div class="uk-card uk-card-default uk-card-body">
                <!--clients-tools :cid="'{{ $infos->CID }}'" :uid="'{{Auth::user()->id}}'"></clients-tools-->

                <br />



                <div class="uk-width-1-1@m">
                    <h2 class="uk-cart-title uk-text-left">N° {{ $infos->CID }}</h2>
                    <h3 class="uk-cart-title uk-text-right">معلومات عن العميل</h3>
                    <hr />
                </div>
                <div>
                    <div class="form-formulaire uk-text-right" dir="rtl" uk-grid>
                        <div class="uk-width-1-2@s">
                            <div class="uk-form-controls">
                                <label class="uk-text-muted uk-margin-left" for="">الاسم الكامل للعميل: </label>

                                <span class="uk-text-emphasis filed-icon">{{ $infos->c_name }}
                                    <span style="opacity: 0"><i class="fas fa-edit"></i></span>

                                </span>
                            </div>

                        </div>
                        <div class="uk-width-1-2@s">
                            <div class="uk-form-controls">
                                <label class="uk-text-muted uk-margin-left">رقم الهاتف: </label>

                                <span class="uk-text-emphasis filed-icon">
                                    {{ $infos->c_phone }}
                                    <span style="opacity: 0"><i class="fas fa-edit"></i></span>

                                </span>
                            </div>

                        </div>
                        <div class="uk-width-1-2@s">
                            <div class="uk-form-controls ">
                                <label class="uk-text-muted uk-margin-left ">البريد الالكتروني: </label>

                                <span class="uk-text-emphasis filed-icon">
                                    {{ $infos->c_email }}
                                    <span style="opacity: 0"><i class="fas fa-edit"></i></span>

                                </span>
                            </div>

                        </div>
                        <div class="uk-width-1-2@s">
                            <div class="uk-form-controls">
                                <label class="uk-text-muted uk-margin-left"> رقم التعريفي الموحد (ICE): </label>
                                <span class="uk-text-emphasis filed-icon">
                                    {{ $infos->c_ice }}
                                    <span style="opacity: 0"><i class="fas fa-edit"></i></span>

                                </span>
                            </div>

                        </div>
                        <div class="uk-width-1-2@s">
                            <div class="uk-form-controls">
                                <label class="uk-text-muted uk-margin-left"> نوع العميل: </label>

                                <span class="uk-text-emphasis filed-icon">
                                    @php
                                        $datajson = file_get_contents('database/data.json');
                                        $json = json_decode($datajson, true);
                                        if (isset($json['type_clients'][$infos->c_type])) {
                                            echo $json['type_clients'][$infos->c_type];
                                        } else {
                                            echo 'غير محدد';
                                        }

                                    @endphp

                                    <span style="opacity: 0"><i class="fas fa-edit"></i></span>

                                </span>

                            </div>

                        </div>
                        <div class="uk-width-1-2@s">
                            <div class="uk-form-controls">
                                <label class="uk-text-muted uk-margin-left"> الدولة: </label>

                                <span class="uk-text-emphasis filed-icon">
                                    @php
                                        $datajson = file_get_contents('database/data.json');
                                        $json = json_decode($datajson, true);
                                        $country = 'غير محدد';
                                        foreach ($json['countries'] as $key) {
                                            if (isset($infos->country) && $key['code'] == $infos->country) {
                                                $country = $key['name'];
                                            }
                                        }
                                        echo $country;

                                    @endphp

                                    <span style="opacity: 0"><i class="fas fa-edit"></i></span>

                                </span>

                            </div>

                        </div>
                        <div class="uk-width-1-2@s">
                            <div class="uk-form-controls">
                                <label class="uk-text-muted uk-margin-left"> المدينة: </label>
                                <span class="uk-text-emphasis filed-icon">
                                    {{ $infos->city }}
                                    <span style="opacity: 0"><i class="fas fa-edit"></i></span>

                                </span>
                            </div>

                        </div>
                        <div class="uk-width-1-2@s">
                            <div class="uk-form-controls">
                                <label class="uk-text-muted uk-margin-left"> العنوان: </label>
                                <span class="uk-text-emphasis filed-icon">
                                    {{ $infos->adresse }}
                                    <span style="opacity: 0"><i class="fas fa-edit"></i></span>

                                </span>
                            </div>

                        </div>
                    </div>
                </div>
                <br />

                    <h1 class="uk-card-title uk-text-right">
                        الملاحضات
                    </h1>
                    <hr>
                    <clients-notes :cid="'{{$infos->CID}}'"></clients-notes>

                </div>
            </div>

        </div>

    </div>
@endsection
