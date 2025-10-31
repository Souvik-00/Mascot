<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Batch;
use App\Models\ExpenseCategory;
use App\Models\ExpenseSubCategory;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the expenses.
     */
    public function index(Request $request)
    {
        $batches = Batch::orderBy('title')->get();

        $query = Expense::with(['batch', 'subcategory.category']);

        if ($request->filled('batch_id')) {
            $query->where('batch_id', $request->batch_id);
        }

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('expense_date', [$request->from_date, $request->to_date]);
        } elseif ($request->filled('from_date')) {
            $query->whereDate('expense_date', '>=', $request->from_date);
        } elseif ($request->filled('to_date')) {
            $query->whereDate('expense_date', '<=', $request->to_date);
        }

        $expenses = $query->orderBy('expense_date', 'desc')->paginate(10);

        return view('expenses.index', compact('expenses', 'batches'));
    }

    /**
     * Show the form for creating a new expense.
     */
    public function create()
    {
        $batches = Batch::orderBy('title')->get();
        $categories = ExpenseCategory::orderBy('category_name')->get();
        $subcategories = ExpenseSubCategory::orderBy('sub_category_name')->get();

        return view('expenses.create', compact('batches', 'categories', 'subcategories'));
    }

    /**
     * Store a newly created expense in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'batch_id' => 'nullable|exists:batches,id',
            'category_id' => 'required|exists:expense_category_tbl,id',
            'subcategory_id' => 'required|exists:expense_subcategory_tbl,id',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'payment_method' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        Expense::create([
            'batch_id' => $request->batch_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'amount' => $request->amount,
            'expense_date' => $request->expense_date,
            'payment_method' => $request->payment_method,
            'notes' => $request->notes,
        ]);

        return redirect()->route('expenses.index')->with('success', 'Expense added successfully.');
    }

    /**
     * Show the form for editing the specified expense.
     */
    public function edit(Expense $expense)
    {
        $batches = Batch::orderBy('title')->get();
        $categories = ExpenseCategory::orderBy('category_name')->get();

    // ✅ Use safe null check
    $categoryId = optional($expense->subcategory)->category_id;

    $subcategories = $categoryId
        ? ExpenseSubCategory::where('category_id', $categoryId)
            ->orderBy('sub_category_name')
            ->get()
        : collect(); // empty collection if null

    return view('expenses.edit', compact('expense', 'batches', 'categories', 'subcategories'));
    }

    /**
     * Update the specified expense in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'batch_id' => 'nullable|exists:batches,id',
            'category_id' => 'required|exists:expense_category_tbl,id',
            'subcategory_id' => 'required|exists:expense_subcategory_tbl,id',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'payment_method' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $expense->update([
            'batch_id' => $request->batch_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'amount' => $request->amount,
            'expense_date' => $request->expense_date,
            'payment_method' => $request->payment_method,
            'notes' => $request->notes,
        ]);

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }

    /**
     * Remove the specified expense from storage.
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }

    /**
     * AJAX: Fetch subcategories for selected category.
     */
    public function getSubcategories($categoryId)
    {
        $subcategories = ExpenseSubCategory::where('category_id', $categoryId)
            ->orderBy('sub_category_name')
            ->get();

        return response()->json($subcategories);
    }
}
