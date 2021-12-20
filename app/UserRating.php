<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class UserRating extends Model
{

    protected $fillable = ['for','from','text','rating','order_id'];
    public function user()
{
    return $this->belongsTo(User::class,'for','id');
}
public function Auther()
{
    return $this->belongsTo(User::class, 'from');
}
}
