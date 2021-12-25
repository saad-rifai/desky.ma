<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account_limits extends Model
{
    protected $fillable  =  ['Number_of_orders_per_month', 'Number_of_offers_per_month', 'Account_number', 'Number_of_Employees_per_order'];
    public function user()
    {
        return $this->belongsTo(User::class, 'Account_number');
    }
}
