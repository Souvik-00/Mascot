<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Support\Facades\DB;

class ExpenseReportController extends Controller
{
    /**
     * Show simple list of all expenses with category, subcategory, date, and cost.
     */
    public function categoryWise()
    {
        $reports = Expense::query()
            ->join('expense_subcategory_tbl as esub', 'expenses.subcategory_id', '=', 'esub.id')
            ->join('expense_category_tbl as ecat', 'esub.category_id', '=', 'ecat.id')
            ->select(
                'ecat.category_name',
                'esub.sub_category_name',
                'expenses.expense_date',
                'expenses.amount'
            )
            ->orderBy('ecat.category_name', 'asc')
            ->orderBy('esub.sub_category_name', 'asc')
            ->orderBy('expenses.expense_date', 'desc')
            ->get();

        return view('categorywise_expense.index', compact('reports'));
    }
}
