<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPrivacy extends Model
{
    protected $table = 'user_privacy';

    protected $fillable = ['email', 'UID', 'public_account', 'public_devis', 'public_facture', 'token_share'];
}
