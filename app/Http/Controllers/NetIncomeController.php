<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Department;

class NetIncomeController extends Controller
{
    public function index(Request $request)
    {
        // Date range filters
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        // Default to current month if not set
        if (!$fromDate || !$toDate) {
            $fromDate = now()->startOfMonth()->toDateString();
            $toDate = now()->endOfMonth()->toDateString();
        }

        $departments = Department::orderBy('dept_name')->get();
        $results = [];

        $grandPayment = 0;
        $grandExpense = 0;
        $grandNet = 0;

        foreach ($departments as $department) {
            // 💰 Total Payments in range
            $totalPayment = DB::table('payments as p')
                ->join('batches as b', 'b.id', '=', 'p.batch_id')
                ->join('courses as c', 'c.id', '=', 'b.course_id')
                ->join('department as d', 'd.id', '=', 'c.department_id')
                ->where('d.id', $department->id)
                ->whereBetween('p.payment_date', [$fromDate, $toDate])
                ->sum('p.amount');

            // 💸 Total Expenses in range
            $totalExpense = DB::table('expenses as e')
                ->join('batches as b', 'b.id', '=', 'e.batch_id')
                ->join('courses as c', 'c.id', '=', 'b.course_id')
                ->join('department as d', 'd.id', '=', 'c.department_id')
                ->where('d.id', $department->id)
                ->whereBetween('e.expense_date', [$fromDate, $toDate])
                ->sum('e.amount');

            // 🧮 Net Income
            $netIncome = $totalPayment - $totalExpense;

            $results[] = [
                'department' => $department->dept_name,
                'total_payment' => $totalPayment,
                'total_expense' => $totalExpense,
                'net_income' => $netIncome,
            ];

            $grandPayment += $totalPayment;
            $grandExpense += $totalExpense;
            $grandNet += $netIncome;
        }

        $grandTotal = [
            'grand_payment' => $grandPayment,
            'grand_expense' => $grandExpense,
            'grand_net' => $grandNet,
        ];

        return view('net_income.index', compact('results', 'fromDate', 'toDate', 'grandTotal'));
    }
}
