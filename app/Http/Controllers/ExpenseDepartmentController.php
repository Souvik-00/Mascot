<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;

class ExpenseDepartmentController extends Controller
{
    /**
     * Display the departmentwise expense report with date.
     */
    public function index(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $query = DB::table('expenses as e')
            ->leftJoin('expense_category_tbl as ecat', 'ecat.id', '=', 'e.category_id')
            ->leftJoin('expense_subcategory_tbl as esub', 'esub.id', '=', 'e.subcategory_id');

        if (Schema::hasColumn('expenses', 'department_id')) {
            $query->leftJoin('department as d', 'd.id', '=', 'e.department_id');
            $departmentExpression = 'COALESCE(d.dept_name, "Unassigned")';
        } elseif (Schema::hasColumn('expenses', 'batch_id')) {
            $query->leftJoin('batches as b', 'b.id', '=', 'e.batch_id')
                ->leftJoin('courses as c', 'c.id', '=', 'b.course_id')
                ->leftJoin('department as d', 'd.id', '=', 'c.department_id');
            $departmentExpression = 'COALESCE(d.dept_name, "Unassigned")';
        } else {
            $departmentExpression = "'Unassigned'";
        }

        $query->select(
            DB::raw($departmentExpression . ' as department'),
            'ecat.category_name as category',
            'esub.sub_category_name as subcategory',
            'e.expense_date',
            DB::raw('SUM(e.amount) as total_expense')
        );

        if ($fromDate && $toDate) {
            $query->whereBetween('e.expense_date', [$fromDate, $toDate]);
        } elseif ($fromDate) {
            $query->whereDate('e.expense_date', '>=', $fromDate);
        } elseif ($toDate) {
            $query->whereDate('e.expense_date', '<=', $toDate);
        }

        $reports = $query
            ->groupBy(
                DB::raw($departmentExpression),
                'ecat.category_name',
                'esub.sub_category_name',
                'e.expense_date'
            )
            ->havingRaw('SUM(e.amount) > 0')
            ->orderBy(DB::raw($departmentExpression), 'asc')
            ->orderBy('ecat.category_name', 'asc')
            ->orderBy('esub.sub_category_name', 'asc')
            ->orderBy('e.expense_date', 'desc')
            ->get();

        return view('department_expense.index', compact('reports', 'fromDate', 'toDate'));
    }
}
