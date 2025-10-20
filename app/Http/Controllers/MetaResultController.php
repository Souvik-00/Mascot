<?php

namespace App\Http\Controllers;

use App\Models\MetaResult;
use Illuminate\Http\Request;

class MetaResultController extends Controller
{
    /**
     * Display a listing of Meta Results.
     */
    public function index()
    {
        $results = MetaResult::orderBy('date', 'desc')->paginate(10);
        return view('meta_results.index', compact('results'));
    }

    /**
     * Show the form for creating a new Meta Result.
     */
    public function create()
    {
        return view('meta_results.create');
    }

    /**
     * Store a newly created Meta Result in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'link_clicks' => 'nullable|numeric',
            'cost_per_link_clicks' => 'nullable|numeric',
            'views' => 'nullable|numeric',
            'viewers' => 'nullable|numeric',
            'post_engagements' => 'nullable|numeric',
            'three_second_video_plays' => 'nullable|numeric',
            'post_reactions' => 'nullable|numeric',
            'estimated_call_confirmation_clicks' => 'nullable|numeric',
            'twenty_second_phone_calls' => 'nullable|numeric',
            'post_comments' => 'nullable|numeric',
            'post_shares' => 'nullable|numeric',
            'actual_call' => 'nullable|numeric',
        ]);

        MetaResult::create($validated);

        return redirect()->route('meta_results.index')->with('success', 'Meta Result added successfully.');
    }

    /**
     * Display the specified Meta Result.
     */
    public function show(MetaResult $metaResult)
    {
        return view('meta_results.show', compact('metaResult'));
    }

    /**
     * Show the form for editing the specified Meta Result.
     */
    public function edit(MetaResult $metaResult)
    {
        return view('meta_results.edit', compact('metaResult'));
    }

    /**
     * Update the specified Meta Result in storage.
     */
    public function update(Request $request, MetaResult $metaResult)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'link_clicks' => 'nullable|numeric',
            'cost_per_link_clicks' => 'nullable|numeric',
            'views' => 'nullable|numeric',
            'viewers' => 'nullable|numeric',
            'post_engagements' => 'nullable|numeric',
            'three_second_video_plays' => 'nullable|numeric',
            'post_reactions' => 'nullable|numeric',
            'estimated_call_confirmation_clicks' => 'nullable|numeric',
            'twenty_second_phone_calls' => 'nullable|numeric',
            'post_comments' => 'nullable|numeric',
            'post_shares' => 'nullable|numeric',
            'actual_call' => 'nullable|numeric',
        ]);

        $metaResult->update($validated);

        return redirect()->route('meta_results.index')->with('success', 'Meta Result updated successfully.');
    }

    /**
     * Remove the specified Meta Result from storage.
     */
    public function destroy(MetaResult $metaResult)
    {
        $metaResult->delete();
        return redirect()->route('meta_results.index')->with('success', 'Meta Result deleted successfully.');
    }
}
