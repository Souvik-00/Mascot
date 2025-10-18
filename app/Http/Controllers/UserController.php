<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
      // Admin: show new user form
    public function create()
    {
        return view('users.create');
    }

    // Admin: store new user
    public function store(Request $request)
    {
        $validated = $request->validate([
        'first_name' => 'required|string|max:100',
        'middle_name' => 'nullable|string|max:100',
        'last_name' => 'nullable|string|max:100',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6|confirmed',
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
        'profile' => 'nullable|in:student,teacher,admin,staff',
        'status' => 'required|in:active,inactive,lead,alumni,withdrawn',
    ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['enc_key'] = Str::random(32);

        User::create($validated);

        return redirect()->route('dashboard')->with('success', 'User created successfully.');

    }

        // Logged-in user: profile page
        public function profile()
        {
        $user = Auth::user();
        return view('users.profile', compact('user'));
        }
}
