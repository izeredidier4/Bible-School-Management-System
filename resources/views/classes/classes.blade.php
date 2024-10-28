@extends('layouts.app')

@section('content')
<!-- Your other scripts and HTML content here -->

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
        <div class="col-md-5 col-lg-2">
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
                            <h1 class="mb-4">Available Classes</h1>
            <div>
                <button class="btn btn-primary" data-toggle="modal" data-target="#addClassModal">Add Class</button>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#enrolledChildrenModal">
                    List Enrolled Children
                </button>
            </div>
            
                
            <br>
            <div class="row"> 
                @foreach($classes as $class)
                    <div class="col-lg-4 col-md-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <a style="font-size: 30px;" href="#" class="card-title">{{ $class->name }}</a>
                                <p class="card-text">{{ $class->description }}</p>
                                <p class="card-text">Teacher: {{-- $class->teacher->name --}}</p>
                                <p class="card-text">Start Date: {{ --$class->start_date }}</p>
                                <p class="card-text">End Date: {{ $class->end_date }}</p>
                                @if(Auth::user()->role == 'Parent' && !$class->children->contains(Auth::user()->id))
                                <form action="{{ route('classes.enroll', $class->id) }}" method="POST">
                                    @csrf
                                    <!-- Add a hidden input field to capture the child ID -->
                                    <input type="hidden" name="child_id" value="{{ Auth::user()->id }}">
                                    <button type="submit" class="btn btn-primary">Enroll</button>
                                </form>
                            @endif
                                @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Teacher')
                                    <form action="{{-- route('classes.addCourse',$class->id) --}}" method="POST">
                                        @csrf
                                        <!-- Add course related input fields here -->

                                        <a href="{{ route('classes.dashboard', ['class_id' => $class->id]) }}">Go to Dashboard</a>

                                        <button style="margin-left: 100px" type="button" class="btn btn"
                                            data-bs-toggle="modal" data-bs-target="#editClassModal{{ $class->id }}">
                                            <i style="color:blue" class="fas fa-edit"></i>
                                        </button>

                                        <form action="{{ route('admin.classes.destroy', $class->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            @if(Gate::allows('add-class'))
                                            <button type="submit" class="btn btn"
                                                onclick="return confirm('{{ __('Are you sure you want to delete this class?') }}')">
                                                <i style="color:red" class="fas fa-trash-alt"></i>
                                            </button>
                                            @endif
                                        </form>
                                    </form>

                                  
                                    
                                @endif
                                
                            </div>
                            
                        </div>
                        
                    </div>
                   
                
                    <!-- Modal for listing enrolled children -->
                    <div class="modal fade" id="enrolledChildrenModal" tabindex="-1" aria-labelledby="enrolledChildrenModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="enrolledChildrenModalLabel">Enrolled Children</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    
                                    @foreach ($classes as $class)
                                    <h2>Class Name: {{ $class->name }}</h2>
                                    <p>Class Description: {{ $class->description }}</p>
                                    @php
                                    $enrollments = \App\Models\ClassEnrollment::where('class_id', $class->id)->get();
                                @endphp
                                    @if ($class->enrollments->count() > 0)
                                        <h3>Enrolled Children:</h3>
                                        <ul class="list-group">
                                            @foreach ($class->enrollments as $enrollment)
                                                @if ($enrollment->child)
                                                    <li class="list-group-item">{{ $enrollment->child->name }}</li>
                                                @endif
                                                <!-- Add any other child information you want to display -->
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>No children enrolled in this class.</p>
                                    @endif
                                    <hr>
                                @endforeach
                                




                                </div>
                            </div>
                                </div>
                            </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


<!-- Add Class Modal -->
<div class="modal fade" id="addClassModal" tabindex="-1" role="dialog" aria-labelledby="addClassModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClassModalLabel">Add a New Class</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.classes.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Class Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="teacher">Teacher</label>
                        <select name="teacher" class="form-control" required>
                            <!-- Include logic to fetch and populate teachers' options -->
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                            <!-- Add more options dynamically -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" name="start_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input type="date" name="end_date" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach($classes as $class)
<!-- Edit Class Modal -->
<div class="modal fade" id="editClassModal{{ $class->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editClassModalLabel{{ $class->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editClassModalLabel{{ $class->id }}">Edit Class: {{ $class->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{-- route('admin.classes.update',$class->id) --}}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Class Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $class->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" required>{{ $class->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="teacher">Teacher</label>
                        <select name="teacher" class="form-control" required>
                            <!-- Include logic to fetch and populate teachers' options -->
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}"
                                    {{ isset($class) && $class->teacher_id == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->name }}
                                </option>
                            @endforeach
                            <!-- Add more options dynamically -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" name="start_date" class="form-control" value="{{ $class->start_date }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input type="date" name="end_date" class="form-control" value="{{ $class->end_date }}"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Your other modals and scripts here -->
@endsection