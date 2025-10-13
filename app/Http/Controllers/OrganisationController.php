<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Illuminate\Http\Request;

class OrganisationController extends Controller
{
    public function index() {
        $organisation = Organisation::all();
        return view('organisation.index', compact('organisation'));
    }

    public function create() {
        return view('organisation.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:30',
            'state' => 'nullable|string|max:30',
            'postal_code' => 'nullable|string|max:15',
            'country' => 'nullable|string|max:30',
            'pan_number' => 'nullable|string|max:15',
            'gstin_number' => 'nullable|string|max:15',
        ]);

        Organisation::create($validated);
        return redirect()->route('organisation.index')->with('success', 'Organisation created successfully!');
    }

    public function edit(Organisation $organisation)
    {
        return view('organisation.edit', compact('organisation'));
    }

    public function update(Request $request, Organisation $organisation)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:30',
            'state' => 'nullable|string|max:30',
            'postal_code' => 'nullable|string|max:15',
            'country' => 'nullable|string|max:30',
            'pan' => 'nullable|string|max:15',
            'gstin' => 'nullable|string|max:15',
        ]);

        $organisation->update($validated);
        return redirect()->route('organisation.index')->with('success', 'Organisation updated successfully!');
    }

    public function destroy(Organisation $organisation)
    {
        $organisation->delete();
        return redirect()->route('organisation.index')->with('success', 'Organisation deleted successfully!');
    }
}
