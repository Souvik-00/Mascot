<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\User;
use App\Models\BatchStudent;
use Illuminate\Http\Request;

class BatchStudentController extends Controller
{
    /**
     * Display assigned students + add form on same page.
     */
    public function index($batch_id)
    {
        $batch = Batch::findOrFail($batch_id);

        // Students already assigned to this batch
        $assignedStudents = BatchStudent::with('student')
            ->where('batches_id', $batch_id)
            ->get();

        // All students available for assignment
        $students = User::where('profile', 'student')
            ->orderBy('first_name')
            ->get(['id', 'first_name', 'last_name']);

        return view('batch_students.index', compact('batch', 'assignedStudents', 'students'));
    }

    /**
     * Show Create Form (separate page).
     */
    public function create($batch_id)
    {
        $batch = Batch::findOrFail($batch_id);

        $students = User::where('profile', 'student')
            ->orderBy('first_name')
            ->get(['id', 'first_name', 'last_name']);

        return view('batch_students.create', compact('batch', 'students'));
    }

    /**
     * Store a new student assignment.
     */
    public function store(Request $request, $batch_id)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
        ]);

        // Prevent duplicate assignment
        $exists = BatchStudent::where('batches_id', $batch_id)
                    ->where('student_id', $request->student_id)
                    ->exists();

        if ($exists) {
            return back()->with('error', 'This student is already assigned to this batch.');
        }

        BatchStudent::create([
            'batches_id' => $batch_id,
            'student_id' => $request->student_id,
        ]);

        return redirect()->route('batch.students.index', $batch_id)
                ->with('success', 'Student added to batch successfully.');
    }

    /**
     * Show Edit Form to change assigned student.
     */
    public function edit($batch_id, $id)
    {
        $batch = Batch::findOrFail($batch_id);
        $batchStudent = BatchStudent::findOrFail($id);

        $students = User::where('profile', 'student')
            ->orderBy('first_name')
            ->get(['id', 'first_name', 'last_name']);

        return view('batch_students.edit', compact('batch', 'batchStudent', 'students'));
    }

    /**
     * Update assigned student record.
     */
    public function update(Request $request, $batch_id, $id)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
        ]);

        $batchStudent = BatchStudent::findOrFail($id);

        // Prevent duplicate assignment
        $exists = BatchStudent::where('batches_id', $batch_id)
                    ->where('student_id', $request->student_id)
                    ->where('id', '!=', $id)
                    ->exists();

        if ($exists) {
            return back()->with('error', 'This student is already assigned to this batch.');
        }

        $batchStudent->update([
            'student_id' => $request->student_id,
        ]);

        return redirect()->route('batch.students.index', $batch_id)
                ->with('success', 'Student updated successfully.');
    }

    /**
     * Remove student from batch.
     */
    public function destroy($batch_id, $student_id)
    {
        BatchStudent::where('batches_id', $batch_id)
            ->where('student_id', $student_id)
            ->delete();

        return back()->with('success', 'Student removed from batch.');
    }
}
