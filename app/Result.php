<?php

namespace SurePlus;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    //
    protected $table = 'results';
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
    	'exam_id',
    	'student_id',
    	'marks',
    ];

    public function student() {
    	return $this->belongsTo('SurePlus\Student');
    }

    public function exam() {
    	return $this->belongsTo('SurePlus\Exam');
    }
}
