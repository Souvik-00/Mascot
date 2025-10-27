<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lead;
use App\Models\Batch;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\LeadsTrialStat;

class LeadsTrialStatController extends Controller
{
     /**
     * Display a listing of the resource
     */
    public function index(Request $request)
    {
        $query = LeadsTrialStat::with(['lead', 'course', 'batch']);

        // Manual date filter by user
        if ($request->filled('from_date') && $request->filled('to_date')) {
        $query->whereBetween('trl_start_dt', [$request->from_date, $request->to_date]);
        }

        $trials = $query->orderBy('id', 'DESC')->paginate(10);

        return view('leads_trial.index', compact('trials'));
    }

    /**
     * Show the form for creating a new resource
     */
    public function create($lead_id)
    {
        $lead = Lead::findOrFail($lead_id);
        $courses = Course::orderBy('title')->get();
        $batches = Batch::orderBy('title')->get();

        return view('leads_trial.create', compact('lead', 'courses', 'batches'));
    }

    /**
     * Store a newly created resource in storage
     */
    public function store(Request $request)
    {
        $request->validate([
            'leads_id'     => 'required|exists:leads_tbl,id',
            'trl_start_dt' => 'required|date',
            'course_id'    => 'required|exists:courses,id',
            'batch_id'     => 'required|exists:batches,id',
            'comments'     => 'required|string',
        ]);

        $start = Carbon::parse($request->trl_start_dt);

        LeadsTrialStat::create([
            'leads_id'     => $request->leads_id,
            'trl_start_dt' => $start,
            'trl_end_dt'   => $start->copy()->addMonth(),
            'course_id'    => $request->course_id,
            'batch_id'     => $request->batch_id,
            'comments'     => $request->comments,
        ]);

        return redirect()->route('leads_trial.index')->with('success', 'Lead Trial added successfully!');
    }

    /**
     * Show the form for editing the specified resource
     */
    public function edit($id)
    {
        $trial = LeadsTrialStat::findOrFail($id);
        $courses = Course::orderBy('title')->get();
        $batches = Batch::orderBy('title')->get();

        return view('leads_trial.edit', compact('trial', 'courses', 'batches'));
    }

    /**
     * Update the specified resource in storage
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'trl_start_dt' => 'required|date',
            'course_id'    => 'required|exists:courses,id',
            'batch_id'     => 'required|exists:batches,id',
            'comments'     => 'required|string',
        ]);

        $trial = LeadsTrialStat::findOrFail($id);
        $start = Carbon::parse($request->trl_start_dt);

        $trial->update([
            'trl_start_dt' => $start,
            'trl_end_dt'   => $start->copy()->addMonth(),
            'course_id'    => $request->course_id,
            'batch_id'     => $request->batch_id,
            'comments'     => $request->comments,
        ]);

        return redirect()->route('leads_trial.index')->with('success', 'Lead Trial updated successfully!');
    }

    /**
     * Remove the specified resource from storage
     */
    public function destroy($id)
    {
        $trial = LeadsTrialStat::findOrFail($id);
        $trial->delete();

        return redirect()->route('leads_trial.index')->with('success', 'Lead Trial deleted successfully!');
    }
}
