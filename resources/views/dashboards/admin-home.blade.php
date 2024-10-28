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
              <a class="nav-link" href="{{ route('admin.home') }}">
                <i class="fas fa-tachometer-alt"></i> <!-- Font Awesome icon for Dashboard -->
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.users.index') }}">
                <i class="fas fa-users"></i> <!-- Font Awesome icon for Users -->
                Users
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.students.index') }}">
                <i class="fas fa-graduation-cap"></i> <!-- Font Awesome icon for Students -->
                Students
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.teachers.index') }}">
                <i class="fas fa-chalkboard-teacher"></i> <!-- Font Awesome icon for Teachers -->
                Teachers
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.classes.index') }}">
                <i class="fas fa-chalkboard"></i> <!-- Font Awesome icon for Classes -->
                Classes
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{-- route('admin.grades.index') --}}">
                <i class="fas fa-star"></i> <!-- Font Awesome icon for Grades -->
                Grades
              </a>
            </li>
   
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-9 col-lg-9">
      <div class="card">
        <div class="card-header">Welcome back, {{ auth()->user()->name }}!</div>
        <div class="card-body">
          <h5 class="card-title">Overview</h5>
          <p class="card-text">Here are some quick stats:</p>
          <div class="row">
            <div class="col-md-4">
              <div class="card bg-primary text-white mb-3">
                <div class="card-body">
                  <h5 class="card-title"><i class="fas fa-user-graduate"></i> Total Students</h5>
                  <p class="card-text">{{ $totalStudents }}</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card bg-success text-white mb-3">
                <div class="card-body">
                  <h5 class="card-title"><i class="fas fa-chalkboard-teacher"></i> Total Teachers</h5>
                  <p class="card-text">{{ $totalTeachers }}</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card bg-warning text-white mb-3">
                <div class="card-body">
                  <h5 class="card-title"><i class="fas fa-book"></i> Total Courses</h5>
                  <p class="card-text">{{ $totalCourses }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
           
          </div>
          </div>
          </div>
          </div>
          </div>
          @endsection
          
          
          
          
          
          