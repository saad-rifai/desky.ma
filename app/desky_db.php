<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class desky_db extends Model
{
protected $fillable = ['email','b_email', 'b_phone', 'slogon', 'logo', 'description', 'compte_bank_name', 'compte_bank_rib', 'compte_bank_username', 'ice', 'if', 'tp', 'siteweb', 'tva', 'cni', 'brandcolor','model_facture', 'model_devis', 'sector', 'adresse'];







}
