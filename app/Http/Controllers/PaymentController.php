<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Batch;
use App\Models\Payment;
use App\Models\BatchStudent;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the payments.
     */
    public function index(Request $request)
    {
        $batches = Batch::orderBy('title')->get();

        $query = Payment::with(['student', 'batch']);

        // 🧠 Filters (optional)
        if ($request->filled('batch_id')) {
            $query->where('batch_id', $request->batch_id);
        }
        if ($request->filled('student_id')) {
            $query->where('student_id', $request->student_id);
        }
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('payment_date', [$request->from_date, $request->to_date]);
        } elseif ($request->filled('from_date')) {
            $query->whereDate('payment_date', '>=', $request->from_date);
        } elseif ($request->filled('to_date')) {
            $query->whereDate('payment_date', '<=', $request->to_date);
        }

        $payments = $query->orderBy('payment_date', 'desc')->paginate(10);

        return view('payments.index', compact('payments', 'batches'));
    }

    public function create(Request $request)
{
    $students = User::where('profile', 'student')->orderBy('first_name')->get();

    // Default: empty collection
    $batches = collect();

    // 🧠 If a student is selected, show only their batches
    if ($request->filled('student_id')) {
        $batchIds = BatchStudent::where('student_id', $request->student_id)->pluck('batches_id');
        $batches = Batch::whereIn('id', $batchIds)->orderBy('title')->get();
    } else {
        // Optional fallback: show all batches if no student selected
        $batches = Batch::orderBy('title')->get();
    }

    return view('payments.create', compact('students', 'batches'));
}

    /**
     * Store a newly created payment in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'batch_id' => 'nullable|exists:batches,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_method' => 'nullable|string|max:255',
            'transaction_id' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        Payment::create($request->all());

        return redirect()->route('payments.index')->with('success', 'Payment added successfully.');
    }

    public function edit(Request $request, Payment $payment)
{
    $students = User::where('profile', 'student')->orderBy('first_name')->get();

    // Default batches (empty or all)
    $batches = collect();

    // If a student is manually selected (via redirect param)
    if ($request->filled('student_id')) {
        $batchIds = BatchStudent::where('student_id', $request->student_id)->pluck('batches_id');
        $batches = Batch::whereIn('id', $batchIds)->orderBy('title')->get();
    } else {
        // Load batches related to this payment's current student
        $batchIds = BatchStudent::where('student_id', $payment->student_id)->pluck('batches_id');
        $batches = Batch::whereIn('id', $batchIds)->orderBy('title')->get();
    }

    return view('payments.edit', compact('payment', 'students', 'batches'));
}
    /**
     * Update the specified payment in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'batch_id' => 'nullable|exists:batches,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_method' => 'nullable|string|max:255',
            'transaction_id' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $payment->update($request->all());

        return redirect()->route('payments.index')->with('success', 'Payment updated successfully.');
    }

    /**
     * Remove the specified payment from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully.');
    }


    public function getBatchesForStudent($studentId)
{
    // Find batch IDs from the pivot table (note: column is "batches_id")
    $batchIds = BatchStudent::where('student_id', $studentId)->pluck('batches_id');

    // Return minimal fields for the dropdown
    $batches = Batch::whereIn('id', $batchIds)->orderBy('title')->get(['id', 'title']);

    return response()->json($batches);

}
}
