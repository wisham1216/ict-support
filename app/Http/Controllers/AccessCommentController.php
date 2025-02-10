<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\AccessComment;
use Illuminate\Http\Request;

class AccessCommentController extends Controller
{
    public function store(Request $request, Access $access)
    {
        $validated = $request->validate([
            'comment' => 'required|string'
        ]);

        $access->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $validated['comment']
        ]);

        return redirect()->back()->with('success', 'Comment added successfully.');
    }
}
