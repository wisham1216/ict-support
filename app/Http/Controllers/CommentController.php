<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $ticketId)
    {
        $validated = $request->validate([
            'content' => 'required|string'
        ]);

        Comment::create([
            'ticket_id' => $ticketId,
            'user_id' => auth()->id(),
            'content' => $validated['content']
        ]);

        return redirect()->back()->with('success', 'Comment added successfully');
    }

    /**
     * Display all comments for a specific ticket
     */
    public function index($ticketId)
    {
        // Fetch the ticket with its comments, including the user who created each comment
        $ticket = Ticket::with(['comments.user'])->findOrFail($ticketId);

        return view('comments.index', compact('ticket'));
    }
}
