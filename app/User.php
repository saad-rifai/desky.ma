<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use App\UserPortFolio;
use App\UserRating;
class User extends Authenticatable
{
    use Notifiable;
    protected $primaryKey = 'Account_number';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Account_number', 'username', 'OAuth_ID', 'frist_name', 'last_name', 'phone_number', 'email', 'country', 'city', 'gender', 'type', 'avatar', 'description', 'sector', 'status', 'IP_Address', 'MAC_Address', 'remember_token', 'source','date_of_birth' ,'password', 'verifiy_token', 'verified_account' ];
    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','verifiy_token', 'OAuth_ID', 'phone_number', 'email', 'gender', 'status', 'IP_Address', 'MAC_Address', 'source','date_of_birth', 'verified_account'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public static function isOnline($Account_number){
        return Cache::has('user-online-'.$Account_number);
    }
    public function AeAccount(){
        return $this->hasOne(AeAccount::class, 'Account_number');
    }
    public function Portfolio()
    {
        return $this->hasMany(UserPortFolio::class, 'Account_number');
    }
    public function Offers()
    {
        return $this->hasMany(Offers::class, 'Account_number');
    }
    public function Orders()
    {
        return $this->hasMany(Orders::class, 'Account_number');
    }
    public function rating()
    {
        return $this->hasMany(UserRating::class,'for');
    }
}
