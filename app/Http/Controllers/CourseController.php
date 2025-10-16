<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Organisation;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('organisation')->paginate(10);
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        $organisations = Organisation::all();
        return view('courses.create', compact('organisations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'organisation_id' => 'required|exists:organisations,id',
            'class_code' => 'required|string|max:50|unique:courses,class_code',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration_hours' => 'nullable|integer|min:1',
            'max_students' => 'nullable|integer|min:1',
            'status' => 'required|in:active,inactive',
        ]);

        Course::create($validated);
        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    public function edit(Course $course)
    {
        $organisations = Organisation::all();
        return view('courses.edit', compact('course', 'organisations'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'organisation_id' => 'required|exists:organisations,id',
            'class_code' => 'required|string|max:50|unique:courses,class_code,' . $course->id,
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration_hours' => 'nullable|integer|min:1',
            'max_students' => 'nullable|integer|min:1',
            'status' => 'required|in:active,inactive',
        ]);

        $course->update($validated);
        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $courses = Course::with('organisation')
            ->when($query, function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('class_code', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->orderBy('title')
            ->paginate(10);

        return view('courses.search', compact('courses', 'query'));
    }
}
