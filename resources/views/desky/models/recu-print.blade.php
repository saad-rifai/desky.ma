<style>
    @import url('https://fonts.googleapis.com/css2?family=Almarai&display=swap');

    * {
        font-family: 'Almarai', sans-serif !important;

    }

    @page {
        margin: 100px 25px;
    }
    small{
        line-height: 0 !important;
    }
    header {
        position: fixed;
        top: -60px;
        left: 0px;
        right: 0px;
        height: 50px;

        /** Extra personal styles **/
        color: white;
        text-align: center;
        line-height: 35px;
    }

    footer {
        position: fixed;
        bottom: -60px;
        left: 0px;
        right: 0px;
        height: 50px;

        /** Extra personal styles **/
        color: white;
        text-align: center;
        line-height: 35px;
    }

    body::after  {
        content: "";

        background-image: url('http://localhost/image/partners/NERYOU-LOGO.png');
        filter: grayscale(100%) !important;
        -webkit-filter: grayscale(100%);
        opacity: 0.02;
        z-index: -1 !important;
        padding: 0;
        margin: 0;
        top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  position: absolute;
    }

    .uk-alert-primary {
        z-index: 1000 !important;
        position: relative !important;
    }

    .logo img {

        width: 100%;
        max-width: 150px;
        text-align: center;

    }



</style>
<!DOCTYPE html>


<html charset="UTF-8">

<head>
    <link href="{{ URL::asset('uikit/dist/css/uikit-rtl.min.css') }}" rel="stylesheet">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Almarai&display=swap" rel="stylesheet">

</head>

<body>
    <header class="uk-text-center">
        <span class="logo uk-text-center">
            <img src="{{ asset('image/logo-desky.png') }}" alt="">
        </span>
        <span class="uk-text-muted uk-position-top-right date-print">2020-06-17 07:32</span>
    </header>
    <main>
        <div>

            <div class="wd-80 uk-margin-small-top uk-margin-small-bottom" style="position: relative">


                <div class="uk-card-default uk-padding uk-text-right">
                    <div class="recu-header" style="position: relative">

                        <span class="uk-label uk-label-warning">En attente de paiement</span>
                    </div>
                    <hr>

                    <div class="recu-body">
                        <h1 class="uk-card-title uk-text-left code-pay-border" dir="ltr"> #398583012352</h1>

                        <table class="uk-table uk-table-small uk-text-left" dir="ltr">
                            <thead>
                                <tr>
                                    <td><span class="uk-text-emphasis uk-text-bold">Demande:</span></td>
                                    <td><span class="uk-text-light uk-text-emphasis">Abonnement d'un mois au forfait or
                                            pour Desky.ma</span></td>
                                </tr>
                                <tr>
                                    <td><span class="uk-text-emphasis uk-text-bold">Mode de paiement:</span></td>
                                    <td><span class="uk-text-light uk-text-emphasis">Paiement en espèces via l'agence
                                            Wafacash (Binga)</span></td>
                                </tr>
                                <tr>
                                    <td><span class="uk-text-emphasis uk-text-bold">Code de paiement (Binga):</span>
                                    </td>
                                    <td><span class="uk-text-light uk-text-bold">398583012352</span></td>
                                </tr>
                                <tr>
                                    <td><span class="uk-text-emphasis uk-text-bold">Numéro de commande:</span></td>
                                    <td><span class="uk-text-light uk-text-emphasis">379413546789114</span></td>
                                </tr>

                                <tr>
                                    <td>Coût des services:</td>
                                    <td class="labelcart">

                                        <span>
                                            99.00 MAD
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        frais de procédure:

                                    </td>
                                    <td class="labelcart">
                                        <span>
                                            4.15 MAD
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <h4>Total:</h4>
                                    </td>
                                    <td class="">
                                        <h4 class="labelcart_green">
                                            <span>
                                                103.15 MAD
                                            </span>

                                            <br />
                                        </h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="">
                                        <small>Le prix comprend les taxes (TVA)</small>
                                    </td>
                                </tr>
                            </thead>
                        </table>
                        <div class="uk-alert-primary uk-text-left uk-padding-small" dir="ltr" uk-alert>
                            <p><span uk-icon="icon:  chevron-double-left"></span>Vous devez vous rendre à l'agence
                                Wafacash la plus proche avec le numéro de paiement : 398583012352 et régler le montant
                                dû afin d'activer votre forfait <br>

                                <span uk-icon="icon:  chevron-double-left"></span>Délai de paiement : 17/06/2021
                                <br>

                                <span uk-icon="icon:  chevron-double-left"></span> Une fois que vous avez payé via
                                l'agence Wafacash, votre forfait sera activé automatiquement. Si vous rencontrez un
                                problème de paiement, veuillez contacter le service commercial sales@desky.ma
                            </p>
                        </div>

                    </div>


                </div>

            </div>
        </div>
        <br>
        <br>
        <span class="brand-logo-hidden">
        </span>
    </main>
    <footer>
        <span class="uk-text-emphasis uk-text-center">

            <small>Desky.ma est un produit de NerYou SARL</small>
            <hr>
            <small>Ce document a été délivré à des fins de paiement dans l'une des agences Wafacash</small>

        </span>
    </footer>
</body>

</html>
