<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    protected $fillable = ['OID', 'Account_number', 'description', 'price', 'time', 'status', 'rating', 'comment'];

    public function user()
    {
        return $this->belongsTo(User::class, 'Account_number');
    }
}
