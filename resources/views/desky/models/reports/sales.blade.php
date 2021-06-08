<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ URL::asset('uikit/dist/css/uikit-rtl.min.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Almarai&display=swap" rel="stylesheet">

    <title>Annual Report</title>
</head>
<style>
    @page { margin: 0px; }
    header {
        position: fixed;
        top: 15px;
        left: 20px;
        right: 20px;
        height: 50px;

        /** Extra personal styles **/
        color: white;
        text-align: center;
        line-height: 35px;
    }

    footer {
        position: fixed;
        bottom: 10px;
        left: 0px;
        right: 0px;
        height: 50px;

        /** Extra personal styles **/
        color: white !important;
        text-align: center;
        line-height: 1;
    }
    body::after  {
        content: "";

        background-image: url('http://localhost/image/logo-web-png-ConvertImage.png');
        filter: grayscale(100%) !important;
        -webkit-filter: grayscale(100%);
        opacity: 0.05;
        z-index: -1 !important;
        padding: 0;
        margin: 20px;
        top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  position: absolute;
    }
    main{
        margin-top: 120px;
    }
    table.small-padding tbody tr td{
        padding: 5px 0 !important;
        margin: 0 !important;
        font-size: 14px;
    }
    table.orange-head thead tr {
        background-color: #f58915;
        color: white !important;
    }
    table.orange-head thead tr th {
        color: white !important;
        font-size: 12px !important;
    }
    table.orange-head tbody tr td {
       font-size: 14px;
    }
    table.orange-head tfoot tr {
        background-color: #f58915;
        color: white !important;
    }
</style>
<body>
    <header class="uk-text-left">
        <div class="uk-margin">
            <span class="logo uk-text-left">

                <img width="80" src="{{ asset('image/logo-desky.png') }}" alt="">
            </span>
            <span class="uk-text-emphasis uk-text-small uk-position-top-right date-print">Date de création: {{ date("Y-m-d H:i:s") }}</span>

        </div>
           <div class="border-color " style="width: 100%;     background-color: #f58915c9; height: 25px" ></div>

    </header>
    <main>
        <div class="head uk-text-center">
            <h4 style="margin: 0" class="uk-heading-line uk-text-center">
                 Rapport de chiffre d'affaires annuel ({{$data['year']}})
            </h4>
            <small style="margin: 0">Ce rapport a été préparé par la plateforme de gestion d'entreprise desky.ma</small>
        </div>
        <div class=" uk-text-center uk-padding ">

            <div class=" ">


                <table class=" uk-table small-padding uk-table-small uk-text-left">

                 <caption class="uk-text-left">Informations sur l'entrepreneur</caption>

                    <tbody class="uk-text-emphasis">
                        <tr>
                            <td>Nom: {{Auth::user()->fname}} {{Auth::user()->lname}} (auto-entrepreneur)</td>
                            <td>Tel: 0665033460</td>
                        </tr>
                        <tr>
                            <td>Secteur: {{$data['sector']}}</td>

                         <td>Email: {{$data['b_email']}}</td>
                        </tr>
                        <tr>
                            <td>Adresse: - {{Auth::user()->country}}  {{Auth::user()->city}} </td>
                            <td>ICE: {{$data['ice']}}</td>

                           </tr>
                        <tr>
                            <td>IF: {{$data['if']}}</td>
                            <td>TP: {{$data['tp']}}</td>
                        </tr>



                    </tbody>

                </table>

             </div>



             <hr>
             <span class="brand-logo-hidden">
            </span>
            <div class="uk-text-left">
                <small for="">Tous les montants sont en dirhams marocains (MAD)</small>

            </div>

             <table class="uk-table orange-head  uk-table-striped uk-table-small uk-text-left uk-table-divider">
                <thead>
                    <tr>
                        <th>Mois</th>
                        @if($data['customize']['unpaidFacture'] == true)
                        <th>Factures dues</th>
                        @endif

                        @if($data['customize']['ventes'] == true)
                        <th>ventes</th>
                        @endif

                        <th>C.D (TTC)</th>

                        @if($data['customize']['revenu'] == true)
                        <th>bénéfice (HT)</th>
                        @endif

                        @if($data['customize']['tva'] == true)
                        <th>TVA ({{$data['tva']}}%)</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                         @php
                  $datajson = file_get_contents('database/data.json');
                    $jsondata = json_decode($datajson, true);
                            $i = 1;
                            @endphp
                 @foreach ($data[1] as $ChiffreDaffire)
                 @php
                     $tva =  (intval($ChiffreDaffire) * intval($data['tva'])) /100;
                 @endphp
                    <tr>
                        <td>{{$jsondata['months'][$i]['namefr']}}</td>

                        @if($data['customize']['unpaidFacture'] == true)
                        <td>{{number_format($data[2][$i], 2)}}</td>
                        @endif

                        @if($data['customize']['ventes'] == true)
                        <td>{{$data[0][$i]}}</td>
                        @endif
                        <td>{{ number_format($ChiffreDaffire, 2)}}</td>

                        @if($data['customize']['revenu'] == true)
                        <td>{{ number_format(intval($ChiffreDaffire - $tva), 2) }}</td>
                        @endif

                        @if($data['customize']['tva'] == true)
                        <td>{{ number_format(intval($tva), 2) }}</td>
                        @endif

                    </tr>
                    @php
                        $i++;
                    @endphp
      @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td>Total</td>

                        @if($data['customize']['unpaidFacture'] == true)
                        <td>{{ number_format(array_sum($data[2]))}}</td>
                        @endif

                        @if($data['customize']['ventes'] == true)
                        <td>{{ array_sum($data[0])}}</td>
                        @endif

                        <td>{{ number_format(array_sum($data[1]), 2 )}}</td>

                        @if($data['customize']['revenu'] == true)
                        @php
                            $totalTva = (intval(array_sum($data[1])) * intval($data['tva']) / 100);
                            $TotalRevunu = intval(array_sum($data[1])) - $totalTva;
                        @endphp
                        <td>{{ number_format($TotalRevunu , 2)}}</td>
                        @endif

                        @if($data['customize']['tva'] == true)
                        <td> {{number_format($totalTva, 2)}} </td>
                        @endif
                    </tr>
                </tfoot>
            </table>

            </div>

    </main>
    <footer>
        <span class="uk-text-emphasis uk-text-center">

            <small>La plate-forme desky.ma n'assume aucune responsabilité en cas d'utilisation abusive du document, ce rapport a été généré automatiquement à partir des données déclarées par le contractant.</small>

        </span>
    </footer>
</body>
</html>
