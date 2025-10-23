@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')
@section('header', 'Selamat Datang, ' . auth()->user()->name)

@section('content')
<div class="space-y-4 md:space-y-6">
      {{-- Quick Stats - Mobile Optimized --}}
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4">
        <!-- Total Peminjaman -->
        <div class="group rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 p-4 md:p-5 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
          <div class="flex items-center justify-between">
            <div class="flex-1">
              <p class="text-xs md:text-sm text-blue-100 font-medium">Total Peminjaman</p>
              <p class="mt-1 md:mt-2 text-2xl md:text-3xl font-bold text-white">{{ $totalPeminjaman ?? 0 }}</p>
            </div>
            <div class="flex items-center justify-center w-10 h-10 md:w-12 md:h-12 rounded-full bg-white/20 backdrop-blur-sm">
              <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
              </svg>
            </div>
          </div>
        </div>

        <!-- Total Ruangan -->
        <div class="group rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 p-4 md:p-5 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
          <div class="flex items-center justify-between">
            <div class="flex-1">
              <p class="text-xs md:text-sm text-purple-100 font-medium">Total Ruangan</p>
              <p class="mt-1 md:mt-2 text-2xl md:text-3xl font-bold text-white">{{ $totalRuangan ?? 0 }}</p>
            </div>
            <div class="flex items-center justify-center w-10 h-10 md:w-12 md:h-12 rounded-full bg-white/20 backdrop-blur-sm">
              <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
              </svg>
            </div>
          </div>
        </div>

        <!-- Total Pengguna -->
        <div class="group rounded-xl bg-gradient-to-br from-green-500 to-green-600 p-4 md:p-5 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
          <div class="flex items-center justify-between">
            <div class="flex-1">
              <p class="text-xs md:text-sm text-green-100 font-medium">Total Pengguna</p>
              <p class="mt-1 md:mt-2 text-2xl md:text-3xl font-bold text-white">{{ $totalUsers ?? 0 }}</p>
            </div>
            <div class="flex items-center justify-center w-10 h-10 md:w-12 md:h-12 rounded-full bg-white/20 backdrop-blur-sm">
              <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
              </svg>
            </div>
          </div>
        </div>

        <!-- Menunggu Persetujuan -->
        <div class="group rounded-xl bg-gradient-to-br from-orange-500 to-orange-600 p-4 md:p-5 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
          <div class="flex items-center justify-between">
            <div class="flex-1">
              <p class="text-xs md:text-sm text-orange-100 font-medium">Pending</p>
              <p class="mt-1 md:mt-2 text-2xl md:text-3xl font-bold text-white">{{ $pendingCount ?? 0 }}</p>
            </div>
            <div class="flex items-center justify-center w-10 h-10 md:w-12 md:h-12 rounded-full bg-white/20 backdrop-blur-sm">
              <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
          </div>
        </div>
      </div>

      {{-- Status Overview & Quick Action --}}
      <div class="grid grid-cols-1 md:grid-cols-3 gap-3 md:gap-4">
        <!-- Approved -->
        <div class="rounded-xl bg-white p-4 shadow border border-gray-100 hover:border-green-200 transition-colors">
          <div class="flex items-center justify-between">
            <div>
              <div class="text-xs text-gray-500 font-medium uppercase tracking-wide">Disetujui</div>
              <div class="mt-1 text-2xl md:text-3xl font-bold text-green-600">{{ $approvedCount ?? 0 }}</div>
            </div>
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-green-50">
              <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
          </div>
        </div>

        <!-- Rejected -->
        <div class="rounded-xl bg-white p-4 shadow border border-gray-100 hover:border-red-200 transition-colors">
          <div class="flex items-center justify-between">
            <div>
              <div class="text-xs text-gray-500 font-medium uppercase tracking-wide">Ditolak</div>
              <div class="mt-1 text-2xl md:text-3xl font-bold text-red-600">{{ $rejectedCount ?? 0 }}</div>
            </div>
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-red-50">
              <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
          </div>
        </div>

        <!-- Quick Action Button -->
        <a href="{{ route('admin.bookings.pending') }}" class="group rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-700 p-4 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 flex items-center justify-center text-center">
          <div class="flex items-center gap-2">
            <svg class="w-5 h-5 md:w-6 md:h-6 text-white group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <span class="text-white font-bold text-sm md:text-base">Kelola Pending</span>
            <svg class="w-4 h-4 text-white group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
          </div>
        </a>
      </div>

      {{-- Recent Bookings - Mobile Optimized --}}
      <div class="rounded-xl bg-white shadow border border-gray-100">
        <div class="px-4 md:px-5 py-3 md:py-4 border-b border-gray-100 flex items-center justify-between">
          <h3 class="text-base md:text-lg font-bold text-gray-800 flex items-center gap-2">
            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Peminjaman Terbaru
          </h3>
          <span class="text-xs text-gray-500 hidden md:inline">Update realtime</span>
        </div>

        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
          <table class="min-w-full text-sm">
            <thead class="bg-gray-50 text-gray-600">
              <tr>
                <th class="px-4 py-3 text-left font-semibold">Peminjam</th>
                <th class="px-4 py-3 text-left font-semibold">Ruangan</th>
                <th class="px-4 py-3 text-left font-semibold">Tanggal</th>
                <th class="px-4 py-3 text-left font-semibold">Waktu</th>
                <th class="px-4 py-3 text-left font-semibold">Status</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
            @forelse($recentBookings ?? [] as $b)
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-4 py-3">
                  <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs">
                      {{ strtoupper(substr($b->user->name ?? '?', 0, 1)) }}
                    </div>
                    <span class="font-medium text-gray-800">{{ $b->user->name ?? '-' }}</span>
                  </div>
                </td>
                <td class="px-4 py-3 text-gray-700">{{ $b->room->name ?? '-' }}</td>
                <td class="px-4 py-3 text-gray-600">{{ \Illuminate\Support\Carbon::parse($b->booking_date)->format('d M Y') }}</td>
                <td class="px-4 py-3 text-gray-600">{{ substr($b->start_time,0,5) }}–{{ substr($b->end_time,0,5) }}</td>
                <td class="px-4 py-3">
                  @php
                    $statusConfig = match($b->status){
                      'approved' => ['bg' => 'bg-green-100', 'text' => 'text-green-700', 'label' => 'Approved'],
                      'rejected' => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'label' => 'Rejected'],
                      'pending'  => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-700', 'label' => 'Pending'],
                      default    => ['bg' => 'bg-gray-100', 'text' => 'text-gray-700', 'label' => ucfirst($b->status)]
                    };
                  @endphp
                  <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }}">
                    {{ $statusConfig['label'] }}
                  </span>
                </td>
              </tr>
            @empty
              <tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">Belum ada data peminjaman.</td></tr>
            @endforelse
            </tbody>
          </table>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden divide-y divide-gray-100">
          @forelse($recentBookings ?? [] as $b)
            <div class="p-4 hover:bg-gray-50 transition-colors">
              <!-- Header: User & Status -->
              <div class="flex items-start justify-between mb-3">
                <div class="flex items-center gap-2">
                  <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-sm">
                    {{ strtoupper(substr($b->user->name ?? '?', 0, 1)) }}
                  </div>
                  <div>
                    <div class="font-semibold text-gray-800 text-sm">{{ $b->user->name ?? '-' }}</div>
                    <div class="text-xs text-gray-500">Peminjam</div>
                  </div>
                </div>
                @php
                  $statusConfig = match($b->status){
                    'approved' => ['bg' => 'bg-green-100', 'text' => 'text-green-700', 'label' => 'Approved'],
                    'rejected' => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'label' => 'Rejected'],
                    'pending'  => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-700', 'label' => 'Pending'],
                    default    => ['bg' => 'bg-gray-100', 'text' => 'text-gray-700', 'label' => ucfirst($b->status)]
                  };
                @endphp
                <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }}">
                  {{ $statusConfig['label'] }}
                </span>
              </div>

              <!-- Details Grid -->
              <div class="grid grid-cols-2 gap-3">
                <!-- Ruangan -->
                <div class="flex items-start gap-2">
                  <svg class="w-4 h-4 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                  </svg>
                  <div>
                    <div class="text-xs text-gray-500">Ruangan</div>
                    <div class="text-sm font-medium text-gray-800">{{ $b->room->name ?? '-' }}</div>
                  </div>
                </div>

                <!-- Tanggal -->
                <div class="flex items-start gap-2">
                  <svg class="w-4 h-4 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                  </svg>
                  <div>
                    <div class="text-xs text-gray-500">Tanggal</div>
                    <div class="text-sm font-medium text-gray-800">{{ \Illuminate\Support\Carbon::parse($b->booking_date)->format('d M Y') }}</div>
                  </div>
                </div>

                <!-- Waktu -->
                <div class="flex items-start gap-2 col-span-2">
                  <svg class="w-4 h-4 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                  </svg>
                  <div>
                    <div class="text-xs text-gray-500">Waktu</div>
                    <div class="text-sm font-medium text-gray-800">{{ substr($b->start_time,0,5) }} – {{ substr($b->end_time,0,5) }} WIB</div>
                  </div>
                </div>
              </div>
            </div>
          @empty
            <div class="p-8 text-center">
              <svg class="w-16 h-16 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
              </svg>
              <p class="text-gray-500 text-sm">Belum ada data peminjaman</p>
            </div>
          @endforelse
        </div>
      </div>
</div>
@endsection
