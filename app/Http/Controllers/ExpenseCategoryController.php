<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of expense categories.
     */
    public function index()
    {
        $categories = ExpenseCategory::orderBy('category_name')->get();
        return view('expense_category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('expense_category.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:expense_category_tbl,category_name',
        ]);

        ExpenseCategory::create([
            'category_name' => $request->category_name,
        ]);

        return redirect()->route('expense_category.index')
                         ->with('success', 'Expense category added successfully.');
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(ExpenseCategory $expenseCategory)
    {
        return view('expense_category.edit', compact('expenseCategory'));
    }

    /**
     * Update the specified category.
     */
    public function update(Request $request, ExpenseCategory $expenseCategory)
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:expense_category_tbl,category_name,' . $expenseCategory->id,
        ]);

        $expenseCategory->update([
            'category_name' => $request->category_name,
        ]);

        return redirect()->route('expense_category.index')
                         ->with('success', 'Expense category updated successfully.');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(ExpenseCategory $expenseCategory)
    {
        $expenseCategory->delete();

        return redirect()->route('expense_category.index')
                         ->with('success', 'Expense category deleted successfully.');
    }
}