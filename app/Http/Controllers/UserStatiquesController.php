<?php

namespace App\Http\Controllers;

use App\desky_db;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\DeskyUserFacture;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Support\Carbon;
use App\Http\Controllers\PaymentSystemController;
use PDF;
class UserStatiquesController extends Controller
{
    public function UserStatistiquesGeneral(Request $request)
    {
        if($request->SA){
            $PaymentSystemController = new PaymentSystemController();
            $CheckSubscriptions = $PaymentSystemController->CheckSubscriptions();
            $Bipack = $CheckSubscriptions['BigPack'];
            $datajson = file_get_contents('database/data.json');
            $jsondata = json_decode($datajson, true);
            if (isset($jsondata['_2147845']['packs'][$Bipack])) {
                if (in_array('SA',$jsondata['_2147845']['packs'][$Bipack]['properties'])) {

                }else{
                    return response('nedd pay', 402);
                }
            }else{
                return response('nedd pay', 402);
            }
        }
     /*  */
                /*
        if($request->month != "*" && is_numeric($request->month)){
               $month = $request->month;
           }else{
               $month = null;
           }*/
                if ($request->year != '*' && is_numeric($request->year)) {
                    $year = $request->year;
                } else {
                    $year = null;
                }
                $datas = DB::table('desky_user_factures')
                    ->select(['status', 'items', 'remise', 'created_at'])
                    ->whereYear('created_at', 'LIKE', '%' . $year . '%')
                    // ->whereMonth('created_at', 'LIKE', '%'.$month.'%')
                    ->where('email', Auth::user()->email)
                    ->orderby('created_at', 'desc')
                    ->get();

                $userdbs = desky_db::where('email', Auth::user()->email)->get([
                    'tva',
                ]);
                foreach ($userdbs as $tva);
                $tva = intval($tva->tva);
                $price_m = 0;
                $price_y = 0;
                $price_u = 0;
                $price_ny = 0;
                $TotalUnpaidThisMonth = 0;
                $TotalThisMonth = 0;
                $TotalThisYear = 0;
                $NumberOfSales = 0;
                $NumberOfSalesMonth = 0;
                $Clients = DB::table('desky_user_clients')
                    ->select(['CID'])
                    ->whereYear('created_at', 'LIKE', '%' . $year . '%')
                    // ->whereMonth('created_at', 'LIKE', '%'.$month.'%')
                    ->where('from', Auth::user()->email)
                    ->orderby('created_at', 'desc')
                    ->get();
                $TotalClientsThisYear = Count($Clients);

                foreach ($datas as $data) {
                    $date_m = date('m', strtotime($data->created_at));
                    $date_y = date('y', strtotime($data->created_at));
                    if ($date_y == date('y')) {
                        if ($data->status == 4 || $data->status == 5) {
                            $NumberOfSales++;
                            // Get Sales Of This Year
                            $items = json_decode($data->items);
                            $remise = intval($data->remise);

                            $n_items = count($items);
                            for ($i = 0; $n_items > $i; $i++) {
                                $price_y += intval(
                                    $items[$i]->price * $items[$i]->quantity
                                );
                            }
                            $price_y = $price_y - $remise;
                        }
                        // Get Facture Need Pay This Year
                        if ($date_y == date('y') && $data->status == 3) {
                            $items = json_decode($data->items);
                            $remise_ny = intval($data->remise);

                            $n_items = count($items);
                            for ($i = 0; $n_items > $i; $i++) {
                                $price_ny += intval(
                                    $items[$i]->price * $items[$i]->quantity
                                );
                            }
                            $price_ny = $price_ny - $remise_ny;
                        }
                        // Get Facture Need Pay This Month
                        if ($date_m == date('m') && $data->status == 3) {
                            $items = json_decode($data->items);
                            $remise = intval($data->remise);

                            $n_items = count($items);
                            for ($i = 0; $n_items > $i; $i++) {
                                $price_u += intval(
                                    $items[$i]->price * $items[$i]->quantity
                                );
                            }
                            $price_u = $price_u - $remise;
                        }

                        if (
                            ($date_m == date('m') && $data->status == 4) ||
                            ($data->status == 5 && $date_m == date('m'))
                        ) {
                            // Get Sales Of This Month
                            $items = json_decode($data->items);
                            $remise = intval($data->remise);
                            $NumberOfSalesMonth++;
                            $n_items = count($items);
                            for ($i = 0; $n_items > $i; $i++) {
                                $price_m += intval(
                                    $items[$i]->price * $items[$i]->quantity
                                );
                            }
                            $price_m = $price_m - $remise;
                        }
                    }
                }
                // Mount Sales
                $tva_cost_m = ($price_m * $tva) / 100;
                $TotalThisMonth = $price_m + $tva_cost_m;

                $tva_cost_y = ($price_y * $tva) / 100;
                $TotalThisYear = $price_y + $tva_cost_y;

                $tva_cost_u = ($price_u * $tva) / 100;
                $TotalUnpaidThisMonth = $price_u + $tva_cost_u;
                $totalNet = $price_u;
                // Factures Need Pay This Year

                $tva_cost_ny = ($price_ny * $tva) / 100;
                $TotalUnpaidThisMonth = $price_ny + $tva_cost_ny;
                return response()->json(
                    [
                        'TotalThisMonth' => $TotalThisMonth,
                        'TotalThisYear' => $TotalThisYear,
                        'TotalUnpaidThisMonth' => $TotalUnpaidThisMonth,
                        'TotalSales' => $NumberOfSales,
                        'TotalUnpaidThisYear' => $TotalUnpaidThisMonth,
                        'TotalClientsThisYear' => $TotalClientsThisYear,
                        'TotalSalesThisMonth' => $NumberOfSalesMonth,
                        'TvaCost' => $tva_cost_y,
                    ],
                    200
                );
                //return response()->json([$data]);

    }
    public function UserStatistiquesGeneralLine(Request $request)
    {
        $PaymentSystemController = new PaymentSystemController();
        $CheckSubscriptions = $PaymentSystemController->CheckSubscriptions();
        $Bipack = $CheckSubscriptions['BigPack'];
        $datajson = file_get_contents('database/data.json');
        $jsondata = json_decode($datajson, true);
        if (isset($jsondata['_2147845']['packs'][$Bipack])) {
            if (
                in_array(
                    'SA',
                    $jsondata['_2147845']['packs'][$Bipack]['properties']
                )
            ) {
                if (isset($request->year) && is_numeric($request->year)) {
                    if (isset($request->json)) {
                        $year = $request->year;

                        $datas = DB::table('desky_user_factures')
                            ->select([
                                'status',
                                'items',
                                'remise',
                                'created_at',
                            ])
                            ->whereYear('created_at', 'LIKE', '%' . $year . '%')
                            // ->whereMonth('created_at', 'LIKE', '%'.$month.'%')
                            ->where('email', Auth::user()->email)
                            ->orderby('created_at', 'desc')
                            ->get();

                        // Months Viriables
                        for ($i = 1; $i <= 12; $i++) {
                            $m[$i] = 0;
                            $NumberOfSales[$i] = 0;
                            $TotalUnpaidThisYear[$i] = 0;
                            $price_m['CD'][$i] = 0;
                            $price_m['UP'][$i] = 0;
                        }
                        $userdbs = desky_db::where(
                            'email',
                            Auth::user()->email
                        )->get(['tva']);
                        foreach ($userdbs as $tva);
                        $tva = intval($tva->tva);

                        foreach ($datas as $data) {
                            $date_m = date('m', strtotime($data->created_at));
                            for ($x = 1; $x <= 12; $x++) {
                                if (
                                    ($date_m == "$x" && $data->status == 4) ||
                                    ($data->status == 5 && $date_m == "$x")
                                ) {
                                    $NumberOfSales[$x]++;
                                    $items = json_decode($data->items);
                                    $remise = intval($data->remise);
                                    ///////////
                                    $n_items = count($items);
                                    for ($i = 0; $n_items > $i; $i++) {
                                        $price_m['CD'][$x] += intval(
                                            $items[$i]->price *
                                                $items[$i]->quantity
                                        );
                                    }
                                    $price_m['CD'][$x] =
                                        $price_m['CD'][$x] - $remise;
                                    $tva_cost =
                                        ($price_m['CD'][$x] * $tva) / 100;

                                    $m[$x] = $price_m['CD'][$x] + $tva_cost;
                                } elseif (
                                    $date_m == "$x" &&
                                    $data->status == 3
                                ) {
                                    $items = json_decode($data->items);
                                    $remise = intval($data->remise);

                                    $n_items = count($items);
                                    for ($i = 0; $n_items > $i; $i++) {
                                        $price_m['UP'][$x] += intval(
                                            $items[$i]->price *
                                                $items[$i]->quantity
                                        );
                                    }
                                    $price_m['UP'][$x] =
                                        $price_m['UP'][$x] - $remise;
                                    $tva_cost =
                                        ($price_m['UP'][$x] * $tva) / 100;

                                    $TotalUnpaidThisYear[$x] +=
                                        $price_m['UP'][$x] + $tva_cost;
                                }
                            }
                        }
                        $data = [$NumberOfSales, $m, $TotalUnpaidThisYear];
                        return response()->json($data, 200);
                    } elseif ($request->print) {
                        if (
                            isset($request->customize) &&
                            isset($request->year)
                        ) {
                            $PaymentSystemController = new PaymentSystemController();
                            $CheckSubscriptions = $PaymentSystemController->CheckSubscriptions();
                            $Bipack = $CheckSubscriptions['BigPack'];
                            $datajson = file_get_contents('database/data.json');
                            $jsondata = json_decode($datajson, true);
                            if (
                                isset($jsondata['_2147845']['packs'][$Bipack])
                            ) {
                                if (
                                    in_array(
                                        'SAP',
                                        $jsondata['_2147845']['packs'][$Bipack][
                                            'properties'
                                        ]
                                    )
                                ) {
                                    //  return $pdfgenerate->download("pdfname.pdf");
                                    $year = $request->year;
                                    $customize = json_decode(
                                        $request->customize,
                                        true
                                    );
                                    $year = $request->year;

                                    $datas = DB::table('desky_user_factures')
                                        ->select([
                                            'status',
                                            'items',
                                            'remise',
                                            'created_at',
                                        ])
                                        ->whereYear(
                                            'created_at',
                                            'LIKE',
                                            '%' . $year . '%'
                                        )
                                        // ->whereMonth('created_at', 'LIKE', '%'.$month.'%')
                                        ->where('email', Auth::user()->email)
                                        ->orderby('created_at', 'desc')
                                        ->get();

                                    // Months Viriables
                                    for ($i = 1; $i <= 12; $i++) {
                                        $m[$i] = 0;
                                        $price_m['CD'][$i] = 0;
                                        $price_m['UP'][$i] = 0;
                                        $NumberOfSales[$i] = 0;
                                        $TotalUnpaidThisYear[$i] = 0;
                                    }
                                    $userdbs = desky_db::where(
                                        'email',
                                        Auth::user()->email
                                    )->get([
                                        'tva',
                                        'b_email',
                                        'b_phone',
                                        'ice',
                                        'if',
                                        'tp',
                                        'sector',
                                    ]);

                                    foreach ($userdbs as $userdb);
                                    $tva = intval($userdb->tva);

                                    $b_email = $userdb->b_email;
                                    $b_phone = $userdb->b_phone;
                                    $ice = $userdb->ice;
                                    $if = $userdb->if;
                                    $tp = $userdb->tp;
                                    $sector =
                                        $jsondata['sector_fr'][$userdb->sector];
                                    foreach ($datas as $data) {
                                        $date_m = date(
                                            'm',
                                            strtotime($data->created_at)
                                        );
                                        for ($x = 1; $x <= 12; $x++) {
                                            if (
                                                ($date_m == "$x" &&
                                                    $data->status == 4) ||
                                                ($data->status == 5 &&
                                                    $date_m == "$x")
                                            ) {
                                                $NumberOfSales[$x]++;
                                                $items = json_decode(
                                                    $data->items
                                                );
                                                $remise = intval($data->remise);
                                                ///////////
                                                $n_items = count($items);
                                                for (
                                                    $i = 0;
                                                    $n_items > $i;
                                                    $i++
                                                ) {
                                                    $price_m['CD'][
                                                        $x
                                                    ] += intval(
                                                        $items[$i]->price *
                                                            $items[$i]->quantity
                                                    );
                                                }
                                                $price_m['CD'][$x] =
                                                    $price_m['CD'][$x] -
                                                    $remise;
                                                $tva_cost =
                                                    ($price_m['CD'][$x] *
                                                        $tva) /
                                                    100;

                                                $m[$x] =
                                                    $price_m['CD'][$x] +
                                                    $tva_cost;
                                            } elseif (
                                                $date_m == "$x" &&
                                                $data->status == 3
                                            ) {
                                                if (
                                                    $customize[
                                                        'unpaidFacture'
                                                    ] == true
                                                ) {
                                                    $items = json_decode(
                                                        $data->items
                                                    );
                                                    $remise = intval(
                                                        $data->remise
                                                    );

                                                    $n_items = count($items);
                                                    for (
                                                        $i = 0;
                                                        $n_items > $i;
                                                        $i++
                                                    ) {
                                                        $price_m['UP'][
                                                            $x
                                                        ] += intval(
                                                            $items[$i]->price *
                                                                $items[$i]
                                                                    ->quantity
                                                        );
                                                    }
                                                    $price_m['UP'][$x] =
                                                        $price_m['UP'][$x] -
                                                        $remise;
                                                    $tva_cost =
                                                        ($price_m['UP'][$x] *
                                                            $tva) /
                                                        100;

                                                    $TotalUnpaidThisYear[$x] +=
                                                        $price_m['UP'][$x] +
                                                        $tva_cost;
                                                }
                                            }
                                        }
                                    }

                                    $data = [
                                        $NumberOfSales,
                                        $m,
                                        $TotalUnpaidThisYear,
                                        'tva' => $tva,
                                        'year' => $year,
                                        'b_email' => $b_email,
                                        'b_phone' => $b_phone,
                                        'ice' => $ice,
                                        'if' => $if,
                                        'tp' => $tp,
                                        'sector' => $sector,
                                        'customize' => $customize,
                                    ];
                                    $pdfgenerate = PDF::loadView(
                                        'desky/models/reports/sales',
                                        [
                                            'infos' => $customize,
                                            'data' => $data,
                                        ],
                                        ['enable_remote' => true]
                                    )->setPaper('A4', 'portrait');

                                    return $pdfgenerate->download(
                                        'rapport annuel (' .
                                            $request->year .
                                            ').pdf'
                                    );
                                } else {
                                    return response()->json(
                                        [
                                            'error' =>
                                                'باقتك لاتسمح لك بهذه الميزة يمكنك مشاهدة <a href="/tarifs">الباقات</a>',
                                        ],
                                        402
                                    );
                                }
                            } else {
                                return response()->json(
                                    ['error' => 'Bad Request'],
                                    402
                                );
                            }
                        } else {
                            $PaymentSystemController = new PaymentSystemController();
                            $CheckSubscriptions = $PaymentSystemController->CheckSubscriptions();
                            $Bipack = $CheckSubscriptions['BigPack'];
                            $datajson = file_get_contents('database/data.json');
                            $jsondata = json_decode($datajson, true);
                            if (
                                isset($jsondata['_2147845']['packs'][$Bipack])
                            ) {
                                if (
                                    in_array(
                                        'SA',
                                        $jsondata['_2147845']['packs'][$Bipack][
                                            'properties'
                                        ]
                                    )
                                ) {
                                    //  return $pdfgenerate->download("pdfname.pdf");
                                    $year = $request->year;
                                    $customize = [
                                        'unpaidFacture' => false,
                                        'ventes' => true,
                                        'revenu' => true,
                                        'tva' => false,
                                        'chiffreDaffire' => true,
                                    ];
                                    $year = $request->year;

                                    $datas = DB::table('desky_user_factures')
                                        ->select([
                                            'status',
                                            'items',
                                            'remise',
                                            'created_at',
                                        ])
                                        ->whereYear(
                                            'created_at',
                                            'LIKE',
                                            '%' . $year . '%'
                                        )
                                        // ->whereMonth('created_at', 'LIKE', '%'.$month.'%')
                                        ->where('email', Auth::user()->email)
                                        ->orderby('created_at', 'desc')
                                        ->get();

                                    // Months Viriables
                                    for ($i = 1; $i <= 12; $i++) {
                                        $m[$i] = 0;
                                        $NumberOfSales[$i] = 0;
                                        $TotalUnpaidThisYear[$i] = 0;
                                        $price_m['CD'][$i] = 0;
                                        $price_m['UP'][$i] = 0;
                                    }
                                    $userdbs = desky_db::where(
                                        'email',
                                        Auth::user()->email
                                    )->get([
                                        'tva',
                                        'b_email',
                                        'b_phone',
                                        'ice',
                                        'if',
                                        'tp',
                                        'sector',
                                    ]);

                                    foreach ($userdbs as $userdb);
                                    $tva = intval($userdb->tva);

                                    $b_email = $userdb->b_email;
                                    $b_phone = $userdb->b_phone;
                                    $ice = $userdb->ice;
                                    $if = $userdb->if;
                                    $tp = $userdb->tp;
                                    $sector =
                                        $jsondata['sector_fr'][$userdb->sector];
                                    foreach ($datas as $data) {
                                        $date_m = date(
                                            'm',
                                            strtotime($data->created_at)
                                        );
                                        for ($x = 1; $x <= 12; $x++) {
                                            if (
                                                ($date_m == "$x" &&
                                                    $data->status == 4) ||
                                                ($data->status == 5 &&
                                                    $date_m == "$x")
                                            ) {
                                                $NumberOfSales[$x]++;
                                                $items = json_decode(
                                                    $data->items
                                                );
                                                $remise = intval($data->remise);
                                                ///////////
                                                $n_items = count($items);
                                                for (
                                                    $i = 0;
                                                    $n_items > $i;
                                                    $i++
                                                ) {
                                                    $price_m['CD'][
                                                        $x
                                                    ] += intval(
                                                        $items[$i]->price *
                                                            $items[$i]->quantity
                                                    );
                                                }
                                                $price_m['CD'][$x] =
                                                    $price_m['CD'][$x] -
                                                    $remise;
                                                $tva_cost =
                                                    ($price_m['CD'][$x] *
                                                        $tva) /
                                                    100;

                                                $m[$x] =
                                                    $price_m['CD'][$x] +
                                                    $tva_cost;
                                            } elseif (
                                                $date_m == "$x" &&
                                                $data->status == 3
                                            ) {
                                                if (
                                                    $customize[
                                                        'unpaidFacture'
                                                    ] == true
                                                ) {
                                                    $items = json_decode(
                                                        $data->items
                                                    );
                                                    $remise = intval(
                                                        $data->remise
                                                    );

                                                    $n_items = count($items);
                                                    for (
                                                        $i = 0;
                                                        $n_items > $i;
                                                        $i++
                                                    ) {
                                                        $price_m['UP'][
                                                            $x
                                                        ] += intval(
                                                            $items[$i]->price *
                                                                $items[$i]
                                                                    ->quantity
                                                        );
                                                    }
                                                    $price_m['UP'][$x] =
                                                        $price_m['UP'][$x] -
                                                        $remise;
                                                    $tva_cost =
                                                        ($price_m['UP'][$x] *
                                                            $tva) /
                                                        100;

                                                    $TotalUnpaidThisYear[$x] +=
                                                        $price_m['UP'][$x] +
                                                        $tva_cost;
                                                }
                                            }
                                        }
                                    }

                                    $data = [
                                        $NumberOfSales,
                                        $m,
                                        $TotalUnpaidThisYear,
                                        'tva' => $tva,
                                        'year' => $year,
                                        'b_email' => $b_email,
                                        'b_phone' => $b_phone,
                                        'ice' => $ice,
                                        'if' => $if,
                                        'tp' => $tp,
                                        'sector' => $sector,
                                        'customize' => $customize,
                                    ];
                                    $pdfgenerate = PDF::loadView(
                                        'desky/models/reports/sales',
                                        [
                                            'infos' => $customize,
                                            'data' => $data,
                                        ],
                                        ['enable_remote' => true]
                                    )->setPaper('A4', 'portrait');

                                    return $pdfgenerate->download(
                                        'rapport annuel (' .
                                            $request->year .
                                            ').pdf'
                                    );
                                } else {
                                    return response()->json(
                                        [
                                            'error' =>
                                                'باقتك لاتسمح لك بهذه الميزة يمكنك مشاهدة <a href="/tarifs">الباقات</a>',
                                        ],
                                        402
                                    );
                                }
                            } else {
                                return response()->json(
                                    ['error' => 'Bad Request'],
                                    402
                                );
                            }
                        }
                        // Do somthing
                    }
                } else {
                    // Do somthing
                }
            } else {
                return response()->json(
                    ['error' => 'باقتك لاتسمح لك باستخدام هذه الميزة'],
                    402
                );
            }
        } else {
            return response()->json(['bad request'], 402);
        }
    }
    public function UserStatistiquesVentesAnnuel(Request $request)
    {
        if (isset($request->year) && is_numeric($request->year)) {
            if (isset($request->json)) {
                $year = $request->year;

                $datas = DB::table('desky_user_factures')
                    ->select(['status', 'items', 'remise', 'created_at'])
                    ->whereYear('created_at', 'LIKE', '%' . $year . '%')
                    // ->whereMonth('created_at', 'LIKE', '%'.$month.'%')
                    ->where('email', Auth::user()->email)
                    ->orderby('created_at', 'desc')
                    ->get();
                // Months Viriables
                for ($i = 1; $i <= 12; $i++) {
                    $m[$i] = 0;
                    $price_m['CD'][$i] = 0;
                }
                $userdbs = desky_db::where('email', Auth::user()->email)->get([
                    'tva',
                ]);
                foreach ($userdbs as $tva);
                $tva = intval($tva->tva);

                foreach ($datas as $data) {
                    $date_m = date('m', strtotime($data->created_at));
                    for ($x = 1; $x <= 12; $x++) {
                        if (
                            ($date_m == "$x" && $data->status == 4) ||
                            ($data->status == 5 && $date_m == "$x")
                        ) {
                            $items = json_decode($data->items);
                            $remise = intval($data->remise);

                            $n_items = count($items);
                            for ($i = 0; $n_items > $i; $i++) {
                                $price_m['CD'][$x] += intval(
                                    $items[$i]->price * $items[$i]->quantity
                                );
                            }
                            $price_m['CD'][$x] = $price_m['CD'][$x] - $remise;
                            $tva_cost = ($price_m['CD'][$x] * $tva) / 100;

                            $m[$x] += $price_m['CD'][$x] + $tva_cost;
                        }
                    }
                }
                return response()->json($m, 200);
            } else {
                // Do somthing
            }
        } else {
            // Do somthing
        }
    }
    public function CasDeFacturation(Request $request)
    {
        if (isset($request->year) && is_numeric($request->year)) {
            if (isset($request->json)) {
                $status = [];

                //////////
                for ($i = 0; $i <= 7; $i++) {
                    $s[$i] = 0;
                }
                //////////

                $year = $request->year;
                $datas = DB::table('desky_user_factures')
                    ->select(['status'])
                    ->whereYear('created_at', 'LIKE', '%' . $year . '%')
                    // ->whereMonth('created_at', 'LIKE', '%'.$month.'%')
                    ->where('email', Auth::user()->email)
                    ->orderby('created_at', 'desc')
                    ->get();
                foreach ($datas as $data) {
                    for ($x = 0; $x <= 7; $x++) {
                        if ($data->status == $x) {
                            $s[$x] += 1;
                        }
                    }
                }

                $responseAr = [
                    $s[0],
                    $s[1],
                    $s[2],
                    $s[3],
                    $s[4],
                    $s[5],
                    $s[6],
                    $s[7],
                ];
                return response()->json($responseAr, 200);
            } else {
                // do
            }
        } else {
            //do
        }
    }
    public function TurnoverLast5years(Request $request)
    {
        $PaymentSystemController = new PaymentSystemController();
        $CheckSubscriptions = $PaymentSystemController->CheckSubscriptions();
        $Bipack = $CheckSubscriptions['BigPack'];
        $datajson = file_get_contents('database/data.json');
        $jsondata = json_decode($datajson, true);
        if (isset($jsondata['_2147845']['packs'][$Bipack])) {
            if (
                in_array(
                    'SA',
                    $jsondata['_2147845']['packs'][$Bipack]['properties']
                )
            ) {
                $dateNow = date('Y');
                $oldDate = $dateNow - 4;
                $infos = [];
                $userdbs = desky_db::where('email', Auth::user()->email)->get([
                    'tva',
                ]);
                foreach ($userdbs as $tva);
                $tva = intval($tva->tva);

                for ($y = $oldDate; $y <= $dateNow; $y++) {
                    $datas = DB::table('desky_user_factures')
                        ->select(['status', 'items', 'remise', 'created_at'])
                        ->whereYear('created_at', 'LIKE', '%' . $y . '%')
                        // ->whereMonth('created_at', 'LIKE', '%'.$month.'%')
                        ->where('email', Auth::user()->email)
                        ->orderby('created_at', 'desc')
                        ->get();
                    $sales[$y] = count($datas);

                    $price_m = 0;

                    foreach ($datas as $data) {
                        if ($data->status == 4 || $data->status == 5) {
                            $items = json_decode($data->items);
                            $remise = intval($data->remise);

                            $n_items = count($items);
                            for ($i = 0; $n_items > $i; $i++) {
                                $price_m += intval(
                                    $items[$i]->price * $items[$i]->quantity
                                );
                            }
                            $price_m = $price_m - $remise;
                            $tva_cost = ($price_m * $tva) / 100;
                            $Cal = $price_m + $tva_cost;
                            $infos[$y] = [
                                'Chiffre_Daffire' => $Cal,
                                'ventes' => $sales[$y],
                                'revenu_ht' => $price_m,
                                'tva' => $tva_cost,
                            ];
                        }
                    }
                }
                if ($request->json) {
                    return response([$infos, 'tva' => $tva . '%'], 200);
                } elseif ($request->print) {
                    $PaymentSystemController = new PaymentSystemController();
                    $CheckSubscriptions = $PaymentSystemController->CheckSubscriptions();
                    $Bipack = $CheckSubscriptions['BigPack'];
                    $datajson = file_get_contents('database/data.json');
                    $jsondata = json_decode($datajson, true);
                    if (isset($jsondata['_2147845']['packs'][$Bipack])) {
                        if (
                            in_array(
                                'CDD5DA',
                                $jsondata['_2147845']['packs'][$Bipack][
                                    'properties'
                                ]
                            )
                        ) {
                            $userdbs = desky_db::where(
                                'email',
                                Auth::user()->email
                            )->get([
                                'tva',
                                'b_email',
                                'b_phone',
                                'ice',
                                'if',
                                'tp',
                                'sector',
                            ]);

                            foreach ($userdbs as $userdb);
                            $sector = $jsondata['sector_fr'][$userdb->sector];

                            $data = [
                                'tva' => $userdb->tva,
                                'b_email' => $userdb->b_email,
                                'b_phone' => $userdb->b_phone,
                                'ice' => $userdb->ice,
                                'if' => $userdb->if,
                                'tp' => $userdb->tp,
                                'sector' => $sector,
                            ];
                            $pdfgenerate = PDF::loadView(
                                'desky/models/reports/TurnoverLast5years',
                                ['infos' => $infos, 'data' => $data],
                                ['enable_remote' => true]
                            )->setPaper('A4', 'portrait');

                            return $pdfgenerate->download(
                                "Chiffre d'affaires des 5 dernières années (" .
                                    $request->year .
                                    ').pdf'
                            );
                        } else {
                            return response()->json(
                                [
                                    'باقتك لاتسمح لك باستخدام هذه الميزة يمكنك مشاهدة <a href="/tarifs',
                                ],
                                402
                            );
                        }
                    } else {
                        return response()->json(
                            [
                                'يجب أن تشترك بباقة يمكنك مشاهدة <a href="/tarifs',
                            ],
                            402
                        );
                    }
                } else {
                    return response()->json(['error' => 'bad Request'], 402);
                }
            } else {
                return response()->json(
                    ['يجب أن تشترك بباقة يمكنك مشاهدة <a href="/tarifs'],
                    402
                );
            }
        } else {
            return response()->json(['error' => 'bad Request'], 402);
        }
    }
    public function InmpotInfos(Request $request)
    {
        $PaymentSystemController = new PaymentSystemController();
        $CheckSubscriptions = $PaymentSystemController->CheckSubscriptions();
        $Bipack = $CheckSubscriptions['BigPack'];
        $datajson = file_get_contents('database/data.json');
        $jsondata = json_decode($datajson, true);
        if (isset($jsondata['_2147845']['packs'][$Bipack])) {
            if (
                in_array(
                    'IFT',
                    $jsondata['_2147845']['packs'][$Bipack]['properties']
                )
            ) {
                if (isset($request->year)) {
                    $y = $request->year;
                } else {
                    $y = date('Y');
                }

                $infos = [];
                $userdbs = desky_db::where('email', Auth::user()->email)->get([
                    'tva',
                ]);
                foreach ($userdbs as $tva);
                $tva = intval($tva->tva);

                $datas = DB::table('desky_user_factures')
                    ->select(['status', 'items', 'remise', 'created_at'])
                    ->whereYear('created_at', 'LIKE', '%' . $y . '%')
                    // ->whereMonth('created_at', 'LIKE', '%'.$month.'%')
                    ->where('email', Auth::user()->email)
                    ->orderby('created_at', 'desc')
                    ->get();

                $price_m[1] = 0;
                $price_m[2] = 0;
                $price_m[3] = 0;
                $price_m[4] = 0;
                $Trimestriel_1_CD = 0;
                $Trimestriel_2_CD = 0;
                $Trimestriel_3_CD = 0;
                $Trimestriel_4_CD = 0;
                // Tva Cost
                $Trimestriel_1_TAV = 0;
                $Trimestriel_2_TAV = 0;
                $Trimestriel_3_TAV = 0;
                $Trimestriel_4_TAV = 0;

                foreach ($datas as $data) {
                    if ($data->status == 4 || $data->status == 5) {
                        $dateData = date("m", strtotime($data->created_at));
                        if (
                            $dateData == 1 ||
                            $dateData == 2 ||
                            $dateData== 3
                        ) {
                            $items = json_decode($data->items);
                            $remise = intval($data->remise);

                            $n_items = count($items);
                            for ($i = 0; $n_items > $i; $i++) {
                                $price_m[1] += intval(
                                    $items[$i]->price * $items[$i]->quantity
                                );
                            }
                            $price_m[1] = $price_m[1] - $remise;
                            $tva_cost = ($price_m[1] * $tva) / 100;
                            $Cal = $price_m[1] + $tva_cost;
                            $Trimestriel_1_CD = $Cal;
                            $Trimestriel_1_TAV = $tva_cost;
                        } elseif (
                            $dateData == 4 ||
                            $dateData == 5 ||
                            $dateData == 6
                        ) {
                            $items = json_decode($data->items);
                            $remise = intval($data->remise);

                            $n_items = count($items);
                            for ($i = 0; $n_items > $i; $i++) {
                                $price_m[2] += intval(
                                    $items[$i]->price * $items[$i]->quantity
                                );
                            }
                            $price_m[2] = $price_m[2] - $remise;
                            $tva_cost = ($price_m[2] * $tva) / 100;
                            $Cal = $price_m[2] + $tva_cost;
                            $Trimestriel_2_CD = $Cal;
                            $Trimestriel_2_TAV = $tva_cost;
                        } elseif (
                            $dateData == 7 ||
                            $dateData == 8 ||
                            $dateData == 9
                        ) {
                            $items = json_decode($data->items);
                            $remise = intval($data->remise);

                            $n_items = count($items);
                            for ($i = 0; $n_items > $i; $i++) {
                                $price_m[3] += intval(
                                    $items[$i]->price * $items[$i]->quantity
                                );
                            }
                            $price_m[3] = $price_m[3] - $remise;
                            $tva_cost = ($price_m[3] * $tva) / 100;
                            $Cal = $price_m[3] + $tva_cost;
                            $Trimestriel_3_CD = $Cal;
                            $Trimestriel_3_TAV = $tva_cost;
                        } elseif (
                            $dateData == 10 ||
                            $dateData == 11 ||
                            $dateData == 12
                        ) {
                            $items = json_decode($data->items);
                            $remise = intval($data->remise);

                            $n_items = count($items);
                            for ($i = 0; $n_items > $i; $i++) {
                                $price_m[4] += intval(
                                    $items[$i]->price * $items[$i]->quantity
                                );
                            }
                            $price_m[4] = $price_m[4] - $remise;
                            $tva_cost = ($price_m[4] * $tva) / 100;
                            $Cal = $price_m[4] + $tva_cost;
                            $Trimestriel_4_CD = $Cal;
                            $Trimestriel_4_TAV = $tva_cost;
                        }
                    }
                }
                $data = [
                    'Trimestriel_1_CD' => $Trimestriel_1_CD,
                    'Trimestriel_2_CD' => $Trimestriel_2_CD,
                    'Trimestriel_3_CD' => $Trimestriel_3_CD,
                    'Trimestriel_4_CD' => $Trimestriel_4_CD,
                    'Trimestriel_1_TAV' => $Trimestriel_1_TAV,
                    'Trimestriel_2_TAV' => $Trimestriel_2_TAV,
                    'Trimestriel_3_TAV' => $Trimestriel_3_TAV,
                    'Trimestriel_4_TAV' => $Trimestriel_4_TAV,
                    'TVA' => $tva,
                ];
                return response()->json($data, 200);
            }else {

                return response()->json(['error' => 'باقتك لاتسمح لك بهذه الميزة يمكنك مشاهدة <a href="/tarifs">الباقات</a>', ], 402);
                }
        }else {

            return response()->json(['error' => 'bad request', ], 402);
            }
    }
}
