<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
    protected $fillable = ['OID', 'email', 'c_email', 'c_name', 'c_type', 'c_phone', 'c_ice', 'items', 'p_method', 'p_condition', 'status'];
}
