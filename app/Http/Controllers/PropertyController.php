<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    // Show the list of properties for the logged-in user
    public function index()
    {
        $properties = Auth::user()->properties;
        return view('dashboard', compact('properties'));
    }

    // Show the "Add Property" form
    public function create()
    {
        return view('properties.create');
    }

    // Save the property to the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'type' => 'required|string',
            'serial_number' => 'nullable|string|max:255',
            'license_plate' => 'nullable|string|max:20', // Specific for cars
        ]);

        // Create the property linked to the authenticated user
        Auth::user()->properties()->create($validated);

        return redirect()->route('dashboard')->with('success', 'Property added to your list!');
    }
}