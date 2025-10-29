<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Lead;
use App\Models\BatchLead;
use App\Models\LeadAttendance;
use Illuminate\Http\Request;

class LeadAttendanceController extends Controller
{
    /**
     * Display the index with search/filter.
     */
    public function index(Request $request)
    {
        $batches = Batch::orderBy('title')->get();

        $query = LeadAttendance::with(['lead', 'batch']);

    if ($request->filled('batch_id')) {
        $query->where('batch_id', $request->batch_id);
    }

    // 🟢 Add date-to-date (range) filter
    if ($request->filled('from_date') && $request->filled('to_date')) {
        $query->whereBetween('attendance_date', [$request->from_date, $request->to_date]);
    } elseif ($request->filled('from_date')) {
        $query->whereDate('attendance_date', '>=', $request->from_date);
    } elseif ($request->filled('to_date')) {
        $query->whereDate('attendance_date', '<=', $request->to_date);
    }

    $attendances = $query->orderBy('attendance_date', 'desc')->get();

    return view('lead_attendance.index', compact('batches', 'attendances'));

    }

    /**
     * Show the create form.
     */
    public function create()
    {
        $batches = Batch::orderBy('title')->get();
        return view('lead_attendance.create', compact('batches'));
    }

    /**
     * Ajax endpoint to get leads for selected batch.
     */
    public function getLeadsByBatch($batch_id)
    {
        $leads = BatchLead::with('lead')
            ->where('batch_id', $batch_id)
            ->get()
            ->pluck('lead');

        return response()->json($leads);
    }

    /**
     * Store the attendance data.
     */
    public function store(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'attendance_date' => 'required|date',
            'attendance' => 'required|array',
        ]);

        foreach ($request->attendance as $lead_id => $is_present) {
            LeadAttendance::updateOrCreate(
                [
                    'batch_id' => $request->batch_id,
                    'lead_id' => $lead_id,
                    'attendance_date' => $request->attendance_date,
                ],
                ['is_present' => $is_present ? true : false]
            );
        }

        return redirect()->route('lead_attendance.index')->with('success', 'Attendance saved successfully.');
    }


    /**
 * Show attendance for editing by batch + date.
 */
public function edit(Request $request)
{
    $batches = Batch::orderBy('title')->get();
    $attendanceRecords = [];

    if ($request->filled('batch_id') && $request->filled('attendance_date')) {
        $attendanceRecords = LeadAttendance::with('lead')
            ->where('batch_id', $request->batch_id)
            ->whereDate('attendance_date', $request->attendance_date)
            ->get();

        // If attendance not yet marked for that date, load from BatchLead
        if ($attendanceRecords->isEmpty()) {
            $leads = BatchLead::with('lead')
                ->where('batch_id', $request->batch_id)
                ->get()
                ->pluck('lead');

            $attendanceRecords = $leads->map(function ($lead) use ($request) {
                return new LeadAttendance([
                    'lead_id' => $lead->id,
                    'batch_id' => $request->batch_id,
                    'attendance_date' => $request->attendance_date,
                    'is_present' => false,
                    'lead' => $lead,
                ]);
            });
        }
    }

    return view('lead_attendance.edit', compact('batches', 'attendanceRecords'));
}

/**
 * Update existing attendance records.
 */
public function update(Request $request)
{
    $request->validate([
        'batch_id' => 'required|exists:batches,id',
        'attendance_date' => 'required|date',
        'attendance' => 'required|array',
    ]);

    foreach ($request->attendance as $lead_id => $is_present) {
        LeadAttendance::updateOrCreate(
            [
                'batch_id' => $request->batch_id,
                'lead_id' => $lead_id,
                'attendance_date' => $request->attendance_date,
            ],
            ['is_present' => $is_present ? true : false]
        );
    }

    return redirect()->route('lead_attendance.index')->with('success', 'Attendance updated successfully.');
    }
}
