<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreationSocite extends Model
{
    protected $fillable = ['OID', 'fullname', 'email', 'phonenumb', 'company', 'countrey', 'city', 'message', 'status'];

}
