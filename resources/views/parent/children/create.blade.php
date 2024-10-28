@extends('layouts.app')

@section('content')

<script>
    // Check if there is a success message and toast flag in the session
    @if (session('success'))
        @if (session('toast'))
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
        @else
            // Show the success message as a regular alert
            alert("{{ session('success') }}");
        @endif
    @endif
</script>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
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
                  
                  <li class="nav-item">
                    
                    <a class="nav-link" href="@foreach ($courses as $course)
                    {{ route('children.materials.show',['course_id' => $course->id]) }}
                    @endforeach">
                    <i class="fas fa-book mr-3"></i>Courses</a>
                   
                  </li>
              
                </ul>
                  
              </div>
            </div>
          </div>
        <!-- Children List -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Added Children</div>
                <div class="card-body">
                    @if (count($children) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Child Name</th>
                                    <th>Date of Birth</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($children as $child)
                                <tr>
                                    <td><a href="{{-- route('child.dashboard.show',['child'=>$child->id]) --}}">{{ $child->name }}</a></td>
                                    <td>{{ $child->dob }}</td>
                                    <td>
                                        <!-- Edit Action -->
                                        <a href="{{-- route('parent.children.edit',['child'=>$child->id]) --}}" class="btn btn-sm">
                                            <i style="color:blue" class="fas fa-edit"></i>
                                        </a>
                                        
                                        <!-- Delete Action -->
                                        <form method="POST" action="{{ route('parent.children.destroy', ['child' => $child->id]) }}" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm" onclick="return confirm('Are you sure you want to delete this child?')">
                                                <i style="color: red" class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                        
                                        @if ($child->enrolledClass)
                                        <!-- Start Class Action -->
                                        <a href="{{ route('parent.children.courses', ['child_id' => $child->id]) }}" class="btn btn-sm">
                                            <i style="color:green" class="fas fa-play"></i> Start Class
                                        </a>
                                     
                                    @else
                                        <span class="btn btn-sm disabled">
                                            <i style="color:blue" class="fas fa-edit"></i> Not Enrolled
                                        </span>
                                    @endif
                                  
                                    </td>
                                </tr>
                            @endforeach
                            
                            </tbody>
                        </table>
                    @else
                        <p>No children added yet.</p>
                    @endif
                    <!-- Add Child Modal -->
<div class="modal fade" id="addChildModal" tabindex="-1" aria-labelledby="addChildModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addChildModalLabel">Add Child</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form to add a child -->
                <form method="POST" action="{{ route('parent.children.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="child_name">Child Name</label>
                            <input type="text" class="form-control" id="child_name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="child_dob">Date of Birth</label>
                            <input type="date" class="form-control" id="child_dob" name="dob" required>
                        </div>
                        <div class="form-group">
                            <label for="class_id">Select Class</label>
                            <select class="form-control" name="class_id" required>
                                <option value="">Select a class</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Child</button>
                    </div>
                </form>
                  
            </div>
        </div>
    </div>
</div>

                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12 text-center">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addChildModal">
                Add New Child
            </button>
        </div>
    </div>
</div>
@endsection
