@extends('desky.panel.app')
@section('title', 'قائمة عروض الأسعار')
@section('content')
<div class="wd-80" dir="rtl" >
    <div dir="ltr" class="uk-text-right uk-margin-top">
        <a href="#form-demande-branding" ><button type="button" class="uk-button uk-button-primary uk-margin-top ">انشاء فاتورة
      <span uk-icon="plus"></span>  </button></a>
        <a href="{{ asset('creer/devis') }}"><button type="button" class="uk-button uk-margin-top uk-button-primary ">انشاء دوفي
            <span uk-icon="plus"></span>  </button></a>
    </div>
    <br>
<list-devis></list-devis>
<br>
</div>
@endsection
