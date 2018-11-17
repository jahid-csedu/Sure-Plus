<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    //
    protected $table = 'exams';
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
    	'id',
    	'name',
    	'class',
        'section',
    	'subject',
    	'date',
    	'total_marks'
    ];

    public function class() {
    	return $this->belongsTo('App\Classes');
    }

    public function result() {
        return $this->hasMany('App\Result');
    }
}
