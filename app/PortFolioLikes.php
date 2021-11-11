<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UserPortFolio;
class PortFolioLikes extends Model
{
    protected $fillable = [
        'from', 'to'
    ];

    public function portfoliowork()
    {
        return $this->belongsTo(UserPortFolio::class, 'id');
    }
}
