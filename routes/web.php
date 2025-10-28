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
use App\Http\Controllers\BatchLeadController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MetaResultController;
use App\Http\Controllers\BatchStudentController;
use App\Http\Controllers\BatchTeacherController;
use App\Http\Controllers\ClassSessionController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\LeadAttendanceController;
use App\Http\Controllers\LeadsTrialStatController;
use App\Http\Controllers\LeadsAttendanceController;
use App\Http\Controllers\MarketingSourceController;
use App\Http\Controllers\CrmPipelineStageController;
use App\Http\Controllers\StudentAttendanceController;
use App\Http\Controllers\TeacherAttendanceController;
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

    Route::resource('batch_students', BatchStudentController::class);

    Route::resource('batch_teachers', BatchTeacherController::class);

    Route::resource('batch_leads', BatchLeadController::class);

    Route::get('lead-attendance/get-leads/{batch_id}', [LeadAttendanceController::class, 'getLeadsByBatch']);
    Route::get('lead-attendance/edit', [LeadAttendanceController::class, 'edit'])->name('lead_attendance.edit');
    Route::put('lead-attendance/update', [LeadAttendanceController::class, 'update'])->name('lead_attendance.update');

    Route::resource('lead_attendance', LeadAttendanceController::class);

    Route::get('student-attendance/get-students/{batch_id}', [StudentAttendanceController::class, 'getStudentsByBatch']);
    Route::get('student_attendance/edit', [StudentAttendanceController::class, 'edit'])->name('student_attendance.edit');
    Route::get('student_attendance/update', [StudentAttendanceController::class, 'update'])->name('student_attendance.update');
    Route::resource('student_attendance', StudentAttendanceController::class);

    Route::get('teacher-attendance/get-teachers/{batch_id}', [TeacherAttendanceController::class, 'getTeachersByBatch']);
     Route::get('teacher_attendance/edit', [TeacherAttendanceController::class, 'edit'])->name('teacher_attendance.edit');
    Route::get('teacher_attendance/update', [TeacherAttendanceController::class, 'update'])->name('teacher_attendance.update');
    Route::resource('teacher_attendance', TeacherAttendanceController::class);



    Route::get('analytics.funnel_conversion', [AnalyticsController::class, 'index'])->name('analytics.funnel_conversion');

});

Route::get('/', function () {
    return redirect('/login');
});
