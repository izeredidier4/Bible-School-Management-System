<!-- View to display all answers -->
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-md-3 col-lg-2">
        <div class="card">
                  <div class="card-header">Navigation</div>
                  <div class="card-body">
                    <ul class="nav flex-column">
                      <li class="nav-item">
                        <a class="nav-link" href="{{-- route('admin.dashboard') --}}">Dashboard</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{-- route('admin.users.index') --}}">Users</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{-- route('admin.students.index') --}}">Students</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{-- route('admin.teachers.index') --}}">Teachers</a>
                      </li>
                      
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.classes.index') }}">Classes</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{-- route('admin.grades.index') --}}">Make Grades report</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-9 col-lg-9">
                <div class="card">
                <h1>Answers</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Child</th>
                            <th>Quiz</th>
                            <th>Question</th>
                            <th>User Answer</th>
                            <th>Is Correct</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($answers as $answer)
                            <tr>
                                <td>{{ $answer->child->name }}</td>
                                <td>{{ $answer->quiz->title }}</td>
                                <td>{{ $answer->question->question_text }}</td>
                                <td>{{ $answer->user_answer }}</td>
                                <td>{{ $answer->is_correct ? 'Yes' : 'No' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
@endsection
