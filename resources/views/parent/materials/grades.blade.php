@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-lg-2 sidebar">
                    <div class="card">
                        <div class="card-header">Navigation</div>
                        <div class="card-body">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                  <a class="nav-link" href="{{ route('parent.home') }}">
                                    <span class="fa fa-home mr-3"></span>Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('parent.children.index') }}">
                                      <span class="fa fa-child mr-3"></span>My Children
                                    </a>
                                  </li>
                                <li class="nav-item">
                                    
                                
                                    <a class="nav-link" href="  @foreach($quizzes as $quiz)
                                    {{ route('children.grades.show', ['quiz_id' => $quiz->id]) }}
                                    @endforeach ">
                                        <i class="fas fa-graduation-cap mr-3"></i>Grades
                                    </a>
                                </li>
                                
                              </ul>
                              
                        </div>
                    </div>
                </div>
        
        
                    
             <div class="col-md-9 col-lg-9">
                <div class="card"></div>
                <h1>Grades</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Child Name</th>
                            <th>Quiz</th>
                            <th>Grade</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       <!-- ... (previous code) ... -->

@foreach ($gradesData as $gradeData)
<tr>
    <td>{{ $gradeData['child_name'] }}</td>
    <td>{{ $gradeData['quiz_title'] }}</td>
    <td>{{ $gradeData['grade'] }}</td>
    <td>
        <!-- Button to trigger the modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reportModal{{ $gradeData['child_id'] }}">
            Generate Report
        </button>

        <!-- Modal for creating a new Report for the specific child -->
        <div class="modal fade" id="reportModal{{ $gradeData['child_id'] }}" tabindex="-1" aria-labelledby="reportModalLabel{{ $gradeData['child_id'] }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reportModalLabel{{ $gradeData['child_id'] }}">Generate Report</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form to create a new Report -->
                        <div class="modal-body">
                            <!-- Display the report content here -->
                            @include('reports.report_template', $gradeData)

                            <!-- Download Report Button -->
                            <a href="{{ route('generate.report',['childName'=>$gradeData['child_name'],'age'=>$gradeData['age'],'className'=>$gradeData['class_name'],'quizTitle'=>$gradeData['quiz_title'],'grade'=>$gradeData['grade'],'teachersRemarks'=>$gradeData['teachers_remarks']]) }}" class="btn btn-primary" target="_blank">Download Report</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </td>
</tr>
@endforeach

<!-- ... (remaining code) ... -->

                    </tbody>
                </table>
            </div>
        </div>
    </div>
        </div>
    </div>
@endsection

       