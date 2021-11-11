<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AeAccount extends Model
{
    protected $fillabels = ['Account_number', 'cin', 'ae_number', 'cin_date_expiration', 'ae_join_date', 'sector', 'activite', 'job_title', 'files', 'status', 'message'];
    public function user()
    {
        return $this->belongsTo(User::class, 'Account_number');
    }
}
