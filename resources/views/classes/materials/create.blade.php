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
                        <li class="nav-item">
                          <a class="nav-link" href="{{ route('teacher.quizzes.index',['course_id'=>$course->id]) }}">
                            <i class="fas fa-question-circle mr-2"></i>Quiz
                          </a>
                        </li>
                      </ul>
                      
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <h1>{{ $course->title }}</h1>
            <h2>Materials</h2>
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadMaterialModal{{ $course->id }}">
                    <i class="fas fa-upload"></i> Upload
                </button>
                <br>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="uploadMaterialModal{{ $course->id }}" tabindex="-1" aria-labelledby="uploadMaterialModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="uploadMaterialModalLabel{{ $course->id }}">Upload Material</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form to upload material -->
                            <form action="{{ route('teacher.materials.store', $course->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" value="{{ old('title') }}" class="form-control" id="title"
                                        name="title">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description"
                                        placeholder="Enter description">{{ old('description') }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="file" class="form-label">File</label>
                                    <input type="file" class="form-control" id="file" name="file" accept=".ppt,.pptx,.pdf">
                                </div>
                                <input type="hidden" name="course_id" value="{{ $course->id }}">

                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

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
