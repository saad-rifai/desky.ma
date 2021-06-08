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
                            مركز الاحصائيات والتحليلات </h4>
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
                                <download-annual-report></download-annual-report>
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
                               <download-turnover-last5years></download-turnover-last5years>
                            </div>
                        </div>

                        <hr>

                        <turnover-last5years></turnover-last5years>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
