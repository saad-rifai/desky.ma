@extends('desky.layouts.app')
@section('title', 'عن الخدمة')

@section('content')
<div class="form-border wd-90 uk-margin-top uk-margin-bottom  uk-padding">
    <h3 class="uk-text-center" dir="rtl">عن الخدمة</h3>
<p class="uk-text-center" dir="rtl">تقدم لك منصة desky.ma نظام احترافي لادارة نشاط المقاول الذاتي يمكن من خلاله ادارة كافة جوانب عملك تمكنك المنصة من انشاء وادارة الفواتير وعروض أسعار (devis) احترافية ببساطة وسهولة بهويتك البصرية كما تمكنك المنصة من ادارة وتسيير عملائك وانجاز تقارير وتحليلات شهرية وسنوية وتمكنك من حساب وتوقع الضرائب الخاصة بك .

</p>
</div>
<div class="wd-80 uk-margin uk-text-center ">
    <h1 class="uk-card-title uk-text-center">مالذي تقدمه المنصة</h1>
    <br>
    <br>
    <div class="uk-grid-column-small uk-grid-row-large uk-child-width-1-3@s uk-text-center  uk-flex-center" uk-grid>
        <div>
            <h3 class="uk-card-title c-org">نظام ادارة الفواتير وعروض الأسعار</h3>

            <div class="uk-card uk-card-body"><img
                    src="{{ URL::asset('image/icon/undraw_Documents_re_isxv.svg') }}"
                    alt="desky نظام الفوترة للمقاول الذاتي بالمغرب" class="icon-services"></div>
            <p dir="rtl">تقدم لك منصة <strong>desky</strong> نظام متكامل لادارة الفواتير وعروض الأسعار الخاصة بك وتمكنك من انشاء نماذج فواتير وعروض أسعار احترافية بهويتك البصرية </p>
        </div>
        <div>
            <h3 class="uk-card-title c-org">
                 نظام ادارة العملاء

                </h3>

            <div class="uk-card uk-card-body"><img src="{{ URL::asset('image/icon/undraw_Friends_online_re_r7pq.svg') }}"
                    alt="desky نظام الفوترة للمقاول الذاتي بالمغرب" class="icon-services"></div>
            <p dir="rtl">تقدم لك منصة <strong>desky</strong> نظام احترافي لادارة عملائك وحفظ المعلومات الخاصة بهم في أمان تام من أجل تجنب ضياعها
            .</p>

        </div>
        <div>
            <h3 class="uk-card-title c-org">التقارير والاحصائيات

            </h3>

            <div class="uk-card uk-card-body"><img src="{{ URL::asset('image/icon/undraw_growth_chart_r99m.svg') }}"
                    alt="desky نظام الفوترة للمقاول الذاتي بالمغرب" class="icon-services"></div>
            <p dir="rtl">تمكنك منصة <strong>desky</strong> من انجاز تقارير واحصائيات سنوية وشهرية وربع سنوية مفصلة تساعدك على تحليل نشاطك التجاري وتطويره وقياس نسبة النمو والمقارنة مع المنافسين.</p>
        </div>
        <div>
            <h3 class="uk-card-title c-org">المحاسبة والضرائب </h3>

            <div class="uk-card uk-card-body"><img src="{{ URL::asset('image/icon/undraw_discount_d4bd.svg') }}"
                    alt="desky نظام الفوترة للمقاول الذاتي بالمغرب" class="icon-services"></div>
            <p dir="rtl">تقدم لك منصة <strong>desky.ma</strong> نظام يساعدك على توقع وحساب الضرائب المستحقة بدقة وبساطة بدون اي مجهود يتم حساب كافة الضرائب تلقائياََ بنائا على الاعدادات المسبقة.</p>
        </div>
    </div>

</div>
<div class="uk-text-center wd-90" dir="rtl">
    <hr>
    <a href='/register' target="_blank"> <button type="button"
        class="uk-button uk-button-primary btn-call">
        سجل الأن</button></a>
        <a href="/tarifs" uk-scroll><button class="uk-button uk-button-text">الباقات والأسعار</button> </a>

        <br>
        <br>
</div>
@endsection
