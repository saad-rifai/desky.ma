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
    table.orange-head thead tr td {
        color: white !important;
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
            <span class="uk-text-emphasis uk-text-small uk-position-top-right date-print">Date de création: 2020-06-17 07:32</span>

        </div>
           <div class="border-color " style="width: 100%;     background-color: #f58915c9; height: 25px" ></div>

    </header>
    <main>
        <div class="head uk-text-center">
            <h4 style="margin: 0" class="uk-heading-line uk-text-center">
                 Rapport de chiffre d'affaires annuel (2021)
            </h4>
            <small style="margin: 0">Ce rapport a été préparé par la plateforme de gestion d'entreprise desky.ma</small>
        </div>
        <div class=" uk-text-center uk-padding ">

            <div class=" ">


                <table class=" uk-table small-padding uk-table-small uk-text-left">

                 <caption class="uk-text-left">Informations sur l'entrepreneur</caption>

                    <tbody class="uk-text-emphasis">
                        <tr>
                            <td>Nom: Saad Rifai (auto-entrepreneur)</td>
                            <td>Tel: 0665033460</td>
                        </tr>
                        <tr>
                         <td>Activité: Conception et développement de sites Web</td>
                         <td>Email: s.rifai@moqawala.ma</td>
                        </tr>
                        <tr>
                            <td>Secteur: services</td>
                            <td>Adresse: technopark Tanger B°457 </td>

                           </tr>
                        <tr>
                            <td>IF: 2354789</td>

                        </tr>
                        <tr>
                         <td>TP: 4152369</td>
                        </tr>
                        <tr>
                         <td>ICE: 021654879213654</td>
                        </tr>


                    </tbody>

                </table>

             </div>



             <hr>
             <span class="brand-logo-hidden">
            </span>
             <table class="uk-table orange-head  uk-table-striped uk-table-small uk-text-left uk-table-divider">
                <thead>
                    <tr>
                        <th>le Mois</th>
                        <th>Factures dues</th>
                        <th>les ventes</th>
                        <th>chiffre d'affaires</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Janvier</td>
                        <td>6,457.00 MAD</td>
                        <td>23</td>
                        <td>20,024.40 MAD</td>
                    </tr>
                    <tr>
                        <td>février</td>
                        <td>5,344.00 MAD</td>
                        <td>34</td>
                        <td>30,002.87 MAD</td>
                    </tr>
                    <tr>
                        <td>Mars</td>
                        <td>7,934.00 MAD</td>
                        <td>21</td>
                        <td>22,321.87 MAD</td>
                    </tr>
                    <tr>
                        <td>avril</td>
                        <td>3,448.89 MAD</td>
                        <td>34</td>
                        <td>29,854.87 MAD</td>
                    </tr>
                    <tr>
                        <td>Mai</td>
                        <td>11,701.00 MAD</td>
                        <td>24</td>
                        <td>25,985.87 MAD</td>
                    </tr>
                    <tr>
                        <td>juin</td>
                        <td>8,487.00 MAD</td>
                        <td>39</td>
                        <td>33,456.87 MAD</td>
                    </tr>
                    <tr>
                        <td>juillet</td>
                        <td>9,470.00 MAD</td>
                        <td>38</td>
                        <td>32,498.87 MAD</td>
                    </tr>

                    <tr>
                        <td>août</td>
                        <td>2,935.00 MAD</td>
                        <td>41</td>
                        <td>35,014.00 MAD</td>
                    </tr>
                    <tr>
                        <td>septembre</td>
                        <td>1,457.00 MAD</td>
                        <td>45</td>
                        <td>48,436.98 MAD</td>
                    </tr>
                    <tr>
                        <td>octobre</td>
                        <td>9,147.00 MAD</td>
                        <td>45</td>
                        <td>51,541.98 MAD</td>
                    </tr>
                    <tr>
                        <td>nov</td>
                        <td>7,934.00 MAD</td>
                        <td>47</td>
                        <td>49,498.87 MAD</td>
                    </tr>
                    <tr>
                        <td>déc</td>
                        <td>4,347.00 MAD</td>
                        <td>49</td>
                        <td>48,088.87 MAD</td>
                    </tr>

                </tbody>
                <tfoot>
                    <tr>
                        <td>Total</td>
                        <td>78,661.89 MAD</td>
                        <td>440</td>
                        <td>444,726.32 MAD</td>
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
