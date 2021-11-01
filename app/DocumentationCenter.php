<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class DocumentationCenter extends Model
{
    protected $fillable = ['Account_number', 'file_type', 'document_id', 'expiration_date', 'status', 'files', 'message'];
}
