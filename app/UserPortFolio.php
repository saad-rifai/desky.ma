<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserPortFolio extends Model
{
    protected $fillable = [
        'Account_number', 'title', 'description', 'activite', 'sector', 'files', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'Account_number');
    }
    public function Likes(){
        return $this->hasMany(PortFolioLikes::class, 'to');
    }
}
