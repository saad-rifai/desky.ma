<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orders_contracts extends Model
{
    protected $fillable = ['OID', 'order_owner', 'self_contracter', 'price', 'time', 'status', 'canceled_at'];
    public function Orders()
    {
        return $this->hasMany(Orders::class, 'OID');
    }
}
