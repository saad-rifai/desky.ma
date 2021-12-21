<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HelpCenter extends Model
{
    protected $fillable = ['Account_number', 'subject', 'message', 'status'];
}
