<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentSystem extends Model
{
    protected $fillable = [

        'OID', 'buyer_email', 'transaction_id', 'status', 'amount', 'object', 'id_addr', 'code'
     ];
}
