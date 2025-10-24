<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use App\Models\CrmPipelineStage;
use App\Models\LeadConversionStat;

class LeadConversionStatController extends Controller
{
    /**
     * Display a listing of the lead conversion records.
     */
    public function index()
    {
        $stats = LeadConversionStat::with(['lead', 'pipelineStage'])
                ->orderBy('leads_id')
                ->orderBy('date', 'asc') // oldest first, latest last
                ->paginate(10);

    return view('lead_conversion_stats.index', compact('stats'));
    }

    /**
     * Show the form for creating a new record.
     */
    public function create()
    {
        $leads = Lead::orderBy('name', 'asc')->get();
        $stages = CrmPipelineStage::orderBy('crm_pipeline_stages', 'asc')->get();

        return view('lead_conversion_stats.create', compact('leads', 'stages'));
    }

    /**
     * Store a newly created record in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'leads_id' => 'required|exists:leads_tbl,id',
            'date' => 'required|date',
            'crm_pipeline_stages_id' => 'required|exists:crm_pipeline_stages_tbl,id',
            'comments' => 'required|string',
        ]);

        LeadConversionStat::create($validated);

        return redirect()->route('lead_conversion_stats.index')
            ->with('success', 'Lead conversion record added successfully.');
    }

    /**
     * Display the specified record.
     */
    public function show(LeadConversionStat $lead_conversion_stat)
    {
        $lead_conversion_stat->load(['lead', 'pipelineStage']);
        return view('lead_conversion_stats.show', compact('lead_conversion_stat'));
    }

    /**
     * Show the form for editing the specified record.
     */
    public function edit(LeadConversionStat $lead_conversion_stat)
    {
        $leads = Lead::orderBy('name', 'asc')->get();
        $stages = CrmPipelineStage::orderBy('crm_pipeline_stages', 'asc')->get();

        return view('lead_conversion_stats.edit', compact('lead_conversion_stat', 'leads', 'stages'));
    }

    /**
     * Update the specified record in storage.
     */
    public function update(Request $request, LeadConversionStat $lead_conversion_stat)
    {
    $validated = $request->validate([
        'leads_id' => 'required|exists:leads_tbl,id',
        'date' => 'required|date',
        'crm_pipeline_stages_id' => 'required|exists:crm_pipeline_stages_tbl,id',
        'comments' => 'required|string',
    ]);

    // Instead of updating existing record, insert a new record
    LeadConversionStat::create($validated);

    return redirect()->route('lead_conversion_stats.index')
        ->with('success', 'Lead conversion updated. Previous version retained.');
    }

    /**
     * Remove the specified record from storage.
     */
    public function destroy(LeadConversionStat $lead_conversion_stat)
    {
        $lead_conversion_stat->delete();

        return redirect()->route('lead_conversion_stats.index')
            ->with('success', 'Lead conversion record deleted successfully.');
    }
}
