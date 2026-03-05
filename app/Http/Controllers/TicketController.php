<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    // User submits a new ticket
    public function store(Request $request, Property $property)
    {
        $request->validate([
            'category' => 'required|string',
            'description' => 'required|string|max:1000',
        ]);

        // Create the ticket
        Ticket::create([
            'property_id' => $property->id,
            'user_id' => Auth::id(),
            'category' => $request->category,
            'description' => $request->description,
            'status' => 'Open',
        ]);

        // Change the actual asset status to show it needs attention
        $property->update(['status' => 'Needs Attention']);

        return back()->with('success', 'Issue reported successfully. IT has been notified.');
    }

    // Admin updates the ticket status
    public function update(Request $request, Ticket $ticket)
    {
        if (!Auth::user()->is_admin)
            abort(403);

        $request->validate(['status' => 'required|string']);

        $ticket->update(['status' => $request->status]);

        // If the admin marks the ticket as Resolved, set the property back to Active
        if ($request->status === 'Resolved') {
            $ticket->property->update(['status' => 'Active']);
        }

        return back()->with('success', 'Ticket status updated.');
    }
}