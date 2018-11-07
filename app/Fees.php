<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fees extends Model
{
    //
    protected $fillable = [
    	'student_id',
    	'type',
    	'amount'
    ];

    public function students() {
    	return $this->belongsToMany('App\Student');
    }

    public function feesType() {
    	return $this->belongsTo('App\FeesType');
    }
}
