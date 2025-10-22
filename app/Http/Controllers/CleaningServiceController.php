<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CleaningServiceController extends Controller
{
    /**
     * Display the cleaning service dashboard.
     */
    public function index()
    {
        // Check if user is authenticated and has cleaning_service role
        if (!Auth::check() || !Auth::user()->isCleaningService()) {
            abort(403, 'Unauthorized access.');
        }

        $now = Carbon::now();
        $today = $now->toDateString();

        // Get active bookings (currently ongoing)
        $activeBookings = Booking::with(['room', 'user'])
            ->where('status', 'approved')
            ->where('date', $today)
            ->where('start_time', '<=', $now->format('H:i:s'))
            ->where('end_time', '>=', $now->format('H:i:s'))
            ->orderBy('start_time')
            ->get();

        // Get all today's bookings
        $todayBookings = Booking::with(['room', 'user'])
            ->where('status', 'approved')
            ->where('date', $today)
            ->orderBy('start_time')
            ->get();

        // Get upcoming bookings for today
        $upcomingBookings = Booking::with(['room', 'user'])
            ->where('status', 'approved')
            ->where('date', $today)
            ->where('start_time', '>', $now->format('H:i:s'))
            ->orderBy('start_time')
            ->limit(5)
            ->get();

        // Get all rooms with their current status
        $rooms = Room::all()->map(function ($room) use ($activeBookings) {
            $currentBooking = $activeBookings->firstWhere('room_id', $room->id);
            $room->is_occupied = $currentBooking ? true : false;
            $room->current_booking = $currentBooking;
            return $room;
        });

        // Statistics
        $stats = [
            'total_rooms' => Room::count(),
            'occupied_rooms' => $activeBookings->count(),
            'available_rooms' => Room::count() - $activeBookings->count(),
            'today_total_bookings' => $todayBookings->count(),
        ];

        return view('cleaning-service.dashboard.index', compact(
            'activeBookings',
            'todayBookings',
            'upcomingBookings',
            'rooms',
            'stats',
            'now'
        ));
    }

    /**
     * Display the schedule for a specific date.
     */
    public function schedule(Request $request)
    {
        // Check if user is authenticated and has cleaning_service role
        if (!Auth::check() || !Auth::user()->isCleaningService()) {
            abort(403, 'Unauthorized access.');
        }

        $date = $request->input('date', Carbon::now()->toDateString());

        $bookings = Booking::with(['room', 'user'])
            ->where('status', 'approved')
            ->where('date', $date)
            ->orderBy('start_time')
            ->get();

        return view('cleaning-service.schedule.index', compact('bookings', 'date'));
    }
}
