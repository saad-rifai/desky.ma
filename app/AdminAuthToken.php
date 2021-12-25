<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminAuthToken extends Model
{
    protected $fillable = ['Account_number', 'ip_adress', 'token', 'last_time_use'];
    public function user()
    {
        return $this->belongsTo(User::class, 'Account_number');
    }
}
