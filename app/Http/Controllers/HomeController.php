<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Employee;
use App\Classes;
use App\Section;

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
