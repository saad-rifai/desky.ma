<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyCart extends Model
{
    protected $fillable = ['OID', 'email', 'UID', 'cookie_id', 'P_ID', 'PK_ID', 'type', 'status'];
}
