<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// routes\web.php




Route::get('/', function () {
    return view('welcome');
});

// routes\web.php

// Define a named route for the login page
//Route::get('/auth/login', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('login');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Dashboard Routes

Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home')->middleware('role');

Route::get('/teacher/home', [App\Http\Controllers\HomeController::class, 'teacherHome'])->name('teacher.home')->middleware('role');

Route::get('/parent/home', [App\Http\Controllers\HomeController::class, 'parentHome'])->name('parent.home')->middleware('role');

Route::get('/child/home', [App\Http\Controllers\HomeController::class, 'childHome'])->name('child.home')->middleware('role');
//

//Admin Dashboard
Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home')->middleware('role');

Route::get('/admin/users', [App\Http\Controllers\UserController::class, 'index'])->name('admin.users.index');

Route::get('admin/users/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('admin.users.edit');

Route::put('/admin/users/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('admin.users.update');

Route::delete('/admin/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('admin.users.destroy');

Route::get('/admin/students', [App\Http\Controllers\UserController::class, 'student'])->name('admin.students.index');

Route::get('/admin/teachers', [App\Http\Controllers\UserController::class, 'teacher'])->name('admin.teachers.index');

Route::get('/admin/courses', [App\Http\Controllers\UserController::class, 'course'])->name('admin.courses.index');

Route::get('/teacher/courses/courses', [App\Http\Controllers\CourseController::class, 'create'])->name('admin.courses.create');

Route::post('/admin/courses', [App\Http\Controllers\CourseController::class, 'store'])->name('admin.courses.store');

Route::get('admin/courses/courses/{id}/edit', [App\Http\Controllers\CourseController::class, 'edit'])->name('admin.courses.edit');

Route::put('/admin/courses/courses/{course}', [App\Http\Controllers\CourseController::class, 'update'])->name('admin.courses.update');

Route::delete('/admin/courses/courses/{class_id}', [App\Http\Controllers\CourseController::class, 'destroy'])->name('admin.courses.destroy');

//Route::get('/teacher/courses', [App\Http\Controllers\UserController::class, 'course'])->name('teacher.courses.index');

//Classes




Route::get('/teacher/classes', [App\Http\Controllers\ClassController::class, 'index'])->name('admin.classes.index');

//Route::get('/child/home', [App\Http\Controllers\ChildController::class, 'index'])->name('admin.classes.show');

Route::post('/classes/classes/{classId}', [App\Http\Controllers\ClassController::class, 'enroll'])->name('classes.enroll');

Route::post('teacher/classes', [App\Http\Controllers\ClassController::class, 'store'])->name('admin.classes.store');

Route::delete('/classes/classes/{class_id}', [App\Http\Controllers\ClassController::class, 'destroy'])->name('admin.classes.destroy');

Route::get('/classes/{class_id}/classes', [App\Http\Controllers\ClassController::class, 'dashboard'])->name('classes.dashboard');

Route::get('classes/{class_id}/class-courses', [App\Http\Controllers\ClassController::class, 'course'])->name('admin.classes.courses');

Route::post('classes/{id}/dashboard', [App\Http\Controllers\ClassController::class, 'Add'])->name('admin.courses.add');

Route::get('/classes/classes', [App\Http\Controllers\ClassController::class, 'index'])->name('admin.class.show');

Route::get('classes/{class_id}/dashboard', [App\Http\Controllers\ClassController::class, 'showCourses'])->name('classes.courses');

//




//Teacher

//Route::get('/teacher/courses', [App\Http\Controllers\UserController::class, 'course'])->name('teacher.courses.index');

Route::post('/teacher/courses/{course}/materials/', [App\Http\Controllers\TeacherMaterialController::class, 'store'])->name('teacher.materials.store');

Route::get('/classes/courses/quizzes/question', [App\Http\Controllers\QuizController::class, 'question'])->name('teacher.quizzes.question');

Route::get('/teacher/quizzes/create', [App\Http\Controllers\QuizController::class, 'create'])->name('teacher.quizzes.create');

Route::get('/classes/courses/{course_id}/quizzes/quiz', [App\Http\Controllers\QuizController::class, 'index'])->name('teacher.quizzes.index');

Route::post('/teacher/courses/materials', [App\Http\Controllers\QuizController::class, 'store'])->name('teacher.quizzes.store');
//Route::get('/teacher/quizzes/{quiz}', [App\Http\Controllers\QuizController::class, 'show'])->name('teacher.quizzes.show');
//Route::get('/teacher/courses/materials/{quiz}/edit', [App\Http\Controllers\QuizController::class, 'edit'])->name('teacher.quizzes.edit');
Route::put('/teacher/courses/materials/quiz/{quiz}', [App\Http\Controllers\QuizController::class, 'update'])->name('teacher.quizzes.update');

Route::delete('/teacher/courses/materials/{quiz}', [App\Http\Controllers\QuizController::class, 'destroy'])->name('teacher.quizzes.destroy');

Route::get('/teacher/courses/materials/quiz/{quiz_id}', [App\Http\Controllers\QuizController::class, 'showQuestions'])->name('quizzes.questions.index');

Route::post('/classes/courses/quizzes/questions', [App\Http\Controllers\QuestionController::class, 'store'])->name('class.questions.store');

Route::get('/classes/courses/{course_id}', [App\Http\Controllers\TeacherMaterialController::class, 'courses'])->name('teacher.materials.show');

//Route::get('/teacher/courses/materials/create', [App\Http\Controllers\TeacherMaterialController::class, 'material'])->name('teacher.materials.view');

Route::get('/teacher/courses/materials/{quiz_id}', [App\Http\Controllers\QuestionController::class, 'show'])->name('teacher.questions.view');

Route::get('/classes/courses/quizzes/{quiz_id}/questions', [App\Http\Controllers\QuestionController::class, 'index'])->name('teacher.questions.index');

Route::delete('/classes/courses/quizzes/questions/{question}', [App\Http\Controllers\QuestionController::class, 'destroy'])->name('teacher.questions.destroy');

Route::get('classes/materials/create', [App\Http\Controllers\TeacherMaterialController::class, 'index'])->name('teacher.materials.index');

Route::post('/teacher/courses/materials/{quiz_id}', [App\Http\Controllers\QuestionController::class, 'update'])->name('teacher.questions.update');

//Answers

Route::post('/classes/courses/quizzes/{quiz_id}/questions', [App\Http\Controllers\AnswerController::class, 'submitQuiz'])->name('user.answers.store');

Route::post('/classes/courses/quizzes/questions', [App\Http\Controllers\QuestionController::class, 'store'])->name('teacher.questions.store');

Route::get('/classes/courses/quizzes/{quiz_id}/responses', [App\Http\Controllers\AnswerController::class, 'showResponses'])->name('quizzes.responses.show');

Route::get('/classes/courses/quizzes/grades', [App\Http\Controllers\AnswerController::class, 'grades'])->name('answers.grades.show');


//Parent

Route::get('/parent/children/create', [App\Http\Controllers\ParentController::class, 'createChild'])->name('parent.children.index');

Route::post('/parent/children/create', [App\Http\Controllers\ChildrenController::class, 'store'])->name('parent.children.store');

Route::get('/parent/children/dashboard/{child}', [App\Http\Controllers\ChildrenController::class,'show'])->name('child.dashboard.show');

Route::delete('/parent/children/dashboard/{child}', [App\Http\Controllers\ChildrenController::class, 'destroy'])->name('parent.children.destroy');

Route::get('parent/children/{child}/start-class', [App\Http\Controllers\ChildrenController::class, 'startClass'])->name('parent.children.startClass');

Route::get('parent/children/course-dashboard/{child_id}', [App\Http\Controllers\ChildrenController::class, 'openEnrolledClass'])->name('parent.children.courses');

Route::get('/parent/children/content/{course_id}', [App\Http\Controllers\ChildrenController::class, 'material'])->name('children.class.material');

Route::get('/parent/children/content/{course_id}', [App\Http\Controllers\ChildrenController::class, 'dashboard'])->name('children.class.dashboard');

Route::get('/parent/materials/child_courses{course_id}', [App\Http\Controllers\ChildrenController::class, 'material'])->name('children.materials.show');

Route::get('/parent/materials/{course_id}/quiz', [App\Http\Controllers\ChildrenController::class, 'quiz'])->name('children.quizzes.show');

Route::post('/parent/materials/{quiz_id}/quiz', [App\Http\Controllers\ChildrenController::class, 'submitQuiz'])->name('children.answers.store');

Route::get('/parent/materials/grades/{quiz_id}', [App\Http\Controllers\ChildrenController::class, 'grades'])->name('children.grades.show');



//Attendance


Route::get('/classes/attendance', [App\Http\Controllers\AttendanceController::class, 'index'])->name('child.attendance.index');
Route::post('/classes/dashboard/{class_id}', [App\Http\Controllers\AttendanceController::class, 'store'])->name('child.attendance.store');

//Report

Route::get('/parent/materials/report/{id}', [App\Http\Controllers\ReportController::class, 'show'])->name('report.show');

Route::post('/parent/materials/report', [App\Http\Controllers\ReportController::class, 'store'])->name('report.store');

Route::get('/generate_report/{childName}/{age}/{className}/{quizTitle}/{grade}/{teachersRemarks}', [\App\Http\Controllers\ChildrenController::class,'generateReport'])->name('generate.report');

Route::get('/parent/materials/report', [App\Http\Controllers\ChildrenController::class, 'showImage'])->name('report.image');
