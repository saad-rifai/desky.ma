<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilesToRemove extends Model
{
    protected $fillable = ['filepath', 'date_to_remove'];
}
