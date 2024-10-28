@extends('layouts.app')

@section('content')

<script>
  // Check if there is a success message and toast flag in the session
  if ("{{ session('success') }}") {
      if ("{{ session('toast') }}") {
          // Show the success message as a SweetAlert toast
          Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: "{{ session('success') }}",
              showConfirmButton: false,
              timer: 3000,
              toast: true,
              customClass: {
                  popup: 'bg-white',
                  title: 'fs-6',
                  container: 'fs-7'
              }
          });
      } else {
          // Show the success message as a regular alert
          alert("{{ session('success') }}");
      }
  }
</script>


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
              <a class="nav-link" href="{{ route('teacher.courses.index') }}">Courses</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('teacher.quizzes.index') }}">Quizzes</a>
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
                    <div class="card-header">{{ __('Courses') }}</div>

                    <div class="card-body">
                       
                        <table class="table">
                            <thead>
                                <tr>
                                   
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($courses as $course)
    <tr>
      
      <td><a href="{{ route('teacher.materials.show',['course_id' => $course->id]) }}">{{ $course->title }}</a></td>
      <td>{{ $course->description }}</td>

        <td>
            <button type="button" class="btn btn" data-bs-toggle="modal" data-bs-target="#editCourseModal{{ $course->id }}">
              <i style="color:blue" class="fas fa-edit"></i>

            </button>
           
            <div class="modal fade" id="editCourseModal{{ $course->id }}" tabindex="-1" role="dialog" aria-labelledby="editCourseModal{{ $course->id }}" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="editCourseModal{{ $course->id }}">Create Course </h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          
                      </div>
                  <div class="modal-body">
                    <!-- Add the create course form here -->
                    <form method="POST" action="{{ route('admin.courses.update', $course->id) }}">
                      @csrf
                      @method('PUT')
                      <div class="modal-body">
                          <div class="form-group">
                              <label for="title">Title</label>
                               <input type="text" class="form-control"  value="{{ old('title', $course->title) }}"  name="title" placeholder="Enter title">
                          </div>
                          <div class="form-group">
                              <label for="description">Description</label>
                              <textarea class="form-control" id="description{{ $course->id }}" name="description" placeholder="Enter description">{{ old('description', $course->description) }}</textarea>
                            </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-primary">Update Course</button>
                      </div>
                  </form>
                  </div>
                </div>
              </div>
            </div>
          
        </div>
        
       

           
            <form action="{{ route('admin.courses.destroy',$course->id) }}" method="POST" style="display: inline-block">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn" onclick="return confirm('{{ __('Are you sure you want to delete this course?') }}')"> <i style="color:red" class="fas fa-trash-alt"></i>
              </button>
          </form>
        </td>
        <td>
          <!-- Add attendance button -->
          <a href="{{ route('teacher.attendance.create', ['course_id' => $course->id]) }}" class="btn btn-outline-primary">
              <i style="color: blue" class="fas fa-check"></i> Take Attendance
          </a>
      </td>
    </tr>
@endforeach


                            </tbody>
                        </table>

                        <div class="container">
                         
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
                                              @foreach ($teachers as $teachers)
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
                          
                      </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

    
@endsection
