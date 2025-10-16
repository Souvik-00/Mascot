<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Expense;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Classroom;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'studentCount' => Student::count(),
            'teacherCount' => Teacher::count(),
            'batchCount'   => Batch::count(),
            'classCount'   => Classroom::count(),
            'totalPayments' => Payment::sum('amount'),
            'totalExpenses' => Expense::sum('amount'),
        ]);
    }
}
