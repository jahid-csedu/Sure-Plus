<?php

namespace App;

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
    	return $this->hasMany('App\Student');
    }

    public function sections() {
    	return $this->belongsToMany('App\Section');
    }

    public function exams() {
        return $this->hasMany('App\Exam');
    }
}
