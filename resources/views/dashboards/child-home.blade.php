@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        .fa-user::before {
            content: "\f007";
        }
    </style>
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-3 col-lg-2">
      <div class="card">
        <div class="card-header">Navigation</div>
        <div class="card-body">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="{{-- route('child.dashboard') --}}">
                <i class="bi bi-speedometer2"></i>

                Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{-- route('child.courses.index') --}}">
                <i class="bi bi-book"></i>

                My Courses</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{-- route('child.assignments.index') --}}">
                <i class="bi bi-journal-check"></i>
                My Assignments</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{-- route('child.grades.index') --}}">
                <i class="bi bi-bar-chart"></i>

                My Grades</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-9 col-lg-10">
      <div class="card">
        <div class="card-header">Welcome back, {{ auth()->user()->name }}!</div>
        <div class="card-body">
          <h5 class="card-title">My Courses</h5>
          <p class="card-text">Here are the courses you're currently enrolled in:</p>
        </div>
      </div> <br>
      <div class="container py-5">
        <h1 class="mb-4">Available Classes</h1>
        <div class="row">
            @foreach($classes as $class)
                <div class="col-lg-4 col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="card-title">{{ $class->name }}</h4>
                            <p class="card-text">{{ $class->description }}</p>
                            <p class="card-text">Teacher: {{ $class->teacher->name }}</p>
                            <p class="card-text">Start Date: {{ $class->start_date }}</p>
                            <p class="card-text">End Date: {{ $class->end_date }}</p>
                            @if(Auth::user()->role == 'Child' && $class->children && !$class->children->contains(Auth::user()))
                            <form action="{{ route('classes.enroll',$class->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Enroll</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

                 
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
