@extends('layout.master')
@section('title', 'اعدادات')
@section('content')

    <div class="container mt-5 mb-5">
        <div class="row text-center" dir="rtl">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ asset('/') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">إعدادات</li>
                    </ol>
                </nav>
                <h1 align="right" class="breadcrumb-title">إعدادات</h1>
            </div>

        </div>
    </div>
    <!-- Modal Info  -->

    <div class="modal fade" id="staticBackdrop" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered  modal-dialog-scrollable">
            <div class="modal-content" dir="rtl">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        كيفية تقديم طلب الحصول على حساب مقاول ذاتي ؟
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body position-relative">

                    <p dir="rtl" style="text-align: right;"><strong>هناك خطواة بسيطة لتفعيل حساب المقاول الذاتي:</strong>
                    </p>
                    <p dir="rtl" style="text-align: right;">ملئ البيانات الخاصة بك أسفله<br />1 - رقم بطاقة التعريف الوطنية
                        سارية المفعول<br />
                        2 - رقم تعريف المقاول الذاتي يمكنك الحصول على هذا الرقم من خلال بطاقة المقاول الذاتي
                        <span style="text-decoration: underline;"><em>"الرقم التعريفي في السجل الوطني للمقاول
                                الذاتي"</em></span>
                    </p>
                    <img src="https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/asset/Carte+auto-entrepreneur.jpg"
                        style="max-width: 450px; width: 100%" alt="بطاقة المقاول الذاتي">
                    <p dir="rtl" style="text-align: right;">&nbsp;</p>
                    <p dir="rtl" style="text-align: right;">&nbsp;</p>
                    <p dir="rtl" style="text-align: right;">أو يمكنك الحصول عليه من خلال<em><span
                                style="text-decoration: underline;"> شهادة التسجيل في السجل الوطني للمقاول
                                الذاتي&nbsp;</span></em></p>
                    <img src="https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/asset/ae-info.png"
                        style="max-width: 450px; width: 100%" alt="هادة التسجيل في السجل الوطني للمقاول الذاتي">

                    <p dir="rtl" style="text-align: right;">&nbsp;</p>
                    <p dir="rtl" style="text-align: right;">أو من خلال الموقع الالكتروني<a href="https://rn.ae.gov.ma/"
                            target="_blank"><em><span style="text-decoration: underline;"> للمقاول الذاتي</span></em></a>
                    </p>
                    <p dir="rtl" style="text-align: right;">3 - ادخال تاريخ انتهاء صلاحية بطاقة الهوية الخاصة بك<br />4 -
                        ادخال تاريخ الانخراط في نظام المقاول الذاتي</p>
                    <p dir="rtl" style="text-align: right;">5 - تحديد القطاع الخاص بك يمكنك مشاهدة من خلال <a
                            target="_blank"
                            href="https://ae.gov.ma/wp-content/themes/ae-theme/activites-eligibles-AE-AR--.pdf">الرابط
                            التالي</a> الى اي قطاع ينتمي نشاطك<br />6 - تحديد النشاط الخاص بك<br />7 - كتابة المسمى الوظيفي
                        الخاص بك على سبيل المثال نجار, رسام, بناء, مهندس, خياط...<br />8 - رفع الوثائق في هذه المرحلة يجب
                        رفع صورة سارية المفعول لبطاقة الهوية وصورة لبطاقة المقاول الذاتي أو شهادة التسجيل في السجل الوطني
                        للمقاول الذاتي<br /><br />ثم أكد المعلومات وأرسل الطلب سوف يتم معالجة طلبك والرد عليك في غضون 48
                        ساعة عبر بريدك الالكتروني أو الاشعارات داخل المنصة&nbsp;</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                        فهمت
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Info  -->
    <div id="app">

        <div class="container">
            <div class="row mt-4" dir="rtl">
                <div class="col-sm col-lg-4">
                    <div class="card p-3 mb-3">
                        <div class="user-box-settings text-center">
                            <div style="width: 80px;height: 80px;" class="avatar-large-box-article ">
                                <img src="{{ asset(request()->Avatar) }}"
                                    alt="{{ Auth::user()->frist_name . ' ' . Auth::user()->last_name }} - avatar">
                            </div>
                            <h1 class="h5 mt-3 mb-0 user-name">
                                {{ ucfirst(Auth::user()->frist_name) . ' ' . ucfirst(Auth::user()->last_name) }}
                                {!! request()->verified_account !!}

                            </h1>
                            <p class="text-muted mb-0" dir="ltr"><span>@</span>{{ Auth::user()->username }}</p>
                        </div>
                    </div>
                    <div class="card mb-3 " style="overflow: hidden">
                        <h1 class="card-title mb-0 mt-2 p-3 " style="font-size: 16px"> الاعدادت</h1>
                        <div class="list-group list-group-flush mt-0" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-home-list"
                                data-bs-toggle="list" href="#edit_profile" role="tab" aria-controls="list-home"><i
                                    class="fas fa-user-cog"></i> الملف الشخصي</a>
                            <a class="list-group-item list-group-item-action" id="list-profile-list" data-bs-toggle="list"
                                href="#account_settings" role="tab" aria-controls="list-profile"><i
                                    class="fas fa-cog"></i> اعدادات الحساب</a>
                            @if (Auth::user()->type == 1)
                                <a class="list-group-item list-group-item-action" id="list-messages-list"
                                    data-bs-toggle="list" href="#ae_account" role="tab" aria-controls="list-messages"><i
                                        class="fas fa-id-card"></i>
                                    حساب المقاول الذاتي</a>
                            @endif
                            @if (Auth::user()->type == 2)
                                <a class="list-group-item list-group-item-action" id="list-settings-list"
                                    data-bs-toggle="list" href="#documentation_center" role="tab"
                                    aria-controls="list-settings"><i class="fas fa-badge-check"></i> مركز التوثيق</a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-sm">
                    <div class="card p-3 mb-3">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="edit_profile" role="tabpanel"
                                aria-labelledby="list-home-list">
                                <h1 class="card-title mb-0 mt-2 p-3 " style="font-size: 16px"> الملف الشخصي</h1>
                                <public-profile-edit :userinfos="{{ Auth::user() }}"></public-profile-edit>

                            </div>
                            <div class="tab-pane fade" id="account_settings" role="tabpanel"
                                aria-labelledby="list-profile-list">
                                <h1 class="card-title mb-0 mt-2 p-3 " style="font-size: 16px"> اعدادات الحساب</h1>
                                <div class="p-3">
                                    <account-settings
                                        :userinfos="{{ Auth::user()->makeVisible(['email', 'phone_number', 'gender', 'date_of_birth', 'verified_account']) }}">
                                    </account-settings>
                                </div>

                            </div>
                            @if (Auth::user()->type == 1)

                                <div class="tab-pane fade" id="ae_account" role="tabpanel"
                                    aria-labelledby="list-messages-list">
                                    <h1 class="card-title mb-0 mt-2 p-3 " style="font-size: 16px"> حساب المقاول الذاتي</h1>
                                    <br>

                                    <request-ae-account></request-ae-account>




                                </div>
                            @endif
                            @if (Auth::user()->type == 2)
                                <div class="tab-pane fade" id="documentation_center" role="tabpanel"
                                    aria-labelledby="list-settings-list">
                                    <h1 class="card-title mb-0 mt-2 p-3 " style="font-size: 16px"> مركز التوثيق</h1>


                                    <div hidden class="row row-cols-1 mx-auto text-center mt-3 mb-3">
                                        <div class="col w-100">
                                            <div class="icon-large-top">
                                                <img src="{{ asset('img/icons/man-ceck.png') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="col w-100 mt-3">
                                            <p class="text-icon">تم توثيق الهوية بنجاح، شكرا لك</p>
                                        </div>
                                    </div>
                                    <request-verification :userinfos="{{ Auth::user() }}"></request-verification>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

@stop
