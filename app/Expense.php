<?php

namespace SurePlus;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    //
    protected $fillable = [
        'type',
        'employee_id',
        'month',
        'year',
		'description',
		'amount',
		'date'
    ];
}
