<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRating extends Model
{
    protected $fillable = ['for','from','text','rating','order_id'];
        
    
}
