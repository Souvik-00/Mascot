<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Organisation;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('organisation')->get();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $organisations = Organisation::all();
        return view('students.create', compact('organisations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'organisation_id' => 'required|exists:organisations,id',
            'student_code' => 'required|string|max:50|unique:students,student_code',
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
            'joined_on' => 'nullable|date',
            'status' => 'required|in:active,inactive,alumni',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }

    public function edit(Student $student)
    {
        $organisations = Organisation::all();
        return view('students.edit', compact('student', 'organisations'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'organisation_id' => 'required|exists:organisations,id',
            'student_code' => 'required|string|max:50|unique:students,student_code,' . $student->id,
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
            'joined_on' => 'nullable|date',
            'status' => 'required|in:active,inactive,alumni',
        ]);

        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }


    public function search(Request $request)
    {
    $query = $request->input('query');

    $students = \App\Models\Student::with('organisation')
        ->when($query, function ($q) use ($query) {
            $q->where('first_name', 'like', "%{$query}%")
              ->orWhere('last_name', 'like', "%{$query}%")
              ->orWhere('email', 'like', "%{$query}%")
              ->orWhere('student_code', 'like', "%{$query}%");
        })
        ->orderBy('first_name')
        ->paginate(10);

    return view('students.search', compact('students', 'query'));
    }


    public function show($id)
    {
    $student = Student::with('organisation')->findOrFail($id);
    return view('students.show', compact('student'));
    }
}
