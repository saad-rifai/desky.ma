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
@php
$datajson = file_get_contents('database/data.json');
$jsondata = json_decode($datajson, true);
//payments_status
$status = $data->status;
@endphp
<body>
    <header class="uk-text-center">
        <span class="logo uk-text-center">
            <img src="{{ asset('image/logo-desky.png') }}" alt="">
        </span>

        <span class="uk-text-muted uk-position-top-right date-print">{{$data->created_at}} </span>
    </header>
    <main>
        <div>
            <div class="wd-80 uk-margin-small-top uk-margin-small-bottom" style="position: relative">


                <div class="uk-card-default uk-padding uk-text-right">
                    <div class="recu-header" style="position: relative">

                        <span class="uk-padding-small uk-label
                    @php if ($status == 0) {
                            echo 'uk-label-warning';
                        } elseif ($status == 1) {
                            echo 'uk-label-success';
                        } elseif ($status == 2) {
                            echo 'uk-label-pending';
                        } elseif ($status == 3) {
                            echo 'uk-label-warning';
                        } elseif ($status == 4) {
                            echo 'uk-label-danger';
                        } elseif ($status == 5) {
                            echo 'uk-label-pending';
                    }
                    @endphp ">{{ $jsondata['payments_status'][$status]['fr'] }}</span>
                    </div>
                    <hr>

                    <div class="recu-body">
                        <h1 class="uk-card-title uk-text-left code-pay-border" dir="ltr"> #{{ $data->OID }}</h1>

                        <table class="uk-table uk-table-small uk-text-left" dir="ltr">
                            <thead>
                                <tr>
                                    <td><span class="uk-text-emphasis uk-text-bold">Demande:</span></td>
                                    <td><span class="uk-text-light uk-text-emphasis">Abonnement d'un @if ($data->type == 'm') Mois @else Une annee @endif à
                                        {{ $jsondata['_2147845']['packs'][$data->pack_id]['namefr'] }} pour la plateforme Desky.ma </span></td>
                                </tr>
                                <tr>
                                    <td><span class="uk-text-emphasis uk-text-bold">Mode de paiement:</span></td>
                                    @if($data->method == 1)
                                    <td><span class="uk-text-light uk-text-emphasis">Paiement en espèces via l'agence
                                            Wafacash (Binga)</span></td>
                                    @endif
                                    @if($data->method == 2)
                                    <td><span class="uk-text-light uk-text-emphasis">Paiement par virement bancaire</span></td>
                                    @endif
                                </tr>
                                @if(isset($data->code) && $data->code != null)
                                <tr>
                                    <td><span class="uk-text-emphasis uk-text-bold">Code de paiement (Binga):</span>
                                    </td>
                                    <td><span class="uk-text-light uk-text-bold">{{ $data->code }}</span></td>
                                </tr>
                                @endif
                                <tr>
                                    <td><span class="uk-text-emphasis uk-text-bold">Numéro de commande:</span></td>
                                    <td><span class="uk-text-light uk-text-emphasis">{{ $data->OID }}</span></td>
                                </tr>

                                <tr>
                                    <td>Coût des services:</td>
                                    <td class="labelcart">

                                        <span>
                                            {{ number_format($data->amount , 2) }} MAD
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        frais de procédure:

                                    </td>
                                    <td class="labelcart">
                                        <span>
                                            {{ number_format($data->frais , 2) }} MAD
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
                                                {{ number_format((intval($data->frais) + intval($data->amount)) , 2) }} MAD
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
                        @if($data->method == 1 && $data->status == 0)

                        <div class="uk-alert-primary uk-text-left uk-padding-small" dir="ltr" uk-alert>
                            <p><span uk-icon="icon:  chevron-double-left"></span>Vous devez vous rendre à l'agence
                                Wafacash la plus proche avec le numéro de paiement : {{$data->code}} et régler le montant
                                dû afin d'activer votre forfait <br>

                                <span uk-icon="icon:  chevron-double-left"></span>Délai de paiement : {{$data->exDate}}
                                <br>

                                <span uk-icon="icon:  chevron-double-left"></span> Une fois que vous avez payé via
                                l'agence Wafacash, votre forfait sera activé automatiquement. Si vous rencontrez un
                                problème de paiement, veuillez contacter le service commercial sales@desky.ma
                            </p>
                        </div>

                        @endif
                        @if($data->method == 2 && $data->status == 0)

                        <div class="uk-alert-primary uk-text-left uk-padding-small" dir="ltr" uk-alert>
                            <p><span uk-icon="icon:  chevron-double-left"></span>Le coût de   {{ number_format((intval($data->frais) + intval($data->amount)) , 2) }} MAD de la commande doit être transféré sur le compte suivant
                                <br>
                                la Banque: {{ $jsondata['NERYOU']['BANK_NAME'] }}
                                <br>
                                nom du compte: {{ $jsondata['NERYOU']['BANK_ACCOUNT'] }}
                                <br>
                                Numéro de compte: <span dir="ltr"> {{ $jsondata['NERYOU']['RIB'] }}</span>
                                <br>
                                <span dir="rtl"> swiftcode: {{ $jsondata['NERYOU']['SWIFTCODE'] }}</span>

                                <br>
                                @if ($data->exDate != null)
                                <span uk-icon="icon:  chevron-double-left"></span>Délai de paiement : {{$data->exDate}}
                                <br>

                                @endif

                                <span uk-icon="icon:  chevron-double-left"></span> Une fois le montant viré, le reçu de paiement doit être envoyé via le site desky.ma
                                Votre demande sera traitée dans un délai maximum de 48h, hors jours fériés
                            </p>
                        </div>
                        @endif
                    </div>


                </div>

            </div>
        </div>

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
