<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Classroom;
use App\Models\Organisation;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = Classroom::with(['organisation', 'batch'])->get();
        return view('classrooms.index', compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $organisations = Organisation::all();
        $batches = Batch::all();
        return view('classrooms.create', compact('organisations', 'batches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'organisation_id' => 'required|exists:organisations,id',
            'batch_id' => 'required|exists:batches,id',
            'class_code' => 'required|string|max:50|unique:classrooms,class_code',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration_hours' => 'nullable|integer|min:0',
            'max_students' => 'nullable|integer|min:1',
        ]);

        Classroom::create($validated);
        return redirect()->route('classrooms.index')->with('success', 'Classroom created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom)
    {
        $organisations = Organisation::all();
        $batches = Batch::all();
        return view('classrooms.edit', compact('classroom', 'organisations', 'batches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom)
    {
        $validated = $request->validate([
            'organisation_id' => 'required|exists:organisations,id',
            'batch_id' => 'required|exists:batches,id',
            'class_code' => 'required|string|max:50|unique:classrooms,class_code,' . $classroom->id,
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration_hours' => 'nullable|integer|min:0',
            'max_students' => 'nullable|integer|min:1',
        ]);

        $classroom->update($validated);
        return redirect()->route('classrooms.index')->with('success', 'Classroom updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        $classroom->delete();
        return redirect()->route('classrooms.index')->with('success', 'Classroom deleted successfully!');
    }
}
