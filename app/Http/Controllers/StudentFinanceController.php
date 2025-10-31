<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentFinanceController extends Controller
{
    /**
     * Display the student finance report:
     * - Total Fee
     * - Total Paid
     * - Pending Amount
     * - Search by student name
     */
    public function index(Request $request)
    {
        $today = now()->toDateString();
        $search = $request->input('search');

        $query = DB::table('users as u')
            ->join('payments as p', 'p.student_id', '=', 'u.id')
            ->join('batches as b', 'b.id', '=', 'p.batch_id')
            ->join('courses as c', 'c.id', '=', 'b.course_id')
            ->select(
                'u.id as student_id',
                DB::raw("CONCAT(u.first_name, ' ', u.last_name) as student_name"),
                'c.title as course_name',
                'c.course_fee',
                DB::raw('IFNULL(SUM(p.amount), 0) as total_paid'),
                DB::raw('(c.course_fee - IFNULL(SUM(p.amount), 0)) as pending_amount')
            )
            ->where('p.payment_date', '<=', $today)
            ->groupBy('u.id', 'c.id')
            ->orderBy('u.first_name');

        // 🔍 Full name search (fixed)
    if (!empty($search)) {
        $search = trim($search);
        $query->where(function ($q) use ($search) {
            $q->whereRaw("CONCAT(TRIM(u.first_name), ' ', TRIM(IFNULL(u.middle_name, '')), ' ', TRIM(u.last_name)) LIKE ?", ["%{$search}%"])
              ->orWhere('u.first_name', 'like', "%{$search}%")
              ->orWhere('u.middle_name', 'like', "%{$search}%")
              ->orWhere('u.last_name', 'like', "%{$search}%");
        });
    }
        $report = $query->get();

        return view('student_finance.index', compact('report', 'search'));
    }
}
