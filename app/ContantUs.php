<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContantUs extends Model
{
    protected $fillable = ['fname', 'lname', 'email', 'category',  'subject', 'message', 'phone','ip_addr', 'USER_AGENT', 'Auth_email'];

}
