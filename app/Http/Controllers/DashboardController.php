<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Course;
use App\Models\Expense;
use App\Models\Payment;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'studentCount' => User::where('profile', 'student')->count(),
            'teacherCount' => User::where('profile', 'teacher')->count(),
            'batchCount'   => Batch::count(),
            'courseCount'  => Course::count(),
            'totalPayments' => Payment::sum('amount'),
            'totalExpenses' => Expense::sum('amount'),
        ]);
    }
}
