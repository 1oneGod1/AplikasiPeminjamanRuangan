<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomType;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roomTypes = RoomType::orderBy('label')->get();
        return view('admin.room-types.index', compact('roomTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.room-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:room_types,name',
            'label' => 'required|string',
            'description' => 'nullable|string',
            'is_active' => 'nullable',
        ]);
        
        // Convert is_active to boolean
        $validated['is_active'] = in_array($request->input('is_active'), ['1', 1, true, 'true'], true);
        
        RoomType::create($validated);

        // Check if this is an AJAX request
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Jenis ruangan berhasil ditambahkan',
                'redirect' => route('admin.room-types.index'),
            ], 201);
        }

        return redirect()->route('admin.room-types.index')->with('success', 'Jenis ruangan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoomType $roomType)
    {
        // If AJAX request, return JSON
        if (request()->expectsJson()) {
            return response()->json($roomType);
        }

        return view('admin.room-types.edit', compact('roomType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoomType $roomType)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:room_types,name,' . $roomType->id,
            'label' => 'required|string',
            'description' => 'nullable|string',
            'is_active' => 'nullable',
        ]);
        
        // Convert is_active to boolean
        $validated['is_active'] = in_array($request->input('is_active'), ['1', 1, true, 'true'], true);
        
        $roomType->update($validated);

        // Check if this is an AJAX request
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Jenis ruangan berhasil diperbarui',
                'redirect' => route('admin.room-types.index'),
            ], 200);
        }

        return redirect()->route('admin.room-types.index')->with('success', 'Jenis ruangan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomType $roomType)
    {
        $roomType->delete();
        return redirect()->route('admin.room-types.index')->with('success', 'Jenis ruangan berhasil dihapus.');
    }
}
