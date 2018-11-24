<?php

namespace SurePlus\Http\Controllers;

use Illuminate\Http\Request;
use SurePlus\Student;
use SurePlus\Employee;
use SurePlus\Classes;
use SurePlus\Section;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalStudent = Student::count();
        $totalEmployees = Employee::count();
        $totalClasses = Classes::count();
        $totalSections = Section::count();
        return view('home', ['student'=>$totalStudent, 'employee'=>$totalEmployees, 'class'=>$totalClasses, 'section'=>$totalSections]);
    }
}
