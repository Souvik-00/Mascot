<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MarketingSource;

class MarketingSourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sources = MarketingSource::orderBy('id', 'desc')->paginate(10);
        return view('marketing_sources.index', compact('sources'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('marketing_sources.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'lead_source' => 'required|string|max:20|unique:marketing_source_tbl,lead_source',
        ]);

        MarketingSource::create($validated);

        return redirect()->route('marketing_sources.index')->with('success', 'Marketing source added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MarketingSource $marketing_source)
    {
        return view('marketing_sources.show', compact('marketing_source'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MarketingSource $marketing_source)
    {
        return view('marketing_sources.edit', compact('marketing_source'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MarketingSource $marketing_source)
    {
        $validated = $request->validate([
        'lead_source' => 'required|string|max:20|unique:marketing_source_tbl,lead_source,' . $marketing_source->id,
        ]);

        $marketing_source->update($validated);

        return redirect()->route('marketing_sources.index')->with('success', 'Marketing source updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MarketingSource $marketing_source)
    {
        $marketing_source->delete();

        return redirect()->route('marketing_sources.index')->with('success', 'Marketing source deleted successfully.');
    }
}
