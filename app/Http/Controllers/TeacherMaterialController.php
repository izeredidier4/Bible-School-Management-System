<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Course;
use App\Models\CourseMaterial;
use App\Models\Quiz;
use App\Models\Teacher;
use   App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\CourseProgress;
use Illuminate\Support\Facades\Auth;

class TeacherMaterialController extends Controller
{
    
    
    public function index($course_id)
    {
        $course = Course::findOrFail($course_id);
        return view('classes.materials.create', compact('course'));
    }

    public function store(Request $request, $course_id)
    {

        //dd($request->all());
       
        
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'file' => 'required|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar|max:20196',
            ]);

            $course = Course::findOrFail($course_id);

            $material = new CourseMaterial();
            $material->title = $request->title;
            $material->description = $request->description;
            $material->file_path = $request->file('file')->store('materials', 'public'); // Store the file in the 'public' disk under the 'materials' directory
            $material->course_id = $course->id;
        
            $material->save();
        
            return redirect()->route('teacher.materials.show', ['course_id' => $course->id])->with([
                'success' => 'Material uploaded successfully',
                'toast' => true,
            ]);
    }

    
    // ...
    
    public function material($course_id)
    {
        
        $course = Course::findOrFail($course_id);
        $materials = CourseMaterial::where('course_id', $course_id)->get();
    
       // $totalLessons = ($course->lessons) ? $course->lessons->count() : 0;
       // $completedLessons = ($course->lessons) ? $course->lessons->where('completed', true)->count() : 0;
    
        //$completionPercentage = ($totalLessons > 0) ? ($completedLessons / $totalLessons) * 100 : 0;
    
        return view('classes.materials.create', compact('course', 'materials', 'report',));
    }
    

    public function dashboard($course_id)
    {
        $user_id = Auth::id();
        $progress = CourseProgress::where('user_id', $user_id)
            ->where('course_id', $course_id)
            ->firstOrFail();

        $completedLessons = $progress->completed_lessons;
        $totalLessons = $progress->total_lessons;
        $completionPercentage = round($completedLessons / $totalLessons * 100);

        $courses = Course::all();

        return view('teacher.courses.materials.create', [
            'completedLessons' => $completedLessons,
            'totalLessons' => $totalLessons,
            'completionPercentage' => $completionPercentage,
            'courses'=> $courses,
        ], compact('courses'));
    }

    public function courses($course_id)
    {
        $materials = CourseMaterial::where('course_id', $course_id)->get();

        //$completionPercentage = round($completedLessons / $totalLessons * 100);

       // $courses = Course::all();
        // Fetch the course details based on the provided $course_id
        $course = Course::find($course_id);

        if (!$course) {
            // If the course with the given ID is not found, handle accordingly (e.g., redirect or show an error message).
            return redirect()->back()->with('error', 'Course not found.');
        }

        // Pass the $course variable to the view and display the course details and materials.
        return view('classes.materials.create', [
           
        ], compact('course','materials'));
    }
}
