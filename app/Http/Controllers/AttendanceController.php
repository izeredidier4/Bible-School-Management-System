<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Child;
use App\Models\Classe;
use App\Models\Course;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $children = Child::all();
        return view('attendance.index', compact('children'));
    }

    public function store(Request $request, $class_id)
    {

      //  dd($request->all());

        $data = $request->validate([
            'date.*' => 'required|date', // Validate each date field in the array
            'child_id.*' => 'required|exists:children,id', // Validate each child_id field in the array
            'status.*' => 'required|in:present,absent,sick', // Validate each status field in the array
        ]);

        // Loop through the form data to save each attendance record
        foreach ($data['date'] as $index => $date) {
            $child_id = $data['child_id'][$index];
            $status = $data['status'][$index];

            Attendance::create([
                //'class_id' => $class_id,
                'child_id' => $child_id,
                'date' => $date,
                'status' => $status,
            ]);
        }
        return redirect()->route('classes.dashboard', ['class_id' => $class_id])
        ->with('success', 'Attendance taken successfully.')
        ->with('toast', true);

        /*
        $children = Child::all();
        $courses = Course::where('class_id', $class_id)->get();
        $class = Classe::findOrFail($class_id);
        $teachers = User::where('role', 'Teacher')->get();
        $data = $request->validate([
            'child_id' => 'required|exists:children,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent',
        ]);

        Attendance::create($data);

        return redirect()->route('classes.dashboard', ['class_id' => $class->id])
        ->with([
            'success' => 'Attendance taken successfully',
            'toast' => true, // add a toast flag
        ]); */
}

}