<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use App\Models\BookingHistory;
use App\Models\BookingChangeRequest;
use App\Http\Requests\RoomManagerChangeRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RoomManagerController extends Controller
{
    /**
     * Display room manager dashboard
     */
    public function dashboard()
    {
    $user = Auth::user();

        $managedRoomIds = $this->getManagedRoomIds($user);
        
        // Get rooms managed by this user
        $managedRooms = Room::query()
            ->whereIn('id', $managedRoomIds)
            ->withCount([
                'bookings as upcoming_bookings_count' => function ($query) {
                    $query->whereDate('booking_date', '>=', now()->toDateString())
                        ->whereIn('status', [Booking::STATUS_PENDING, Booking::STATUS_APPROVED]);
                },
            ])
            ->orderBy('name')
            ->get();

        // Get pending bookings for managed rooms
        $pendingBookings = Booking::whereIn('room_id', $managedRoomIds)
            ->where('status', Booking::STATUS_PENDING)
            ->with('room', 'user')
            ->orderBy('booking_date', 'desc')
            ->paginate(10);

        // Get approved bookings for managed rooms
        $approvedBookings = Booking::whereIn('room_id', $managedRoomIds)
            ->where('status', Booking::STATUS_APPROVED)
            ->where('booking_date', '>=', now()->toDateString())
            ->with('room', 'user')
            ->orderBy('booking_date')
            ->paginate(10);

        // Statistics
        $totalManagedRooms = $managedRooms->count();
        $totalPendingBookings = Booking::whereIn('room_id', $managedRoomIds)
            ->where('status', Booking::STATUS_PENDING)
            ->count();
        $totalApprovedBookings = Booking::whereIn('room_id', $managedRoomIds)
            ->where('status', Booking::STATUS_APPROVED)
            ->where('booking_date', '>=', now()->toDateString())
            ->count();

        return view('room-manager.dashboard', compact(
            'managedRooms',
            'pendingBookings',
            'approvedBookings',
            'totalManagedRooms',
            'totalPendingBookings',
            'totalApprovedBookings'
        ));
    }

    /**
     * Display list of managed rooms
     */
    public function rooms()
    {
    $user = Auth::user();
        $managedRoomIds = $this->getManagedRoomIds($user);

        $managedRooms = Room::query()
            ->whereIn('id', $managedRoomIds)
            ->withCount([
                'bookings as upcoming_bookings_count' => function ($query) {
                    $query->whereDate('booking_date', '>=', now()->toDateString())
                        ->whereIn('status', [Booking::STATUS_PENDING, Booking::STATUS_APPROVED]);
                },
            ])
            ->orderBy('name')
            ->paginate(10);

        return view('room-manager.rooms', compact('managedRooms'));
    }

    /**
     * Display detail of managed room
     */
    public function showRoom(Room $room)
    {
    $user = Auth::user();

        // Check if user manages this room
        if (!$user->managesRoom($room)) {
            abort(403, 'Unauthorized');
        }

        $room->loadMissing('managers');

        $upcomingBookings = $room->bookings()
            ->with('user')
            ->whereDate('booking_date', '>=', now()->toDateString())
            ->whereIn('status', [Booking::STATUS_PENDING, Booking::STATUS_APPROVED])
            ->orderBy('booking_date')
            ->orderBy('start_time')
            ->limit(6)
            ->get();

        $recentHistories = BookingHistory::whereHas('booking', function ($query) use ($room) {
                $query->where('room_id', $room->id);
            })
            ->with('changedBy')
            ->orderByDesc('created_at')
            ->limit(6)
            ->get();

        $approvedBookingsCount = $room->approvedBookings()
            ->whereDate('booking_date', '>=', now()->toDateString())
            ->count();

        $otherManagers = $room->managers->where('id', '!=', $user->id);

        return view('room-manager.show-room', compact(
            'room',
            'upcomingBookings',
            'recentHistories',
            'approvedBookingsCount',
            'otherManagers'
        ));
    }

    /**
     * Display pending bookings for managed rooms
     */
    public function pendingBookings()
    {
    $user = Auth::user();
        $managedRoomIds = $this->getManagedRoomIds($user);

        $bookings = Booking::whereIn('room_id', $managedRoomIds)
            ->where('status', Booking::STATUS_PENDING)
            ->with('room', 'user')
            ->orderBy('booking_date', 'desc')
            ->paginate(15);

        return view('room-manager.pending-bookings', compact('bookings'));
    }

    /**
     * Display upcoming approved bookings for managed rooms.
     */
    public function upcomingBookings(Request $request)
    {
        $user = Auth::user();
        $managedRoomIds = $this->getManagedRoomIds($user);

        $query = Booking::whereIn('room_id', $managedRoomIds)
            ->where('status', Booking::STATUS_APPROVED)
            ->whereDate('booking_date', '>=', now()->toDateString())
            ->with(['room', 'user'])
            ->orderBy('booking_date')
            ->orderBy('start_time');

        if ($request->filled('room_id') && $managedRoomIds->contains((int) $request->room_id)) {
            $query->where('room_id', $request->room_id);
        }

        $bookings = $query
            ->with(['changeRequests' => function ($relation) use ($user) {
                $relation
                    ->where('requested_by', $user->id)
                    ->orderByDesc('created_at');
            }])
            ->paginate(15)
            ->withQueryString();

        $rooms = Room::whereIn('id', $managedRoomIds)
            ->orderBy('name')
            ->get();

        return view('room-manager.upcoming-bookings', compact('bookings', 'rooms'));
    }

    /**
     * Submit change request (edit/cancel) for an approved booking.
     */
    public function submitChangeRequest(RoomManagerChangeRequest $request, Booking $booking)
    {
        $user = Auth::user();

        if (!$user->managesRoom($booking->room)) {
            abort(403, 'Unauthorized');
        }

        if ($booking->status !== Booking::STATUS_APPROVED) {
            return back()->with('error', 'Hanya jadwal yang sudah disetujui yang dapat diajukan perubahan.');
        }

        $data = $request->validated();

        $existing = BookingChangeRequest::query()
            ->where('booking_id', $booking->id)
            ->where('requested_by', $user->id)
            ->where('type', $data['type'])
            ->where('status', BookingChangeRequest::STATUS_PENDING)
            ->exists();

        if ($existing) {
            return back()->with('error', 'Pengajuan serupa masih menunggu tindak lanjut admin.');
        }

        BookingChangeRequest::create([
            'booking_id' => $booking->id,
            'requested_by' => $user->id,
            'type' => $data['type'],
            'reason' => $data['reason'],
            'status' => BookingChangeRequest::STATUS_PENDING,
        ]);

        return back()->with('success', 'Pengajuan Anda telah dikirim ke admin.');
    }

    /**
     * Approve booking
     */
    public function approveBooking(Booking $booking)
    {
    $user = Auth::user();
        $room = $booking->room;

        // Check if user manages this room
        if (!$user->managesRoom($room)) {
            return back()->with('error', 'Anda tidak memiliki hak untuk meng-approve peminjaman ruangan ini.');
        }

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Peminjaman ini tidak dalam status pending.');
        }

        $booking->update(['status' => 'approved']);

        return back()->with('success', 'Peminjaman berhasil disetujui!');
    }

    /**
     * Reject booking
     */
    public function rejectBooking(Booking $booking, Request $request)
    {
    $user = Auth::user();
        $room = $booking->room;

        // Check if user manages this room
        if (!$user->managesRoom($room)) {
            return back()->with('error', 'Anda tidak memiliki hak untuk menolak peminjaman ruangan ini.');
        }

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Peminjaman ini tidak dalam status pending.');
        }

        $booking->update([
            'status' => 'rejected',
            'rejection_reason' => $request->input('reason'),
        ]);

        return back()->with('success', 'Peminjaman berhasil ditolak!');
    }

        /**
         * Retrieve room IDs managed by the given user via admin assignment.
         */
        protected function getManagedRoomIds($user): Collection
        {
            return DB::table('room_user')
                ->where('user_id', $user->id)
                ->pluck('room_id')
                ->unique()
                ->values();
        }
}
