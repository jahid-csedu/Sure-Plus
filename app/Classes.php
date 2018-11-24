<?php

namespace SurePlus;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    //
    protected $fillable = [
    	'name',
    	'class',
    	'description'
    ];

    public function students() {
    	return $this->hasMany('SurePlus\Student');
    }

    public function sections() {
    	return $this->belongsToMany('SurePlus\Section');
    }

    public function exams() {
        return $this->hasMany('SurePlus\Exam');
    }
}
