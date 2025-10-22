@extends('cleaning-service.layouts.app')

@section('title', 'Jadwal Peminjaman')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Jadwal Peminjaman Ruangan</h1>
        <p class="text-gray-600 mt-2">Lihat jadwal peminjaman berdasarkan tanggal</p>
    </div>

    <!-- Date Picker -->
    <div class="bg-white rounded-lg shadow mb-6 p-6">
        <form method="GET" action="{{ route('cleaning-service.schedule') }}" class="flex items-end gap-4">
            <div class="flex-1">
                <label for="date" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-calendar mr-1"></i>Pilih Tanggal
                </label>
                <input type="date" 
                       id="date" 
                       name="date" 
                       value="{{ $date }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
            </div>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg transition duration-200">
                <i class="fas fa-search mr-2"></i>Lihat Jadwal
            </button>
        </form>
    </div>

    <!-- Schedule Display -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-900">
                <i class="fas fa-list mr-2"></i>
                Jadwal untuk {{ \Carbon\Carbon::parse($date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
            </h2>
            <p class="text-sm text-gray-600 mt-1">Total {{ $bookings->count() }} peminjaman</p>
        </div>
        <div class="p-6">
            @if($bookings->count() > 0)
                <div class="space-y-4">
                    @php
                        $groupedBookings = $bookings->groupBy('room_id');
                    @endphp
                    
                    @foreach($groupedBookings as $roomId => $roomBookings)
                        @php
                            $room = $roomBookings->first()->room;
                        @endphp
                        <div class="border rounded-lg overflow-hidden">
                            <div class="bg-gray-50 px-4 py-3 border-b">
                                <h3 class="font-bold text-lg text-gray-900">
                                    <i class="fas fa-door-open text-green-600 mr-2"></i>
                                    {{ $room->name }}
                                </h3>
                                <p class="text-sm text-gray-600">
                                    <i class="fas fa-map-marker-alt mr-1"></i>{{ $room->location }}
                                </p>
                            </div>
                            <div class="divide-y divide-gray-200">
                                @foreach($roomBookings as $booking)
                                    <div class="px-4 py-3 hover:bg-gray-50">
                                        <div class="flex justify-between items-start">
                                            <div class="flex-1">
                                                <p class="text-sm font-medium text-gray-900">
                                                    <i class="fas fa-clock text-gray-400 mr-1"></i>
                                                    {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} - 
                                                    {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }} WIB
                                                </p>
                                                <p class="text-sm text-gray-700 mt-1">
                                                    <i class="fas fa-user text-gray-400 mr-1"></i>
                                                    <strong>Peminjam:</strong> {{ $booking->user->name }}
                                                </p>
                                                <p class="text-sm text-gray-700 mt-1">
                                                    <i class="fas fa-info-circle text-gray-400 mr-1"></i>
                                                    <strong>Tujuan:</strong> {{ $booking->purpose }}
                                                </p>
                                                @if($booking->participants_count)
                                                    <p class="text-sm text-gray-700 mt-1">
                                                        <i class="fas fa-users text-gray-400 mr-1"></i>
                                                        <strong>Peserta:</strong> {{ $booking->participants_count }} orang
                                                    </p>
                                                @endif
                                            </div>
                                            @php
                                                $now = \Carbon\Carbon::now();
                                                $bookingDate = \Carbon\Carbon::parse($booking->date);
                                                $startTime = \Carbon\Carbon::parse($booking->date . ' ' . $booking->start_time);
                                                $endTime = \Carbon\Carbon::parse($booking->date . ' ' . $booking->end_time);
                                                
                                                if ($now->between($startTime, $endTime)) {
                                                    $statusClass = 'bg-red-100 text-red-800';
                                                    $statusIcon = 'circle';
                                                    $statusText = 'Sedang Berlangsung';
                                                } elseif ($now->lt($startTime)) {
                                                    $statusClass = 'bg-blue-100 text-blue-800';
                                                    $statusIcon = 'clock';
                                                    $statusText = 'Akan Datang';
                                                } else {
                                                    $statusClass = 'bg-gray-100 text-gray-800';
                                                    $statusIcon = 'check';
                                                    $statusText = 'Selesai';
                                                }
                                            @endphp
                                            <span class="{{ $statusClass }} text-xs px-3 py-1 rounded-full font-medium">
                                                <i class="fas fa-{{ $statusIcon }} mr-1"></i>{{ $statusText }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-calendar-times text-gray-400 text-6xl mb-4"></i>
                    <p class="text-gray-600 text-lg">Tidak ada jadwal peminjaman pada tanggal ini</p>
                    <p class="text-gray-500 text-sm mt-2">Pilih tanggal lain untuk melihat jadwal</p>
                </div>
            @endif
        </div>
    </div>
@endsection
