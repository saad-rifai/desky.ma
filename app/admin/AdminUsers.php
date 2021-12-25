<?php

namespace App\admin;

use Illuminate\Database\Eloquent\Model;

class AdminUsers extends Model
{
    protected $fillable = ['Account_number', 'status', 'type ', 'supervisor '];
}
