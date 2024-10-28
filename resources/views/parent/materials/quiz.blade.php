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
                
            
                <a class="nav-link" href="  @foreach($quizzes as $quiz)
                {{ route('children.grades.show', ['quiz_id' => $quiz->id]) }}
                @endforeach ">
                    <i class="fas fa-graduation-cap mr-3"></i>Grades
                </a>
            </li>
            
          </ul>

        </div>
      </div>
    </div>

         <div class="col-md-9">
        <div class="card">
            <div class="card-header">{{ __('Quizzes') }}</div>

            <div class="card-body">

           <!-- Create Quiz Modal -->

<!-- JavaScript code to set the course ID in the modal -->
<script>
  $('#createQuizModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var courseId = button.data('course-id');
      $('#course_id').val(courseId);
  });
</script>


              

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
                                <!-- Button to Show Full Quiz -->
<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#fullQuizModal">
    Attempt Quiz
</button>

<!-- Full Quiz Modal -->
<div class="modal fade" id="fullQuizModal" tabindex="-1" aria-labelledby="fullQuizModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fullQuizModalLabel">{{ $quiz->title }} - Full Quiz</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p>{{ $quiz->description }}</p>
                <hr>
                <h3>Questions</h3>
                <form action="{{ route('children.answers.store',['quiz_id'=>$quiz->id]) }}" method="POST" >
                    @csrf
                    <!-- Add a hidden input field for quiz_id -->
                    <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                    <!-- Add a hidden input field for child_id -->
                    @foreach($child as $child)
                    <input type="hidden" name="child_id" value="{{ $child->id }}">
                    @endforeach
                    @php $questionNumber = 1; @endphp 
                    @if(count($quiz->questions) > 0)
                        @foreach($quiz->questions as $question)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <p><b>Question {{ $questionNumber }}</b>: {{ $question->question_text }}</p>
                                    @if ($question->question_type === 'multiple_choice' && $question->options !== null)
                                        @php
                                            $options = json_decode($question->options, true);
                                        @endphp
                                        <p><b>Answer</b>:</p>
                                        <ul>
                                            @foreach ($options as $index => $option)
                                            <li class="list-group-item">
                                                <label>
                                                    <input type="radio" class="ml-2" name="question_{{ $question->id }}" value="{{ $option }}">
                                                    {{ $option }}
                                                </label><br>
                                            </li>
                                            @endforeach
                                        </ul>
                                    @elseif ($question->question_type === 'true_false')
                                        <p><b>Answer</b>:</p>
                                        <ul>
                                            <li>
                                                <label>
                                                    <input type="radio" name="question_{{ $question->id }}" value="true">
                                                    True
                                                </label>
                                            </li>
                                            <li>
                                                <label>
                                                    <input type="radio" name="question_{{ $question->id }}" value="false">
                                                    False
                                                </label>
                                            </li>
                                        </ul>
                                    @elseif ($question->question_type === 'short_answer' || $question->question_type === 'fill_in_the_blank')
                                        <p><b>Your Answer</b>:</p>
                                        <!-- Add input for user_answer -->
                                        <input type="text" name="question_{{ $question->id }}" class="form-control">
                                    @endif
                                    <!-- Add input for question_id -->
                                    <input type="hidden" name="question_id[]" value="{{ $question->id }}">
                                </div>
                            </div>
                            @php $questionNumber++; @endphp <!-- Increment the question number counter -->
                        @endforeach
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit Quiz</button>
                        </div>
                    @else
                        <p>No questions found for this quiz.</p>
                    @endif
                </form>
                
            </div>

            
        </div>
    </div>
</div>
                               
                                <!-- ... -->
                              
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
