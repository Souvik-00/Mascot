<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MetaResultController;
use App\Http\Controllers\ClassSessionController;
use App\Http\Controllers\OrganisationController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    
    Route::get('/profile', [UserController::class, 'profile'])->name('users.profile');
    Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
    Route::resource('users', UserController::class);

    Route::resource('organisation', OrganisationController::class);
    
    // Students
    Route::get('students', [StudentController::class, 'index'])->name('students.index');
    Route::get('students/search', [StudentController::class, 'search'])->name('students.search');

    // Teachers
    Route::get('teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::get('teachers/search', [TeacherController::class, 'search'])->name('teachers.search');
    

    Route::get('/courses/search', [CourseController::class, 'search'])->name('courses.search');
    Route::resource('courses', CourseController::class);

    
    Route::get('/batches/search', [BatchController::class, 'search'])->name('batches.search');
    Route::resource('batches', BatchController::class);
    
    Route::resource('classrooms', ClassroomController::class);
    
    Route::resource('sessions', SessionController::class);
    
    Route::resource('class-sessions', ClassSessionController::class);
    
    Route::resource('schedules', ScheduleController::class);
    
    Route::resource('payments', PaymentController::class);
    
    Route::resource('expenses', ExpenseController::class);

    Route::resource('meta_results', MetaResultController::class);

});

Route::get('/', function () {
    return redirect('/login');
});
