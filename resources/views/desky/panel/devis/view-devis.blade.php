@extends('desky.panel.app')
@section('title', 'DEVIS-' . $infos->OID)
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
                    <li><a href="{{ asset('devis/list') }}">قائمة عروض الاسعار</a></li>
                    <li class="uk-disabled"><a>عرض اسعار #{{ $infos->OID }}</a></li>

                </ul>
            </div>


        </div>
        <br>
        <div>
            <div id="loading" class="form-loading"></div>

            <div class="uk-card uk-card-default uk-card-body">
                <devis-modifier-status :oid="'{{ $infos->OID }}'" :uid="'{{Auth::user()->id}}'"></devis-modifier-status>

                <br />



                <div class="uk-width-1-1@m">
                    <h2 class="uk-cart-title uk-text-left">N° {{ $infos->OID }}</h2>
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
                <div class="uk-width-1-1@m">
                    <h3 class="uk-cart-title uk-text-right">معلومات عن الطلب</h3>
                    <hr />
                </div>
                <div>
                    @php
                        $items = json_decode($infos->items);
                        $countItems = count($items);
                        $subtotal = 0;
                        $article_p = 0;
                        $tva = $db_desky->tva;
                        for ($i = 0; $i < $countItems; $i++) {
                            $article_p = $items[$i]->price * $items[$i]->quantity;
                            $subtotal = $subtotal + $article_p;
                        }
                        $tva_cost = ($subtotal * $tva) / 100;
                        $TotalFinal = $subtotal - $tva_cost;
                    @endphp
                    @foreach ($items as $item)

                        <div class="item-border" id="fileds ">
                            <div class="form-formulaire uk-text-right " dir="rtl" >
                                <div class="uk-width-1-1">

                                    <h1 class="uk-card-title uk-text-right uk-margin-right">
                                        العنصر {{ $loop->index + 1 }}
                                    </h1>

                                </div>
                                <div class="uk-padding uk-flex" style="width: 100%">
                                <div class="uk-margin-small-left  uk-width-1-3@s">
                                    <div class="uk-form-controls">
                                        <label class="uk-text-muted" for=""> العنصر  </label>
                                        <br>
                                        <span class="uk-text-emphasis">{{ $item->article }}</span>
                                    </div>
                                </div>
                                <div class="uk-margin-small-left uk-width-1-3@s">
                                    <div class="uk-form-controls">
                                        <label class="uk-text-muted" for="">السعر</label>
                                        <br>
                                        <span class="uk-text-emphasis">{{ $item->price }}</span>
                                    </div>
                                </div>
                                <div class="uk-margin-small-left uk-width-1-3@s">
                                    <div class="uk-form-controls">
                                        <label class="uk-text-muted" for="">الكمية</label>
                                        <br>
                                        <span class="uk-text-emphasis">{{ $item->quantity }}</span>
                                    </div>
                                </div>
                                </div>

                                <div class="uk-width-1-1@s">
                                    <hr />
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @php

                        $data = file_get_contents('database/data.json');
                        $json = json_decode($data, true);

                    @endphp
                    <div class="uk-margin uk-grid-small" uk-grid>
                        <h2 class="uk-card-title uk-text-right uk-width-1-1@s">
                            الدفع والأداء
                        </h2>
                        <div class="uk-width-1-2@s" dir="rtl">
                            <label class="uk-text-right uk-text-muted uk-margin-left uk-margin" dir="rtl">شروط الدفع
                                :</label>

                            <span class="uk-text-emphasis filed-icon">@php
                                if ($infos->p_condition != null) {
                                    echo $json['condition'][$infos->p_condition];
                                } else {
                                    echo 'غير محدد';
                                }

                            @endphp
                                <span style="opacity: 0"><i class="fas fa-edit"></i></span>

                            </span>
                        </div>
                        <div class="uk-width-1-2@s" dir="rtl">
                            <label class="uk-text-right uk-margin" dir="rtl">وسيلة الدفع :</label>

                            <span class="uk-text-emphasis filed-icon">@php
                                if ($infos->p_method != null) {
                                    echo $json['p_method'][$infos->p_method];
                                } else {
                                    echo 'غير محدد';
                                }

                            @endphp
                                <span style="opacity: 0"><i class="fas fa-edit"></i></span>
                            </span>
                        </div>
                    </div>
                    <h1 class="uk-card-title uk-text-right">
                        الملاحضات
                    </h1>
                    <hr>
                    <devis-notes :oid="'{{$infos->OID}}'"></devis-notes>

                    <div class="uk-width-1-3@s uk-text-left">
                        <div class="uk-text-right content-total">
                            <h3 class="text-f-bloder">
                                المجموع: {{ number_format($subtotal, 2, '.', ',') }} MAD

                            </h3>
                            <hr />
                            <h3 class="text-f-bloder" dir="rtl">
                                الضريبة(TVA): MAD {{ number_format($tva, 2, '.', ',') }}

                            </h3>
                            <hr />
                            <div class="total-border">
                                <h3 class="text-f-bolder-w">
                                    المجموع الكلي: {{ number_format($TotalFinal, 2, '.', ',') }} MAD

                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
