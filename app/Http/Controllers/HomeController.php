<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Classe;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function adminHome()
    {
        $totalStudents = Child::count();
       $totalTeachers = Teacher::count();
        $totalCourses = Course::count();
        ///$recentActivity = []; // Retrieve the recent activity data here from your database
        
        return view('dashboards.admin-home',compact('totalCourses','totalTeachers','totalStudents'));
    }
    public function addminHome()
    {
        return view('dashboards.admin-home');
    }
    public function teacherHome()
    {
        return view('dashboards.teacher-home');
    }
    public function parentHome()
    {
        $totalClasses = Classe::count();
        $totalCourses = Course::count();
        // Get the authenticated parent user
    $parent = auth()->user();

    // Count the number of children assigned to the parent
    $totalChildren = $parent->children->count();


        return view('dashboards.parent-home',compact('totalClasses','totalCourses','totalChildren'));
    }
    public function childHome()
    {
      $courses = Course::all();
      $classes = Classe::all();
        return view('dashboards.child-home',compact('courses','classes'));
    }
}
