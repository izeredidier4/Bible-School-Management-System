<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Classe;
use App\Models\Course;
use App\Models\Image;
use Illuminate\Http\Request;
// YourController.php

use App\Models\Quiz;
use App\Models\Answer;


class AnswerController extends Controller
{

public function showQuiz(Quiz $quiz)
{
    return view('quiz', compact('quiz'));
}

public function submitQuiz(Request $request)
{
    dd($request->all());

        // Validate the incoming form data
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'child_id' => 'required|exists:children,id',
            'question_id' => 'required|array',
            'question_id.*' => 'required|exists:questions,id',
            // Add other validation rules as needed for the user_answer field (e.g., 'required' or 'string')
        ]);

        $quiz = Quiz::findOrFail($request->input('quiz_id'));
        $child_id = $request->input('child_id');
        $question_ids = $request->input('question_id');

        // Loop through the questions of the quiz
        foreach ($quiz->questions as $question) {
            $question_id = $question->id;
            // Check if the current question is in the list of submitted question_ids
            if (in_array($question_id, $question_ids)) {
                // Get the user's answer for this question
                $userAnswer = $request->input('question_' . $question_id);

                // Determine correctness status based on the question type
                $isCorrect = false;
                if ($question->question_type === 'multiple_choice') {
                    // Check if the user's answer matches the correct option
                    $isCorrect = $userAnswer === $question->correct_answer;
                } elseif ($question->question_type === 'true_false') {
                    // Check if the user's answer matches the correct answer ('true' or 'false')
                    $isCorrect = $userAnswer === $question->correct_answer;
                } elseif ($question->question_type === 'short_answer' || $question->question_type === 'fill_in_the_blank') {
                    // Check if the user's answer matches the correct answer (case insensitive)
                    $isCorrect = strtolower(trim($userAnswer)) === strtolower(trim($question->correct_answer));
                }

                // Save the user's answer and correctness status in the database
                Answer::create([
                    'user_id' => auth()->user()->id, // Assuming you are using authentication
                    'quiz_id' => $quiz->id,
                    'child_id' => $child_id,
                    'question_id' => $question_id,
                    'user_answer' => $userAnswer,
                    'is_correct' => $isCorrect,
                ]);
            }
        }

        return redirect()->route('teacher.questions.index', ['quiz_id' => $quiz->id])->with([
            'success' => 'Quiz submitted successfully',
            'toast' => true,
        ]);
    
    /*
    $quiz = Quiz::findOrFail($request->input('quiz_id'));

    // Loop through the questions of the quiz
    foreach ($quiz->questions as $question) {
        $userAnswer = $request->input('question_' . $question->id);

        $isCorrect = false;

        if ($question->question_type === 'multiple_choice') {
            // Check if the user's answer matches the correct option index
            $isCorrect = $userAnswer === $question->correct_answer;
        } elseif ($question->question_type === 'true_false') {
            // Check if the user's answer matches the correct answer ('true' or 'false')
            $isCorrect = $userAnswer === $question->correct_answer;
        } elseif ($question->question_type === 'short_answer' || $question->question_type === 'fill_in_the_blank') {
            // Check if the user's answer matches the correct answer (case insensitive)
            $isCorrect = strtolower(trim($userAnswer)) === strtolower(trim($question->correct_answer));
        }

        // Save the user's answer and the correctness status in the database
        Answer::create([
            'user_id' => auth()->user()->id, // Assuming you are using authentication
            'question_id' => $question->id,
            'user_answer' => $userAnswer,
            'is_correct' => $isCorrect,
        ]);
    }

    return redirect()->route('teacher.questions.index', ['quiz_id' => $quiz->id])->with([
        'success' => 'Quiz submitted successfully',
        'toast' => true,
    ]); */
}
public function showResponses($quiz_id)
{
    // Fetch all the answers related to the given quiz along with the child's name
    $quiz = Quiz::findOrFail($quiz_id);
    $answers = Answer::where('quiz_id', $quiz_id)->with('child', 'quiz', 'question')->get();

    return view('classes.courses.quizzes.responses', compact('quiz', 'answers'));
}
   
public function grades()
{

    $class = Classe::all();
    // Fetch all answers along with their related child and quiz information
    $answers = Answer::with('child', 'quiz')->get();

    // Calculate the overall grades for each quiz for each child
    $quizGrades = [];

    foreach ($answers as $answer) {
        $childId = $answer->child_id;
        $quizId = $answer->quiz_id;

        if (!isset($quizGrades[$childId][$quizId])) {
            $quizGrades[$childId][$quizId] = [
                'child_id' => $answer->child_id,
                'child_name' => $answer->child->name,
                'date_of_birth' => $answer->child->dob, // Include the date_of_birth
                'class_name' => optional($answer->child->enrolledClass)->name, // Use optional chaining for class name
                'quiz_title' => $answer->quiz->title,
                'totalQuestions' => 0,
                'totalCorrect' => 0,
            ];
        }

        $quizGrades[$childId][$quizId]['totalQuestions']++;
        if ($answer->is_correct) {
            $quizGrades[$childId][$quizId]['totalCorrect']++;
        }
    }

    // Calculate the percentage for each quiz for each child and store it in the gradesData array
    $gradesData = [];

    foreach ($quizGrades as $childId => $quizData) {
        foreach ($quizData as $quizId => $data) {
            $totalQuestions = $data['totalQuestions'];
            $totalCorrect = $data['totalCorrect'];
            $percentage = ($totalCorrect / $totalQuestions) * 100;

            $dateOfBirth = $data['date_of_birth'];
            $age = $dateOfBirth ? \Carbon\Carbon::parse($dateOfBirth)->age : 'N/A';

            $gradesData[] = [
                'child_id' => $data['child_id'],
                'child_name' => $data['child_name'],
                'age' => $age,
                'class_name' => $data['class_name'],
                'quiz_title' => $data['quiz_title'],
                'grade' => $percentage,
            ];
        }
    }

    $children = Child::all();
    $classes = Classe::all();

    $courses = Course::all();
    $images = Image::all();

    foreach ($gradesData as &$data) {
        $grade = $data['grade'];

        if ($grade > 70) {
            $remarks = 'The child '.$data['child_name'].' can continue to other courses.';
        } else {
            $remarks = 'The child '.$data['child_name'].' is advised to re-take the courses.';
        }

        $data['teachers_remarks'] = $remarks;
    }


    return view('classes.courses.quizzes.grades', compact('gradesData', 'children', 'classes', 'courses','images'));
}
}