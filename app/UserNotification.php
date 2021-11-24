<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    protected $fillable = ['from', 'to', 'message', 'status', 'notifybyemail', 'email_status'];
    public function user()
    {
        return $this->belongsTo(User::class, 'Account_number');
    }
}
