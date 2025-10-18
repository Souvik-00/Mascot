<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of all users.
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Display search results on a separate page.
     */
    public function search(Request $request)
    {
        $query = $request->input('q');

        $users = User::query()
            ->where('first_name', 'like', "%{$query}%")
            ->orWhere('last_name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->orWhere('phone', 'like', "%{$query}%")
            ->orWhere('aadhar_no', 'like', "%{$query}%")
            ->orWhere('enc_key', 'like', "%{$query}%")
            ->orderBy('id', 'desc')
            ->get();

        return view('users.search', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'            => 'required|string|max:255',
            'middle_name'           => 'nullable|string|max:255',
            'last_name'             => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|min:6|confirmed',
            'phone'                 => 'nullable|string|max:20',
            'dob'                   => 'nullable|date',
            'gender'                => 'nullable|in:male,female,other',
            'father_name'           => 'nullable|string|max:255',
            'mother_name'           => 'nullable|string|max:255',
            'marital_status'        => 'nullable|in:single,married,divorced,widowed,separated',
            'spouse_name'           => 'nullable|string|max:255',
            'current_address'       => 'nullable|string',
            'permanent_address'     => 'nullable|string',
            'voter_id_card_no'      => 'nullable|string|max:255',
            'pan_card_no'           => 'nullable|string|max:255',
            'aadhar_no'             => 'nullable|string|max:255',
            'highest_qualification' => 'nullable|in:matriculation,higher_secondary,graduation,masters,phd',
            'joined_at'             => 'nullable|date',
            'profile'               => 'nullable|in:student,teacher,admin,staff',
            'status'                => 'nullable|in:active,inactive,lead,alumni,withdrawn',
            'enc_key'               => 'nullable|string|max:255',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        // Auto-generate encryption key if not provided
        if (empty($validated['enc_key'])) {
            $validated['enc_key'] = Str::random(32);
        }

        User::create($validated);

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified user details.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'first_name'            => 'required|string|max:255',
            'middle_name'           => 'nullable|string|max:255',
            'last_name'             => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email,' . $user->id,
            'password'              => 'nullable|min:6|confirmed',
            'phone'                 => 'nullable|string|max:20',
            'dob'                   => 'nullable|date',
            'gender'                => 'nullable|in:male,female,other',
            'father_name'           => 'nullable|string|max:255',
            'mother_name'           => 'nullable|string|max:255',
            'marital_status'        => 'nullable|in:single,married,divorced,widowed,separated',
            'spouse_name'           => 'nullable|string|max:255',
            'current_address'       => 'nullable|string',
            'permanent_address'     => 'nullable|string',
            'voter_id_card_no'      => 'nullable|string|max:255',
            'pan_card_no'           => 'nullable|string|max:255',
            'aadhar_no'             => 'nullable|string|max:255',
            'highest_qualification' => 'nullable|in:matriculation,higher_secondary,graduation,masters,phd',
            'joined_at'             => 'nullable|date',
            'profile'               => 'nullable|in:student,teacher,admin,staff',
            'status'                => 'nullable|in:active,inactive,lead,alumni,withdrawn',
            'enc_key'               => 'nullable|string|max:255',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        // Preserve existing enc_key if not changed
        if (empty($validated['enc_key'])) {
            $validated['enc_key'] = $user->enc_key ?? Str::random(32);
        }

        $user->update($validated);

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted successfully.');
    }

    /**
     * Display the currently logged-in user's profile.
     */
    public function profile()
    {
        $user = Auth::user();
        return view('users.profile', compact('user'));
    }
}
