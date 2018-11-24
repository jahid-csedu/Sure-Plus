<?php

namespace SurePlus;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    //
    protected $fillable = [
    	'description',
    	'debit',
    	'credit',
    	'date'
    ];
}
