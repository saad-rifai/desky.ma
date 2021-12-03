<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserReport extends Model
{
   protected $fillable =  ['claimant', 'defendant', 'about', 'category', 'description', 'from_url', 'status'];
}
