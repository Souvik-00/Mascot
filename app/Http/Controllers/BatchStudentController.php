<?php

namespace App\Http\Controllers;

use App\Models\BatchStudent;
use App\Models\Batch;
use App\Models\User;
use Illuminate\Http\Request;

class BatchStudentController extends Controller
{
    /**
     * Display a listing of all batch–student assignments.
     */
    public function index()
    {
        $assignments = BatchStudent::with(['batch', 'student'])->latest()->get();

        return view('batch_students.index', compact('assignments'));
    }

    /**
     * Show the form for creating a new assignment.
     */
    public function create()
    {
        $batches = Batch::orderBy('title')->get();
        $students = User::where('profile', 'student')->orderBy('first_name')->get();

        return view('batch_students.create', compact('batches', 'students'));
    }

    /**
     * Store a newly created assignment in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'batches_id' => 'required|exists:batches,id',
            'student_id' => 'required|exists:users,id',
        ]);

        // prevent duplicate
        $exists = BatchStudent::where('batches_id', $request->batches_id)
            ->where('student_id', $request->student_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Student is already assigned to this batch.');
        }

        BatchStudent::create([
            'batches_id' => $request->batches_id,
            'student_id' => $request->student_id,
        ]);

        return redirect()->route('batch_students.index')->with('success', 'Student successfully assigned to batch.');
    }

    /**
     * Show the form for editing an existing assignment.
     */
    public function edit($id)
    {
        $assignment = BatchStudent::findOrFail($id);
        $batches = Batch::orderBy('title')->get();
        $students = User::where('profile', 'student')->orderBy('first_name')->get();

        return view('batch_students.edit', compact('assignment', 'batches', 'students'));
    }

    /**
     * Update the specified assignment in the database.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'batches_id' => 'required|exists:batches,id',
            'student_id' => 'required|exists:users,id',
        ]);

        $assignment = BatchStudent::findOrFail($id);

        // prevent duplicate
        $exists = BatchStudent::where('batches_id', $request->batches_id)
            ->where('student_id', $request->student_id)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'This student is already assigned to that batch.');
        }

        $assignment->update([
            'batches_id' => $request->batches_id,
            'student_id' => $request->student_id,
        ]);

        return redirect()->route('batch_students.index')->with('success', 'Assignment updated successfully.');
    }

    /**
     * Remove the specified assignment from storage.
     */
    public function destroy($id)
    {
        $assignment = BatchStudent::findOrFail($id);
        $assignment->delete();

        return redirect()->back()->with('success', 'Assignment removed successfully.');
    }
}
