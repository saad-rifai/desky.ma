@extends('desky.panel.headform')
@section('title', 'انشاء حساب')
<script src='https://www.google.com/recaptcha/api.js'></script>

@section('content')

    @php
    $datajson = file_get_contents('database/data.json');
    $jsondatas = json_decode($datajson, true);
    @endphp
    <div class="form-border wd-80 uk-margin-top uk-margin-bottom uk-card-default uk-padding">
        <h2 class="uk-card-title uk-text-right">انشاء حساب</h2>
        <hr class="uk-divider-icon">

{{ Auth::user()}}
<register-form :csrf="'{{ csrf_token() }}'" :app_url="'{{ env('APP_URL') }}'" :recaptcha="'{{config('services.recaptcha.key')}}'"></register-form>
    </div>

@endsection
