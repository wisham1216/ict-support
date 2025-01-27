<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::query()->with('assignedTo');

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('department_name', 'like', '%' . $request->search . '%')
                    ->orWhere('contact_person', 'like', '%' . $request->search . '%')
                    ->orWhere('summary', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->has('department') && $request->department !== 'all') {
            $query->where('department_name', $request->department);
        }

        if ($request->has('assigned_to') && $request->assigned_to !== 'all') {
            $query->where('assigned_to', $request->assigned_to);
        }

        // Get unique departments for the filter dropdown
        $departments = Ticket::distinct()->pluck('department_name');

        $tickets = $query->orderBy('created_at', 'desc')->paginate(10);

        // Get users for assignment dropdown
        $users = \App\Models\User::all();

        return view('tickets.index', compact('tickets', 'departments', 'users'));
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'department_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'summary' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'attachment' => 'nullable|file|max:2048',
        ]);

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('attachments');
            $validated['attachment'] = $path;
        }

        $validated['creator_id'] = auth()->id();

        Ticket::create($validated);

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket created successfully.');
    }

    public function show($id)
    {
        $ticket = Ticket::with('user', 'comments.user', 'assignedTo')->findOrFail($id);
        $users = \App\Models\User::all();
        return view('tickets.show', compact('ticket', 'users'));
    }

    /**
     * Update the status of a ticket (for agents only)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:open,in_progress,closed',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Ticket status updated successfully');
    }

    public function edit(Ticket $ticket)
    {
        return view('tickets.edit', compact('ticket'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'department_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'summary' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'status' => 'required|in:open,in_progress,closed',
            'attachment' => 'nullable|file|max:2048',
        ]);

        if ($request->hasFile('attachment')) {
            if ($ticket->attachment) {
                Storage::delete($ticket->attachment);
            }
            $path = $request->file('attachment')->store('attachments');
            $validated['attachment'] = $path;
        }

        $ticket->update($validated);

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket updated successfully.');
    }

    public function destroy(Ticket $ticket)
    {
        if ($ticket->attachment) {
            Storage::delete($ticket->attachment);
        }

        $ticket->delete();

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket deleted successfully.');
    }

    public function assign(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'assigned_to' => 'required|exists:users,id'
        ]);

        $ticket->update([
            'assigned_to' => $validated['assigned_to'],
            'status' => 'in_progress'
        ]);

        return redirect()->back()->with('success', 'Ticket assigned successfully');
    }
}
