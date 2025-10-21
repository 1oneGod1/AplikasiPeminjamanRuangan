<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class LandingController extends Controller
{
    /**
     * Display the landing page for guests or redirect authenticated users.
     */
    public function __invoke(): View|RedirectResponse
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user instanceof User) {
                if ($user->isAdmin()) {
                    return redirect()->route('admin.dashboard');
                }

                if ($user->isKepalaSekolah()) {
                    return redirect()->route('reports.index');
                }
            }

            return redirect()->route('dashboard');
        }

        $activeRooms = collect();

        $stats = [
            'rooms' => 0,
            'bookings' => 0,
            'room_types' => 0,
        ];

        if (Schema::hasTable('rooms')) {
            $activeRooms = Room::query()
                ->where('is_active', true)
                ->orderByDesc('updated_at')
                ->limit(6)
                ->get(['id', 'name', 'type', 'capacity', 'location']);

            $stats['rooms'] = Room::where('is_active', true)->count();
            $stats['room_types'] = Room::distinct()->count('type');
        }

        if (Schema::hasTable('bookings')) {
            $stats['bookings'] = Booking::count();
        }

        return view('landing', [
            'rooms' => $activeRooms,
            'stats' => $stats,
        ]);
    }
}
