<?php

namespace SurePlus\Http\Controllers;

use Illuminate\Http\Request;
use SurePlus\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function create() {
    	return view('auth.register');
    }
}
