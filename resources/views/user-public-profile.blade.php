@extends('layout.master')
@section('title', 'Saad Rifai')


@section('content')
<!-- Modal preview  -->

<div class="modal fade" id="Preview_work1"  data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl  modal-dialog-centered">
      <div class="modal-content" dir="rtl">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">نجارة وتركيب أبواب المنيوم</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      
        </div>
        <div class="modal-body ">
         

            <!-- images slider -->
            <div class="images-preview">
            <div id="main-slider" class="splide">
                <div class="splide__track">
                      <ul class="splide__list">
                          <li class="splide__slide">
                            <img src="{{asset('img/users/portfolios/1/1.jpg')}}" alt="" />
                          </li>
                          <li class="splide__slide">
                            <img src="{{asset('img/users/portfolios/1/2.jpg')}}" alt="" />
                          </li>
                          <li class="splide__slide">
                            <img src="{{asset('img/users/portfolios/1/3.jpg')}}" alt="" />
                          </li>
                          <li class="splide__slide" data-splide-youtube="https://www.youtube.com/watch?v=cdz__ojQOuU">
                            <img src="{{asset('img/users/portfolios/1/1.jpg')}}">
                          </li>
                      </ul>
                </div>
              </div>

            <div id="thumbnail-slider" class="splide mx-auto">
                <div class="splide__track">
                      <ul class="splide__list">
                          <li class="splide__slide">
                            <img src="{{asset('img/users/portfolios/1/1.jpg')}}" alt="" />
                          </li>
                          <li class="splide__slide">
                            <img src="{{asset('img/users/portfolios/1/2.jpg')}}" alt="" />
                          </li>
                          <li class="splide__slide">
                            <img src="{{asset('img/users/portfolios/1/3.jpg')}}" alt="" />
                          </li>
                          <li class="splide__slide" data-splide-youtube="https://www.youtube.com/watch?v=cdz__ojQOuU">
                            <img src="{{asset('img/users/portfolios/1/1.jpg')}}">
                          </li>
                      </ul>
                </div>
              </div>


         
            </div>
            <!-- images slider -->
            <div class="p-2 position-relative">
            <h1 class="card-title mb-4 mt-2" style="font-size: 16px"> وصف العمل</h1>
            <div class="footer-social-media mb-3 position-absolute top-0 end-0">
                <ul class="list-social-media bg-border">
                    <li>
                        <a target="_blank" href="https://www.facebook.com/Youcandotshop">
                            <i class="fab fa-facebook-square"></i>
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="https://twitter.com/Youcandotshop">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="https://www.linkedin.com/company/youcandotshop/">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </li>
     
                    <li>
                        <a target="_blank" href="https://www.youtube.com/c/Youcandotshop">
                            <i class="fas fa-share-alt"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="body-card-text">
                <p>
                    هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى،
                    حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها
                    التطبيق.
                    إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص
                    لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث
                    يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.
                    ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملاً،دور مولد النص
                    العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم
                    فيظهر بشكل لا يليق.
                </p>
            </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">اغلاق</button>
        </div>
      </div>
    </div>
  </div>
  

