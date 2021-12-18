<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account_limits extends Model
{
    protected $fillable  =  ['Number_of_orders_per_month', 'Number_of_offers_per_month', 'Account_number'];
    public function user()
    {
        return $this->belongsTo(User::class, 'Account_number');
    }
}
