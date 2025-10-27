<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MetaResultController;
use App\Http\Controllers\BatchStudentController;
use App\Http\Controllers\ClassSessionController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\LeadsTrialStatController;
use App\Http\Controllers\LeadsAttendanceController;
use App\Http\Controllers\MarketingSourceController;
use App\Http\Controllers\CrmPipelineStageController;
use App\Http\Controllers\LeadConversionStatController;

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

    Route::resource('marketing_sources', MarketingSourceController::class);

    Route::resource('crm_pipeline_stages', CrmPipelineStageController::class);

    Route::resource('leads', LeadController::class);

    Route::resource('department', DepartmentController::class);

    Route::resource('lead_conversion_stats', LeadConversionStatController::class);

    // Custom route for creating trial for a specific lead
    Route::get('/leads_trial/create/{lead_id}', [LeadsTrialStatController::class, 'create'])->name('leads_trial.create');

    // Resource route for full CRUD except create
    Route::resource('leads_trial', LeadsTrialStatController::class)->except(['create']);


    // Step 1: Mark Attendance (Select date → Load → Save)
    Route::get('leads_attendance/mark', [LeadsAttendanceController::class, 'mark'])
    ->name('leads_attendance.mark');

    Route::post('leads_attendance/store', [LeadsAttendanceController::class, 'store'])
    ->name('leads_attendance.store');

    // Step 2: Attendance History (Search by date range)
    Route::get('leads_attendance', [LeadsAttendanceController::class, 'index'])
    ->name('leads_attendance.index');

    Route::resource('batch_students', BatchStudentController::class);


    Route::get('analytics.funnel_conversion', [AnalyticsController::class, 'index'])->name('analytics.funnel_conversion');

});

Route::get('/', function () {
    return redirect('/login');
});
