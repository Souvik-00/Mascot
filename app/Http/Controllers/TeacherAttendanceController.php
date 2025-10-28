<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\User;
use App\Models\BatchTeacher;
use App\Models\TeacherAttendance;
use Illuminate\Http\Request;

class TeacherAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $batches = Batch::orderBy('title')->get();
    $query = TeacherAttendance::with(['teacher', 'batch']);

    // 🟢 Filter by batch (optional)
    if ($request->filled('batch_id')) {
        $query->where('batch_id', $request->batch_id);
    }

    // 🟣 Date-to-date filtering
    if ($request->filled('from_date') && $request->filled('to_date')) {
        $query->whereBetween('attendance_date', [$request->from_date, $request->to_date]);
    } elseif ($request->filled('from_date')) {
        $query->whereDate('attendance_date', '>=', $request->from_date);
    } elseif ($request->filled('to_date')) {
        $query->whereDate('attendance_date', '<=', $request->to_date);
    }

    $attendances = $query->orderBy('attendance_date', 'desc')->get();

    return view('teacher_attendance.index', compact('batches', 'attendances'));
    }

    public function create()
    {
        $batches = Batch::orderBy('title')->get();
        return view('teacher_attendance.create', compact('batches'));
    }

    public function getTeachersByBatch($batch_id)
    {
        $teachers = BatchTeacher::with('teacher')
            ->where('batches_id', $batch_id)
            ->get()
            ->pluck('teacher');

        return response()->json($teachers);
    }

    public function store(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'attendance_date' => 'required|date',
            'attendance' => 'required|array',
        ]);

        foreach ($request->attendance as $teacher_id => $is_present) {
            TeacherAttendance::updateOrCreate(
                [
                    'batch_id' => $request->batch_id,
                    'teacher_id' => $teacher_id,
                    'attendance_date' => $request->attendance_date,
                ],
                ['is_present' => $is_present ? true : false]
            );
        }

        return redirect()->route('teacher_attendance.index')->with('success', 'Attendance saved successfully.');
    }

    public function edit(Request $request)
    {
        $batches = Batch::orderBy('title')->get();
        $attendanceRecords = [];

        if ($request->filled('batch_id') && $request->filled('attendance_date')) {
            $attendanceRecords = TeacherAttendance::with('teacher')
                ->where('batch_id', $request->batch_id)
                ->whereDate('attendance_date', $request->attendance_date)
                ->get();

            if ($attendanceRecords->isEmpty()) {
                $teachers = BatchTeacher::with('teacher')
                    ->where('batches_id', $request->batch_id)
                    ->get()
                    ->pluck('teacher');

                $attendanceRecords = $teachers->map(function ($teacher) use ($request) {
                    return new TeacherAttendance([
                        'teacher_id' => $teacher->id,
                        'batch_id' => $request->batch_id,
                        'attendance_date' => $request->attendance_date,
                        'is_present' => false,
                        'teacher' => $teacher,
                    ]);
                });
            }
        }

        return view('teacher_attendance.edit', compact('batches', 'attendanceRecords'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'attendance_date' => 'required|date',
            'attendance' => 'required|array',
        ]);

        foreach ($request->attendance as $teacher_id => $is_present) {
            TeacherAttendance::updateOrCreate(
                [
                    'batch_id' => $request->batch_id,
                    'teacher_id' => $teacher_id,
                    'attendance_date' => $request->attendance_date,
                ],
                ['is_present' => $is_present ? true : false]
            );
        }

        return redirect()->route('teacher_attendance.index')->with('success', 'Attendance updated successfully.');
    }
}
