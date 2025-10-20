<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CrmPipelineStage;

class CrmPipelineStageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stages = CrmPipelineStage::orderBy('id', 'desc')->paginate(10);
        return view('crm_pipeline_stages.index', compact('stages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('crm_pipeline_stages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'crm_pipeline_stages' => 'required|string|max:64|unique:crm_pipeline_stages_tbl,crm_pipeline_stages',
            'what_it_means'       => 'required|string',
            'enter_when'          => 'required|string',
            'exit_when'           => 'required|string',
            'owner'               => 'required|string',
        ]);

        CrmPipelineStage::create($validated);

        return redirect()->route('crm_pipeline_stages.index')->with('success', 'Pipeline stage added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CrmPipelineStage $crm_pipeline_stage)
    {
        return view('crm_pipeline_stages.show', compact('crm_pipeline_stage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CrmPipelineStage $crm_pipeline_stage)
    {
        return view('crm_pipeline_stages.edit', compact('crm_pipeline_stage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CrmPipelineStage $crm_pipeline_stage)
    {
        $validated = $request->validate([
            'crm_pipeline_stages' => 'required|string|max:64|unique:crm_pipeline_stages_tbl,crm_pipeline_stages,' . $crm_pipeline_stage->id,
            'what_it_means'       => 'required|string',
            'enter_when'          => 'required|string',
            'exit_when'           => 'required|string',
            'owner'               => 'required|string',
        ]);

        $crm_pipeline_stage->update($validated);

        return redirect()->route('crm_pipeline_stages.index')->with('success', 'Pipeline stage updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CrmPipelineStage $crm_pipeline_stage)
    {
        $crm_pipeline_stage->delete();

        return redirect()->route('crm_pipeline_stages.index')->with('success', 'Pipeline stage deleted successfully.');
    }
}
