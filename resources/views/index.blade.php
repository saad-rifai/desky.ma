@extends('layout.master')
@section('title', 'أول شبكة للمقاولين الذتيين')

@section('content')
    <header>
        <div class="container">
            <div class="row text-center" dir="rtl">
                <div class="col-sm">
                    <div class="header-box text-right position-relative">
                        <span class="text-background-md1"></span>

                        <h1 class="header-text mt-5 ">
                            أنجز مشاريعك <span class="orange-text">بسهولة وأمان</span> مع أول
                            وأكبر شبكة للمقاولين الذاتيين بالمغرب</h1>
                        <div class="btn-act-section mt-5 mb-5" style="    text-align: right;" dir="rtl">
                            <button style="margin-right: 0 !important;" type="button" class="btn btn-outline-primary mb-2 ">تصفح المشاريع</button>

                       <a href="{{asset('new/order')}}"><button style="margin-right: 0 !important;" type="button" class="btn btn-primary mb-2">أضف مشروع</button></a>

                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="img-header">
                        <img src="{{ asset('https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/icons/Connected+world-bro-min.png') }}" alt="desky.ma">
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="white-bg">
        <div class="container">
            <h1 dir="rtl" class="text-section">كيف تعمل منصة desky ؟</h1>
            <div class="row text-center" dir="rtl">
                <div class="col-sm">
                    <ul class="steps-list mt-5 mb-5">
                        <li class="steps-list-li">
                                   <div class="row">
                                       <div class="col-auto">
                                        <span class="nb-step position-relative"><span class="position-absolute top-50 start-45 translate-middle">1</span></span>
                                       </div>
                                       <div class="col">
                                        أنشر مشروعك مع
                                        كافة تفاصيل العمل الذي توده وابد باستقبال عروض المقاولين
                                       </div>
                                   </div>
                        </li>
                        <li class="steps-list-li">
                            <div class="row">
                                <div class="col-auto">
                                 <span class="nb-step position-relative"><span class="position-absolute top-50 start-45 translate-middle">1</span></span>
                                </div>
                                <div class="col">
                                 أنشر مشروعك مع
                                 كافة تفاصيل العمل الذي توده وابد باستقبال عروض المقاولين
                                </div>
                            </div>
                        </li>
                        <li class="steps-list-li">
                            <div class="row">
                                <div class="col-auto">
                                 <span class="nb-step position-relative"><span class="position-absolute top-50 start-45 translate-middle">1</span></span>
                                </div>
                                <div class="col">
                                 أنشر مشروعك مع
                                 كافة تفاصيل العمل الذي توده وابد باستقبال عروض المقاولين
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-sm position-relative">
                    <span class="video-canva-modal"></span>
                    <div>
                        <div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;">
                            <div class="wistia_responsive_wrapper"
                                style="height:100%;left:0;position:absolute;top:0;width:100%;"><iframe
                                    src="https://fast.wistia.net/embed/iframe/n1ik6rxzxh?videoFoam=true"
                                    title=" [Example Video] Wistia Video Essentials" allow="autoplay; fullscreen"
                                    allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed"
                                    name="wistia_embed" allowfullscreen msallowfullscreen width="100%"
                                    height="100%"></iframe></div>
                        </div>
                        <script src="https://fast.wistia.net/assets/external/E-v1.js" async></script>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="bg-section mt-5">
        <div class="container">
            <h1 dir="rtl" class="text-section mb-5">لماذا منصة desky ؟</h1>

            <div class="row text-center ">
                <div dir="rtl" class="col-sm mb-5">
                    <div class="card hover_card">
                        <div class="card-body">
                            <img src="img/icons/291-coin-dollar-outline.png" class="icon-card" alt="desky.ma">
                            <h2 class="title-icon">
                                أنشر مشارعك بشكل مجاني
                            </h2>
                            <p class="icon-text">
                                أنشر مشارعك في المنصة وتلقى العروض
                                من المقاولين بشكل مجاني
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm mb-5">
                    <div class="card hover_card">
                        <div class="card-body">
                            <img src="img/icons/457-shield-security-outline.png" class="icon-card" alt="desky.ma">
                            <h2 class="title-icon">
                                أنجز مشاريعك بأمان
                            </h2>
                            <p class="icon-text">
                                جميع المقاولين في المنصة تم التحقق
                                منهم ومن الوثائق القانونية الخاصة بهم
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm mb-5">
                    <div class="card hover_card">
                        <div class="card-body">
                            <img src="img/icons/1007-organization-outline.png" class="icon-card" alt="desky.ma">
                            <h2 class="title-icon">
                                اعمل مع أفضل المقاولين في المغرب
                            </h2>
                            <p class="icon-text">
                                تضم المنصة أفضل المقاولين الذاتيين في
                                جميع انحاء المغرب لإنجاز مشاريعك
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row text-center">
                <div dir="rtl" class="col-sm mb-5">
                    <div class="card hover_card">
                        <div class="card-body">
                            <img src="img/icons/682-male-customer-service-outline.png" class="icon-card"
                                alt="desky.ma">
                            <h2 class="title-icon">
                                الدعم والمساعدة 7/7
                            </h2>
                            <p class="icon-text">
                                فريقنا جاهز ومستعد دائما لتقديم الدعم والمساعدة لك في أي وقت
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm mb-5">
                    <div class="card hover_card">
                        <div class="card-body">
                            <img src="img/icons/456-handshake-deal-outline.png" class="icon-card" alt="desky.ma">
                            <h2 class="title-icon">
                                نفّذ مشاريعك بسهولة

                            </h2>
                            <p class="icon-text">
                                أنشر مشروعك واترك مهمة تنفيذه
                                الى أمهر المقاولين الذاتيين بالمغرب
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm mb-5">
                    <div class="card hover_card">
                        <div class="card-body">
                            <img src="img/icons/453-savings-pig-outline.png" class="icon-card" alt="desky.ma">
                            <h2 class="title-icon">
                                أنجز مشاريعك بأقل تكلفة

                            </h2>
                            <p class="icon-text">
                                أختر بين العروض المقدمة من طرف المقاولين أفضل عرض يناسب ميزانيتك
                            </p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="cta text-center">
                <button type="button" class="btn btn-primary mb-5">سجل الأن</button>

            </div>
        </div>
    </div>
    <div class="white-bg">
        <div class="container">
            <h1 dir="rtl" class="text-section-t text-center mb-2">هل انت مقاول ذاتي ؟</h1>
            <div class="card-image-text">
                <div class="row justify-content-md-center align-items-center" dir="rtl">

                    <div class="col-sm  mb-5" align="center">
                        <div class="card-col-img  mb-5">
                            <span class="img-user-modal"></span>
                            <span class="img-user-modal-2"></span>
     
                            <img class="col-img-nobg" src="{{asset('/img/icons/user-nobg.png')}}" alt="مالذي تقدمه لك منصة desky ؟">
                        </div>
                    </div>
                    <div class="col-sm" align="right">
                        <h1 class="col-title" style="font-size: 20px"> مالذي تقدمه لك منصة desky ؟</h1>
                        <br>
                        
                        <p>أنجز مشاريعك بسهولة وأمان مع أول وأكبر شبكة للمقاولين الذاتيين بالمغرب
                            أنجز مشاريعك بسهولة وأمان مع أول وأكبر شبكة للمقاولين الذاتيين بالمغرب
                            أنجز مشاريعك بسهولة وأمان مع أول وأكبر شبكة للمقاولين الذاتيين بالمغرب
                        </p>
                    </div>
                </div>

            </div>
            <h3 dir="rtl" class="text-section text-center">انضم الى أكبر شبكة مقاوليين ذاتيين بالمغرب</h3>
            <div class="users-avatars-section">
                <div class="user-av-show">
                    <img src="img/users/1.jpg" alt="saad rifai">
                </div>
                <div class="user-av-show">
                    <img src="img/users/2.jpg" alt="saad rifai">
                </div>
                <div class="user-av-show">
                    <img src="img/users/3.jpg" alt="saad rifai">
                </div>
                <div class="user-av-show">
                    <img src="img/users/4.jpg" alt="saad rifai">
                </div>
                <div class="user-av-show">
                    <img src="img/users/5.jpg" alt="saad rifai">
                </div>
                <div class="user-av-show">
                    <img src="img/users/4.jpg" alt="saad rifai">
                </div>
                <div class="user-av-show">
                    <img src="img/users/2.jpg" alt="saad rifai">
                </div>

            </div>
            <br>
            <div class="cta text-center">
                <button type="button" class="btn btn-primary mb-5">سجل الأن</button>

            </div>
        </div>
    </div>
    <div class="bg-section mt-5 mb-5">
        <div class="container">
            <h1 dir="rtl" class="text-section mb-5">الأسئلة الشائعة</h1>

            <!-- accordion -->


            <div dir="rtl" class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                        <button class="accordion-button" type="button" data-toggle="collapse"
                            data-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                            aria-controls="panelsStayOpen-collapseOne">
                            ما هي منصة desky ؟
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse show"
                        aria-labelledby="panelsStayOpen-headingOne" data-parent="#accordionPanelsStayOpenExample">
                        <div class="accordion-body">
                            <p>
                                مستقل هو منصة عربية تتيح لأصحاب المشاريع والشركات التعاقد مع مستقلين محترفين للقيام
                                بأعمالهم، وبنفس الوقت يتيح للمستقلين المحترفين مكانًا لإيجاد مشاريع يعملون عليها ويكسبون من
                                خلالها.

                            </p>

                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-toggle="collapse"
                            data-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseTwo">
                            كيف أنضم للمنصة كمقاول ذاتي؟
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingTwo" data-parent="#accordionPanelsStayOpenExample">
                        <div class="accordion-body">
                            <strong>This is the second item's accordion body.</strong> It is hidden by default, until the
                            collapse plugin adds the appropriate classes that we use to style each element. These classes
                            control the overall appearance, as well as the showing and hiding via CSS transitions. You can
                            modify any of this with custom CSS or overriding our default variables. It's also worth noting
                            that just about any HTML can go within the <code>.accordion-body</code>, though the transition
                            does limit overflow.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                        <button class="accordion-button collapsed" type="button" data-toggle="collapse"
                            data-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseThree">
                            كيف تضمن المنصة حقوقي؟

                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingThree" data-parent="#accordionPanelsStayOpenExample">
                        <div class="accordion-body">
                            <strong>This is the third item's accordion body.</strong> It is hidden by default, until the
                            collapse plugin adds the appropriate classes that we use to style each element. These classes
                            control the overall appearance, as well as the showing and hiding via CSS transitions. You can
                            modify any of this with custom CSS or overriding our default variables. It's also worth noting
                            that just about any HTML can go within the <code>.accordion-body</code>, though the transition
                            does limit overflow.
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    
    <div class="white-bg">
        <div class="container">
  
            <div class="row row-cols-auto justify-content-md-center text-center" dir="rtl">

               <div class="col"> <h4 dir="rtl" class="text-section-t text-center">مالذي تنتظره ؟</h4></div>

               <div class="col">   <button type="button" class="btn btn-outline-primary ">سجل الأن</button></div>

            </div>
        </div>
    </div>

@stop
