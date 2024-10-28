<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Image;
use App\Models\Quiz;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class ChildrenController extends Controller
{


    
    public function generateReport($childName, $age, $className, $quizTitle, $grade, $teachersRemarks)
{
    // Define the data to pass to the view
    $gradeData = [
        'child_name' => $childName,
        'age' => $age,
        'class_name' => $className,
        'quiz_title' => $quizTitle,
        'grade' => $grade,
        'teachers_remarks' => $teachersRemarks,
    ];

    // Retrieve the image data from the database
    $images = Image::all();

    // Load the view, passing both gradeData and the image to the view
    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.report_template', compact('gradeData', 'images'));

    // Download the PDF report
    return $pdf->download('report.pdf');
}

    public function submitQuiz(Request $request)
    {
        
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
    
            return redirect()->route('children.quizzes.show')->with([
                'success' => 'Quiz submitted successfully',
                'toast' => true,
            ]);
        }
        
    
    
    
    public function grades($quiz_id)
{
    // Fetch all answers along with their related child and quiz information for the specific quiz
    $answers = Answer::whereHas('quiz', function ($query) use ($quiz_id) {
        $query->where('id', $quiz_id);
    })->with('child', 'quiz')->get();

    // Calculate the overall grades for each child for the specific quiz
    $quizGrades = [];

    foreach ($answers as $answer) {
        $childId = $answer->child_id;

        if (!isset($quizGrades[$childId])) {
            $quizGrades[$childId] = [
                'child_name' => $answer->child->name,
                'quiz_title' => $answer->quiz->title,
                'totalQuestions' => 0,
                'totalCorrect' => 0,
            ];
        }

        $quizGrades[$childId]['totalQuestions']++;
        if ($answer->is_correct) {
            $quizGrades[$childId]['totalCorrect']++;
        }
    }

    // Calculate the percentage for each child and store it in the gradesData array
    $gradesData = [];

    foreach ($quizGrades as $childId => $data) {
        $totalQuestions = $data['totalQuestions'];
        $totalCorrect = $data['totalCorrect'];
        $percentage = ($totalCorrect / $totalQuestions) * 100;

        $gradesData[] = [
            'child_name' => $data['child_name'],
            'grade' => $percentage,
        ];
    }

    return view('classes.courses.quizzes.grades', compact('gradesData'));
}

}
