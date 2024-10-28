<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Course;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class QuestionController extends Controller
{
public function index($quiz_id)
{
    $quiz = Quiz::findOrFail($quiz_id);
    $questions = Question::all();
    $child = Child::all();

    return view('classes.courses.quizzes.questions', compact('quiz','questions','child'));
}
public function create()
    {
        return view('teacher.materials.createq');
    }

    public function store(Request $request)
    {
        
        


        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'question_text' => 'required|string',
            'question_type' => 'required|in:multiple_choice,true_false,fill_in_the_blank,short_answer',
            'options' => 'required_if:question_type,multiple_choice|array',
            'correct_answer' => 'required|string',
        ]);

        $question = new Question();
        $question = new Question;
    $question->quiz_id = $request->input('quiz_id');
    $question->question_text = $request->input('question_text');
    $question->question_type = $request->input('question_type');

    // Convert the options to a JSON string before saving
    if ($request->has('options') && is_array($request->input('options'))) {
        $options = $request->input('options');
        $question->options = json_encode($options);
    }

        $question->correct_answer = $request->input('correct_answer');
        $question->save();

        $quiz_id = $request->input('quiz_id');

        return Redirect::route('teacher.questions.index', ['quiz_id' => $quiz_id])->with([
            'success' => 'Question added successfully',
            'toast' => true,
        ]);
        
    

        /*
        $validatedData = $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'question_text' => 'required',
            'question_type' => 'required|in:multiple_choice,true_false,fill_in_the_blank,short_answer',
            'options' => 'nullable|array',
            'correct_answer' => 'required',
        ]);
    
        $question = new Question();
        $question->quiz_id = $validatedData['quiz_id'];
        $question->question_text = $validatedData['question_text'];
        $question->question_type = $validatedData['question_type'];
        $question->options = is_array($validatedData['options']) ? serialize($validatedData['options']) : $validatedData['options'];
        $question->correct_answer = $validatedData['correct_answer'];
        $question->save();
    
        return redirect()->route('teacher.questions.index', $validatedData['quiz_id'])->with([
            'success' => 'Question created successfully',
            'toast' => true,
        ]);  */
    }
    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'question' => 'required|string|max:255',
            'type' => 'required|in:multiple_choice,true_false,fill_in_the_blank,short_answer',
            'options' => 'nullable|array',
            'answer' => 'required|string|max:255',
            'points' => 'required|integer|min:0',
        ]);
    
        $question = Question::findOrFail($id);
        $question->question = $validatedData['question'];
        $question->type = $validatedData['type'];
        $question->options = is_array($validatedData['options']) ? serialize($validatedData['options']) : $validatedData['options'];
        $question->answer = $validatedData['answer'];
        $question->points = $validatedData['points'];
        $question->save();
    
        return redirect()->route('teacher.questions.index', $question->quiz_id)->with([
            'success' => 'Question updated successfully',
            'toast' => true,
        ]);
    }
    
    

    public function edit(Question $question)
    {
        return view('questions.edit', compact('question'));
    }



    public function destroy(Question $question)
    {
        $question->delete();

        return redirect()->route('teacher.questions.index',$question->quiz_id)->with([
            'success' => 'Question deleted successfully',
            'toast' => true,
        ]);
    }   
        public function show($quiz_id)
    {
        $quiz = Quiz::findOrFail($quiz_id);
        $questions = $quiz->questions;
        return view('teacher.courses.materials.ask', compact('questions', 'quiz'));
    }
    

}
