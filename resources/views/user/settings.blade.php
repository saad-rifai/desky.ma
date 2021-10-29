@extends('layout.master')
@section('title', 'اعدادات')
@section('content')

<div class="container mt-5 mb-5">
    <div class="row text-center" dir="rtl">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{asset('/')}}">الرئيسية</a></li>
                    <li class="breadcrumb-item active" aria-current="page">إعدادات</li>
                </ol>
            </nav>
            <h1 align="right" class="breadcrumb-title">إعدادات</h1>
        </div>

    </div>
</div>

<div id="app">
    <div class="container">
        <div class="row mt-4" dir="rtl">
            <div class="col-sm col-lg-4">
                <div class="card p-3 mb-3">
                    <div class="user-box-settings text-center">
                        <div style="width: 80px;height: 80px;" class="avatar-large-box-article ">
                            <img src="{{ asset(request()->Avatar) }}" alt="{{Auth::user()->frist_name .' '. Auth::user()->last_name}} - avatar">
                        </div>
                        <h1 class="h5 mt-3 mb-0 user-name">{{ucfirst(Auth::user()->frist_name) .' '. ucfirst(Auth::user()->last_name)}}
                            {!! request()->verified_account !!}
                    
                        </h1>
                   <p class="text-muted mb-0" dir="ltr"><span>@</span>{{Auth::user()->username}}</p>
                    </div>
                </div>
                <div class="card mb-3 " style="overflow: hidden">
                    <h1 class="card-title mb-0 mt-2 p-3 " style="font-size: 16px"> الاعدادت</h1>
    
         
    
                      <div class="list-group list-group-flush mt-0" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-home-list" data-bs-toggle="list" href="#edit_profile" role="tab" aria-controls="list-home"><i class="fas fa-user-cog"></i> الملف الشخصي</a>
                        <a class="list-group-item list-group-item-action" id="list-profile-list" data-bs-toggle="list" href="#account_settings" role="tab" aria-controls="list-profile"><i class="fas fa-cog"></i> اعدادات الحساب</a>
                        <a class="list-group-item list-group-item-action" id="list-messages-list" data-bs-toggle="list" href="#ae_account" role="tab" aria-controls="list-messages"><i class="fas fa-id-card"></i> حساب المقاول الذاتي</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list" data-bs-toggle="list" href="#documentation_center" role="tab" aria-controls="list-settings"><i class="fas fa-badge-check"></i> مركز التوثيق</a>
                      </div>
                </div>
            </div>
    
            <div class="col-sm">
                <div class="card p-3 mb-3">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="edit_profile" role="tabpanel" aria-labelledby="list-home-list">
                            <h1 class="card-title mb-0 mt-2 p-3 " style="font-size: 16px"> الملف الشخصي</h1>
                            <public-profile-edit :userinfos="{{Auth::user()}}"></public-profile-edit>
    
                        </div>
                        <div class="tab-pane fade" id="account_settings" role="tabpanel" aria-labelledby="list-profile-list">
                            <h1 class="card-title mb-0 mt-2 p-3 " style="font-size: 16px">  اعدادات الحساب</h1>
                       <div class="p-3">
                        <account-settings :userinfos="{{Auth::user()}}"></account-settings>
                       </div>
    
                        </div>
                        <div class="tab-pane fade" id="ae_account" role="tabpanel" aria-labelledby="list-messages-list">.3..</div>
                        <div class="tab-pane fade" id="documentation_center" role="tabpanel" aria-labelledby="list-settings-list">..4.</div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

@stop