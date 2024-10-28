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
                          <a class="nav-link" href="{{-- route('teacher.grades.index') --}}">
                            <i class="fas fa-chart-bar mr-2"></i>Grades
                          </a>
                        </li>
                      </ul>
                      
                </div>
            </div>
        </div>

        <div class="col-md-9 col-lg-9">
            <div class="card">
                <div class="card-header">{{ __('Questions') }}</div>

                <div class="card-body">

                    <!-- ... (the rest of your existing code) ... -->

                    <div class="mb-3">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addQuestionModal">
                            Add Question
                        </button>
                        <!-- Add Question Modal -->
<div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuestionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addQuestionModalLabel">Add Question</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('teacher.questions.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
            
                    <div class="form-group">
                        <label for="question">Question</label>
                        <textarea class="form-control" id="question" name="question_text" rows="2" required>{{ old('question') }}</textarea>
                        @error('question')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-control" id="type" name="question_type" required>
                            <option value="short_answer">Short Answer</option>
                            <option value="true_false">True/False</option>
                            <option value="fill_in_the_blank">Fill in the Blank</option>
                            <option value="multiple_choice">Multiple Choice</option>
                        </select>
                        @error('question_type')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group" id="options-group">
                        <label for="options">Options</label>
                        @php
                            $options = old('options') ? old('options') : [];
                        @endphp
                        @foreach ($options as $key => $option)
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="options[]" value="{{ $option }}" placeholder="Enter Option">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-danger" type="button" onclick="removeOption(this)">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
            
                    <!-- Add Option Button (Visible for Multiple Choice) -->
                    <button type="button" class="btn btn-primary" onclick="addOption()" id="addOptionButton">Add Option</button>
            
                    <script>
                        function addOption() {
                            const optionsGroup = document.getElementById('options-group');
                            const inputGroup = document.createElement('div');
                            inputGroup.classList.add('input-group', 'mb-2');
                            inputGroup.innerHTML = `
                                <input type="text" class="form-control" name="options[]" placeholder="Enter Option">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-danger" type="button" onclick="removeOption(this)">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            `;
                            optionsGroup.appendChild(inputGroup);
                        }
            
                        function removeOption(button) {
                            const optionsGroup = document.getElementById('options-group');
                            optionsGroup.removeChild(button.parentElement.parentElement);
                        }
            
                        // Show/Hide "Add Option" button based on the selected question type
                        const typeSelect = document.getElementById('type');
                        const addOptionButton = document.getElementById('addOptionButton');
                        typeSelect.addEventListener('change', () => {
                            addOptionButton.style.display = typeSelect.value === 'multiple_choice' ? 'block' : 'none';
                        });
                    </script>
            
                    <div class="form-group">
                        <label for="answer">Correct Answer</label>
                        <textarea class="form-control" id="answer" name="correct_answer" rows="3" required>{{ old('correct_answer') }}</textarea>
                        @error('correct_answer')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Question</button>
                </div>
            </form>
            
        </div>
    </div>
</div>

<!-- JavaScript to show/hide options field based on question type -->
<script>
    $(document).ready(function () {
        // Initially hide the options field
        $('#options-group').hide();

        // Show/hide options field based on question type selection
        $('#type').on('change', function () {
            var questionType = $(this).val();
            if (questionType === 'multiple_choice') {
                $('#options-group').show();
            } else {
                $('#options-group').hide();
            }
        });
    });
</script>


<!-- Button to Show Full Quiz -->
<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#fullQuizModal">
    Full Quiz
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
                <form action="{{ route('user.answers.store',['quiz_id'=>$quiz->id]) }}" method="POST" >
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

<!-- JavaScript to Handle Quiz Submission -->




                        
                    </div>
                    
                       
                    

                    <!-- Questions List Table -->
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Question Text</th>
                                <th scope="col">Question Type</th>
                                <th scope="col">Options</th>
                                <th scope="col">Correct Answer</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quiz->questions as $question)
                            <tr>
                                <td>{{ $question->question_text }}</td>
                                <td>{{ $question->question_type }}</td>
                                <td>
                                    @if ($question->question_type === 'multiple_choice' && $question->options !== null)
                                    @php
                                        $options = json_decode($question->options, true);
                                    @endphp

                                        @foreach ($options as $option)
                                            {{ $option }}<br>
                                        @endforeach
                                   
                                    @endif
                                </td>
                                <td>{{ $question->correct_answer }}</td>
                                <td>
                                    <a href="{{-- php --}}" class="btn btn">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <!-- Delete Question Form -->
                                    <form action="{{ route('teacher.questions.destroy', ['question' => $question->id]) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn" onclick="return confirm('Are you sure you want to delete this question?')">
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
  