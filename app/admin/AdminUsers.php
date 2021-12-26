<?php

namespace App\admin;

use Illuminate\Database\Eloquent\Model;

class AdminUsers extends Model
{
    protected $fillable = ['Account_number', 'status', 'type ', 'supervisor '];
    public function user()
    {
        return $this->belongsTo(User::class, 'Account_number');
    }
}
