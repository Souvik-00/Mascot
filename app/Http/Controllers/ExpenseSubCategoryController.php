<?php

namespace App\Http\Controllers;

use App\Models\ExpenseSubCategory;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = ExpenseSubCategory::with('category')
            ->orderBy('sub_category_name')
            ->get();

        return view('expense_subcategory.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ExpenseCategory::orderBy('category_name')->get();
        return view('expense_subcategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:expense_category_tbl,id',
            'sub_category_name' => 'required|string|max:255|unique:expense_subcategory_tbl,sub_category_name',
        ]);

        ExpenseSubCategory::create([
            'category_id' => $request->category_id,
            'sub_category_name' => $request->sub_category_name,
        ]);

        return redirect()->route('expense_subcategory.index')
                         ->with('success', 'Expense subcategory added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExpenseSubCategory $expenseSubcategory)
    {
        $categories = ExpenseCategory::orderBy('category_name')->get();
        return view('expense_subcategory.edit', compact('expenseSubcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExpenseSubCategory $expenseSubcategory)
    {
        $request->validate([
            'category_id' => 'required|exists:expense_category_tbl,id',
            'sub_category_name' => 'required|string|max:255|unique:expense_subcategory_tbl,sub_category_name,' . $expenseSubcategory->id,
        ]);

        $expenseSubcategory->update([
            'category_id' => $request->category_id,
            'sub_category_name' => $request->sub_category_name,
        ]);

        return redirect()->route('expense_subcategory.index')
                         ->with('success', 'Expense subcategory updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExpenseSubCategory $expenseSubcategory)
    {
        $expenseSubcategory->delete();

        return redirect()->route('expense_subcategory.index')
                         ->with('success', 'Expense subcategory deleted successfully.');
    }
}
