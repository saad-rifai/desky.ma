<?php

namespace App\Http\Controllers;

use App\desky_db;
use Dompdf\Dompdf;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use PDF;
use App\desky_user_devis;
use App\desky_user_clients;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class pdfGeneretor extends Controller
{

   public function devis(Request $request)
   {
      if (Auth::check()) {
         if (isset($request->OID) && isset($request->UID) && is_numeric($request->OID) && is_numeric($request->UID) && !isset($request->token_share)) {
            if ($request->UID == Auth::user()->id) {
               $OID = $request->OID;
               $db_deskys =  Cache::remember('user_desky_infos_' . Auth::user()->id, 60 * 24 * 15, function () {
                  return desky_db::all()->where("email", Auth::user()->email);
               });
               $devis =  Cache::remember('desky_user_devis' . Auth::user()->id . 'oid_' . $OID, 60 * 24 * 15, function () use ($OID) {
                  return DB::table('desky_user_devis')
                     ->join('desky_user_clients', 'desky_user_devis.CID', '=', 'desky_user_clients.CID')
                     ->select('desky_user_devis.*', 'desky_user_clients.CID', 'desky_user_clients.from', 'desky_user_clients.c_email', 'desky_user_clients.c_phone', 'desky_user_clients.c_name', 'desky_user_clients.c_type', 'desky_user_clients.c_ice', 'desky_user_clients.notes', 'desky_user_clients.country', 'desky_user_clients.city', 'desky_user_clients.adresse')
                     ->where('OID', $OID)
                     ->get();
               });
               if (count($devis) > 0) {
                  foreach ($devis as $devi);
                  $c_email = $devi->c_email;
                  $c_name = $devi->c_name;
                  $c_type = $devi->c_type;
                  $c_phone = $devi->c_phone;
                  $c_ice = $devi->c_ice;
                  $items = $devi->items;
                  $remise = 0 + $devi->remise;
                  $p_method = $devi->p_method;
                  $p_condition = $devi->p_condition;
                  $status = $devi->status;
                  $created_at = $devi->created_at;
                  $itemsArray = json_decode($items);
                  $subtotal = 0;
                  $article_p = 0;
                  $countItems = count($itemsArray);


                  $data = file_get_contents('database/data.json');
                  $json = json_decode($data, true);
                  if ($devi->p_condition > 0 && $devi->p_condition != null) {
                     $remarqe = $json['condition'][$devi->p_condition];
                  } else {
                     $remarqe = "";
                  }
                  foreach ($db_deskys as $db_desky);
                  $model_devis_infos = $json['devis_template'][$db_desky->model_devis];
                  $subtotal = 0;
                  $tva = $db_desky->tva;
                  for ($i = 0; $i < $countItems; $i++) {
                     $article_p = ($itemsArray[$i]->price * $itemsArray[$i]->quantity);
                     $subtotal  = ($subtotal + $article_p);
                  }
                  $subtotal_with_remise = $subtotal - $remise;
                  $tva_cost = ($subtotal_with_remise * $tva / 100);
                  $TotalFinal = ($subtotal_with_remise + $tva_cost);
                  $c_infos = desky_user_clients::all()->where("c_email", $c_email)->where("from", Auth::user()->email);
                  foreach ($c_infos as $c_info);
                  $data = [
                     'OID' => $request->OID,
                     'UID' => $request->UID,
                     'items' => $itemsArray,
                     'c_email' => $c_email,
                     'c_name' => $c_name,
                     'c_type' => $c_type,
                     'c_phone' => $c_phone,
                     'c_ice' => $c_ice,
                     'p_method' => $p_method,
                     'p_condition' => $p_condition,
                     'status' => $status,
                     'created_at' => $created_at,
                     'slogon' => $db_desky->slogon,
                     'compte_bank_name' => $db_desky->compte_bank_name,
                     'compte_bank_rib' => $db_desky->compte_bank_rib,
                     'compte_bank_username' => $db_desky->compte_bank_username,
                     'ice' => $db_desky->ice,
                     'if' => $db_desky->if,
                     'tp' => $db_desky->tp,
                     'telephone' => $db_desky->b_phone,
                     'siteweb' => $db_desky->siteweb,
                     'b_email' => $db_desky->b_email,
                     'remarque' => $remarqe,
                     'logo' => $db_desky->logo,
                     'tva_percentage' => $db_desky->tva,
                     'tva' => $tva_cost,
                     'subtotal' => $subtotal,
                     'TotalFinal' => $TotalFinal,
                     'brandcolor' => $db_desky->brandcolor,
                     'CID' => $c_info->CID,
                     'remise' => $remise

                  ];
                  return PDF::loadView('desky/models/devis/' . $model_devis_infos['url'], array('enable_remote' => true), $data)->setPaper('A4', 'portrait')->stream('DEVIS-' . $OID . '.pdf');

                  //echo $itemsArray[0]->price;

               } else {
                  return abort(404);
               }
               ////////////////////////////////////////////////////
            } else {
               abort(404);
            }
         } elseif (isset($request->OID) && isset($request->UID) && is_numeric($request->OID) && is_numeric($request->UID) && isset($request->token_share)) {
            $OID = $request->OID;
            $UID = $request->UID;
            $token_share = $request->token_share;
            $privacyCheck = DB::table('user_privacy')->where('UID', $UID)->get(['public_devis', 'email']);

            if ($privacyCheck->count() > 0) {
               foreach ($privacyCheck as $privacy);
               if ($privacy->public_devis == 1) {
                  $db_deskys = desky_db::all()->where("email", $privacy->email);


                  if ($db_deskys->count() > 0) {
                     $devis =  DB::table('desky_user_devis')
                        ->join('desky_user_clients', 'desky_user_devis.CID', '=', 'desky_user_clients.CID')
                        ->select('desky_user_devis.*', 'desky_user_clients.CID', 'desky_user_clients.from', 'desky_user_clients.c_email', 'desky_user_clients.c_phone', 'desky_user_clients.c_name', 'desky_user_clients.c_type', 'desky_user_clients.c_ice', 'desky_user_clients.notes', 'desky_user_clients.country', 'desky_user_clients.city', 'desky_user_clients.adresse')
                        ->where('desky_user_devis.OID', $OID)
                        ->where('desky_user_devis.token_share', $token_share)
                        ->get();


                     if (count($devis) > 0) {
                        foreach ($devis as $devi);
                        $c_email = $devi->c_email;
                        $c_name = $devi->c_name;
                        $c_type = $devi->c_type;
                        $c_phone = $devi->c_phone;
                        $c_ice = $devi->c_ice;
                        $items = $devi->items;
                        $p_method = $devi->p_method;
                        $p_condition = $devi->p_condition;
                        $status = $devi->status;
                        $created_at = $devi->created_at;
                        $itemsArray = json_decode($items);
                        $subtotal = 0;
                        $article_p = 0;
                        $countItems = count($itemsArray);
                        $remise = 0 + $devi->remise;

                        $data = file_get_contents('database/data.json');
                        $json = json_decode($data, true);
                        if ($devi->p_condition > 0 && $devi->p_condition != null) {
                           $remarqe = $json['condition'][$devi->p_condition];
                        } else {
                           $remarqe = "";
                        }
                        foreach ($db_deskys as $db_desky);
                        $model_devis_infos = $json['devis_template'][$db_desky->model_devis];
                        $subtotal = 0;
                        $tva = $db_desky->tva;
                        for ($i = 0; $i < $countItems; $i++) {
                           $article_p = ($itemsArray[$i]->price * $itemsArray[$i]->quantity);
                           $subtotal  = ($subtotal + $article_p);
                        }
                        $subtotal_with_remise = $subtotal - $remise;
                        $tva_cost = ($subtotal_with_remise * $tva / 100);
                        $TotalFinal = ($subtotal_with_remise + $tva_cost);
                        $c_infos = desky_user_clients::all()->where("c_email", $c_email)->where("from", $db_desky->email);
                        foreach ($c_infos as $c_info);
                        $data = [
                           'OID' => $request->OID,
                           'UID' => $request->UID,
                           'items' => $itemsArray,
                           'c_email' => $c_email,
                           'c_name' => $c_name,
                           'c_type' => $c_type,
                           'c_phone' => $c_phone,
                           'c_ice' => $c_ice,
                           'p_method' => $p_method,
                           'p_condition' => $p_condition,
                           'status' => $status,
                           'created_at' => $created_at,
                           'slogon' => $db_desky->slogon,
                           'compte_bank_name' => $db_desky->compte_bank_name,
                           'compte_bank_rib' => $db_desky->compte_bank_rib,
                           'compte_bank_username' => $db_desky->compte_bank_username,
                           'ice' => $db_desky->ice,
                           'if' => $db_desky->if,
                           'tp' => $db_desky->tp,
                           'telephone' => $db_desky->b_phone,
                           'siteweb' => $db_desky->siteweb,
                           'b_email' => $db_desky->b_email,
                           'remarque' => $remarqe,
                           'logo' => $db_desky->logo,
                           'tva_percentage' => $db_desky->tva,
                           'tva' => $tva_cost,
                           'subtotal' => $subtotal,
                           'TotalFinal' => $TotalFinal,
                           'brandcolor' => $db_desky->brandcolor,
                           'CID' => $c_info->CID,
                           'remise' => $remise

                        ];
                        return PDF::loadView('desky/models/devis/' . $model_devis_infos['url'], array('enable_remote' => true), $data)->setPaper('A4', 'portrait')->stream('DEVIS-' . $OID . '.pdf');

                        //echo $itemsArray[0]->price;

                     } else {
                        abort(404);
                     }
                  } else {
                     abort(404);
                  }
               } else {
                  abort(401);
               }
            } else {
               abort(404, 'لايوجد ');
            }
         } else {
            abort(404);
         }
      } else {
         if (isset($request->OID) && isset($request->UID) && is_numeric($request->OID) && is_numeric($request->UID) && isset($request->token_share)) {
            $OID = $request->OID;
            $UID = $request->UID;
            $token_share = $request->token_share;
            $privacyCheck = DB::table('user_privacy')->where('UID', $UID)->get(['public_devis', 'email']);

            if ($privacyCheck->count() > 0) {
               foreach ($privacyCheck as $privacy);
               if ($privacy->public_devis == 1) {
                  $db_deskys = desky_db::all()->where("email", $privacy->email);


                  if ($db_deskys->count() > 0) {
                     $devis =  DB::table('desky_user_devis')
                        ->join('desky_user_clients', 'desky_user_devis.CID', '=', 'desky_user_clients.CID')
                        ->select('desky_user_devis.*', 'desky_user_clients.CID', 'desky_user_clients.from', 'desky_user_clients.c_email', 'desky_user_clients.c_phone', 'desky_user_clients.c_name', 'desky_user_clients.c_type', 'desky_user_clients.c_ice', 'desky_user_clients.notes', 'desky_user_clients.country', 'desky_user_clients.city', 'desky_user_clients.adresse')
                        ->where('desky_user_devis.OID', $OID)
                        ->where('desky_user_devis.token_share', $token_share)
                        ->get();


                     if (count($devis) > 0) {
                        foreach ($devis as $devi);
                        $c_email = $devi->c_email;
                        $c_name = $devi->c_name;
                        $c_type = $devi->c_type;
                        $c_phone = $devi->c_phone;
                        $c_ice = $devi->c_ice;
                        $items = $devi->items;
                        $p_method = $devi->p_method;
                        $p_condition = $devi->p_condition;
                        $status = $devi->status;
                        $created_at = $devi->created_at;
                        $itemsArray = json_decode($items);
                        $subtotal = 0;
                        $article_p = 0;
                        $countItems = count($itemsArray);
                        $remise = 0 + $devi->remise;

                        $data = file_get_contents('database/data.json');
                        $json = json_decode($data, true);
                        if ($devi->p_condition > 0 && $devi->p_condition != null) {
                           $remarqe = $json['condition'][$devi->p_condition];
                        } else {
                           $remarqe = "";
                        }
                        foreach ($db_deskys as $db_desky);
                        $model_devis_infos = $json['devis_template'][$db_desky->model_devis];
                        $subtotal = 0;
                        $tva = $db_desky->tva;
                        for ($i = 0; $i < $countItems; $i++) {
                           $article_p = ($itemsArray[$i]->price * $itemsArray[$i]->quantity);
                           $subtotal  = ($subtotal + $article_p);
                        }
                        $subtotal_with_remise = $subtotal - $remise;
                        $tva_cost = ($subtotal_with_remise * $tva / 100);
                        $TotalFinal = ($subtotal_with_remise + $tva_cost);
                        $c_infos = desky_user_clients::all()->where("c_email", $c_email)->where("from", $db_desky->email);
                        foreach ($c_infos as $c_info);
                        $data = [
                           'OID' => $request->OID,
                           'UID' => $request->UID,
                           'items' => $itemsArray,
                           'c_email' => $c_email,
                           'c_name' => $c_name,
                           'c_type' => $c_type,
                           'c_phone' => $c_phone,
                           'c_ice' => $c_ice,
                           'p_method' => $p_method,
                           'p_condition' => $p_condition,
                           'status' => $status,
                           'created_at' => $created_at,
                           'slogon' => $db_desky->slogon,
                           'compte_bank_name' => $db_desky->compte_bank_name,
                           'compte_bank_rib' => $db_desky->compte_bank_rib,
                           'compte_bank_username' => $db_desky->compte_bank_username,
                           'ice' => $db_desky->ice,
                           'if' => $db_desky->if,
                           'tp' => $db_desky->tp,
                           'telephone' => $db_desky->b_phone,
                           'siteweb' => $db_desky->siteweb,
                           'b_email' => $db_desky->b_email,
                           'remarque' => $remarqe,
                           'logo' => $db_desky->logo,
                           'tva_percentage' => $db_desky->tva,
                           'tva' => $tva_cost,
                           'subtotal' => $subtotal,
                           'TotalFinal' => $TotalFinal,
                           'brandcolor' => $db_desky->brandcolor,
                           'CID' => $c_info->CID,
                           'remise' => $remise

                        ];
                        return PDF::loadView('desky/models/devis/' . $model_devis_infos['url'], array('enable_remote' => true), $data)->setPaper('A4', 'portrait')->stream('DEVIS-' . $OID . '.pdf');

                        //echo $itemsArray[0]->price;

                     } else {
                        abort(404);
                     }
                  } else {
                     abort(404);
                  }
               } else {
                  abort(401);
               }
            } else {
               abort(404, 'لايوجد ');
            }
         } else {
            abort(404);
         }
      }
   }
   public function facture(Request $request)
   {
      if (Auth::check()) {
         if (isset($request->OID) && isset($request->UID) && is_numeric($request->OID) && is_numeric($request->UID) && !isset($request->token_share)) {
            if ($request->UID == Auth::user()->id) {
               $OID = $request->OID;
               $db_deskys =  Cache::remember('user_desky_infos_' . Auth::user()->id, 60 * 24 * 15, function () {
                  return desky_db::all()->where("email", Auth::user()->email);
               });
               $devis =  Cache::remember('desky_user_facture' . Auth::user()->id . 'oid_' . $OID, 60 * 24 * 15, function () use ($OID) {
                  return DB::table('desky_user_factures')
                     ->join('desky_user_clients', 'desky_user_factures.CID', '=', 'desky_user_clients.CID')
                     ->select('desky_user_factures.*', 'desky_user_clients.CID', 'desky_user_clients.from', 'desky_user_clients.c_email', 'desky_user_clients.c_phone', 'desky_user_clients.c_name', 'desky_user_clients.c_type', 'desky_user_clients.c_ice', 'desky_user_clients.notes', 'desky_user_clients.country', 'desky_user_clients.city', 'desky_user_clients.adresse')
                     ->where('OID', $OID)
                     ->get();
               });
               if (count($devis) > 0) {
                  foreach ($devis as $devi);
                  $c_email = $devi->c_email;
                  $c_name = $devi->c_name;
                  $c_type = $devi->c_type;
                  $c_phone = $devi->c_phone;
                  $c_ice = $devi->c_ice;
                  $items = $devi->items;
                  $remise = 0 + $devi->remise;
                  $p_method = $devi->p_method;
                  $p_condition = $devi->p_condition;
                  $status = $devi->status;
                  $created_at = $devi->created_at;
                  $itemsArray = json_decode($items);
                  $subtotal = 0;
                  $article_p = 0;
                  $countItems = count($itemsArray);


                  $data = file_get_contents('database/data.json');
                  $json = json_decode($data, true);
                  if ($devi->p_condition > 0 && $devi->p_condition != null) {
                     $remarqe = $json['condition'][$devi->p_condition];
                  } else {
                     $remarqe = "";
                  }
                  foreach ($db_deskys as $db_desky);
                  $model_facture_infos = $json['facture_template'][$db_desky->model_facture];
                  $subtotal = 0;
                  $tva = $db_desky->tva;
                  for ($i = 0; $i < $countItems; $i++) {
                     $article_p = ($itemsArray[$i]->price * $itemsArray[$i]->quantity);
                     $subtotal  = ($subtotal + $article_p);
                  }
                  $subtotal_with_remise = $subtotal - $remise;
                  $tva_cost = ($subtotal_with_remise * $tva / 100);
                  $TotalFinal = ($subtotal_with_remise + $tva_cost);
                  $c_infos = desky_user_clients::all()->where("c_email", $c_email)->where("from", Auth::user()->email);
                  foreach ($c_infos as $c_info);
                  $data = [
                     'OID' => $request->OID,
                     'UID' => $request->UID,
                     'items' => $itemsArray,
                     'c_email' => $c_email,
                     'c_name' => $c_name,
                     'c_type' => $c_type,
                     'c_phone' => $c_phone,
                     'c_ice' => $c_ice,
                     'p_method' => $p_method,
                     'p_condition' => $p_condition,
                     'status' => $status,
                     'created_at' => $created_at,
                     'slogon' => $db_desky->slogon,
                     'compte_bank_name' => $db_desky->compte_bank_name,
                     'compte_bank_rib' => $db_desky->compte_bank_rib,
                     'compte_bank_username' => $db_desky->compte_bank_username,
                     'ice' => $db_desky->ice,
                     'if' => $db_desky->if,
                     'tp' => $db_desky->tp,
                     'telephone' => $db_desky->b_phone,
                     'siteweb' => $db_desky->siteweb,
                     'b_email' => $db_desky->b_email,
                     'remarque' => $remarqe,
                     'logo' => $db_desky->logo,
                     'tva_percentage' => $db_desky->tva,
                     'tva' => $tva_cost,
                     'subtotal' => $subtotal,
                     'TotalFinal' => $TotalFinal,
                     'brandcolor' => $db_desky->brandcolor,
                     'CID' => $c_info->CID,
                     'remise' => $remise

                  ];
                  return PDF::loadView('desky/models/facture/' . $model_facture_infos['url'], array('enable_remote' => true), $data)->setPaper('A4', 'portrait')->stream('FACTURE-' . $OID . '.pdf');

                  //echo $itemsArray[0]->price;

               } else {
                  return abort(404);
               }
               ////////////////////////////////////////////////////
            } else {
               abort(404);
            }
         } elseif (isset($request->OID) && isset($request->UID) && is_numeric($request->OID) && is_numeric($request->UID) && isset($request->token_share)) {
            $OID = $request->OID;
            $UID = $request->UID;
            $token_share = $request->token_share;
            $privacyCheck = DB::table('user_privacy')->where('UID', $UID)->get(['public_facture', 'email']);

            if ($privacyCheck->count() > 0) {
               foreach ($privacyCheck as $privacy);
               if ($privacy->public_facture == 1) {
                  $db_deskys = desky_db::all()->where("email", $privacy->email);


                  if ($db_deskys->count() > 0) {
                     $devis =  DB::table('desky_user_factures')
                        ->join('desky_user_clients', 'desky_user_factures.CID', '=', 'desky_user_clients.CID')
                        ->select('desky_user_factures.*', 'desky_user_clients.CID', 'desky_user_clients.from', 'desky_user_clients.c_email', 'desky_user_clients.c_phone', 'desky_user_clients.c_name', 'desky_user_clients.c_type', 'desky_user_clients.c_ice', 'desky_user_clients.notes', 'desky_user_clients.country', 'desky_user_clients.city', 'desky_user_clients.adresse')
                        ->where('desky_user_factures.OID', $OID)
                        ->where('desky_user_factures.token_share', $token_share)
                        ->get();


                     if (count($devis) > 0) {
                        foreach ($devis as $devi);
                        $c_email = $devi->c_email;
                        $c_name = $devi->c_name;
                        $c_type = $devi->c_type;
                        $c_phone = $devi->c_phone;
                        $c_ice = $devi->c_ice;
                        $items = $devi->items;
                        $p_method = $devi->p_method;
                        $p_condition = $devi->p_condition;
                        $status = $devi->status;
                        $created_at = $devi->created_at;
                        $itemsArray = json_decode($items);
                        $subtotal = 0;
                        $article_p = 0;
                        $countItems = count($itemsArray);
                        $remise = 0 + $devi->remise;

                        $data = file_get_contents('database/data.json');
                        $json = json_decode($data, true);
                        if ($devi->p_condition > 0 && $devi->p_condition != null) {
                           $remarqe = $json['condition'][$devi->p_condition];
                        } else {
                           $remarqe = "";
                        }
                        foreach ($db_deskys as $db_desky);
                        $model_facture_infos = $json['facture_template'][$db_desky->model_facture];
                        $subtotal = 0;
                        $tva = $db_desky->tva;
                        for ($i = 0; $i < $countItems; $i++) {
                           $article_p = ($itemsArray[$i]->price * $itemsArray[$i]->quantity);
                           $subtotal  = ($subtotal + $article_p);
                        }
                        $subtotal_with_remise = $subtotal - $remise;
                        $tva_cost = ($subtotal_with_remise * $tva / 100);
                        $TotalFinal = ($subtotal_with_remise + $tva_cost);
                        $c_infos = desky_user_clients::all()->where("c_email", $c_email)->where("from", $db_desky->email);
                        foreach ($c_infos as $c_info);
                        $data = [
                           'OID' => $request->OID,
                           'UID' => $request->UID,
                           'items' => $itemsArray,
                           'c_email' => $c_email,
                           'c_name' => $c_name,
                           'c_type' => $c_type,
                           'c_phone' => $c_phone,
                           'c_ice' => $c_ice,
                           'p_method' => $p_method,
                           'p_condition' => $p_condition,
                           'status' => $status,
                           'created_at' => $created_at,
                           'slogon' => $db_desky->slogon,
                           'compte_bank_name' => $db_desky->compte_bank_name,
                           'compte_bank_rib' => $db_desky->compte_bank_rib,
                           'compte_bank_username' => $db_desky->compte_bank_username,
                           'ice' => $db_desky->ice,
                           'if' => $db_desky->if,
                           'tp' => $db_desky->tp,
                           'telephone' => $db_desky->b_phone,
                           'siteweb' => $db_desky->siteweb,
                           'b_email' => $db_desky->b_email,
                           'remarque' => $remarqe,
                           'logo' => $db_desky->logo,
                           'tva_percentage' => $db_desky->tva,
                           'tva' => $tva_cost,
                           'subtotal' => $subtotal,
                           'TotalFinal' => $TotalFinal,
                           'brandcolor' => $db_desky->brandcolor,
                           'CID' => $c_info->CID,
                           'remise' => $remise

                        ];
                        return PDF::loadView('desky/models/facture/' . $model_facture_infos['url'], array('enable_remote' => true), $data)->setPaper('A4', 'portrait')->stream('FACTURE-' . $OID . '.pdf');

                        //echo $itemsArray[0]->price;

                     } else {
                        abort(404);
                     }
                  } else {
                     abort(404);
                  }
               } else {
                  abort(401);
               }
            } else {
               abort(404, 'لايوجد ');
            }
         } else {
            abort(404);
         }
      } else {
         if (isset($request->OID) && isset($request->UID) && is_numeric($request->OID) && is_numeric($request->UID) && isset($request->token_share)) {
            $OID = $request->OID;
            $UID = $request->UID;
            $token_share = $request->token_share;
            $privacyCheck = DB::table('user_privacy')->where('UID', $UID)->get(['public_facture', 'email']);

            if ($privacyCheck->count() > 0) {
               foreach ($privacyCheck as $privacy);
               if ($privacy->public_facture == 1) {
                  $db_deskys = desky_db::all()->where("email", $privacy->email);


                  if ($db_deskys->count() > 0) {
                     $devis =  DB::table('desky_user_factures')
                        ->join('desky_user_clients', 'desky_user_factures.CID', '=', 'desky_user_clients.CID')
                        ->select('desky_user_factures.*', 'desky_user_clients.CID', 'desky_user_clients.from', 'desky_user_clients.c_email', 'desky_user_clients.c_phone', 'desky_user_clients.c_name', 'desky_user_clients.c_type', 'desky_user_clients.c_ice', 'desky_user_clients.notes', 'desky_user_clients.country', 'desky_user_clients.city', 'desky_user_clients.adresse')
                        ->where('desky_user_factures.OID', $OID)
                        ->where('desky_user_factures.token_share', $token_share)
                        ->get();


                     if (count($devis) > 0) {
                        foreach ($devis as $devi);
                        $c_email = $devi->c_email;
                        $c_name = $devi->c_name;
                        $c_type = $devi->c_type;
                        $c_phone = $devi->c_phone;
                        $c_ice = $devi->c_ice;
                        $items = $devi->items;
                        $p_method = $devi->p_method;
                        $p_condition = $devi->p_condition;
                        $status = $devi->status;
                        $created_at = $devi->created_at;
                        $itemsArray = json_decode($items);
                        $subtotal = 0;
                        $article_p = 0;
                        $countItems = count($itemsArray);
                        $remise = 0 + $devi->remise;

                        $data = file_get_contents('database/data.json');
                        $json = json_decode($data, true);
                        if ($devi->p_condition > 0 && $devi->p_condition != null) {
                           $remarqe = $json['condition'][$devi->p_condition];
                        } else {
                           $remarqe = "";
                        }
                        foreach ($db_deskys as $db_desky);
                        $model_facture_infos = $json['facture_template'][$db_desky->model_facture];
                        $subtotal = 0;
                        $tva = $db_desky->tva;
                        for ($i = 0; $i < $countItems; $i++) {
                           $article_p = ($itemsArray[$i]->price * $itemsArray[$i]->quantity);
                           $subtotal  = ($subtotal + $article_p);
                        }
                        $subtotal_with_remise = $subtotal - $remise;
                        $tva_cost = ($subtotal_with_remise * $tva / 100);
                        $TotalFinal = ($subtotal_with_remise + $tva_cost);
                        $c_infos = desky_user_clients::all()->where("c_email", $c_email)->where("from", $db_desky->email);
                        foreach ($c_infos as $c_info);
                        $data = [
                           'OID' => $request->OID,
                           'UID' => $request->UID,
                           'items' => $itemsArray,
                           'c_email' => $c_email,
                           'c_name' => $c_name,
                           'c_type' => $c_type,
                           'c_phone' => $c_phone,
                           'c_ice' => $c_ice,
                           'p_method' => $p_method,
                           'p_condition' => $p_condition,
                           'status' => $status,
                           'created_at' => $created_at,
                           'slogon' => $db_desky->slogon,
                           'compte_bank_name' => $db_desky->compte_bank_name,
                           'compte_bank_rib' => $db_desky->compte_bank_rib,
                           'compte_bank_username' => $db_desky->compte_bank_username,
                           'ice' => $db_desky->ice,
                           'if' => $db_desky->if,
                           'tp' => $db_desky->tp,
                           'telephone' => $db_desky->b_phone,
                           'siteweb' => $db_desky->siteweb,
                           'b_email' => $db_desky->b_email,
                           'remarque' => $remarqe,
                           'logo' => $db_desky->logo,
                           'tva_percentage' => $db_desky->tva,
                           'tva' => $tva_cost,
                           'subtotal' => $subtotal,
                           'TotalFinal' => $TotalFinal,
                           'brandcolor' => $db_desky->brandcolor,
                           'CID' => $c_info->CID,
                           'remise' => $remise

                        ];
                        return PDF::loadView('desky/models/facture/' . $model_facture_infos['url'], array('enable_remote' => true), $data)->setPaper('A4', 'portrait')->stream('FACTURE-' . $OID . '.pdf');

                        //echo $itemsArray[0]->price;

                     } else {
                        abort(404);
                     }
                  } else {
                     abort(404);
                  }
               } else {
                  abort(401);
               }
            } else {
               abort(404, 'لايوجد ');
            }
         } else {
            abort(404);
         }
      }
   }
   public function invoice(){
    header('Content-type: text/html; charset=UTF-8') ;//chrome

    return PDF::loadView('desky/models/recu-print', array('enable_remote' => true))->setPaper('A4', 'portrait')->stream('invoice.pdf');

   }
}
