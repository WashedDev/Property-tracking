<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\PasswordResetController;


Route::get('/', function () {
    return view('auth.register');
});

// Registration
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//password reset routes
Route::get('/forgot-password', [PasswordResetController::class, 'showLinkRequestForm'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLinkEmail'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'reset'])->middleware('guest')->name('password.update');

Route::middleware(['auth'])->group(function () {
    // Shared Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // User Asset PDF Download
    Route::get('/my-assets/pdf', [App\Http\Controllers\PropertyController::class, 'downloadPdf'])->name('user.assets.pdf');

    // Digital Acknowledgment Route
    Route::patch('/properties/{property}/acknowledge', [App\Http\Controllers\PropertyController::class, 'acknowledge'])->name('properties.acknowledge');

    // Ticketing Routes
    Route::post('/properties/{property}/tickets', [App\Http\Controllers\TicketController::class, 'store'])->name('tickets.store');
    Route::patch('/admin/tickets/{ticket}', [App\Http\Controllers\TicketController::class, 'update'])->name('admin.tickets.update');

    // Employee Routes
    Route::get('/dashboard', [PropertyController::class, 'index'])->name('dashboard');
    Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
    Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');


    // Admin Routes
    Route::middleware(['admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/contract/{user}', [AdminController::class, 'generateContract'])->name('admin.contract');

        // FIX: Removed the extra '/admin' from the start of the URL string
        Route::patch('/properties/{property}', [App\Http\Controllers\PropertyController::class, 'update'])->name('admin.properties.update');
    });
});