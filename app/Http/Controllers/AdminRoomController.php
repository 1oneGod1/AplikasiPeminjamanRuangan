<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use App\Models\RoomType;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminRoomController extends Controller
{
    /**
     * Display a listing of the rooms.
     */
    public function index()
    {
        $rooms = Room::orderBy('name')->paginate(10);
        
        $totalRooms = Room::count();
        $availableRooms = Room::where('is_active', true)->count();
        $unavailableRooms = Room::where('is_active', false)->count();

        return view('admin.rooms.index', compact('rooms', 'totalRooms', 'availableRooms', 'unavailableRooms'));
    }

    /**
     * Show the form for creating a new room.
     */
    public function create()
    {
        $roomTypes = \App\Models\RoomType::active()->orderBy('label')->get();
        return view('admin.rooms.create', compact('roomTypes'));
    }

    /**
     * Store a newly created room in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:rooms',
            'type' => 'required|string|exists:room_types,name',
            'capacity' => 'required|integer|min:1',
            'location' => 'required|string|max:255',
            'facilities' => 'nullable|string',
            'is_active' => 'nullable',
            'manager_ids' => 'nullable|array',
            'manager_ids.*' => 'integer|exists:users,id',
        ]);

        if ($validator->fails()) {
            // Check if this is an AJAX request
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                ], 422);
            }

            return redirect()
                ->route('admin.rooms.create')
                ->withErrors($validator)
                ->withInput();
        }

        $room = Room::create([
            'name' => $request->name,
            'type' => $request->type,
            'capacity' => $request->capacity,
            'location' => $request->location,
            'facilities' => $request->facilities,
            'is_active' => in_array($request->input('is_active'), ['1', 1, true, 'true'], true),
        ]);

        if ($request->has('manager_ids')) {
            $room->managers()->sync($request->manager_ids ?? []);
        }

        // Check if this is an AJAX request
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Ruangan berhasil ditambahkan',
                'redirect' => route('admin.rooms.index'),
            ], 201);
        }

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Ruangan berhasil ditambahkan');
    }

    /**
     * Display the specified room.
     */
    public function show($id)
    {
        $room = Room::findOrFail($id);
        $bookings = Booking::where('room_id', $id)
            ->with('user')
            ->orderBy('booking_date', 'desc')
            ->paginate(10);
        
        return view('admin.rooms.show', compact('room', 'bookings'));
    }

    /**
     * Show the form for editing the specified room.
     */
    public function edit(Request $request, $id)
    {
        $room = Room::findOrFail($id);
        
        // Check if this is an AJAX request
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $room->id,
                    'name' => $room->name,
                    'type' => $room->type,
                    'capacity' => $room->capacity,
                    'location' => $room->location,
                    'facilities' => $room->facilities,
                    'is_active' => $room->is_active,
                    'manager_ids' => $room->managers()->pluck('user_id')->toArray(),
                ],
            ]);
        }
        
        $roomTypes = \App\Models\RoomType::active()->orderBy('label')->get();
        return view('admin.rooms.edit', compact('room', 'roomTypes'));
    }

    /**
     * Update the specified room in storage.
     */
    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:rooms,name,' . $id,
            'type' => 'required|string|exists:room_types,name',
            'capacity' => 'required|integer|min:1',
            'location' => 'required|string|max:255',
            'facilities' => 'nullable|string',
            'is_active' => 'nullable',
            'manager_ids' => 'nullable|array',
            'manager_ids.*' => 'integer|exists:users,id',
        ]);

        if ($validator->fails()) {
            // Check if this is an AJAX request
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                ], 422);
            }

            return redirect()
                ->route('admin.rooms.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $room->update([
            'name' => $request->name,
            'type' => $request->type,
            'capacity' => $request->capacity,
            'location' => $request->location,
            'facilities' => $request->facilities,
            'is_active' => in_array($request->input('is_active'), ['1', 1, true, 'true'], true),
        ]);

        // Sync managers (allow detaching all managers when empty)
        $room->managers()->sync($request->input('manager_ids', []));

        // Check if this is an AJAX request
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Ruangan berhasil diperbarui',
                'redirect' => route('admin.rooms.index'),
            ], 200);
        }

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Ruangan berhasil diperbarui');
    }

    /**
     * Remove the specified room from storage.
     */
    public function destroy($id)
    {
        $room = Room::findOrFail($id);

        // Check if room has upcoming approved bookings
        $hasUpcomingBookings = Booking::where('room_id', $room->id)
            ->where('status', 'approved')
            ->where('booking_date', '>=', now()->toDateString())
            ->exists();

        if ($hasUpcomingBookings) {
            return redirect()
                ->route('admin.rooms.index')
                ->with('error', 'Ruangan tidak dapat dihapus karena masih memiliki peminjaman yang sudah disetujui.');
        }

        $room->delete();

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Ruangan berhasil dihapus');
    }

    /**
     * Get list of peminjam users for manager selection (AJAX endpoint)
     */
    public function getPeminjamUsers()
    {
        $peminjam = User::where('role', User::ROLE_PEMINJAM)
            ->where('is_active', true)
            ->orderBy('name')
            ->select('id', 'name', 'email')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $peminjam,
        ]);
    }

    /**
     * Get list of active room types (AJAX endpoint)
     */
    public function getRoomTypes()
    {
        $roomTypes = RoomType::where('is_active', true)
            ->orderBy('label')
            ->select('name', 'label')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $roomTypes,
        ]);
    }
}
