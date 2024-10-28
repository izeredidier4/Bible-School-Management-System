<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Classe;
use App\Models\Course;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function createChild()
{
   $courses = Course::all();
    $children = Child::all(); // Assuming you have a Child model and a children table in your database
    $classes =Classe::all();

    return view('parent.children.create',compact('children','classes','courses'));
}

}
