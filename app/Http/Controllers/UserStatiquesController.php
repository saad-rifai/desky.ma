<?php

namespace App\Http\Controllers;

use App\desky_db;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\DeskyUserFacture;
class UserStatiquesController extends Controller
{
    public function UserStatistiquesGeneral(Request $request)
    {
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
        $userdbs = desky_db::where('email', Auth::user()->email)->get(['tva']);
        foreach ($userdbs as $tva);
        $tva = intval($tva->tva);
        $price_m = 0;
        $price_y = 0;
        $price_u = 0;
        $TotalUnpaidThisMonth = 0;
        $TotalThisMonth = 0;
        $TotalThisYear = 0;
        foreach ($datas as $data) {
            $date_m = date('m', strtotime($data->created_at));
            $date_y = date('y', strtotime($data->created_at));
            if ($date_y == date('y')) {
                if ($data->status == 4 || $data->status == 5) {
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
        return response()->json(
            [
                'TotalThisMonth' => $TotalThisMonth,
                'TotalThisYear' => $TotalThisYear,
                'TotalUnpaidThisMonth' => $TotalUnpaidThisMonth,
            ],
            200
        );
        //return response()->json([$data]);
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
                }
                $userdbs = desky_db::where('email', Auth::user()->email)->get([
                    'tva',
                ]);
                foreach ($userdbs as $tva);
                $tva = intval($tva->tva);
                $price_m = 0;

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
                                $price_m += intval(
                                    $items[$i]->price * $items[$i]->quantity
                                );
                            }
                            $price_m = $price_m - $remise;
                            $tva_cost = ($price_m * $tva) / 100;

                            $m[$x] += $price_m + $tva_cost;
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
}
