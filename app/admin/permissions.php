<?php

namespace App\admin;

use Illuminate\Database\Eloquent\Model;

class permissions extends Model
{
  protected $primaryKey = 'type';

  protected $fillable = ['type','permissions'];

}
