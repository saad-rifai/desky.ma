@extends('layout.master')
@section('title', 'لوحة التحكم')
@section('content')

<div class="container">
    <div class="head-dashboard mt-5 mb-3">
        <div class="row" dir="rtl">
            <div class="col">
                <div class="row">
                    <div class="col-auto">
                        <div class="avatar-large-box-article">
                            <img src="{{ asset(request()->Avatar) }}" alt="{{Auth::user()->frist_name .' '. Auth::user()->last_name}} - avatar">
                        </div>
                    </div>
                    <div class="col-auto mt-2">
                        <div class="user-name-box-article">
                            <span>مرحبا بك ! </span>
                            <br>
                            <h4>
                               {{ucfirst(Auth::user()->frist_name) .' '. ucfirst(Auth::user()->last_name)}}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-auto mt-4">
                <p class="text-muted fs-6">
              N°  <strong>{{Auth::user()->Account_number}}</strong>
                  </p>
            </div>
        </div>
    </div>

    <div class="body-dashboard">
        <div class="row" dir="rtl">
            <div class="col-sm">
                <div class="card p-3 mb-4">
                    <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> نظرة عامة</h1>
                    <div class="row mx-auto w-100">
                        <div class="col-sm mb-4">
                            <div class="card card__info text-center p-3">
                                <div class="card__info_body">
                                    <h1 class="card__info_title">الرصيد الكلي</h1>
                                    <h1 class="card__info_money">0.00 MAD</h1>
                                </div>
                                <div class="card__info_footer">
                                  <div class="row">
                                    <div class="col-sm">
                                        المبلغ المستحق
                                    </div>
                                    <div class="col-sm">
                                       0.00 MAD
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm mb-4">
                            <div class="card card__info text-center p-3" >
                                <div class="card__info_body">
                                    <h1 class="card__info_title">الرصيد القابل للسحب</h1>
                                    <h1 class="card__info_money">0.00 MAD</h1>
                                </div>
                                <div class="card__info_footer">
                                  <div class="row">
                                    <div class="col-sm">
                                        الرصيد المعلق
                                    </div>
                                    <div class="col-sm">
                                       0.00 MAD
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card pt-5 pb-5 ps-2 pe-4 mb-4">
                        <div class="row align-middle">
                            <div class="col-sm col-lg-3 text-center">
                              <div class="pg-info-head mt-4 mb-4">
                                  <h3 class="pg-info-title">
                                      طلباتي
                                  </h3>
                                  <h3 class="pg-info-number">
                                    11
                                </h3>
                                <button class="btn btn-primary btn-sm mb-3">اضافة طلب</button>
                              </div>
                            </div>
                            <div class="col-sm mt-3">
                                <div class="pg-box mb-3">
                                    <label class="form-label">2 قيد المراجعة</label>
                                    <span class="pg-percentage">25%</span>

                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar bg-secondary" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="pg-box mb-3">
                                    <label class="form-label">1 المفتوحة</label>
                                    <span class="pg-percentage">35%</span>
                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar" role="progressbar" style="width: 35%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="pg-box mb-3">
                                    <label class="form-label">2 المرفوضة</label>
                                    <span class="pg-percentage">47%</span>

                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 47%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm mt-3">
                                <div class="pg-box mb-3">
                                    <label class="form-label">5 الملغاة</label>
                                    <span class="pg-percentage">70%</span>

                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar bg-secondary" role="progressbar" style="width: 70%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="pg-box mb-3">
                                    <label class="form-label">4 المكتملة</label>
                                    <span class="pg-percentage">32%</span>

                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 32%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="pg-box mb-3">
                                    <label class="form-label">7 قيد التنفيذ</label>
                                    <span class="pg-percentage">60%</span>
                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 60%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card pt-5 pb-5 ps-2 pe-4 mb-4">
                        <div class="row align-middle">
                            <div class="col-sm col-lg-3 text-center">
                              <div class="pg-info-head mt-4 mb-4">
                                  <h3 class="pg-info-title">
                                      عروضي
                                  </h3>
                                  <h3 class="pg-info-number">
                                    11
                                </h3>
                              </div>
                            </div>
                            <div class="col-sm mt-3">
                                <div class="pg-box mb-3">
                                    <label class="form-label">2 بانتظار الموافقة</label>
                                    <span class="pg-percentage">25%</span>

                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar bg-secondary" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
     
                                <div class="pg-box mb-3">
                                    <label class="form-label">2 قيد التنفيذ</label>
                                    <span class="pg-percentage">47%</span>

                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 47%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm mt-3">
                                <div class="pg-box mb-3">
                                    <label class="form-label">4 المكتملة</label>
                                    <span class="pg-percentage">32%</span>

                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 32%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="pg-box mb-3">
                                    <label class="form-label">5 المستبعدة</label>
                                    <span class="pg-percentage">70%</span>

                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 70%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
 
                           
                            </div>
                        </div>
                    </div>
                </div>



                    <div class="box-left mb-5 card p-4">
                       <a href="{{asset('orders?from=dashboard')}}"> <h1 class="card-title mb-4 mt-2" style="font-size: 16px">  أحدث طلبات العروض</h1></a>
                        @for ($i = 1; $i < 5; $i++)
                        <a href="{{asset('order/'.$i)}}">
                            <div class="box-article pb-3 mb-3"">
                                <div class="    head-box-article">
                                <div class="row text-center">
                                    <div class="col">
                                        <h1 align="right" class="title-box-article">تنظيف وتجهيز مكاتب عمارة حديثة البناء</h1>
                                    </div>
                                    <div class="col-3">
                                        <div align="left" class="box-article-cta">
                                            <button align="left" type="button"
                                                class="btn btn-primary btn-sm bid-mobile-icon">قدم عرضك</button>
    
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="user-info-box-article">
                                            <div class="row" onclick="redirectUserPage(event,11)">
                                                <div class="col-auto">
                                                    <div class="user-info-box-article-avatar">
                                                        <img src="img/users/{{ $i }}.jpg" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="user-info-box-article-name">
                                                        <h5 class="user-info-box-article-name-h5" > Saad Rifai</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="user-info-box-article">
                                            <i class="fas fa-map-marker-alt"></i> طنجة, المغرب
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="user-info-box-article">
                                            <i class="fas fa-ticket-alt"></i> 3 عروض
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="body-box-article">
                                <p class="box-article-description ">
                                    هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                                    العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف
                                    التى يولدها التطبيق.
                                    إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد،
                                    النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه
                                    الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.
                                </p>
                            </div>
                    </div>
                </a>
                    @endfor
    
                </div>

          
            </div>
            <div class="col-sm col-lg-4 mb-3">
                <div class="card p-3">

                <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> الرسائل</h1>
                @for ($i = 1; $i < 5; $i++)
                    <div class="box-article pb-3 mb-3">
                        <div class="    head-box-article">
                        <div class="row text-center">
                            <div class="col">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="avatar-large-box-article">
                                            <img src="{{ asset('img/users/'.$i.'.jpg') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="user-name-box-article">
                                            <h4>
                                                Saad Rifai
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                   
                        </div>

                    </div>
                    <div class="body-box-article mt_n_15 ">
                        <p class="box-article-description ">
                            هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                            العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف
                            التى يولدها التطبيق.
                            إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد،
                            النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه
                            الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.
                        </p>
                    </div>
            </div>

            @endfor
            <div class="text-center">
                <button class="btn btn-primary btn-sm"> المزيد</button>
            </div>
                </div>
            </div>
        </div>
    </div>

</div>

@stop