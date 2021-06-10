<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFeedback extends Model
{
    protected $fillable = ['email', 'UID', 'ip_addr', 'USER_CLIENT', 'rating', 'feedback'];
}
