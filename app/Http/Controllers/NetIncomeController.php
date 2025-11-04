<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Department;

class NetIncomeController extends Controller
{
    public function index(Request $request)
    {
        // 📅 Date Range
        $fromDate = $request->input('from_date');
        $toDate   = $request->input('to_date');

        if ($fromDate && !$toDate) $toDate = $fromDate;
        if ($toDate && !$fromDate) $fromDate = $toDate;

        if (!$fromDate && !$toDate) {
            $fromDate = now()->startOfMonth()->toDateString();
            $toDate   = now()->endOfMonth()->toDateString();
        }

        // 🏫 Departmentwise Payments
        $departments = Department::orderBy('dept_name')->get();
        $results = [];
        $grandPayment = 0;

        foreach ($departments as $dept) {
            $totalPayment = DB::table('payments as p')
                ->join('batches as b', 'b.id', '=', 'p.batch_id')
                ->join('courses as c', 'c.id', '=', 'b.course_id')
                ->join('department as d', 'd.id', '=', 'c.department_id')
                ->where('d.id', $dept->id)
                ->whereBetween('p.payment_date', [$fromDate, $toDate])
                ->sum('p.amount');

            $results[] = [
                'department' => $dept->dept_name,
                'total_payment' => $totalPayment,
            ];

            $grandPayment += $totalPayment;
        }

        // 💸 Total Expense (All Departments Combined)
        $totalExpense = DB::table('expenses')
            ->whereBetween('expense_date', [$fromDate, $toDate])
            ->sum('amount');

        // 🧮 Net Income (Balance)
        $netIncome = $grandPayment - $totalExpense;

        return view('net_income.index', compact(
            'results', 'fromDate', 'toDate', 'grandPayment', 'totalExpense', 'netIncome'
        ));
    }
}
