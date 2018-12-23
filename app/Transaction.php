<?php

namespace SurePlus;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable = [
    	'id',
    	'date',
    	'description',
    	'debit',
    	'credit'
    ];
}
