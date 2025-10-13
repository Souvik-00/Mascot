<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Classroom;
use App\Models\ClassSession;
use App\Models\Organisation;
use Illuminate\Http\Request;

class ClassSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sessions = ClassSession::with(['organisation', 'classroom', 'teacher'])->get();
        return view('class_sessions.index', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $organisations = Organisation::all();
        $classrooms = Classroom::all();
        $teachers = Teacher::all();
        return view('class_sessions.create', compact('organisations', 'classrooms', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'organisation_id' => 'required|exists:organisations,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'teacher_id' => 'nullable|exists:teachers,id',
            'topic' => 'required|string|max:255',
            'session_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'nullable',
            'notes' => 'nullable|string',
        ]);

        ClassSession::create($validated);
        return redirect()->route('class-sessions.index')->with('success', 'Class session created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassSession $classSession)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassSession $classSession)
    {
        $organisations = Organisation::all();
        $classrooms = Classroom::all();
        $teachers = Teacher::all();
        return view('class_sessions.edit', compact('class_session', 'organisations', 'classrooms', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassSession $classSession)
    {
        $validated = $request->validate([
            'organisation_id' => 'required|exists:organisations,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'teacher_id' => 'nullable|exists:teachers,id',
            'topic' => 'required|string|max:255',
            'session_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'nullable',
            'notes' => 'nullable|string',
        ]);

        $class_session->update($validated);
        return redirect()->route('class-sessions.index')->with('success', 'Class session updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassSession $classSession)
    {
        $class_session->delete();
        return redirect()->route('class-sessions.index')->with('success', 'Class session deleted successfully!');
    }
}
