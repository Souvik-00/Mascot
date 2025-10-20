<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use App\Models\MarketingSource;

class LeadController extends Controller
{
    /**
     * Display a listing of the leads.
     */
    public function index()
    {
        $leads = Lead::with('marketingSource')->orderBy('id', 'desc')->paginate(10);
        return view('leads.index', compact('leads'));
    }

    /**
     * Show the form for creating a new lead.
     */
    public function create()
    {
        $sources = MarketingSource::orderBy('lead_source', 'asc')->get();
        return view('leads.create', compact('sources'));
    }

    /**
     * Store a newly created lead in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'location' => 'required|string',
            'phone_number' => 'required|string|max:16',
            'sex' => 'required|string|max:20',
            'date_of_contact' => 'required|date',
            'budget_range' => 'required|numeric|min:0',
            'authority' => 'required|string|max:20',
            'need' => 'required|string',
            'timeline' => 'required|string|max:25',
            'marketing_source_id' => 'required|exists:marketing_source_tbl,id',
        ]);

        Lead::create($validated);

        return redirect()->route('leads.index')->with('success', 'Lead added successfully.');
    }

    /**
     * Display the specified lead.
     */
    public function show(Lead $lead)
    {
        $lead->load('marketingSource');
        return view('leads.show', compact('lead'));
    }

    /**
     * Show the form for editing the specified lead.
     */
    public function edit(Lead $lead)
    {
        $sources = MarketingSource::orderBy('lead_source', 'asc')->get();
        return view('leads.edit', compact('lead', 'sources'));
    }

    /**
     * Update the specified lead in storage.
     */
    public function update(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'location' => 'required|string',
            'phone_number' => 'required|string|max:16',
            'sex' => 'required|string|max:20',
            'date_of_contact' => 'required|date',
            'budget_range' => 'required|numeric|min:0',
            'authority' => 'required|string|max:20',
            'need' => 'required|string',
            'timeline' => 'required|string|max:25',
            'marketing_source_id' => 'required|exists:marketing_source_tbl,id',
        ]);

        $lead->update($validated);

        return redirect()->route('leads.index')->with('success', 'Lead updated successfully.');
    }

    /**
     * Remove the specified lead from storage.
     */
    public function destroy(Lead $lead)
    {
        $lead->delete();
        return redirect()->route('leads.index')->with('success', 'Lead deleted successfully.');
    }
}
