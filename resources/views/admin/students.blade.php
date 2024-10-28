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
              <a class="nav-link" href="{{route('admin.users.index') }}">Users</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.students.index') }}">Students</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.teachers.index') }}">Teachers</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{-- route('admin.courses.index') --}}">Courses</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{-- route('admin.assignments.index') --}}">Assignments</a>
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
        <div class="card-header">Students</div>
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Name</th>
                <th>Date of Birth</th>
                <th>Parent Name</th>
                <th>Parent Email</th>
                <th>Class Name</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($children as $student)
              <tr>
                <td>{{ $student->name }}</td>
                <td>{{ $student->dob }}</td>
                <td>{{ $student->parent->name }}</td>
                <td>{{ $student->class ? $student->class->name : 'N/A' }}</td>
                <td>
                  <a href="{{ route('admin.users.edit',$student->id) }}" class="btn btn"><i style="color:blue" class="fas fa-edit"> </i></a>
                  <form action="{{route('admin.users.destroy',$student->id)}}" method="POST" style="display: inline-block">
                    @csrf
                    @method ('DELETE')
                    <button type="submit" class="btn btn" onclick="return confirm('Are you sure?')"><i style="color:red" class="fas fa-trash-alt"> </i></button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
