<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    /**
     * Display all teacher users.
     */
    public function index()
    {
        $teachers = User::where('profile', 'teacher')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('teachers.index', compact('teachers'));
    }

    /**
     * Display search results for teachers.
     */
    public function search(Request $request)
    {
        $query = $request->input('q');

        $teachers = User::where('profile', 'teacher')
            ->where(function ($q) use ($query) {
                $q->where('first_name', 'like', "%{$query}%")
                  ->orWhere('last_name', 'like', "%{$query}%")
                  ->orWhere('email', 'like', "%{$query}%")
                  ->orWhere('phone', 'like', "%{$query}%")
                  ->orWhere('aadhar_no', 'like', "%{$query}%");
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('teachers.search', compact('teachers', 'query'));
    }
}
