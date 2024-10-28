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
                    <a class="nav-link" href="{{ route('admin.home') }}">Dashboard</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{-- route('classes.courses',['class_id'=>$class->id]) --}}">Courses</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.classes.index') }}">Classes</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{-- route('admin.grades.index') --}}">Grades</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-9 col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Class: {{ $class->name }}</h5>
                </div>
                <div class="card-body">
                    <p>{{ $class->description }}</p>
                    <!-- Add more class-related information here -->
                </div>
            </div>

            <h1 class="mb-4">Courses</h1>
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#createCourseModal">
              <i style="color:blue" class="fas fa-plus"></i> New Course
            </button>
            <div class="modal fade" id="createCourseModal" tabindex="-1" role="dialog" aria-labelledby="createCourseModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="createCourseModalLabel">Create Course </h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                      </div>
                  <div class="modal-body">
                    <!-- Add the create course form here -->
                    <form method="POST" action="{{ route('admin.courses.store') }}">
                      @csrf

                      <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
                        @if ($errors->has('title'))
                        <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                    @endif 
                      </div>
                      <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Enter description"></textarea>
                        @if ($errors->has('description'))
                        <div class="alert alert-danger">{{ $errors->first('description') }}</div>
                    @endif 
                      </div>
                      <div class="form-group row">
                        <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                        <div class="col-md-6">
                            <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required autocomplete="date">

                            @if ($errors->has('date'))
                            <div class="alert alert-danger">{{ $errors->first('date') }}</div>
                        @endif 
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="teacher" class="col-md-4 col-form-label text-md-right">{{ __('Teacher') }}</label>

                        <div class="col-md-6">
                            <select id="teacher" class="form-control @error('teacher') is-invalid @enderror" name="teacher_id" required>
                                @foreach ($teachers as $teacher)
                                    <option name="teacher_id" value="{{ $teacher->id }}" {{ old('teacher') == $teacher->id ? 'selected' : '' }}>{{ $teacher->id }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('teacher_id'))
                            <div class="alert alert-danger">{{ $errors->first('teacher_id') }}</div>
                        @endif 
                        </div>
                    </div>
                      <button type="submit" class="btn btn-primary"> Create Course</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <br>
            </div>
        </div>
    </div>
</div>
@endsection
