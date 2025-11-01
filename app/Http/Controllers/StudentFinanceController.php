<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentFinanceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = DB::table('users as u')
            ->join('payments as p', 'u.id', '=', 'p.student_id')
            ->join('batches as b', 'b.id', '=', 'p.batch_id')
            ->join('courses as c', 'c.id', '=', 'b.course_id')
            ->select(
                DB::raw("CONCAT(u.first_name, ' ', COALESCE(u.middle_name, ''), ' ', u.last_name) AS student_name"),
                'c.title as course_name',
                'c.course_fee',
                DB::raw('SUM(p.amount) as total_paid'),
                DB::raw('(c.course_fee - SUM(p.amount)) as pending_amount'),
                'u.id as student_id'
            )
            ->where('u.profile', 'student')
            ->groupBy('u.id', 'u.first_name', 'u.middle_name', 'u.last_name', 'c.title', 'c.course_fee');

        // 🔍 Full name search
        if (!empty($search)) {
            $query->whereRaw("CONCAT(u.first_name, ' ', COALESCE(u.middle_name, ''), ' ', u.last_name) LIKE ?", ["%{$search}%"]);
        }

        $report = $query->get();

        return view('student_finance.index', compact('report', 'search'));
    }

    /**
     * Show detailed payment history for a student
     */
    public function showPayments($student_id)
    {
        $studentPayments = DB::table('payments as p')
            ->join('batches as b', 'b.id', '=', 'p.batch_id')
            ->join('courses as c', 'c.id', '=', 'b.course_id')
            ->join('users as u', 'u.id', '=', 'p.student_id')
            ->select(
                DB::raw("CONCAT(u.first_name, ' ', COALESCE(u.middle_name, ''), ' ', u.last_name) AS student_name"),
                'c.title as course_name',
                'b.title as batch_name',
                'p.amount',
                'p.payment_date',
                'p.payment_method',
                'p.transaction_id',
                'p.notes'
            )
            ->where('p.student_id', $student_id)
            ->orderBy('p.payment_date', 'desc')
            ->get();

        if ($studentPayments->isEmpty()) {
            return redirect()->route('student_finance.index')->with('error', 'No payments found for this student.');
        }

        $studentName = $studentPayments->first()->student_name;

        return view('student_finance.payments', compact('studentPayments', 'studentName'));
    }
}
