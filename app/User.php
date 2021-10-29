<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Account_number', 'username', 'OAuth_ID', 'frist_name', 'last_name', 'phone_number', 'email', 'country', 'city', 'gender', 'type', 'avatar', 'description', 'sector', 'status', 'IP_Address', 'MAC_Address', 'remember_token', 'source', 'password', 'verifiy_token', 'verified_account' ];
    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','verifiy_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
