<?php

namespace App\Http\Controllers;

use App\Models\BatchTeacher;
use App\Models\Batch;
use App\Models\User;
use Illuminate\Http\Request;

class BatchTeacherController extends Controller
{
    /**
     * Display a listing of the batch–teacher assignments.
     */
    public function index()
    {
        $assignments = BatchTeacher::with(['batch', 'teacher'])->latest()->get();

        return view('batch_teachers.index', compact('assignments'));
    }

    /**
     * Show the form for creating a new teacher assignment.
     */
    public function create()
    {
        $batches = Batch::orderBy('title')->get();
        $teachers = User::where('profile', 'teacher')->orderBy('first_name')->get();

        return view('batch_teachers.create', compact('batches', 'teachers'));
    }

    /**
     * Store a newly created teacher assignment.
     */
    public function store(Request $request)
    {
        $request->validate([
            'batches_id' => 'required|exists:batches,id',
            'teacher_id' => 'required|exists:users,id',
        ]);

        // Prevent duplicate assignment
        $exists = BatchTeacher::where('batches_id', $request->batches_id)
            ->where('teacher_id', $request->teacher_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'This teacher is already assigned to the selected batch.');
        }

        BatchTeacher::create([
            'batches_id' => $request->batches_id,
            'teacher_id' => $request->teacher_id,
        ]);

        return redirect()->route('batch_teachers.index')->with('success', 'Teacher assigned to batch successfully.');
    }

    /**
     * Show the form for editing an existing teacher assignment.
     */
    public function edit($id)
    {
        $assignment = BatchTeacher::findOrFail($id);
        $batches = Batch::orderBy('title')->get();
        $teachers = User::where('profile', 'teacher')->orderBy('first_name')->get();

        return view('batch_teachers.edit', compact('assignment', 'batches', 'teachers'));
    }

    /**
     * Update the specified teacher assignment.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'batches_id' => 'required|exists:batches,id',
            'teacher_id' => 'required|exists:users,id',
        ]);

        $assignment = BatchTeacher::findOrFail($id);

        // Prevent duplicate
        $exists = BatchTeacher::where('batches_id', $request->batches_id)
            ->where('teacher_id', $request->teacher_id)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'This teacher is already assigned to that batch.');
        }

        $assignment->update([
            'batches_id' => $request->batches_id,
            'teacher_id' => $request->teacher_id,
        ]);

        return redirect()->route('batch_teachers.index')->with('success', 'Teacher assignment updated successfully.');
    }

    /**
     * Remove a teacher assignment.
     */
    public function destroy($id)
    {
        $assignment = BatchTeacher::findOrFail($id);
        $assignment->delete();

        return redirect()->back()->with('success', 'Teacher assignment deleted successfully.');
    }
}
