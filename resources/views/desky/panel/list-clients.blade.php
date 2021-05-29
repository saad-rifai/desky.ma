@extends('desky.panel.app')
@section('title', 'قائمة العملاء')
@section('content')
<div class="wd-80" dir="rtl" >
    <div dir="ltr" class="uk-text-right uk-margin-top">
        <a href="{{ asset('creer/facture') }}" ><button type="button" class="uk-button uk-button-primary uk-margin-top ">اضافة عميل
      <span uk-icon="plus"></span>  </button></a>

    </div>
    <br>
<list-clients :uid="{{ Auth::user()->id }}"></list-clients>
<br>
</div>
@endsection
