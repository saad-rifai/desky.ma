<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = ['OID', 'Account_number', 'title', 'sector', 'activite', 'description', 'place', 'budget', 'time', 'files', 'status'];
   protected $hidden = ['message'];
    public function user()
    {
        return $this->belongsTo(User::class, 'Account_number');
    }
}
