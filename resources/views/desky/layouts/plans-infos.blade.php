@php
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

  $infos = DB::table('subscriptions')
         ->join('payment_systems', 'payment_systems.OID', '=', 'subscriptions.OID')
         ->select('subscriptions.*', 'payment_systems.status','payment_systems.code')
         ->where('email', Auth::user()->email)
         ->where('payment_systems.buyer_email', Auth::user()->email)
         ->get();

@endphp
<div class="uk-child-width-1-2@m uk-grid-small uk-grid-match" uk-grid>
    @foreach($infos as $info)



        @php
  $orgdate =  Carbon::parse($info->created_at);
  $pack_id = $info->pack_id;
  $newDate = date("Y-m-d", strtotime($orgdate));
  $datajson = file_get_contents('database/data.json');
$jsondatas = json_decode($datajson, true);
$timenow = date("Y-m-d");
if($info->type == "m"){
    $time_payments = 'شهر';
    $points = $jsondatas['packs'][$pack_id]['points'];
    $price = $jsondatas['packs'][$pack_id]['price'];
    $olddate = Carbon::parse($info->created_at);
     $exdate = $olddate->addDays(31);
     $exdate = date("Y-m-d", strtotime($exdate));


}elseif ($info->type == "y") {
    $time_payments = 'سنة';
    $points = $jsondatas['packs'][$pack_id]['points'];
    $points = intval($points)*12;
    $price = $jsondatas['packs'][$pack_id]['price_year'];
    $olddate = Carbon::parse($info->created_at);
     $exdate = $olddate->addDays(366);
     $exdate = date("Y-m-d", strtotime($exdate));
}
$c_points = $info->point;
if($points != "unlimited"){
    $consumption = ($points-$c_points);

}else {
    $consumption = 'غير محدود';
}

        @endphp
        @if($exdate > $timenow)
           <div>
        <div class="uk-card uk-card-default uk-card-body uk-text-right uk-flex">
            <span class="uk-label  @php
            if($info->status == 1){ echo 'uk-label-success';  }elseif ($info->status == 0) {
               echo 'uk-label-warning';
            }elseif ($info->status == 2) {
               echo 'uk-label-pending';
            }elseif ($info->status ==  3) {
                echo 'uk-label-warning';
            } elseif ($info->status ==  4) {
                echo 'uk-label-danger';
            } @endphp  uk-position-top-left uk-position-small">{{$jsondatas['payments_status'][$info->status]['ar']}}</span>

            <div class="icon-big uk-margin-left"><i class="fas fa-box"></i></div>

            <div><h1 class="uk-card-title">الباقة الابتدائية</h1>
                <p dir="rtl">@if($points == "unlimited") غير محدود @else {{$points}} @endif دوفي / عرض أسعار <br>({{$time_payments}}/{{$price}}Dhs)</p>
               @if ($info->status == 1)
               <p>
                <span uk-icon="icon:clock; ratio:0.7"></span> تاريخ البدء: {{$newDate}}
                <br>

                <span uk-icon="icon:clock; ratio:0.7"></span>  تاريخ الانتهاء: {{$exdate}}
            </p>
               @endif
@if ($info->status == 0)
<a href="#" class="uk-link-heading"> <span uk-icon="icon:info"></span> معلومات الاداء</a> &nbsp;
<a href="#" class="uk-link-heading"> <span uk-icon="icon:upload"></span> رفع وصل الأداء</a>

@endif
            </div>

        </div>

    </div>

    <div>
        <div class="uk-card uk-card-default uk-card-body uk-text-right uk-flex">
            <div class="icon-big uk-margin-left"><i class="fas fa-chart-pie"></i></div>
            <div><h1 class="uk-card-title">استهلاكي
            </h1>
     <p>
         @if($info->type == "m")
          تم استهلاك {{$consumption}} نقاط من {{$points}} نقطة
          @else
              استهلاكك غير محدود
          @endif
        </p>
            <p> الرصيد المتبقي @php if(is_numeric($consumption)){echo ($points-$consumption); }else{ echo 'غير محدود'; } @endphp</p>

            </div>

        </div>
    </div>
@endif
    @endforeach
    @if(count($infos) < 1 || $exdate < $timenow)
    <div class="uk-card uk-card-default uk-card-body uk-text-right uk-flex " style="    position: relative !important;
    height: 250px;">
        <div class="uk-text-center uk-position-center">

            <p>اكتشف العروض والباقات</p>
            <button class="uk-button uk-button-primary btn-call">الاشتراك بباقة</button>

        </div>



    </div>
    @endif
</div>
