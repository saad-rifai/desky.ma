@extends('desky.panel.app')
@section('title', 'الاحصائات والتقارير السنوية')
    <style>
        .l1 a {
            color: #f98a13 !important;
        }

        #form-loading {
            display: block;
        }

    </style>

@section('content')
    <div>
        @php
            $datajson = file_get_contents('database/data.json');
            $jsondatas = json_decode($datajson, true);
        @endphp

        <div class="wd-90 uk-margin-small-top uk-margin-small-bottom">

            <div dir="rtl" class="uk-text-center " uk-grid>

                <div class="uk-width-1-4@m">
                    <div class="uk-card uk-card-default uk-card-body" uk-sticky="bottom: true">
                        <h4 class="uk-card-title uk-text-right">
                            مرحبا Saad Rifai !</h4>
                        <hr>

                        @include('desky.layouts.right-bar-statistique')

                        <br>

                    </div>
                </div>
                <div class="uk-width-expand@m">
                    <div class="uk-card uk-card-default uk-card-body">
                        <div uk-grid>
                            <div class="uk-width-1-2@s">
                                <h4 class="uk-card-title uk-text-right">
                                    <i class="fas fa-chart-bar"></i> الاحصائيات والتقارير السنوية
                                </h4>
                            </div>

                            <div class="uk-text-left uk-width-1-2@s">
                                <button class="uk-button uk-button-primary">تحميل التقرير السنوي</button>
                            </div>
                        </div>

                        <hr>

                        <br>
                        <infos-anne :year='"{{ date('Y') }}"'></infos-anne>
                        <br>

                        <generale-line-charts :year='"{{ date('Y') }}"'></generale-line-charts>
                        <br>
                        <br>
                        <div uk-grid>
                            <div class="uk-width-1-2@s">
                                <h4 class="uk-card-title uk-text-right">
                                    رقم المعاملات أخر 5 سنوات</h4>
                            </div>

                            <div class="uk-text-left uk-width-1-2@s">
                                <button class="uk-button uk-button-primary">تحميل تقرير أخر 5 سنوات</button>
                            </div>
                        </div>

                        <hr>

                        <table class="uk-table uk-table-striped">
                            <thead>
                                <tr>
                                    <th>السنة</th>
                                    <th>عدد المبيعات</th>
                                    <th>رقم الأعمال</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2016</td>
                                    <td>124</td>
                                    <td>250,247.00 MAD</td>
                                </tr>
                                <tr>
                                    <td>2017</td>
                                    <td>214</td>
                                    <td>268,841.00 MAD</td>
                                </tr>
                                <tr>
                                    <td>2018</td>
                                    <td>256</td>
                                    <td>298,893.00 MAD</td>
                                </tr>
                                <tr>
                                    <td>2019</td>
                                    <td>321</td>
                                    <td>302,201.00 MAD</td>
                                </tr>
                                <tr>
                                    <td>2020</td>
                                    <td>390</td>
                                    <td>305,052.00 MAD</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
