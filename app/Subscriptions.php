<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriptions extends Model
{
    protected $fillable = ['OID', 'email', 'pr_name', 'PID', 'pack_id', 'point', 'auto_pay', 'type', 'start_at'];
}
