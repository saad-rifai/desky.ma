<?php

namespace App\Http\Controllers;

use App\list_credit_card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class ListCreditCardController extends Controller
{
    public function UserCardInfo(Request $request)
    {
        $infos = list_credit_card::all()->where("email", Auth::user()->email);
        $count  = $infos->count();
        $arrayinfos = [];
        for($i=0; $i < $count; $i++){
            $hash_card_holder_name = $infos[$i]->card_holder_name;
            $hash_card_number = $infos[$i]->card_number;
            $hash_card_end_month = $infos[$i]->card_end_month;
            $hash_card_end_year = $infos[$i]->card_end_year;
            try {
                $card_number = Crypt::decryptString($hash_card_number);
                $card_holder_name = Crypt::decryptString($hash_card_holder_name);
                $card_end_month = Crypt::decryptString($hash_card_end_month);
                $card_end_year = Crypt::decryptString($hash_card_end_year);
                $card_number_hideen = substr($card_number,0,2).'## #### #### '.substr($card_number,-4);
                 $arrayinfos[$i] = array('card_number' => $card_number_hideen, 'card_holder_name' => $card_holder_name, 'card_end_month'=> $card_end_month, 'card_end_year'=> $card_end_year);

                //
                //echo $card_holder_name.'<br>';

            } catch (DecryptException $e) {

            }
        }
        return response()->json([$arrayinfos], 200);


       /* foreach($infos as $info){
        $hash_card_holder_name = $info->card_holder_name;
        $hash_card_number = $info->card_number;
        $hash_card_end_month = $info->card_end_month;
        $hash_card_end_year = $info->card_end_year;
        $arrayinfos = array();
        try {
            $card_number = Crypt::decryptString($hash_card_number);
            $card_holder_name = Crypt::decryptString($hash_card_holder_name);
            $card_end_month = Crypt::decryptString($hash_card_end_month);
            $card_end_year = Crypt::decryptString($hash_card_end_year);
            $card_number_hideen = substr($card_number,0,2).'## #### #### '.substr($card_number,-4);
            //array('card_number' => $card_number_hideen, 'card_holder_name' => $card_holder_name, 'card_end_month'=> $card_end_month, 'card_end_year'=> $card_end_year)

            //return response()->json([$arrayinfos], 200);


        } catch (DecryptException $e) {

        }
        $arrayinfos[$i] = $i;
        $i++;
    }*/
      //  $card_holder_name = Crypt::decrypt("eyJpdiI6IkJ5Q2o5bnpwRENYSXpWTWFsQWF5Qmc9PSIsInZhbHVlIjoiMWd2d1hMN00xNk9HeDh4NlVXb1Z1cTM0K003aUdGZU92OGNsZDk1enRZcz0iLCJtYWMiOiI4ZGRjYzljZWI3NDRhMmZlOTY2ZWI4ZmQ4MDZmODgwNTc0Yjc1YmM1MjlhNjE0YWViMWNjZTQwOWQ2MDZlNzhkIn0", 100);
      //print_r($arrayinfos);
    }

}
