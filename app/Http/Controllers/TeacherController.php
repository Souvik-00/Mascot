<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::latest()->paginate(10);
        return view('teachers.index', compact('teachers'));
    }

    public function search(Request $request)
    {
        $query = Teacher::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('teacher_code', 'like', "%{$search}%");
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $teachers = $query->latest()->paginate(10)->appends($request->query());

        return view('teachers.search', compact('teachers'));
    }

    public function create()
    {
        return view('teachers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'teacher_code' => ['required', 'regex:/^TC-\d{3}$/', 'unique:teachers,teacher_code'],
            'first_name' => 'required|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:100',
            'phone' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'father_name' => 'nullable|string|max:100',
            'mother_name' => 'nullable|string|max:100',
            'marital_status' => 'nullable|in:single,married,divorced,widowed,separated',
            'spouse_name' => 'nullable|string|max:100',
            'current_address' => 'nullable|string',
            'permanent_address' => 'nullable|string',
            'voter_id_card_no' => 'nullable|string|max:50',
            'pan_card_no' => 'nullable|string|max:50',
            'aadhar_no' => 'nullable|string|max:50',
            'highest_qualification' => 'nullable|in:matriculation,higher_secondary,graduation,masters,phd',
            'specialization' => 'nullable|string|max:150',
            'joined_on' => 'nullable|date',
            'status' => 'required|in:active,inactive',
        ], [
            'teacher_code.regex' => 'Teacher code must follow format TC-001.',
        ]);

        Teacher::create($validated);

        return redirect()->route('teachers.index')->with('success', 'Teacher added successfully!');
    }

    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'teacher_code' => [
                'required', 'regex:/^TC-\d{3}$/',
                Rule::unique('teachers', 'teacher_code')->ignore($teacher->id)
            ],
            'first_name' => 'required|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:100',
            'phone' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'father_name' => 'nullable|string|max:100',
            'mother_name' => 'nullable|string|max:100',
            'marital_status' => 'nullable|in:single,married,divorced,widowed,separated',
            'spouse_name' => 'nullable|string|max:100',
            'current_address' => 'nullable|string',
            'permanent_address' => 'nullable|string',
            'voter_id_card_no' => 'nullable|string|max:50',
            'pan_card_no' => 'nullable|string|max:50',
            'aadhar_no' => 'nullable|string|max:50',
            'highest_qualification' => 'nullable|in:matriculation,higher_secondary,graduation,masters,phd',
            'specialization' => 'nullable|string|max:150',
            'joined_on' => 'nullable|date',
            'status' => 'required|in:active,inactive',
        ]);

        $teacher->update($validated);

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully!');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully!');
    }
}
