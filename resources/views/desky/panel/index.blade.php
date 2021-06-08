@extends('desky.panel.app')
@section('title', 'لوحة التحكم')
@section('content')
    </div>

    <div class="wd-90 uk-margin">

        <div class="uk-text-right uk-margin-top">
            <a href="{{ asset('creer/facture') }}"><button type="button"
                    class="uk-button uk-button-primary uk-margin-top btn-call">انشاء فاتورة
                    <span uk-icon="plus"></span> </button></a>
            <a href="{{ asset('creer/devis') }}"><button type="button"
                    class="uk-button uk-margin-top uk-button-primary btn-call">انشاء دوفي
                    <span uk-icon="plus"></span> </button></a>
        </div>
        <br>

        <div class="uk-margin-bottom">
            <panel-statistics :year='"{{date("Y")}}"'></panel-statistics>
        </div>
        <div class="uk-text-center  uk-grid-match" uk-grid>

            <div class="uk-width-1-3@s">
                <div class="uk-card uk-card-default uk-card-body">
                    <h4 class="uk-card-title uk-text-right">احصائيات الشهر</h4>
                    <div class="uk-position-top-left uk-overlay "><a href="/statistique/mois"><small>مشاهدة المزيد   </small></a></div>

                    <hr>
                    <cas-de-facturation-pie :year='"{{ date('Y') }}"'></cas-de-facturation-pie>



                </div>
            </div>
            <div class="uk-width-expand@s">
                <div class="uk-card uk-card-default uk-card-body">

                    <h4 class="uk-card-title uk-text-right">
                        احصائيات هذه السنة</h4>
                        <div class="uk-position-top-left uk-overlay "><a href="/statistique/annee"><small>مشاهدة المزيد   </small></a></div>

                    <hr>
                    <year-line-chart-desky :year='"{{ date('Y') }}"'></year-line-chart-desky>

                    <!--p class="no-data-message"> لايوجد بيانات لعرضها</p-->
                </div>
            </div>

        </div>
        <div class="uk-text-center " dir="rtl" uk-grid>
            <div class="uk-width-expand@s">
                <div class="uk-card uk-card-default uk-card-body">
                    <h4 class="uk-card-title uk-text-right">أحدث العملاء</h4>
                    <div class="uk-position-top-left uk-overlay "><a href="/clients/list"><small>مشاهدة المزيد   </small></a></div>

                    <hr>
                    <last-clients :limit="5" :uid='"{{Auth::user()->id}}"'></last-clients>



                </div>
            </div>
            <div class="uk-width-1-3@s">
                <div class="uk-card uk-card-default uk-card-body">
                    <h4 class="uk-card-title uk-text-right">أحدث الرسائل</h4>
                    <div class="uk-position-top-left uk-overlay "><a href="#"><small>مشاهدة المزيد   </small></a></div>

                    <hr>
                    <table dir="rtl" class="uk-table uk-table-divider uk-text-right">
                        <thead>
                            <tr>
                                <th>العميل</th>
                                <th>عنوان الرسالة</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><div class="user-image-box"><div class="symbole-image">S</div></div></td>
                                <td>اريد من يصمم شعار لي </td>
                                <td> <button  class="act-btn-radio">
                                    <i class="fas fa-eye"></i>
                                  </button> </td>
                            </tr>
                            <tr>
                                <td><div class="user-image-box"><div class="symbole-image">A</div></div></td>

                                <td>أحتاج مطور ويب</td>
                                <td> <button  class="act-btn-radio">
                                    <i class="fas fa-eye"></i>
                                  </button> </td>
                            </tr>
                            <tr>
                                <td><div class="user-image-box"><div class="symbole-image">S</div></div></td>

                                <td>اريد العمل معك</td>
                                <td> <button  class="act-btn-radio">
                                    <i class="fas fa-eye"></i>
                                  </button> </td>
                            </tr>
                            <tr>
                                <td><div class="user-image-box"><div class="symbole-image">S</div></div></td>

                                <td>أود التواصل معك</td>
                                <td> <button  class="act-btn-radio">
                                    <i class="fas fa-eye"></i>
                                  </button> </td>
                            </tr>
                            <tr>
                                <td><div class="user-image-box"><div class="symbole-image">S</div></div></td>

                                <td>Hoda yazid</td>
                                <td> <button  class="act-btn-radio">
                                    <i class="fas fa-eye"></i>
                                  </button> </td>
                            </tr>
                            <tr>
                                <td><div class="user-image-box"><div class="symbole-image">S</div></div></td>

                                <td>sihame yasiri</td>
                                <td> <button  class="act-btn-radio">
                                    <i class="fas fa-eye"></i>
                                  </button> </td>

                            </tr>


                        </tbody>
                    </table>



                </div>
            </div>
        </div>
    </div>
<div>

</div>
@endsection
