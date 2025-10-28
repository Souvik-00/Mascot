<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\User;
use App\Models\BatchStudent;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;

class StudentAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $batches = Batch::orderBy('title')->get();

    $query = StudentAttendance::with(['student', 'batch']);

    if ($request->filled('batch_id')) {
        $query->where('batch_id', $request->batch_id);
    }

    // 🟢 Add date-range filter
    if ($request->filled('from_date') && $request->filled('to_date')) {
        $query->whereBetween('attendance_date', [$request->from_date, $request->to_date]);
    } elseif ($request->filled('from_date')) {
        $query->whereDate('attendance_date', '>=', $request->from_date);
    } elseif ($request->filled('to_date')) {
        $query->whereDate('attendance_date', '<=', $request->to_date);
    }

    $attendances = $query->orderBy('attendance_date', 'desc')->get();

    return view('student_attendance.index', compact('batches', 'attendances'));
    }

    public function create()
    {
        $batches = Batch::orderBy('title')->get();
        return view('student_attendance.create', compact('batches'));
    }

    public function getStudentsByBatch($batch_id)
    {
        $students = BatchStudent::with('student')
            ->where('batches_id', $batch_id)
            ->get()
            ->pluck('student');

        return response()->json($students);
    }

    public function store(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'attendance_date' => 'required|date',
            'attendance' => 'required|array',
        ]);

        foreach ($request->attendance as $student_id => $is_present) {
            StudentAttendance::updateOrCreate(
                [
                    'batch_id' => $request->batch_id,
                    'student_id' => $student_id,
                    'attendance_date' => $request->attendance_date,
                ],
                ['is_present' => $is_present ? true : false]
            );
        }

        return redirect()->route('student_attendance.index')->with('success', 'Attendance saved successfully.');
    }

    public function edit(Request $request)
    {
        $batches = Batch::orderBy('title')->get();
        $attendanceRecords = [];

        if ($request->filled('batch_id') && $request->filled('attendance_date')) {
            $attendanceRecords = StudentAttendance::with('student')
                ->where('batch_id', $request->batch_id)
                ->whereDate('attendance_date', $request->attendance_date)
                ->get();

            if ($attendanceRecords->isEmpty()) {
                $students = BatchStudent::with('student')
                    ->where('batches_id', $request->batch_id)
                    ->get()
                    ->pluck('student');

                $attendanceRecords = $students->map(function ($student) use ($request) {
                    return new StudentAttendance([
                        'student_id' => $student->id,
                        'batch_id' => $request->batch_id,
                        'attendance_date' => $request->attendance_date,
                        'is_present' => false,
                        'student' => $student,
                    ]);
                });
            }
        }

        return view('student_attendance.edit', compact('batches', 'attendanceRecords'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'attendance_date' => 'required|date',
            'attendance' => 'required|array',
        ]);

        foreach ($request->attendance as $student_id => $is_present) {
            StudentAttendance::updateOrCreate(
                [
                    'batch_id' => $request->batch_id,
                    'student_id' => $student_id,
                    'attendance_date' => $request->attendance_date,
                ],
                ['is_present' => $is_present ? true : false]
            );
        }

        return redirect()->route('student_attendance.index')->with('success', 'Attendance updated successfully.');
    }
}
