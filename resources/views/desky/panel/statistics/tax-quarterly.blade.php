@extends('desky.panel.app')
@section('title', 'المحاسبة الضرائب')
    <style>
        .l3 a {
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
                            مركز الاحصائيات والتحليلات</h4>
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
                                    <i class="fas fa-percent"></i> المحاسبة الضرائب
                                </h4>
                            </div>


                        </div>

                        <hr>

                        <br>
                        <impot-infos :year='"{{ date('Y') }}"'></impot-infos>
                        <br>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
