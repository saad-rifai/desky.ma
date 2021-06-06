@extends('desky.panel.headform')
@section('title', 'اعادة تعيين كلمة السر')
@section('content')
<div  class="form-border wd-80 uk-margin-top uk-margin-bottom uk-card-default uk-padding">
    <h2 class="uk-card-title uk-text-right">اعادة تعيين كلمة السر </h2>
    <div class="uk-margin uk-text-right">


        </div>
    <form class="uk-text-right" dir="rtl" action="/ResetPassword/reset" method="post">
        @csrf

    @if ($errors->any())
    <div class="uk-alert-danger" uk-alert>
        <p>
          @foreach ($errors->all() as $error)
             {{ $error }}
          @endforeach
        </p>
       @if ($errors->has('email'))
       @endif
    </div>
  @endif
  @if(session()->has('success'))
  <div class="uk-alert-success" uk-alert>
  <p>  {{ session()->get('success') }}</p>
    </div>
@endif
        <label  for="email">أدخل البريد الالكتروني</label>

        <div class="uk-margin" >

            <input class="uk-input" type="email" name="email" id="email" placeholder="البريد الالكتروني">
        </div>
        <div class="uk-margin " >
            <button class="uk-button uk-button-primary" type="submit">ارسال</button>

        </div>
        <div class="uk-margin-small uk-text-center">
            <p><a href="login">الدخول الى حسابي</a></p>
     </div>
    </form>
</div>
@endsection
