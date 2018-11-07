<?php

namespace App;

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
    	return $this->belongsToMany('App\Classes');
    }

    public function students() {
    	return $this->hasMany('App\Student');
    }
}
