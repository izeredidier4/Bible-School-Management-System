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
  
    <div class="col-md-9">
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
      
      <td>{{ $course->title }}</td>
      <td>{{ $course->description }}</td>

        <td>
            <a href="{{ route('children.materials.show',['course_id' => $course->id]) }}" class="btn btn-primary">
                <i class="fas fa-play" style="color: white;"></i>
            </a> 
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
  </div>
</div>

    
@endsection
