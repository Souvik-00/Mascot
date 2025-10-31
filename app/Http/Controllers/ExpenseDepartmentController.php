<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ExpenseDepartmentController extends Controller
{
    /**
     * Display the departmentwise expense report with date.
     */
    public function index()
    {
        $reports = DB::table('department as d')
            ->join('courses as c', 'c.department_id', '=', 'd.id')
            ->join('batches as b', 'b.course_id', '=', 'c.id')
            ->join('expenses as e', 'e.batch_id', '=', 'b.id')
            ->leftJoin('expense_subcategory_tbl as esub', 'esub.id', '=', 'e.subcategory_id')
            ->leftJoin('expense_category_tbl as ecat', 'ecat.id', '=', 'esub.category_id')
            ->select(
                'd.dept_name as department',
                'ecat.category_name as category',
                'esub.sub_category_name as subcategory',
                'e.expense_date',
                DB::raw('COALESCE(SUM(e.amount), 0) as total_expense')
            )
            ->groupBy(
                'd.id',
                'd.dept_name',
                'ecat.id',
                'ecat.category_name',
                'esub.id',
                'esub.sub_category_name',
                'e.expense_date'
            )
            ->havingRaw('total_expense > 0')
            ->orderBy('d.dept_name', 'asc')
            ->orderBy('ecat.category_name', 'asc')
            ->orderBy('esub.sub_category_name', 'asc')
            ->orderBy('e.expense_date', 'desc')
            ->get();

        return view('department_expense.index', compact('reports'));
    }
}
