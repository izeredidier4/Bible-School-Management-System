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
                  @isset($class)
                    <a class="nav-link" href="{{ route('classes.dashboard', ['class_id' => $class->id]) }}">
                      <i class="fas fa-book mr-2"></i>Courses
                    </a>
                  @endisset
                </li>
                
                @foreach($quizzes as $quiz)
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('teacher.quizzes.index', ['course_id' => $quiz->course_id]) }}">
                    <i class="fas fa-question-circle mr-2"></i>Quizzes
                  </a>
                </li>
                @endforeach
                
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('answers.grades.show') }}">
                    <i class="fas fa-chart-bar mr-2"></i>Grades
                  </a>
                </li>
              </ul>
              

        </div>
      </div>
    </div>

    <div class="col-md-9 col-lg-10">
        <div class="card">
            <div class="card-header">{{ __('Quizzes') }}</div>

            <div class="card-body">

           <!-- Create Quiz Modal -->
<div class="modal fade" id="createQuizModal" tabindex="-1" role="dialog" aria-labelledby="createQuizModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="createQuizModalLabel">Create Quiz</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form action="{{ route('teacher.quizzes.store') }}" method="POST">
              @csrf
              <div class="modal-body">
                  <!-- Quiz details form inputs -->
                  
                  <input type="hidden" id="course_id" name="course_id" value="{{ $courses->id }}">
                  
                  <div class="form-group">
                      <label for="quiz_title">Title</label>
                      <input type="text" class="form-control" id="quiz_title" name="title" required>
                  </div>
                  <div class="form-group">
                      <label for="quiz_description">Description</label>
                      <textarea class="form-control" id="quiz_description" name="description" rows="3"></textarea>
                  </div>
                  <div class="form-group">
                      <label for="quiz_type">Type</label>
                      <select class="form-control" id="quiz_type" name="type" required>
                          <option value="multiple_choice">Multiple Choice</option>
                          <option value="true_false">True/False</option>
                          <option value="fill_in_the_blank">Fill in the Blank</option>
                          <option value="short_answer">Short Answer</option>
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="quiz_time_limit">Time Limit (minutes)</label>
                      <input type="number" class="form-control" id="quiz_time_limit" name="quiz_time_limit" min="1">
                  </div>
                 
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Create</button>
              </div>
          </form>
      </div>
  </div>
</div>

<!-- JavaScript code to set the course ID in the modal -->
<script>
  $('#createQuizModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var courseId = button.data('course-id');
      $('#course_id').val(courseId);
  });
</script>


                <div class="mb-3">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createQuizModal">
                        Create New Quiz
                    </button>
                </div>

                <!-- Quiz List Table -->
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($quizzes as $quiz) <!-- Loop over quizzes, not courses -->
                        <tr>
                            <td>{{ $quiz->title }}</td>
                            <td>{{ $quiz->description }}</td>
                            <td>
                                <a href="{{ route('teacher.questions.index', ['quiz_id' => $quiz->id]) }}" class="btn btn-primary">
                                    <i class="fas fa-edit">View Quiz</i> 
                                </a>

                                <a href="{{ route('quizzes.responses.show', ['quiz_id' => $quiz->id]) }}" class="btn btn-secondary">
                                    <i class="fas fa-edit">View Responses</i> 
                                </a>
                                <!-- ... -->
                                <form action="{{ route('teacher.quizzes.destroy', ['quiz' => $quiz->id]) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn" onclick="return confirm('Are you sure you want to delete this quiz?')">
                                        <i style="color:red" class="fas fa-trash-alt"></i>
                                    </button>
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
