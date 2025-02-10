<?php

namespace App\Http\Controllers;

use App\Models\System;
use App\Models\SystemAccss;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SystemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $systems = System::with('accesses')->get();
        return view('systems.index', compact('systems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('systems.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        System::create($request->all());

        return redirect()->route('systems.index')->with('success', 'System created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $system = System::findOrFail($id);
        return view('systems.show', compact('system'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $system = System::findOrFail($id);
        return view('systems.edit', compact('system'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $system = System::findOrFail($id);
        $system->update($request->all());

        return redirect()->route('systems.index')->with('success', 'System updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $system = System::findOrFail($id);
        $system->delete();

        return redirect()->route('systems.index')->with('success', 'System deleted successfully.');
    }

    public function getAccesses(System $system): JsonResponse
    {
        $accesses = $system->accesses()->get(['id', 'access_name']);
        return response()->json($accesses);
    }
}
