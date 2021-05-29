@extends('desky.panel.app')
@section('title', 'قائمة الفواتير')
@section('content')
<div class="wd-80" dir="rtl" >
    <div dir="ltr" class="uk-text-right uk-margin-top">
        <a href="{{ asset('creer/facture') }}" ><button type="button" class="uk-button uk-button-primary uk-margin-top ">انشاء فاتورة
      <span uk-icon="plus"></span>  </button></a>
        <a href="{{ asset('creer/devis') }}"><button type="button" class="uk-button uk-margin-top uk-button-primary ">انشاء دوفي
            <span uk-icon="plus"></span>  </button></a>
    </div>
    <br>
<list-facture :uid="{{ Auth::user()->id }}"></list-facture>
<br>
</div>
@endsection
