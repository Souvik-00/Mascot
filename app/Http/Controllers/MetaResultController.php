<?php

namespace App\Http\Controllers;

use App\Models\MetaResult;
use Illuminate\Http\Request;

class MetaResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results = MetaResult::orderBy('date', 'desc')->paginate(10);
        return view('meta_results.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('meta_results.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'link_clicks' => 'nullable|string|max:255',
            'cost_per_link_clicks' => 'nullable|string|max:255',
            'views' => 'nullable|string|max:255',
            'viewers' => 'nullable|string|max:255',
            'post_engagements' => 'nullable|string|max:255',
            'three_second_video_plays' => 'nullable|string|max:255',
            'post_reactions' => 'nullable|string|max:255',
            'estimated_call_confirmation_clicks' => 'nullable|string|max:255',
            'twenty_second_phone_calls' => 'nullable|string|max:255',
            'post_comments' => 'nullable|string|max:255',
            'post_shares' => 'nullable|string|max:255',
            'actual_call' => 'nullable|string|max:255',
        ]);

        MetaResult::create($validated);

        return redirect()->route('meta_results.index')->with('success', 'Meta result added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MetaResult $metaResult)
    {
        return view('meta_results.show', compact('metaResult'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MetaResult $metaResult)
    {
        return view('meta_results.edit', compact('metaResult'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MetaResult $metaResult)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'link_clicks' => 'nullable|string|max:255',
            'cost_per_link_clicks' => 'nullable|string|max:255',
            'views' => 'nullable|string|max:255',
            'viewers' => 'nullable|string|max:255',
            'post_engagements' => 'nullable|string|max:255',
            'three_second_video_plays' => 'nullable|string|max:255',
            'post_reactions' => 'nullable|string|max:255',
            'estimated_call_confirmation_clicks' => 'nullable|string|max:255',
            'twenty_second_phone_calls' => 'nullable|string|max:255',
            'post_comments' => 'nullable|string|max:255',
            'post_shares' => 'nullable|string|max:255',
            'actual_call' => 'nullable|string|max:255',
        ]);

        $metaResult->update($validated);

        return redirect()->route('meta_results.index')->with('success', 'Meta result updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MetaResult $metaResult)
    {
        $metaResult->delete();
        return redirect()->route('meta_results.index')->with('success', 'Meta result deleted successfully.');
    }
}
