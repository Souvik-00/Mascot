<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Teacher;
use App\Models\Schedule;
use App\Models\ClassSession;
use App\Models\Organisation;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::with(['organisation', 'batch', 'classSession', 'teacher'])->get();
        return view('schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $organisations = Organisation::all();
        $batches = Batch::all();
        $sessions = ClassSession::all();
        $teachers = Teacher::all();
        return view('schedules.create', compact('organisations', 'batches', 'sessions', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'organisation_id' => 'required|exists:organisations,id',
            'batch_id' => 'nullable|exists:batches,id',
            'class_session_id' => 'nullable|exists:class_sessions,id',
            'teacher_id' => 'nullable|exists:teachers,id',
            'scheduled_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'nullable',
            'room' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
        ]);

        Schedule::create($validated);
        return redirect()->route('schedules.index')->with('success', 'Schedule created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        $organisations = Organisation::all();
        $batches = Batch::all();
        $sessions = ClassSession::all();
        $teachers = Teacher::all();
        return view('schedules.edit', compact('schedule', 'organisations', 'batches', 'sessions', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'organisation_id' => 'required|exists:organisations,id',
            'batch_id' => 'nullable|exists:batches,id',
            'class_session_id' => 'nullable|exists:class_sessions,id',
            'teacher_id' => 'nullable|exists:teachers,id',
            'scheduled_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'nullable',
            'room' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
        ]);

        $schedule->update($validated);
        return redirect()->route('schedules.index')->with('success', 'Schedule updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedules.index')->with('success', 'Schedule deleted successfully!');
    }
}
