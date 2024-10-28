

@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<style>
    /* Custom style for increasing modal width */
    .modal-xl {
        max-width: 100%;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-lg-2">
            <div class="card">
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
                <li class="nav-item">
              
                    <a class="nav-link" href="
                    {{ route('children.materials.show',['course_id' => $course->id]) }}
                    ">
                    <i class="fas fa-book mr-3"></i>Courses</a>
                   
                  </li>  
                        <li class="nav-item">
                            <a class="nav-link" href=" 
                            {{ route('children.quizzes.show',['course_id'=>$course->id]) }}">
                            <i class="fas fa-question-circle mr-2"></i> Quiz</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    
        <div class="col-md-8">
            <h1>{{ $course->title }}</h1>
            <h2>Materials</h2>
           

            <!-- Modal -->
          

            <div id="materialList">
                <ul class="list-group">
                    @foreach($materials as $material)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                {{ $material->title }}
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#materialModal{{ $material->id }}">
                                    View
                                </button>
                            </div>
                        </li>
                        <!-- Modal for each material -->
                        <div class="modal fade modal-xl"  id="materialModal{{ $material->id }}" tabindex="-1" style="max-width: 80;" aria-labelledby="materialModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content" >
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="materialModalLabel">{{ $material->title }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" >
                                        <embed src="{{ asset('storage/' . $material->file_path) }}" width="100%" height="600px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection

