<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\System;
use App\Models\SystemAccss;
use Illuminate\Http\Request;

class AccessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Access::query();

        // If user can only view own requests
        if (!auth()->user()->can('access-request.view.any')) {
            $query->where('user_id', auth()->id());
        }

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

        return view('access-requests.index', compact('accessRequests', 'sections', ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $systems = System::all();

        $systemAccesses = []; // Initialize empty array for initial load

        // If there's an old input for access_type, load its accesses
        if (old('access_type')) {
            $systemAccesses = SystemAccss::where('system_id', old('access_type'))
                ->select('id', 'name')
                ->get();
        }

        return view('access-requests.create', compact('systems', 'systemAccesses'));
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
            'access_type' => 'required|exists:systems,id',
            'request_type' => Access::$rules['request_type'],
            'accesses' => 'required|array',
            'accesses.*' => 'exists:system_accsses,id'
        ]);

        // Set default status for new requests
        $validated['status'] = 'pending';

        // Add user_id if authenticated
        if (auth()->check()) {
            $validated['user_id'] = auth()->id();
        }

        // Remove accesses from validated data since it's not a column
        $selectedAccesses = $validated['accesses'];
        unset($validated['accesses']);

        // Create access request
        $access = Access::create($validated);

        // Attach selected system accesses
        $access->systemAccesses()->attach($selectedAccesses);

        return redirect()->route('access-requests.index')
            ->with('success', 'Access request created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $access = Access::with([
            'user',
            'system',
            'grantedBy.roles',
            'modifiedBy.roles',
            'revokedBy.roles'
        ])->findOrFail($id);

        return view('access-requests.show', compact('access'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $access = Access::with('systemAccesses')->findOrFail($id);
        $systems = System::all();

        return view('access-requests.edit', compact('access', 'systems'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
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
            'access_type' => 'required|exists:systems,id',
            'request_type' => Access::$rules['request_type'],
            'accesses' => 'required|array',
            'accesses.*' => 'exists:system_accsses,id'
        ]);

        $access = Access::findOrFail($id);

        // Update basic information
        $access->update($validated);

        // Sync the system accesses
        $access->systemAccesses()->sync($request->accesses);

        return redirect()->route('access-requests.index')
            ->with('success', 'Access request updated successfully.');
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
        $this->authorize('access-request.grant');
        $access->update([
            'status' => 'granted',
            'granted_at' => now(),
            'granted_by' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'Access permission granted successfully');
    }

    public function modifyPermission(Access $access)
    {
        $this->authorize('access-request.modify');
        $access->update([
            'status' => 'modified',
            'modified_at' => now(),
            'modified_by' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'Access permission modified successfully');
    }

    public function revokePermission(Access $access)
    {
        $this->authorize('access-request.revoke');
        $access->update([
            'status' => 'revoked',
            'revoked_at' => now(),
            'revoked_by' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'Access permission revoked successfully');
    }

    /**
     * Update the status of the access request.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,granted,rejected,revoked'
        ]);

        $access = Access::findOrFail($id);
        $oldStatus = $access->status;
        $newStatus = $request->status;

        // Update status and related timestamps/users
        $access->status = $newStatus;

        if ($newStatus === 'granted' && $oldStatus !== 'granted') {
            $access->granted_at = now();
            $access->granted_by = auth()->id();
        } elseif ($newStatus === 'revoked' && $oldStatus !== 'revoked') {
            $access->revoked_at = now();
            $access->revoked_by = auth()->id();
        }

        // Always record modification
        $access->modified_at = now();
        $access->modified_by = auth()->id();

        $access->save();

        return redirect()->back()->with('success', 'Access request status updated successfully.');
    }
}
