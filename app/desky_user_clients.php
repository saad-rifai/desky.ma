<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class desky_user_clients extends Model
{
    protected $fillable = ['CID', 'from', 'c_email', 'c_phone', 'c_name', 'c_type', 'notes', 'files', 'country', 'city', 'adresse'];

}
