<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $primaryKey = 'OID';

    protected $fillable = ['OID', 'Account_number', 'title', 'sector', 'activite', 'description', 'place', 'budget', 'time', 'files','keywords', 'status'];
   protected $hidden = ['message'];
    public function user()
    {
        return $this->belongsTo(User::class, 'Account_number');
    }
    public function Contracts()
    {
        return $this->belongsTo(User::class, 'OID');
    }
    public function Offers()
    {
        return $this->hasMany(Offers::class, 'OID');
    }
}
