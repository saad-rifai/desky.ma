<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeskyUserFacture extends Model
{
    protected $fillable = ['OID', 'email', 'CID', 'items', 'remise', 'p_method', 'p_condition', 'status', 'notes', 'token_share'];

}
