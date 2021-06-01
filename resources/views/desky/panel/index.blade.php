@extends('desky.panel.app')

@section('content')
    </div>

    <div class="wd-90 uk-margin">

        <div class="uk-text-right uk-margin-top">
            <a href="#form-demande-branding"><button type="button"
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
        <div class="uk-text-center " uk-grid>

            <div class="uk-width-1-3@s">
                <div class="uk-card uk-card-default uk-card-body">
                    <h4 class="uk-card-title uk-text-right">أحدث العملاء</h4>
                    <div class="uk-position-top-left uk-overlay "><a href="#"><small>مشاهدة المزيد   </small></a></div>

                    <hr>
                    <table dir="rtl" class="uk-table uk-table-divider uk-text-right">
                        <thead>
                            <tr>
                                <th>اسم العميل</th>
                                <th>تاريخ الاضافة</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Saad Rifai</td>
                                <td>2021-05-26 </td>
                                <td> <button  class="act-btn-radio">
                                    <i class="fas fa-eye"></i>
                                  </button> </td>
                            </tr>
                            <tr>
                                <td>Adil Miftah</td>
                                <td>2021-05-20</td>
                                <td> <button  class="act-btn-radio">
                                    <i class="fas fa-eye"></i>
                                  </button> </td>
                            </tr>
                            <tr>
                                <td>Zineb kadi</td>
                                <td>2021-05-19</td>
                                <td> <button  class="act-btn-radio">
                                    <i class="fas fa-eye"></i>
                                  </button> </td>
                            </tr>
                            <tr>
                                <td>Yassin baladi</td>
                                <td>2021-05-18</td>
                                <td> <button  class="act-btn-radio">
                                    <i class="fas fa-eye"></i>
                                  </button> </td>
                            </tr>
                            <tr>
                                <td>Hoda yazid</td>
                                <td>2021-05-18</td>
                                <td> <button  class="act-btn-radio">
                                    <i class="fas fa-eye"></i>
                                  </button> </td>
                            </tr>
                            <tr>
                                <td>sihame yasiri</td>
                                <td>2021-05-18</td>
                                <td> <button  class="act-btn-radio">
                                    <i class="fas fa-eye"></i>
                                  </button> </td>

                            </tr>


                        </tbody>
                    </table>



                </div>
            </div>
            <div class="uk-width-expand@s">
                <div class="uk-card uk-card-default uk-card-body">

                    <h4 class="uk-card-title uk-text-right">
                        احصائيات هذه السنة</h4>
                        <div class="uk-position-top-left uk-overlay "><a href="#"><small>مشاهدة المزيد   </small></a></div>

                    <hr>
                    <year-line-chart-desky></year-line-chart-desky>

                    <!--p class="no-data-message"> لايوجد بيانات لعرضها</p-->
                </div>
            </div>
        </div>
    </div>
<div>

</div>
@endsection
