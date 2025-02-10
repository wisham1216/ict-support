<?php

namespace App\Http\Controllers;

use App\Models\System;
use App\Models\SystemAccss;
use Illuminate\Http\Request;

class SystemAccessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $systems = System::with('accesses')->get();
        return view('system-accesses.index', compact('systems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $systems = System::all();
        return view('system-accesses.create', compact('systems'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'system_id' => 'required|exists:systems,id',
            'access_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        SystemAccss::create($request->all());

        return redirect()->route('system-accesses.index')->with('success', 'Access added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $systemAccess = SystemAccss::findOrFail($id);
        return view('system-accesses.show', compact('systemAccess'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $systemAccess = SystemAccss::findOrFail($id);
        $systems = System::all();
        return view('system-accesses.edit', compact('systemAccess', 'systems'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'system_id' => 'required|exists:systems,id',
            'access_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $systemAccess = SystemAccss::findOrFail($id);
        $systemAccess->update($request->all());

        return redirect()->route('system-accesses.index')->with('success', 'Access updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $systemAccess = SystemAccss::findOrFail($id);
        $systemAccess->delete();

        return redirect()->route('system-accesses.index')->with('success', 'Access deleted successfully.');
    }
}
