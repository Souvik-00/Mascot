<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Batch;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BatchController extends Controller
{
    public function index()
    {
        $batches = Batch::with('course')->orderByDesc('id')->paginate(10);
        return view('batches.index', compact('batches'));
    }

    public function search(Request $request)
    {
        $query = Batch::query();

        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('batch_code', 'like', "%{$search}%");
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $batches = $query->orderBy('id', 'desc')->paginate(10)->appends($request->query());
        return view('batches.search', compact('batches'));
    }

    public function create()
    {
        $courses = Course::orderBy('title')->get(['id', 'title']);
        return view('batches.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'batch_code' => ['required', 'regex:/^BT-\d{3}$/', 'unique:batches,batch_code'],
            'course_id'    => 'nullable|exists:courses,id',
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'capacity' => 'nullable|integer|min:1',
            'status' => 'required|in:planned,running,completed,cancelled',
        ], [
            'batch_code.regex' => 'Batch code must follow format BT-001.',
        ]);

        Batch::create($validated);
        return redirect()->route('batches.index')->with('success', 'Batch created successfully!');
    }

    public function edit(Batch $batch)
    {
        $courses = Course::orderBy('title')->get(['id', 'title']); // for dropdown
        return view('batches.edit', compact('batch', 'courses'));
    }

    public function update(Request $request, Batch $batch)
    {
        $validated = $request->validate([
            'batch_code' => [
                'required', 'regex:/^BT-\d{3}$/',
                Rule::unique('batches', 'batch_code')->ignore($batch->id),
            ],
            'course_id'    => 'nullable|exists:courses,id',
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
}
