<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Organisation;
use Illuminate\Http\Request;

class StudentController extends Controller
{
     /**
     * Display all student users.
     */
    public function index()
    {
        $students = User::where('profile', 'student')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('students.index', compact('students'));
    }

    /**
     * Display search results for students.
     */
    public function search(Request $request)
    {
        $query = $request->input('q');

        $students = User::where('profile', 'student')
            ->where(function ($q) use ($query) {
                $q->where('first_name', 'like', "%{$query}%")
                  ->orWhere('last_name', 'like', "%{$query}%")
                  ->orWhere('email', 'like', "%{$query}%")
                  ->orWhere('phone', 'like', "%{$query}%")
                  ->orWhere('aadhar_no', 'like', "%{$query}%");
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('students.search', compact('students', 'query'));
    }
}
