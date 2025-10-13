<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Organisation;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('organisation')->get();
        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        $organisations = Organisation::all();
        return view('teachers.create', compact('organisations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'organisation_id' => 'required|exists:organisations,id',
            'teacher_code' => 'required|string|max:50|unique:teachers,teacher_code',
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

        Teacher::create($validated);

        return redirect()->route('teachers.index')->with('success', 'Teacher added successfully!');
    }

    public function edit(Teacher $teacher)
    {
        $organisations = Organisation::all();
        return view('teachers.edit', compact('teacher', 'organisations'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'organisation_id' => 'required|exists:organisations,id',
            'teacher_code' => 'required|string|max:50|unique:teachers,teacher_code,' . $teacher->id,
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
