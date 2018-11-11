<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
    	'name',
    	'father_name',
    	'mother_name',
    	'present_address',
    	'permanent_address',
    	'personal_phone',
    	'father_phone',
    	'mother_phone',
    	'class',
    	'section',
    	'group',
    	'institute',
    	'dob',
    	'blood_group',
    	'shift',
    	'photo'
    ];

    public function class() {
    	return $this->belongsTo('App\Classes');
    }

    public function section() {
    	return $this->belongsTo('App\Section');
    }

    public function fees() {
    	return $this->belongsToMany('App\Fees');
    }
}
