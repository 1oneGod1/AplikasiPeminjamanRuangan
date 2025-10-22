@extends('cleaning-service.layouts.app')

@section('title', 'Dashboard Petugas Kebersihan')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard Petugas Kebersihan</h1>
        <p class="text-gray-600 mt-2">Monitoring ruangan dan jadwal peminjaman hari ini</p>
        <p class="text-sm text-gray-500 mt-1">
            <i class="fas fa-clock mr-1"></i>
            {{ $now->locale('id')->isoFormat('dddd, D MMMM YYYY - HH:mm') }} WIB
        </p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-blue-100 rounded-full p-3">
                    <i class="fas fa-door-open text-blue-600 text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Ruangan</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_rooms'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-red-100 rounded-full p-3">
                    <i class="fas fa-users text-red-600 text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Sedang Dipakai</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['occupied_rooms'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-green-100 rounded-full p-3">
                    <i class="fas fa-door-closed text-green-600 text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Tersedia</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['available_rooms'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-purple-100 rounded-full p-3">
                    <i class="fas fa-calendar-check text-purple-600 text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Booking Hari Ini</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['today_total_bookings'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Bookings (Currently Ongoing) -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-900">
                <i class="fas fa-circle text-red-500 animate-pulse mr-2"></i>
                Ruangan Sedang Dipakai
            </h2>
            <p class="text-sm text-gray-600 mt-1">Ruangan yang sedang aktif digunakan saat ini</p>
        </div>
        <div class="p-6">
            @if($activeBookings->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($activeBookings as $booking)
                        <div class="border-l-4 border-red-500 bg-red-50 p-4 rounded-lg">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-bold text-lg text-gray-900">{{ $booking->room->name }}</h3>
                                <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                                    <i class="fas fa-circle animate-pulse"></i> Aktif
                                </span>
                            </div>
                            <p class="text-sm text-gray-600 mb-2">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                {{ $booking->room->location }}
                            </p>
                            <p class="text-sm text-gray-700 mb-1">
                                <i class="fas fa-user mr-1"></i>
                                <strong>Peminjam:</strong> {{ $booking->user->name }}
                            </p>
                            <p class="text-sm text-gray-700 mb-1">
                                <i class="fas fa-info-circle mr-1"></i>
                                <strong>Tujuan:</strong> {{ $booking->purpose }}
                            </p>
                            <p class="text-sm text-gray-700">
                                <i class="fas fa-clock mr-1"></i>
                                <strong>Waktu:</strong> {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }} WIB
                            </p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-check-circle text-green-500 text-5xl mb-4"></i>
                    <p class="text-gray-600 text-lg">Tidak ada ruangan yang sedang dipakai saat ini</p>
                    <p class="text-gray-500 text-sm mt-2">Semua ruangan tersedia untuk dibersihkan</p>
                </div>
            @endif
        </div>
    </div>

    <!-- All Rooms Status -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-900">
                <i class="fas fa-th-large mr-2"></i>
                Status Semua Ruangan
            </h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($rooms as $room)
                    <div class="border rounded-lg p-4 {{ $room->is_occupied ? 'bg-red-50 border-red-200' : 'bg-green-50 border-green-200' }}">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-bold text-gray-900">{{ $room->name }}</h3>
                            <span class="{{ $room->is_occupied ? 'bg-red-500' : 'bg-green-500' }} text-white text-xs px-2 py-1 rounded-full">
                                {{ $room->is_occupied ? 'Terpakai' : 'Tersedia' }}
                            </span>
                        </div>
                        <p class="text-xs text-gray-600 mb-2">
                            <i class="fas fa-map-marker-alt mr-1"></i>{{ $room->location }}
                        </p>
                        @if($room->is_occupied && $room->current_booking)
                            <p class="text-xs text-gray-700">
                                <i class="fas fa-user mr-1"></i>{{ $room->current_booking->user->name }}
                            </p>
                            <p class="text-xs text-gray-700">
                                <i class="fas fa-clock mr-1"></i>
                                {{ \Carbon\Carbon::parse($room->current_booking->start_time)->format('H:i') }} - 
                                {{ \Carbon\Carbon::parse($room->current_booking->end_time)->format('H:i') }}
                            </p>
                        @else
                            <p class="text-xs text-gray-600">
                                <i class="fas fa-broom mr-1"></i>Siap dibersihkan
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Upcoming Bookings -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-900">
                <i class="fas fa-clock mr-2"></i>
                Jadwal Selanjutnya Hari Ini
            </h2>
            <p class="text-sm text-gray-600 mt-1">5 peminjaman berikutnya</p>
        </div>
        <div class="p-6">
            @if($upcomingBookings->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ruangan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peminjam</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tujuan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($upcomingBookings as $booking)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <i class="fas fa-clock text-gray-400 mr-1"></i>
                                        {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $booking->room->name }}
                                        <span class="text-xs text-gray-500 block">{{ $booking->room->location }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $booking->user->name }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ $booking->purpose }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-calendar-times text-gray-400 text-5xl mb-4"></i>
                    <p class="text-gray-600">Tidak ada jadwal peminjaman selanjutnya hari ini</p>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Auto refresh every 5 minutes
    setTimeout(function() {
        location.reload();
    }, 300000);
</script>
@endpush
