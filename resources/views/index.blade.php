@extends('layout.master')

@section('content')
    <header>
        <div class="container">
            <div class="row text-center align-items-center" dir="rtl">
                <div class="col-sm">
                    <div class="header-box text-right position-relative">
                        <span class="text-background-md1"></span>

                        <h1 class="header-text mt-5 ">
                            أنجز مشاريعك <span class="orange-text">بسهولة وأمان</span> مع أول
                            وأكبر شبكة للمقاولين الذاتيين بالمغرب</h1>
                        <div class="btn-act-section mt-5 mb-5" style="    text-align: right;" dir="rtl">
                            <a href="{{asset('/orders')}}"><button style="margin-right: 0 !important;" type="button" class="btn btn-outline-primary mb-2 ">تصفح المشاريع</button></a>

                       <a href="{{asset('new/order')}}"><button style="margin-right: 0 !important;" type="button" class="btn btn-primary mb-2">أضف مشروع</button></a>

                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="img-header">
                        <img src="{{ asset('https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/asset/Coworking-bro.png') }}" alt="desky.ma">
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
                                        أنشر طلبك مع كافة تفاصيل العمل وابدأ باستقبال عروض المقاولين الذاتيين بشكل مجاني وبسيط.
                                       </div>
                                   </div>
                        </li>
                        <li class="steps-list-li">
                            <div class="row">
                                <div class="col-auto">
                                 <span class="nb-step position-relative"><span class="position-absolute top-50 start-45 translate-middle">2</span></span>
                                </div>
                                <div class="col">
                                    اختر أفضل المقاولين الذاتيين و أفضل العروض المقدمة على طلبك                                </div>
                            </div>
                        </li>
                        <li class="steps-list-li">
                            <div class="row">
                                <div class="col-auto">
                                 <span class="nb-step position-relative"><span class="position-absolute top-50 start-45 translate-middle">3</span></span>
                                </div>
                                <div class="col">
                                    تابع مراحل تنفيذ وانجاز طلبك من طرف المقاولين الذاتيين وتواصل معهم                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-sm position-relative">
                    <span class="video-canva-modal"></span>
                    <div>
                        <!--div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;">
                            <div class="wistia_responsive_wrapper"
                                style="height:100%;left:0;position:absolute;top:0;width:100%;"><iframe
                                    src="https://fast.wistia.net/embed/iframe/n1ik6rxzxh?videoFoam=true"
                                    title=" [Example Video] Wistia Video Essentials" allow="autoplay; fullscreen"
                                    allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed"
                                    name="wistia_embed" allowfullscreen msallowfullscreen width="100%"
                                    height="100%"></iframe></div>
                        </div>
                        <script src="https://fast.wistia.net/assets/external/E-v1.js" async></script-->
                            <img src="https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/asset/edmond-dant%C3%A8s-8068834.jpg" alt="What Is Desky ?" class="col-img">

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
                            <img src="https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/icons/291-coin-dollar-outline.png" class="icon-card" alt="desky.ma">
                            <h2 class="title-icon">
                                أنشر طلباتك بشكل مجاني
                            </h2>
                            <p class="icon-text">
                                أنشر طلباتك في المنصة وتلقى العروض
                                من المقاولين بشكل مجاني
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm mb-5">
                    <div class="card hover_card">
                        <div class="card-body">
                            <img src="https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/icons/457-shield-security-outline.png" class="icon-card" alt="desky.ma">
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
                            <img src="https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/icons/1007-organization-outline.png" class="icon-card" alt="desky.ma">
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
                            <img src="https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/icons/682-male-customer-service-outline.png" class="icon-card"
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
                            <img src="https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/icons/945-dividends-outline.png" class="icon-card" alt=" أنت كشركة يمكنك">
                            <h2 class="title-icon">
                               أنت كشركة يمكنك

                            </h2>
                            <p class="icon-text">
                                الاستفادة من خدمات المقاولين الذاتيين لمدة متفق عليها بتفضيلات ضريبة وقانونية
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm mb-5">
                    <div class="card hover_card">
                        <div class="card-body">
                            <img src="https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/icons/453-savings-pig-outline.png" class="icon-card" alt="desky.ma">
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
              <a href="/register?ref=landing-page">  <button type="button" class="btn btn-primary mb-5">سجل الأن</button></a>

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
                        
                        <p>
                            تتيح منصة ديسكي لك كمقاول ذاتي فرصة ايجاد عملاء جدد والتعريف بخدماتك وعرض أعمالك قصد زيادة دخلك, فيمكنك من خلال المنصة تقديم عروضك على طلبات العملاء كما يمكن للعملاء أن يتواصلوا معك مباشرة من خلال حسابك.
                        </p>
                    </div>
                </div>

            </div>
            <h3 dir="rtl" class="text-section text-center">انضم الى أكبر شبكة مقاولين ذاتيين بالمغرب</h3>
            <div class="users-avatars-section">
                <div class="user-av-show">
                    <img src="https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/default/av-1.jpg" >
                </div>
                <div class="user-av-show">
                    <img src="https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/default/av-2.jpg">
                </div>
                <div class="user-av-show">
                    <img src="https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/default/av-3.jpg" >
                </div>
                <div class="user-av-show">
                    <img src="https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/default/av-4.jpg" >
                </div>
                <div class="user-av-show">
                    <img src="https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/default/av-5.jpg" >
                </div>
                <div class="user-av-show">
                    <img src="https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/default/av-6.jpg">
                </div>
                <div class="user-av-show">
                    <img src="https://desky-ma-disk.s3.eu-west-3.amazonaws.com/assets/default/av-7.jpg" >
                </div>

            </div>
            <br>
            <div class="cta text-center">
                <a href="/register?ref=landing-page">  <button type="button" class="btn btn-primary mb-5">سجل الأن</button></a>

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
                                تعمل ديسكي على توفير مساحة وصل بين المقاول الذاتي و أصحاب الاعمال و الشركات, من خلال المنصة يمكن للشركات والافراد إيداع طلباتهم التي تعبر عن الخدمات التي يحتجونها و التي تتماشى مع متطلباتهم قصد الحصول على عروض من المقاولين الذاتيين وتنفيذ طلبهم, كذلك تتيح منصة ديسكي للمقاولين الذاتيين ايجاد عملاء جدد والتعريف بخدماتهم واعمالهم.


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
                        <p>يمكنك الانضمام ببساطة من خلال انشاء حساب على المنصة والتوجه الى صفحة <a href="{{asset('/account/settings#ae_account')}}">طلب تفعيل حساب المقاول الذاتي</a> ثم يمكنك اتمام الخطوات لتفعيل حسابك.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                        <button class="accordion-button collapsed" type="button" data-toggle="collapse"
                            data-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseThree">
                           ماهي شروط الانضمام للمنصة كمقاول ذاتي

                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingThree" data-parent="#accordionPanelsStayOpenExample">
                        <div class="accordion-body">
                            <p>
                                لاتوجد شروط يكفي توفرك على بطاقة المقاول الذاتي سارية المفعول وبطاقة الهوية أو بطاقة الاقامة ويمكنك تفعيل حساب المقاول الذاتي
                            </p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingThree121">
                        <button class="accordion-button collapsed" type="button" data-toggle="collapse"
                            data-target="#panelsStayOpen-collapseThree121" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseThree121">
                           كيف يمكنني الاستفاذة من المنصة كصاحب شركة ؟

                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseThree121" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingThree121" data-parent="#accordionPanelsStayOpenExample">
                        <div class="accordion-body">
                            <p>
                                يمكنك نشر طلباتك في المنصة والحصول على العروض من أفضل المقاوليين الذاتيين قصد تنفيذ طبلك, يمكنك كذلك البحث عن مقاول ذاتي والتواصل معه مباشرة من خلال المنصة
                            </p>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    
    <div class="white-bg">
        <div class="container">
  
            <div class="row row-cols-auto justify-content-md-center text-center" dir="rtl">

               <div class="col"> <h4 dir="rtl" class="text-section-t text-center">ما الذي تنتظره ؟</h4></div>

               <div class="col">  <a href="/register?ref=landing-page"> <button type="button" class="btn btn-outline-primary ">سجل الأن</button></a></div>

            </div>
        </div>
    </div>

@stop
