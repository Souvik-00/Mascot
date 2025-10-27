<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    public function index()
    {
        // Eager load department to show its name in the table
        $courses = Course::with('department')->orderByDesc('id')->paginate(15);
        return view('courses.index', compact('courses'));
    }

    public function search(Request $request)
    {
        $query = Course::query();

        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('class_code', 'like', "%{$search}%");
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $courses = $query->orderBy('id', 'desc')->paginate(10)->appends($request->query());

        return view('courses.search', compact('courses'));
    }

    public function create()
    {
         // For dropdown
        $departments = Department::orderBy('dept_name')->get(['id', 'dept_name']);
        return view('courses.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_code' => ['required', 'regex:/^CR-\d{3}$/', 'unique:courses,class_code'],
            'department_id'   => 'nullable|exists:department,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration_hours' => 'nullable|integer|min:0',
            'max_students' => 'nullable|integer|min:1',
            'status' => 'required|in:active,inactive',
        ], [
            'class_code.regex' => 'Class code must follow format CR-001.',
        ]);

        Course::create($validated);
        return redirect()->route('courses.index')->with('success', 'Course added successfully!');
    }

    public function edit(Course $course)
    {
        $departments = Department::orderBy('dept_name')->get(['id', 'dept_name']);
        return view('courses.edit', compact('course', 'departments'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'class_code' => [
                'required', 'regex:/^CR-\d{3}$/',
                Rule::unique('courses', 'class_code')->ignore($course->id)
            ],
            'department_id'   => 'nullable|exists:department,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration_hours' => 'nullable|integer|min:0',
            'max_students' => 'nullable|integer|min:1',
            'status' => 'required|in:active,inactive',
        ]);

        $course->update($validated);
        return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully!');
    }
}
