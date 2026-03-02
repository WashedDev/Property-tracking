<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Get all users who are NOT admins, including their properties
        $users = User::with('properties')->where('is_admin', false)->get();


        return view('admin.dashboard', compact('users'));
    }

    public function showUserProperties(User $user)
    {
        return view('admin.user-details', compact('user'));
    }
}