<!-- Modal preview  -->
    <div class="bg-brand-h150"></div>
    <div class="container">
        <div class="row mx-auto user-head-pf" dir="rtl">
            <div class="col-auto ">
                <div class="position-relative" style="width: max-content">
                    <span class="position-absolute top-0 start-100 translate-middle p-2 bg-success online-status border border-light rounded-circle"  data-bs-toggle="tooltip" data-bs-placement="top" title="متصل" >
                        <span class="visually-hidden">New alerts</span>
                      </span>
               

                <div class="avatar-user-large ">

                    <img src="{{ asset('img/users/3.jpg') }}" alt="">
                </div>
            </div>
            </div>
          <div class="col mt-2">
                <h1 class="user-name">Saad Rifai <span data-bs-toggle="tooltip" data-bs-placement="top" title="حساب مقاول ذاتي موثق"   class="verified-icon verified-lv-1"  dir="rtl"></span></h1>
                <br>
                <div class="row" style="    margin-top: -30px;">

                    <div class="col-auto">
                        <div class="user-info-box-article">
                            <i class="fas fa-briefcase"></i> نجارة الألمنيوم
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="user-info-box-article">
                            <i class="fas fa-map-marker-alt"></i> طنجة, المغرب
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="user-info-box-article">
                            <span class="user-rating-stars" dir="rtl">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-auto mt-2">
                <button class="btn btn-primary btn-sm"><i class="fas fa-envelope"></i></button>
                <span class="dropdown">
                    <button class="btn btn-outline-primary btn-sm" id="menu_user" data-toggle="dropdown"
                        aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                    <ul class="dropdown-menu" aria-labelledby="menu_user">
                        <li><a class="dropdown-item" href="#">مراسلة</a></li>
                        <li><a class="dropdown-item" href="#">التبليغ</a></li>
                    </ul>
                </span>
            </div>
        </div>

        <div class="row mx-auto mt-5 mb-5" dir="rtl">
            <div class="col-sm mb-4">
                <div class="card p-4">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                type="button" role="tab" aria-controls="home" aria-selected="true">نبذة عني</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="false">معرض الأعمال</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                                type="button" role="tab" aria-controls="contact" aria-selected="false">التقييمات</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active p-3 body-card-text" id="home" role="tabpanel"
                            aria-labelledby="home-tab">

                            <p>
                                هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                                العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف
                                التى يولدها التطبيق.
                                إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد،
                                النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه
                                الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.

                            </p>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="portfolio-show-section">
                                <div class="row row-cols-sm-3 mx-auto">
                                    @for ($i = 1; $i < 4; $i++)
                                    <div class="col-sm"  type="button" data-bs-toggle="modal" data-bs-target="#Preview_work1">
                                        <div class="box-portfolio card">
                                            <div class="box-portfolio-thumbnile">
                                                <img src="{{asset('img/users/portfolios/1/'.$i.'.jpg')}}" alt="">
                                            </div>
                                            <div class="box-portfolio-title">
                                                <a href="#">نجارة وتركيب أبواب المنيوم {{$i}}</a>
                                            </div>
                                        </div>
                                    </div>     
                                    @endfor

                                
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            @for ($i = 1; $i < 5; $i++)
                            <div class="box-article pb-3 mb-3 mt-3">
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
                                <div class="row mr-65 mmt-35">
                                    <div class="col-auto">
                                        <div class="user-info-box-article">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <div class="user-info-box-article">
                                                        <span class="user-rating-stars" dir="rtl">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="user-info-box-article">
                                                        <i class="fas fa-briefcase"></i> صناعة الخبز والحلويات
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
        
                                </div>
                            </div>
                            <div class="body-box-article mr-65">
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

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card p-3">
                    <h1 class="card-title mb-4 mt-2" style="font-size: 16px">  معلومات</h1>
                    <div class="row mx-auto w-100 row-cols-2 " dir="rtl">
                        <div class="col mb-3" align="right">
                            <span class="card-info-title"> نوع الحساب:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                                مقاول ذاتي
                            </span>
                        </div>
    
                        <div class="col mb-3" align="right">
                            <span class="card-info-title">القطاع, النشاط:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                              الصناعة, نجارة الألمنيوم
                            </span>
                        </div>
    
         
    
                        <div class="col mb-3" align="right">
                            <span class="card-info-title"> تاريخ الانضمام:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                               16/10/2019
                            </span>
                        </div>
    
    
                        <div class="col mb-3" align="right">
                            <span class="card-info-title"> الصفقات الناجحة:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                                11
                            </span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-title"> الدولة, المدينة:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                                المغرب, طنجة
                            </span>
                        </div>
    
                        <div class="col mb-3" align="right">
                            <span class="card-info-title"> التقييم:</span>
                        </div>
                        <div class="col mb-3" align="right">
                            <span class="card-info-text">
                                <span class="user-rating-stars" dir="rtl">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </span>
                                <span class="user-rating-number">4.0</span>
                            </span>
                        </div>
                        
                    </div>
    
                </div>

                <div class="card p-3 mt-4">
                    <h1 class="card-title mb-4 mt-2" style="font-size: 16px">  أوسمة</h1>
                    <div class="alert alert-light text-center" role="alert">
                        لايوجد</div>
    
                </div>
            </div>
        </div>

    </div>




@stop
