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
                      <a class="nav-link" href="{{ route('admin.home') }}">
                        <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{-- route('classes.courses',['class_id'=>$class->id]) --}}">
                        <i class="fas fa-book mr-2"></i>Courses
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('admin.classes.index') }}">
                        <i class="fas fa-chalkboard mr-2"></i>Classes
                      </a>
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
            <div class="card">
                <div class="card-header">
                    <h1 class="mb-4">Courses</h1>
                </div>
                <div class="card-body">
                    @if ($courses->count() > 0)
                        <div class="row">
                            @foreach ($courses as $course)
                                <div class="col-md-4">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <a href="{{ route('teacher.materials.show', ['class_id' => $class->id, 'course_id' => $course->id]) }}
                                                " style="font-size: 30px;" class="card-title">{{ $course->title }}</a>
                                            <p class="card-text">{{ $course->description }}</p>
                                            <p class="card-text">Date: {{ $course->date }}</p>
                                    
                                            <button style="margin-left: 200px; margin-top:-70px;" type="button" class="btn btn" data-bs-toggle="modal" data-bs-target="#editClassModal{{ $class->id }}">
                                                <i style="color:blue" class="fas fa-edit"></i>
                                  
                                              </button>
                                              <form action="{{ route('admin.courses.destroy',$course->id) }}" method="POST" style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button style=" margin-top:-70px" type="submit" class="btn btn" onclick="return confirm('{{ __('Are you sure you want to delete this class?') }}')"> <i style="color:red" class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                            
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#attendanceModal">
                                                Take Attendance
                                            </button>
                            
                                            <div class="modal fade" id="attendanceModal" tabindex="-1" role="dialog" aria-labelledby="attendanceModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="attendanceModalLabel">Take Attendance</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Your attendance form goes here -->
                                                            <form action="{{ route('child.attendance.store', ['class_id' => $class->id]) }}" method="POST">
                                                                @csrf
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Date</th>
                                                                            <th>Child Name</th>
                                                                            <th>Status</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($children as $child)
                                                                            <tr>
                                                                                <td>
                                                                                    <input type="date" name="date[]" class="form-control @error('date') is-invalid @enderror" 
                                                                                    value="{{  date('Y-m-d') }}" required>
                                                                                                                                                             </td>
                                                                                <td>{{ $child->name }}
                                                                                    <input type="hidden" name="child_id[]" value="{{ $child->id }}">
                                                                                </td>
                                                                                <td>
                                                                                    <select name="status[]" class="form-control" required>
                                                                                        <option value="present">Present</option>
                                                                                        <option value="absent">Absent</option>
                                                                                        <option value="sick">Sick</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                            </form>
                                                        </div>
                                                        <!-- ... Any other modal footer content you may want ... -->
                                                    </div>
                                                </div>
                                            </div>
                                      
                                        </div>
                                    </div>
                                </div>
                              
                                
                            @endforeach
                        </div>
                        
                        
                    @else
                        <p>No courses found for this class.</p>
                    @endif
                </div>
            </div>
            <br>
            
            <button class="btn btn-outline-primary" data-toggle="modal" data-target="#createCourseModal"><i style="color:blue" class="fas fa-plus"></i> New Course</button>

                    
                </div>
                    <div>
                    
                    <div class="modal fade" id="createCourseModal" tabindex="-1" role="dialog" aria-labelledby="createCourseModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createCourseModalLabel">Create Course</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Add the create course form here -->
                                    <form action="{{ route('admin.courses.add', ['id' => $class->id]) }}" method="POST">
                                        @csrf
                    
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
                                        </div>
                    
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" id="description" name="description" placeholder="Enter description" required></textarea>
                                        </div>
                    
                                        <div class="form-group">
                                            <label for="date">Date</label>
                                            <input type="date" class="form-control" id="date" name="date" required>
                                        </div>
                    
                                        <div class="form-group">
                                            <label for="teacher">Teacher</label>
                                            <select id="teacher" class="form-control" name="teacher_id" required>
                                                @foreach ($teachers as $teacher)
                                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                    
                                        <input type="hidden" name="class_id" value="{{ $class->id }}">
                    
                                        <button type="submit" class="btn btn-primary">Create Course</button>
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
@endsection
