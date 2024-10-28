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
              <a class="nav-link" href="{{-- route('teacher.dashboard') --}}">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.classes.index') }}">Classes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('teacher.materials.index') }}">Course Materials</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{-- route('teacher.assignments.index') --}}">Assignments</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{-- route('teacher.grades.index') --}}">Grades</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-9 col-lg-10">
      <div class="card">
        <div class="card-header">Welcome back, {{ auth()->user()->name }}!</div>
        <div class="card-body">
          <h5 class="card-title">Overview</h5>
          <p class="card-text">Here are some quick stats:</p>
          <div class="row">
            <div class="col-md-4">
              <div class="card bg-primary text-white mb-3">
                <div class="card-body">
                  <h5 class="card-title">Total Students</h5>
                  <p class="card-text">{{-- $totalStudents --}}</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card bg-warning text-white mb-3">
                <div class="card-body">
                  <h5 class="card-title">Total Courses</h5>
                  <p class="card-text">{{-- $totalCourses --}}</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card bg-success text-white mb-3">
                <div class="card-body">
                  <h5 class="card-title">Total Assignments</h5>
                  <p class="card-text">{{-- $totalAssignments --}}</p>
                </div>
              </div>
            </div>
          </div>
          <h5 class="card-title">Recent Activity</h5>
          <div class="list-group">
                {{-- @foreach($recentActivity as $activity) --}}
            <a href="{{-- $activity->link --}}" class="list-group-item list-group-item-action">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{-- $activity->title --}}</h5>
                <small>{{-- $activity->created_at->diffForHumans() --}}</small>
              </div>
              <p class="mb-1">{{-- $activity->description --}}</p>
              <small>{{-- $activity->user->name --}}</small>
            </a>
         {{--   @endforeach--}}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
