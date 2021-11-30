<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chat_system extends Model
{
    protected $fillable = ['type', 'OID','from', 'to', 'message', 'status'];
}
