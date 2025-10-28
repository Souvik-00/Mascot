<?php

namespace App\Http\Controllers;

use App\Models\BatchLead;
use App\Models\Batch;
use App\Models\Lead;
use Illuminate\Http\Request;

class BatchLeadController extends Controller
{
    /**
     * Display a listing of all batch–lead assignments.
     */
    public function index()
    {
        $assignments = BatchLead::with(['batch', 'lead'])->latest()->get();

        return view('batch_leads.index', compact('assignments'));
    }

    /**
     * Show the form for creating a new batch–lead assignment.
     */
    public function create()
    {
        $batches = Batch::orderBy('title')->get();
        $leads = Lead::orderBy('name')->get();

        return view('batch_leads.create', compact('batches', 'leads'));
    }

    /**
     * Store a new batch–lead assignment.
     */
    public function store(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'lead_id' => 'required|exists:leads_tbl,id',
        ]);

        $exists = BatchLead::where('batch_id', $request->batch_id)
            ->where('lead_id', $request->lead_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'This lead is already assigned to the selected batch.');
        }

        BatchLead::create([
            'batch_id' => $request->batch_id,
            'lead_id' => $request->lead_id,
        ]);

        return redirect()->route('batch_leads.index')->with('success', 'Lead assigned to batch successfully.');
    }

    /**
     * Show the form for editing a batch–lead assignment.
     */
    public function edit($id)
    {
        $assignment = BatchLead::findOrFail($id);
        $batches = Batch::orderBy('title')->get();
        $leads = Lead::orderBy('name')->get();

        return view('batch_leads.edit', compact('assignment', 'batches', 'leads'));
    }

    /**
     * Update the specified batch–lead assignment.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'lead_id' => 'required|exists:leads_tbl,id',
        ]);

        $assignment = BatchLead::findOrFail($id);

        $exists = BatchLead::where('batch_id', $request->batch_id)
            ->where('lead_id', $request->lead_id)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'This lead is already assigned to that batch.');
        }

        $assignment->update([
            'batch_id' => $request->batch_id,
            'lead_id' => $request->lead_id,
        ]);

        return redirect()->route('batch_leads.index')->with('success', 'Lead assignment updated successfully.');
    }

    /**
     * Remove the specified batch–lead assignment.
     */
    public function destroy($id)
    {
        $assignment = BatchLead::findOrFail($id);
        $assignment->delete();

        return redirect()->back()->with('success', 'Lead assignment deleted successfully.');
    }
}
