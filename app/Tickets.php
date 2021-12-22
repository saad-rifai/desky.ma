<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    protected $fillable = ['Account_number','category', 'subject', 'message', 'status', 'TID'];
}
