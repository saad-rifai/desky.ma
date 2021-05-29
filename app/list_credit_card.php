<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class list_credit_card extends Model
{
    protected $fillable = [

        'email', 'card_holder_name', 'card_number', 'card_cvv', 'ipadd', 'HTTP_USER_AGENT'
     ];
}
