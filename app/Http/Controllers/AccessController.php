<?php

namespace App\Http\Controllers;

use App\Models\Access;
use Illuminate\Http\Request;

class AccessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Access::query();

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('email', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('reason', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('status', 'like', '%' . $request->input('search') . '%');
            });
        }

        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->input('status'));
        }

        if ($request->has('section') && $request->section !== 'all') {
            $query->where('section', $request->input('section'));
        }

        $accessRequests = $query->orderBy('created_at', 'desc')->paginate(5);

        // Get unique sections for the filter dropdown
        $sections = Access::distinct()->pluck('section');

        return view('access-requests.index', compact('accessRequests', 'sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('access-requests.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nation_id' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'dob' => 'required|date',
            'record_card_number' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'mobile' => 'required|string|max:255',
            'email' => 'required|email',
            'reason' => 'required|string|max:255',
            'access_type' => 'required|string|max:255',
        ]);

        // Set default status for new requests
        $validated['status'] = 'pending';

        // Create access request using validated data only
        Access::create($validated);

        return redirect()->route('access-requests.index')
            ->with('success', 'Access request created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $access = Access::findOrFail($id);
        return view('access-requests.show', compact('access'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $access = Access::findOrFail($id);
        return view('access-requests.edit', compact('access'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'reason' => 'required|string|max:255',
            'access_type' => 'required|string|max:255',
        ]);
        $access = Access::findOrFail($id);
        $access->update($validated);
        return redirect()->route('access-requests.index')->with('success', 'Access request updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $access = Access::findOrFail($id);
        $access->delete();
        return redirect()->route('access-requests.index')->with('success', 'Access request deleted successfully.');
    }

    public function grantPermission(Access $access)
    {
        $access->update([
            'status' => 'granted',
            'granted_at' => now(),
            'granted_by' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'Access permission granted successfully');
    }

    public function modifyPermission(Access $access)
    {
        $access->update([
            'status' => 'modified',
            'modified_at' => now(),
            'modified_by' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'Access permission modified successfully');
    }

    public function revokePermission(Access $access)
    {
        $access->update([
            'status' => 'revoked',
            'revoked_at' => now(),
            'revoked_by' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'Access permission revoked successfully');
    }
}
