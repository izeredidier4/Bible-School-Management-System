<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class CourseController extends Controller
{
  
    public function index()
    {
        $courses = Course::all();
        return view('admin.courses.courses', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
       // dd($request);
       $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'date' => 'required|date',
        'teacher_id' => [
            'required',
            Rule::exists('users', 'id')->where(function ($query) {
                $query->where('role', ['Teacher', 'Admin']);
            }),
        ],
    ]);


    $course = new Course();
    $course->title = $validatedData['title'];
    $course->description = $validatedData['description'];
    $course->date = $validatedData['date'];
    $course->teacher_id = $validatedData['teacher_id'];
    $course->save();

        return redirect()->route('admin.courses.index')->with([
            'success' => 'Course created successfully',
            'toast' => true, // add a toast flag
        ]); 
    }


    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('admin.courses.editcourse', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            //'price' => 'required|numeric',
        ]);

        $course->title = $validatedData['title'];
        $course->description = $validatedData['description'];

       // $course->price = $request->input('price');
        $course->save();

        return redirect()->route('admin.courses.index')->with([
            'success' => 'Course updated successfully',
            'toast' => true, // add a toast flag
        ]);
    }
   

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('admin.courses.index')->with([
            'success' => 'Course deleted successfully',
            'toast' => true, // add a toast flag
        ]);
    }

    public function showMaterials($id, $slug)
{
    // Retrieve the course from the database using the ID
    $course = Course::findOrFail($id);

    // Pass the course to the view
    return view('courses.materials', compact('course'));
}


}


