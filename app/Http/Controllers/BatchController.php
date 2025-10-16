<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Organisation;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function index()
    {
        $batches = Batch::with('organisation')->get();
        return view('batches.index', compact('batches'));
    }

    public function create()
    {
        $organisations = Organisation::all();
        return view('batches.create', compact('organisations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'organisation_id' => 'required|exists:organisations,id',
            'batch_code' => 'required|string|max:50|unique:batches,batch_code',
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'capacity' => 'nullable|integer|min:1',
            'status' => 'required|in:planned,running,completed,cancelled',
        ]);

        Batch::create($validated);

        return redirect()->route('batches.index')->with('success', 'Batch created successfully!');
    }

    public function edit(Batch $batch)
    {
        $organisations = Organisation::all();
        return view('batches.edit', compact('batch', 'organisations'));
    }

    public function update(Request $request, Batch $batch)
    {
        $validated = $request->validate([
            'organisation_id' => 'required|exists:organisations,id',
            'batch_code' => 'required|string|max:50|unique:batches,batch_code,' . $batch->id,
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'capacity' => 'nullable|integer|min:1',
            'status' => 'required|in:planned,running,completed,cancelled',
        ]);

        $batch->update($validated);

        return redirect()->route('batches.index')->with('success', 'Batch updated successfully!');
    }

    public function destroy(Batch $batch)
    {
        $batch->delete();
        return redirect()->route('batches.index')->with('success', 'Batch deleted successfully!');
    }


     public function search(Request $request)
    {
        $query = $request->input('query');

        $batches = Batch::with('organisation')
            ->when($query, function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('batch_code', 'like', "%{$query}%");
            })
            ->orderBy('start_date', 'desc')
            ->paginate(10);

        return view('batches.search', compact('batches', 'query'));
    }
}
