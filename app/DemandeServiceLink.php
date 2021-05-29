<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DemandeServiceLink extends Model
{
    protected $fillable = [

       'OID', 'user_email', 'service'
    ];
}
