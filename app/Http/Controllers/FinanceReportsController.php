<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinanceReportsController extends Controller
{
    public function index(Request $request)
    {
        // Input filters
        $departmentName = $request->input('department_name');
        $fromDate = $request->input('from_date', '2025-01-01');
        $toDate = $request->input('to_date', '2025-12-31');

        // Core query
        $payments = DB::table('department as d')
            ->join('courses as c', 'c.department_id', '=', 'd.id')
            ->join('batches as b', 'b.course_id', '=', 'c.id')
            ->join('payments as p', 'p.batch_id', '=', 'b.id')
            ->join('users as u', 'u.id', '=', 'p.student_id')
            ->select(
                'd.dept_name as department',
                'c.title as course',
                'b.title as batch',
                DB::raw("CONCAT(u.first_name, ' ', u.last_name) as student_name"),
                'p.amount',
                'p.payment_date',
                'p.payment_method',
                'p.transaction_id',
                DB::raw('p.amount AS total_payment_received')
            )
            ->when($departmentName, function ($query) use ($departmentName) {
                $query->where('d.dept_name', $departmentName);
            })
            ->whereBetween('p.payment_date', [$fromDate, $toDate])
            ->orderBy('p.payment_date', 'desc')
            ->get();

        // Grand total
        $grandTotal = $payments->sum('total_payment_received');

        // For department dropdown
        $departments = DB::table('department')->select('dept_name')->orderBy('dept_name')->get();

        return view('finance.reports', compact(
            'payments',
            'departments',
            'departmentName',
            'fromDate',
            'toDate',
            'grandTotal'
        ));
    }
}
