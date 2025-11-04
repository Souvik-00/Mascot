<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\BatchLeadController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NetIncomeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MetaResultController;
use App\Http\Controllers\BatchStudentController;
use App\Http\Controllers\BatchTeacherController;
use App\Http\Controllers\ClassSessionController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\ExpenseReportController;
use App\Http\Controllers\FinanceReportsController;
use App\Http\Controllers\LeadAttendanceController;
use App\Http\Controllers\LeadsTrialStatController;
use App\Http\Controllers\StudentFinanceController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\MarketingSourceController;
use App\Http\Controllers\CrmPipelineStageController;
use App\Http\Controllers\ExpenseDepartmentController;
use App\Http\Controllers\StudentAttendanceController;
use App\Http\Controllers\TeacherAttendanceController;
use App\Http\Controllers\ExpenseSubCategoryController;
use App\Http\Controllers\LeadConversionStatController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    
    Route::get('/profile', [UserController::class, 'profile'])->name('users.profile');
    Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::match(['put', 'patch'], 'users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('organisation', [OrganisationController::class, 'index'])->name('organisation.index');
    Route::get('organisation/create', [OrganisationController::class, 'create'])->name('organisation.create');
    Route::post('organisation', [OrganisationController::class, 'store'])->name('organisation.store');
    Route::get('organisation/{organisation}/edit', [OrganisationController::class, 'edit'])->name('organisation.edit');
    Route::match(['put', 'patch'], 'organisation/{organisation}', [OrganisationController::class, 'update'])->name('organisation.update');
    Route::delete('organisation/{organisation}', [OrganisationController::class, 'destroy'])->name('organisation.destroy');

    // Students
    Route::get('students', [StudentController::class, 'index'])->name('students.index');
    Route::get('students/search', [StudentController::class, 'search'])->name('students.search');

    // Teachers
    Route::get('teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::get('teachers/search', [TeacherController::class, 'search'])->name('teachers.search');

    Route::get('/courses/search', [CourseController::class, 'search'])->name('courses.search');
    Route::get('courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::match(['put', 'patch'], 'courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');

    Route::get('/batches/search', [BatchController::class, 'search'])->name('batches.search');
    Route::get('batches', [BatchController::class, 'index'])->name('batches.index');
    Route::get('batches/create', [BatchController::class, 'create'])->name('batches.create');
    Route::post('batches', [BatchController::class, 'store'])->name('batches.store');
    Route::get('batches/{batch}/edit', [BatchController::class, 'edit'])->name('batches.edit');
    Route::match(['put', 'patch'], 'batches/{batch}', [BatchController::class, 'update'])->name('batches.update');
    Route::delete('batches/{batch}', [BatchController::class, 'destroy'])->name('batches.destroy');

    Route::get('classrooms', [ClassroomController::class, 'index'])->name('classrooms.index');
    Route::get('classrooms/create', [ClassroomController::class, 'create'])->name('classrooms.create');
    Route::post('classrooms', [ClassroomController::class, 'store'])->name('classrooms.store');
    Route::get('classrooms/{classroom}', [ClassroomController::class, 'show'])->name('classrooms.show');
    Route::get('classrooms/{classroom}/edit', [ClassroomController::class, 'edit'])->name('classrooms.edit');
    Route::match(['put', 'patch'], 'classrooms/{classroom}', [ClassroomController::class, 'update'])->name('classrooms.update');
    Route::delete('classrooms/{classroom}', [ClassroomController::class, 'destroy'])->name('classrooms.destroy');

    Route::get('class-sessions', [ClassSessionController::class, 'index'])->name('class-sessions.index');
    Route::get('class-sessions/create', [ClassSessionController::class, 'create'])->name('class-sessions.create');
    Route::post('class-sessions', [ClassSessionController::class, 'store'])->name('class-sessions.store');
    Route::get('class-sessions/{class_session}', [ClassSessionController::class, 'show'])->name('class-sessions.show');
    Route::get('class-sessions/{class_session}/edit', [ClassSessionController::class, 'edit'])->name('class-sessions.edit');
    Route::match(['put', 'patch'], 'class-sessions/{class_session}', [ClassSessionController::class, 'update'])->name('class-sessions.update');
    Route::delete('class-sessions/{class_session}', [ClassSessionController::class, 'destroy'])->name('class-sessions.destroy');

    Route::get('schedules', [ScheduleController::class, 'index'])->name('schedules.index');
    Route::get('schedules/create', [ScheduleController::class, 'create'])->name('schedules.create');
    Route::post('schedules', [ScheduleController::class, 'store'])->name('schedules.store');
    Route::get('schedules/{schedule}', [ScheduleController::class, 'show'])->name('schedules.show');
    Route::get('schedules/{schedule}/edit', [ScheduleController::class, 'edit'])->name('schedules.edit');
    Route::match(['put', 'patch'], 'schedules/{schedule}', [ScheduleController::class, 'update'])->name('schedules.update');
    Route::delete('schedules/{schedule}', [ScheduleController::class, 'destroy'])->name('schedules.destroy');

    // Route::get('payments/get-batches/{student}', [PaymentController::class, 'getBatchesForStudent'])->name('payments.get-batches');
    Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('payments/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('payments', [PaymentController::class, 'store'])->name('payments.store');
    Route::get('payments/{payment}/edit', [PaymentController::class, 'edit'])->name('payments.edit');
    Route::match(['put', 'patch'], 'payments/{payment}', [PaymentController::class, 'update'])->name('payments.update');
    Route::delete('payments/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');

    Route::get('/get-subcategories/{categoryId}', [ExpenseController::class, 'getSubcategories'])->name('expenses.getSubcategories');
    Route::get('expenses', [ExpenseController::class, 'index'])->name('expenses.index');
    Route::get('expenses/create', [ExpenseController::class, 'create'])->name('expenses.create');
    Route::post('expenses', [ExpenseController::class, 'store'])->name('expenses.store');
    Route::get('expenses/{expense}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit');
    Route::match(['put', 'patch'], 'expenses/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');
    Route::delete('expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');

    Route::get('meta_results', [MetaResultController::class, 'index'])->name('meta_results.index');
    Route::get('meta_results/create', [MetaResultController::class, 'create'])->name('meta_results.create');
    Route::post('meta_results', [MetaResultController::class, 'store'])->name('meta_results.store');
    Route::get('meta_results/{meta_result}', [MetaResultController::class, 'show'])->name('meta_results.show');
    Route::get('meta_results/{meta_result}/edit', [MetaResultController::class, 'edit'])->name('meta_results.edit');
    Route::match(['put', 'patch'], 'meta_results/{meta_result}', [MetaResultController::class, 'update'])->name('meta_results.update');
    Route::delete('meta_results/{meta_result}', [MetaResultController::class, 'destroy'])->name('meta_results.destroy');

    Route::get('marketing_sources', [MarketingSourceController::class, 'index'])->name('marketing_sources.index');
    Route::get('marketing_sources/create', [MarketingSourceController::class, 'create'])->name('marketing_sources.create');
    Route::post('marketing_sources', [MarketingSourceController::class, 'store'])->name('marketing_sources.store');
    Route::get('marketing_sources/{marketing_source}', [MarketingSourceController::class, 'show'])->name('marketing_sources.show');
    Route::get('marketing_sources/{marketing_source}/edit', [MarketingSourceController::class, 'edit'])->name('marketing_sources.edit');
    Route::match(['put', 'patch'], 'marketing_sources/{marketing_source}', [MarketingSourceController::class, 'update'])->name('marketing_sources.update');
    Route::delete('marketing_sources/{marketing_source}', [MarketingSourceController::class, 'destroy'])->name('marketing_sources.destroy');

    Route::get('crm_pipeline_stages', [CrmPipelineStageController::class, 'index'])->name('crm_pipeline_stages.index');
    Route::get('crm_pipeline_stages/create', [CrmPipelineStageController::class, 'create'])->name('crm_pipeline_stages.create');
    Route::post('crm_pipeline_stages', [CrmPipelineStageController::class, 'store'])->name('crm_pipeline_stages.store');
    Route::get('crm_pipeline_stages/{crm_pipeline_stage}', [CrmPipelineStageController::class, 'show'])->name('crm_pipeline_stages.show');
    Route::get('crm_pipeline_stages/{crm_pipeline_stage}/edit', [CrmPipelineStageController::class, 'edit'])->name('crm_pipeline_stages.edit');
    Route::match(['put', 'patch'], 'crm_pipeline_stages/{crm_pipeline_stage}', [CrmPipelineStageController::class, 'update'])->name('crm_pipeline_stages.update');
    Route::delete('crm_pipeline_stages/{crm_pipeline_stage}', [CrmPipelineStageController::class, 'destroy'])->name('crm_pipeline_stages.destroy');

    Route::get('leads', [LeadController::class, 'index'])->name('leads.index');
    Route::get('leads/create', [LeadController::class, 'create'])->name('leads.create');
    Route::post('leads', [LeadController::class, 'store'])->name('leads.store');
    Route::get('leads/{lead}', [LeadController::class, 'show'])->name('leads.show');
    Route::get('leads/{lead}/edit', [LeadController::class, 'edit'])->name('leads.edit');
    Route::match(['put', 'patch'], 'leads/{lead}', [LeadController::class, 'update'])->name('leads.update');
    Route::delete('leads/{lead}', [LeadController::class, 'destroy'])->name('leads.destroy');

    Route::get('department', [DepartmentController::class, 'index'])->name('department.index');
    Route::get('department/create', [DepartmentController::class, 'create'])->name('department.create');
    Route::post('department', [DepartmentController::class, 'store'])->name('department.store');
    Route::get('department/{department}', [DepartmentController::class, 'show'])->name('department.show');
    Route::get('department/{department}/edit', [DepartmentController::class, 'edit'])->name('department.edit');
    Route::match(['put', 'patch'], 'department/{department}', [DepartmentController::class, 'update'])->name('department.update');
    Route::delete('department/{department}', [DepartmentController::class, 'destroy'])->name('department.destroy');

    Route::get('lead_conversion_stats', [LeadConversionStatController::class, 'index'])->name('lead_conversion_stats.index');
    Route::get('lead_conversion_stats/create', [LeadConversionStatController::class, 'create'])->name('lead_conversion_stats.create');
    Route::post('lead_conversion_stats', [LeadConversionStatController::class, 'store'])->name('lead_conversion_stats.store');
    Route::get('lead_conversion_stats/{lead_conversion_stat}', [LeadConversionStatController::class, 'show'])->name('lead_conversion_stats.show');
    Route::get('lead_conversion_stats/{lead_conversion_stat}/edit', [LeadConversionStatController::class, 'edit'])->name('lead_conversion_stats.edit');
    Route::match(['put', 'patch'], 'lead_conversion_stats/{lead_conversion_stat}', [LeadConversionStatController::class, 'update'])->name('lead_conversion_stats.update');
    Route::delete('lead_conversion_stats/{lead_conversion_stat}', [LeadConversionStatController::class, 'destroy'])->name('lead_conversion_stats.destroy');

    // Custom route for creating trial for a specific lead
    Route::get('leads_trial/create/{lead_id}', [LeadsTrialStatController::class, 'create'])->name('leads_trial.create');
    Route::get('leads_trial', [LeadsTrialStatController::class, 'index'])->name('leads_trial.index');
    Route::post('leads_trial', [LeadsTrialStatController::class, 'store'])->name('leads_trial.store');
    Route::get('leads_trial/{leads_trial}/edit', [LeadsTrialStatController::class, 'edit'])->name('leads_trial.edit');
    Route::match(['put', 'patch'], 'leads_trial/{leads_trial}', [LeadsTrialStatController::class, 'update'])->name('leads_trial.update');
    Route::delete('leads_trial/{leads_trial}', [LeadsTrialStatController::class, 'destroy'])->name('leads_trial.destroy');

    Route::get('batch_students', [BatchStudentController::class, 'index'])->name('batch_students.index');
    Route::get('batch_students/create', [BatchStudentController::class, 'create'])->name('batch_students.create');
    Route::post('batch_students', [BatchStudentController::class, 'store'])->name('batch_students.store');
    Route::get('batch_students/{batch_student}/edit', [BatchStudentController::class, 'edit'])->name('batch_students.edit');
    Route::match(['put', 'patch'], 'batch_students/{batch_student}', [BatchStudentController::class, 'update'])->name('batch_students.update');
    Route::delete('batch_students/{batch_student}', [BatchStudentController::class, 'destroy'])->name('batch_students.destroy');

    Route::get('batch_teachers', [BatchTeacherController::class, 'index'])->name('batch_teachers.index');
    Route::get('batch_teachers/create', [BatchTeacherController::class, 'create'])->name('batch_teachers.create');
    Route::post('batch_teachers', [BatchTeacherController::class, 'store'])->name('batch_teachers.store');
    Route::get('batch_teachers/{batch_teacher}/edit', [BatchTeacherController::class, 'edit'])->name('batch_teachers.edit');
    Route::match(['put', 'patch'], 'batch_teachers/{batch_teacher}', [BatchTeacherController::class, 'update'])->name('batch_teachers.update');
    Route::delete('batch_teachers/{batch_teacher}', [BatchTeacherController::class, 'destroy'])->name('batch_teachers.destroy');

    Route::get('batch_leads', [BatchLeadController::class, 'index'])->name('batch_leads.index');
    Route::get('batch_leads/create', [BatchLeadController::class, 'create'])->name('batch_leads.create');
    Route::post('batch_leads', [BatchLeadController::class, 'store'])->name('batch_leads.store');
    Route::get('batch_leads/{batch_lead}/edit', [BatchLeadController::class, 'edit'])->name('batch_leads.edit');
    Route::match(['put', 'patch'], 'batch_leads/{batch_lead}', [BatchLeadController::class, 'update'])->name('batch_leads.update');
    Route::delete('batch_leads/{batch_lead}', [BatchLeadController::class, 'destroy'])->name('batch_leads.destroy');

    Route::get('expense_category', [ExpenseCategoryController::class, 'index'])->name('expense_category.index');
    Route::get('expense_category/create', [ExpenseCategoryController::class, 'create'])->name('expense_category.create');
    Route::post('expense_category', [ExpenseCategoryController::class, 'store'])->name('expense_category.store');
    Route::get('expense_category/{expense_category}/edit', [ExpenseCategoryController::class, 'edit'])->name('expense_category.edit');
    Route::match(['put', 'patch'], 'expense_category/{expense_category}', [ExpenseCategoryController::class, 'update'])->name('expense_category.update');
    Route::delete('expense_category/{expense_category}', [ExpenseCategoryController::class, 'destroy'])->name('expense_category.destroy');

    Route::get('expense_subcategory', [ExpenseSubCategoryController::class, 'index'])->name('expense_subcategory.index');
    Route::get('expense_subcategory/create', [ExpenseSubCategoryController::class, 'create'])->name('expense_subcategory.create');
    Route::post('expense_subcategory', [ExpenseSubCategoryController::class, 'store'])->name('expense_subcategory.store');
    Route::get('expense_subcategory/{expense_subcategory}/edit', [ExpenseSubCategoryController::class, 'edit'])->name('expense_subcategory.edit');
    Route::match(['put', 'patch'], 'expense_subcategory/{expense_subcategory}', [ExpenseSubCategoryController::class, 'update'])->name('expense_subcategory.update');
    Route::delete('expense_subcategory/{expense_subcategory}', [ExpenseSubCategoryController::class, 'destroy'])->name('expense_subcategory.destroy');

    Route::get('lead-attendance/get-leads/{batch_id}', [LeadAttendanceController::class, 'getLeadsByBatch']);
    Route::get('lead-attendance/edit', [LeadAttendanceController::class, 'edit'])->name('lead_attendance.edit');
    Route::match(['put', 'patch'], 'lead-attendance/update', [LeadAttendanceController::class, 'update'])->name('lead_attendance.update');
    Route::get('lead_attendance', [LeadAttendanceController::class, 'index'])->name('lead_attendance.index');
    Route::get('lead_attendance/create', [LeadAttendanceController::class, 'create'])->name('lead_attendance.create');
    Route::post('lead_attendance', [LeadAttendanceController::class, 'store'])->name('lead_attendance.store');

    Route::get('student-attendance/get-students/{batch_id}', [StudentAttendanceController::class, 'getStudentsByBatch']);
    Route::get('student_attendance/edit', [StudentAttendanceController::class, 'edit'])->name('student_attendance.edit');
    Route::match(['put', 'patch'], 'student_attendance/update', [StudentAttendanceController::class, 'update'])->name('student_attendance.update');
    Route::get('student_attendance', [StudentAttendanceController::class, 'index'])->name('student_attendance.index');
    Route::get('student_attendance/create', [StudentAttendanceController::class, 'create'])->name('student_attendance.create');
    Route::post('student_attendance', [StudentAttendanceController::class, 'store'])->name('student_attendance.store');

    Route::get('teacher-attendance/get-teachers/{batch_id}', [TeacherAttendanceController::class, 'getTeachersByBatch']);
    Route::get('teacher_attendance/edit', [TeacherAttendanceController::class, 'edit'])->name('teacher_attendance.edit');
    Route::match(['put', 'patch'], 'teacher_attendance/update', [TeacherAttendanceController::class, 'update'])->name('teacher_attendance.update');
    Route::get('teacher_attendance', [TeacherAttendanceController::class, 'index'])->name('teacher_attendance.index');
    Route::get('teacher_attendance/create', [TeacherAttendanceController::class, 'create'])->name('teacher_attendance.create');
    Route::post('teacher_attendance', [TeacherAttendanceController::class, 'store'])->name('teacher_attendance.store');

    Route::get('analytics.funnel_conversion', [AnalyticsController::class, 'index'])->name('analytics.funnel_conversion');

    Route::get('/finance/reports', [FinanceReportsController::class, 'index'])->name('finance.reports');

    Route::get('/student-finance', [StudentFinanceController::class, 'index'])->name('student_finance.index');
    Route::get('/student-finance/{student_id}/payments', [StudentFinanceController::class, 'showPayments'])->name('student_finance.payments');

    Route::get('/categorywise-expense', [ExpenseReportController::class, 'categoryWise'])->name('categorywise_expense.index');

    Route::get('/department-expense', [ExpenseDepartmentController::class, 'index'])->name('department_expense.index');

    Route::get('/net-income', [NetIncomeController::class, 'index'])->name('net_income.index');

});

Route::get('/', function () {
    return redirect('/login');
});
