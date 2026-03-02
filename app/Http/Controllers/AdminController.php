<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function index()
    {
        // Get all users who are NOT admins, including their properties
        $users = User::with('properties')->where('is_admin', false)->get();


        return view('admin.dashboard', compact('users'));
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
