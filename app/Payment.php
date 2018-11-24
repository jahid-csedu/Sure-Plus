<?php

namespace SurePlus;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $table = 'payment';
    protected $fillable = [
    	'student_id',
    	'type',
    	'month',
    	'year',
    	'description',
    	'amount',
    	'date'
    ];

    public function student() {
    	return $this->belongsTo('SurePlus\Student');
    }
}
