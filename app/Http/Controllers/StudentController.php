<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Organisation;
use Illuminate\Http\Request;

class StudentController extends Controller
{
     /**
     * Display a listing of students (with search & filter)
     */
    public function index(Request $request)
    {
    $students = \App\Models\Student::latest()->paginate(10);
    return view('students.index', compact('students'));
}

    public function search(Request $request)
    {
    $query = \App\Models\Student::query();

    // Search by code, name
    if ($search = $request->input('search')) {
        $query->where(function ($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
              ->orWhere('last_name', 'like', "%{$search}%")
              ->orWhere('student_code', 'like', "%{$search}%");
        });
    }

    // Filter by status
    if ($status = $request->input('status')) {
        $query->where('status', $status);
    }

    $students = $query->orderBy('id', 'desc')->paginate(10)->appends($request->query());

    return view('students.search', compact('students'));
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        $organisation = Organisation::first(); // Static organisation setup
        return view('students.create', compact('organisation'));
    }

    /**
     * Store a newly created student.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // 'organisation_id' => 'required|exists:organisations,id',
            'student_code' => [
                'required',
                'string',
                'max:50',
                'unique:students,student_code',
                'regex:/^ST-\d{3}$/',
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
            'joined_on' => 'nullable|date',
            'status' => 'required|in:active,inactive,lead,alumni,withdrawn',
        ], [
            'student_code.regex' => 'Student code must follow format ST-001.',
            'student_code.unique' => 'This student code already exists.',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }

    /**
     * Show the form for editing a student.
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $organisation = Organisation::first();
        return view('students.edit', compact('student', 'organisation'));
    }

    /**
     * Update an existing student.
     */
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'organisation_id' => 'required|exists:organisations,id',
            'student_code' => [
                'required',
                'regex:/^ST-\d{3}$/',
                Rule::unique('students', 'student_code')->ignore($student->id),
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
            'joined_on' => 'nullable|date',
            'status' => 'required|in:active,inactive,lead,alumni,withdrawn',
        ], [
            'student_code.regex' => 'Format must be like ST-001.',
            'student_code.unique' => 'This student code already exists.',
        ]);

        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    /**
     * Delete a student.
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}
