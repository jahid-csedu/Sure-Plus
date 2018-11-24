<?php

namespace SurePlus;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [
        'id',
    	'name',
    	'present_address',
    	'permanent_address',
    	'phone',
    	'designation',
    	'dob',
    	'blood_group',
    	'photo'
    ];
}
