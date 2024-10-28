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
                            <a class="nav-link" href="{{ route('parent.home') }}">
                              <span class="fa fa-home mr-3"></span>Dashboard</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="{{ route('parent.children.index') }}">
                                <span class="fa fa-child mr-3"></span>My Children
                              </a>
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
          <div class="row">
            <div class="col-md-4">
              <div class="card bg-primary text-white mb-3">
                <div class="card-body">
                  <h5 class="card-title"> Classes</h5>
                  <p class="card-text">{{ $totalClasses }}</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card bg-success text-white mb-3">
                <div class="card-body">
                  <h5 class="card-title">Courses</h5>
                      <p class="card-text">{{ $totalCourses }}</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card bg-warning text-white mb-3">
                <div class="card-body">
                  <h5 class="card-title">Children</h5>
                <p class="card-text">{{ $totalChildren }}</p>
                </div>
              </div>
            </div>
          </div>
          
      </div>
    </div>
  </div>
</div>
@endsection
