<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class desky_user_devis extends Model
{
    protected $fillable = ['OID', 'email', 'CID', 'items', 'remise', 'p_method', 'p_condition', 'status', 'notes'];

}
