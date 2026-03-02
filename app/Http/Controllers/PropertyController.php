<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Barryvdh\DomPDF\Facade\Pdf;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Auth::user()->properties;
        return view('dashboard', compact('properties'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'type' => 'required|string',
            'serial_number' => 'nullable|string|max:255',
            'license_plate' => 'nullable|string|max:20',
            'user_id' => 'nullable|exists:users,id',
            // New fields for details modal
            'procurement_date' => 'nullable|date',
            'warranty_expiration' => 'nullable|date',
            'estimated_value' => 'nullable|numeric'
        ]);

        $targetUserId = Auth::id();
        $status = 'Active'; // If user registers it themselves, it's active immediately

        if (Auth::user()->is_admin && $request->filled('user_id')) {
            $targetUserId = $request->user_id;
            $status = 'Pending Acknowledgment'; // Admin assigned it, user MUST acknowledge
        }

        $propertyData = Arr::except($validated, ['user_id']);
        $propertyData['status'] = $status; // Inject the status

        $targetUser = User::findOrFail($targetUserId);
        $targetUser->properties()->create($propertyData);

        if (Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard')->with('success', 'Asset successfully assigned. User must acknowledge receipt.');
        }

        return redirect()->route('dashboard')->with('success', 'Property added to your inventory!');
    }

    // NEW: Digital Acknowledgment Logic
    public function acknowledge(Property $property)
    {
        // Security check: ensure the user actually owns this property
        if ($property->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $property->update(['status' => 'Active']);

        return redirect()->back()->with('success', 'You have officially acknowledged receipt of ' . $property->name);
    }

    // NEW: User PDF Generation Logic
    public function downloadPdf()
    {
        $user = Auth::user()->load('properties');

        // We will reuse your existing admin PDF view for now, or you can create a specific user one!
        $pdf = Pdf::loadView('admin.pdf_contract', compact('user'));

        return $pdf->download('My_Assigned_Assets_' . date('Y_m_d') . '.pdf');
    }
}