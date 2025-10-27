<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lead;
use Illuminate\Http\Request;
use App\Models\LeadsAttendance;

class LeadsAttendanceController extends Controller
{
    // Attendance history with from/to filter
    public function index(Request $request)
    {
        $from = $request->query('from_date');
        $to   = $request->query('to_date');

        $q = LeadsAttendance::with('lead')->orderByDesc('attn_date')->orderBy('lead_id');

        if ($from && $to) {
            $q->whereBetween('attn_date', [$from, $to]);
        }

        $records = $q->paginate(20);

        return view('leads_attendance.index', compact('records', 'from', 'to'));
    }

    // Date -> list all leads -> mark radios
    public function mark(Request $request)
    {
        $date = $request->query('date', Carbon::today()->toDateString());

        // Always list all leads; new leads appear automatically
        $leads = Lead::orderBy('name')->get(['id','name']);

        // existing attendance map for this date
        $attendance = LeadsAttendance::where('attn_date', $date)->get()->keyBy('lead_id');

        return view('leads_attendance.mark', compact('leads', 'attendance', 'date'));
    }

    // Save the marked attendance for a date
    public function store(Request $request)
    {
        $data = $request->validate([
            'attn_date'            => 'required|date',
            'attendance'           => 'array',       // attendance[lead_id] => present|absent
            'attendance.*'         => 'in:present,absent',
            'included_lead_ids'    => 'required|array',
            'included_lead_ids.*'  => 'integer',
        ]);

        $date       = $data['attn_date'];
        $rendered   = collect($data['included_lead_ids']);
        $submitted  = collect($data['attendance'] ?? []); // key: lead_id, val: status

        // 1) Upsert submitted radios
        foreach ($submitted as $leadId => $status) {
            LeadsAttendance::updateOrCreate(
                ['lead_id' => $leadId, 'attn_date' => $date],
                ['status'  => $status]
            );
        }

        // 2) Treat non-submitted as ABSENT (your chosen default)
        $notSubmitted = $rendered->diff($submitted->keys());
        foreach ($notSubmitted as $leadId) {
            LeadsAttendance::updateOrCreate(
                ['lead_id' => $leadId, 'attn_date' => $date],
                ['status'  => 'absent']
            );
        }

        return redirect()->route('leads_attendance.mark', ['date' => $date])
            ->with('success', 'Attendance saved for '.Carbon::parse($date)->format('d M Y'));
    }
}
