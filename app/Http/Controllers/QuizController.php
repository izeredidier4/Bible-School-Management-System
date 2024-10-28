<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuizRequest;
use App\Models\Classe;
use App\Models\Course;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Validator;

/**
 * Summary of QuizController
 */
class QuizController extends Controller
{

    public function course()
{
    $courses = Course::all();
  
    return view('classes.courses.quizzes.quiz', compact('courses'));
}


   public function index($course_id)
{
    //$quiz = Quiz::all();
   $courses = Course::findOrFail($course_id);
   $quizzes = $courses->quizzes;
   $class = $courses->class;
    return view('classes.courses.quizzes.quiz', compact('courses','quizzes','class'));
}

    public function create()
    {
    }

    public function store(CreateQuizRequest $request)
    {
        $course = Course::findOrFail($request->input('course_id'));
    
        $quiz = new Quiz;
        $quiz->course_id = $request->input('course_id');
        $quiz->title = $request->input('title');
        $quiz->description = $request->input('description');
        $quiz->type = $request->input('type');
        $quiz->time_limit = $request->input('quiz_time_limit'); // Corrected field name
        $quiz->is_published = $request->has('is_published') ? 1 : 0;
        $quiz->save();
    
        return redirect()->route('teacher.quizzes.index',['course_id'=> $course->id])->with([
            'success' => 'Quiz created successfully',
            'toast' => true, // add a toast flag
        ]);
    }
    

    public function question(Quiz $quiz)
    {
        
        return view('classes.courses.quizzes.questions', compact('quiz'));
    }
    public function update(Request $request, Quiz $quiz)
    {
        
        $validatedData = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required',
            'description' => 'required',
            'type' => 'required',
            'time_limit' => 'nullable|integer|min:1',
            'is_published' => 'nullable|boolean',
        ]);
        
    
        $quiz->course_id =  $validatedData['course_id'];
        $quiz->title = $request->input('title');
        $quiz->description = $request->input('description');
        $quiz->type = $request->input('type');
        $quiz->time_limit = $request->input('time_limit');
        $quiz->is_published = $request->has('is_published') ? 1 : 0;
    
        $quiz->save();
    
        return redirect()->route('teacher.quizzes.index')->with([
            'success' => 'Quiz updated successfully',
            'toast' => true,
        ]);
    }
    


    

    public function destroy($quiz_id)
{
    $quiz = Quiz::findOrFail($quiz_id);
    $quiz->delete();

    return redirect()->route('teacher.quizzes.index', ['course_id' => $quiz->course_id])->with([
        'success' => 'Quiz Deleted Successfully',
        'toast' => true, // add a toast flag
    ]);
}

}
