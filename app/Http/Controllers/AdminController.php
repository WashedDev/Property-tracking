<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function index()
    {
        // 1. Get all regular employees
        $users = User::with('properties')->where('is_admin', false)->get();

        // 2. Get all support tickets (Feature #1)
        $tickets = \App\Models\Ticket::with(['user', 'property'])->latest()->get();

        // 3. Get all properties and their history logs for the Master Inventory (Feature #2)
        $properties = \App\Models\Property::with(['user', 'histories.user'])->latest()->get();

        // Pass all three variables to the admin dashboard view
        return view('admin.dashboard', compact('users', 'tickets', 'properties'));
    }
    public function generateContract(User $user)
    {
        // Ensure properties are loaded
        $user->load('properties');

        // Load the specialized PDF view and pass the user data
        $pdf = Pdf::loadView('admin.pdf_contract', compact('user'));

        // Return the PDF for download with a professional filename
        return $pdf->download('Ctech_Contract_' . str_replace(' ', '_', $user->name) . '.pdf');
    }
}
