<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    protected $fillable = ['from', 'to', 'message', 'status', 'notifybyemail', 'email_status'];
    protected $hidden = ['email_status', 'notifybyemail'];
    public function user()
    {
        return $this->belongsTo(User::class, 'Account_number');
    }
}
