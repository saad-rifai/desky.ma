<?php

namespace App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class desky_user_clients extends Model
{
    protected $fillable = ['CID', 'from', 'c_email', 'c_phone', 'c_name', 'c_type', 'notes', 'files', 'country', 'city', 'adresse'];

   /* public static function exportClientsByDate($from,$to){

        $Cleants = desky_user_clients::all()->where('from', Auth::user()->email)->whereBetween('created_at', [$from,$to]);
        return $Cleants;
    }*/
}
