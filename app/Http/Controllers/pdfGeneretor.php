<?php

namespace App\Http\Controllers;

use App\desky_db;
use Dompdf\Dompdf;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use PDF;
use App\desky_user_devis;
use App\desky_user_clients;
use Illuminate\Support\Facades\Auth;

class pdfGeneretor extends Controller
{
   public function __construct()
   {
      $this->middleware('auth');
   }
   public function devis(Request $request)
   {
      $OID = $request->OID;
      $UID = $request->UID;
      if (is_numeric($OID) && is_numeric($UID)) {
         $db_deskys = desky_db::all()->where("email", Auth::user()->email);
         $devis = desky_user_devis::all()->where('OID', $OID);
         if (count($devis) > 0) {
            if ($UID == Auth::user()->id) {
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

               /*          for (var i = 0; i < articels; i++) {
            var pricearticle = parseFloat(0 + this.devis[i].price);
            var qty = parseFloat(0 + this.devis[i].quantity);
            this.subtotal += pricearticle * qty;
          }*/

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
               $subtotal_with_remise = $subtotal-120;
               $tva_cost = ($subtotal_with_remise*$tva/100);
               $TotalFinal = ($subtotal_with_remise+$tva_cost);
               $c_infos = desky_user_clients::all()->where("c_email", $c_email)->where("from", Auth::user()->email);
               foreach($c_infos as $c_info);
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
                  'CID' => $c_info->CID

               ];
               return PDF::loadView('desky/models/devis/'.$model_devis_infos['url'],array('enable_remote' => true), $data)->setPaper('A4', 'portrait')->stream('DEVIS-'.$OID.'.pdf');

               //echo $itemsArray[0]->price;
            } else {
               return abort(404);
            }
         } else {
            return abort(404);
         }
      } else {
         return abort(404);
      }

      //return public_path().'/models/sample.blade.php';
      //$pdf = PDF::loadView('desky.models.sample');
      //return $pdf->download('docume4snt45.pdf');

   }
}
