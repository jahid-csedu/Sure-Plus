<?php

namespace SurePlus;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //
    protected $fillable = [
    	'name',
    	'class',
    	'description',
    	'shift'
    ];

    public function classes() {
    	return $this->belongsToMany('SurePlus\Classes');
    }

    public function students() {
    	return $this->hasMany('SurePlus\Student');
    }
}
