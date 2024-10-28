<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Classe;
use App\Models\ClassEnrollment;
use App\Models\Course;
use App\Models\Report;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class ClassController extends Controller
{
    public function index()

    {

        $classes = Classe::with('enrollments.child')->get();
        $teachers = Teacher::all();
        return view('classes.classes', compact('classes', 'teachers'));
    }

    public function dashboard($class_id)
    {
       // $reports = Report::whereHas('course', function ($query) use ($class_id) {
         //   $query->where('class_id', $class_id);
        //})->get();
        $children = Child::all();
        $courses = Course::where('class_id', $class_id)->get();
        $class = Classe::findOrFail($class_id);
        $teachers = Teacher::all();
        $enrollments = ClassEnrollment::with('child')->where('class_id', $class_id)->get();

        //$enrolledChildrenArray = json_decode($enrolledChildren, true);


        return view('classes.dashboard', compact('class', 'courses', 'teachers','children','enrollments'));
    }

    /**
     * Summary of destroy
     * @param \App\Models\Classe $class
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Classe $class)
    {
        // Check if the user is authorized to delete classes
        dd('Deleting class');

        // Now, delete the class
        $class->delete();

        return redirect()->route('admin.classes.index')->with([
            'success' => 'Class deleted successfully',
            'toast' => true, // add a toast flag
        ]);
    }

    public function enroll(Request $request, $classId)
    {
        // Validate the form data
        $parentId = $request->input('child_id');

        $class = Classe::findOrFail($classId);
        $class->children()->attach($parentId);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Enrolled successfully');
    }

    public function showCourses($id)
    {

        $class = Classe::findOrFail($id);
        $courses = Course::all();
        $teachers = Teacher::all();

        return view('classes.dashboard', compact('class', 'courses', 'teachers'));
    }

    public function store(Request $request)
    {
        // Validate the input fields
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'teacher' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        // Check if the user is authorized to add classes
        

        // Create a new instance of the Class model
        $class = new Classe;
        $class->name = $validatedData['name'];
        $class->description = $validatedData['description'];
        $class->teacher_id = $validatedData['teacher'];
        $class->start_date = $validatedData['start_date'];
        $class->end_date = $validatedData['end_date'];

        // Save the new class to the database
        $class->save();

        // Redirect the user to the classes index page or any other appropriate page
        return redirect()->route('admin.classes.index')->with([
            'success' => 'Class created successfully',
            'toast' => true, // add a toast flag
        ]);
    }

    public function add(Request $request)
    {
        // Validate the input fields
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'date' => 'required|date',
            'teacher_id' => 
                'required',
            'class_id' => 'required|exists:classes,id',
        ]);

        // Check if the user is authorized to add courses
        

        // Create a new course instance
        $course = new Course();
        $course->title = $validatedData['title'];
        $course->description = $validatedData['description'];
        $course->date = $validatedData['date'];
        $course->teacher_id = $validatedData['teacher_id'];
        $course->class_id = $validatedData['class_id'];
        $course->save();

        return redirect()->route('classes.dashboard', ['class_id' => $validatedData['class_id']])
            ->with([
                'success' => 'Course created successfully',
                'toast' => true, // add a toast flag
            ]);
    }
}
