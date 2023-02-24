<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherSubjectController;
use App\Http\Controllers\GroupSubjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view('index');
});

//Route::get('/teachers', function () {
//    return view('frontend.teachers');
//});

Route::get('/teachers', [TeacherController::class, 'teachers'])->name('teacher');
Route::get('/tutors', [TutorController::class, 'tutors'])->name('tutors');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //index/dashboard panel uchun
    Route::get('/admins', [ProfileController::class, 'index'])->name('admin.index');
    Route::get('/addUser', [ProfileController::class, 'create'])->name('admin.addUser');
    Route::post('store', [ProfileController::class, 'store']);
    Route::get('/editUser/{id}', [ProfileController::class, 'edit'])->name('admin.editUser');
    Route::post('/update', [ProfileController::class, 'update']);
    Route::get('/destroy/{id}', [ProfileController::class, 'destroy']);

    //faculty panel uchun
    Route::resource('/faculty', FacultyController::class);

    Route::resource('/department', DepartmentController::class);

    Route::resource('/tutor', TutorController::class);

    Route::resource('/teacher', TeacherController::class);

    Route::resource('/group', GroupController::class);

    Route::resource('/student', StudentController::class);

    Route::resource('/subject', SubjectController::class);

    Route::resource('/teacherSubject', TeacherSubjectController::class);

    Route::resource('/groupSubject', GroupSubjectController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
