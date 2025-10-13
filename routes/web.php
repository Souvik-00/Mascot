<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ClassSessionController;
use App\Http\Controllers\OrganisationController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('organisation', OrganisationController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('students', StudentController::class);
    Route::resource('batches', BatchController::class);
    Route::resource('classrooms', ClassroomController::class);
    Route::resource('sessions', SessionController::class);
    Route::resource('class-sessions', ClassSessionController::class);
    Route::resource('schedules', ScheduleController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('expenses', ExpenseController::class);









    
});

Route::get('/', function () {
    return redirect('/login');
});
