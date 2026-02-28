@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')
@section('header', 'Selamat Datang, ' . auth()->user()->name)

@section('content')
<div class="space-y-4 md:space-y-6">
      {{-- Quick Stats - Mobile Optimized with Slate Theme --}}
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4">
        <!-- Total Peminjaman -->
  <div class="group rounded-2xl border border-white/10 bg-linear-to-br from-blue-500/20 to-blue-600/10 backdrop-blur-sm p-5 md:p-6 hover:border-blue-500/30 transition-all duration-300">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Total Peminjaman</p>
              <p class="mt-2 text-3xl md:text-4xl font-bold text-white">{{ $totalPeminjaman ?? 0 }}</p>
              <p class="mt-1 text-xs text-slate-500">Seluruh pengajuan</p>
            </div>
            <div class="flex items-center justify-center w-14 h-14 rounded-xl bg-blue-500 shadow-lg shadow-blue-500/30">
              <i class="fas fa-clipboard-list text-white text-2xl"></i>
            </div>
          </div>
        </div>

        <!-- Total Ruangan -->
  <div class="group rounded-2xl border border-white/10 bg-linear-to-br from-purple-500/20 to-purple-600/10 backdrop-blur-sm p-5 md:p-6 hover:border-purple-500/30 transition-all duration-300">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Total Ruangan</p>
              <p class="mt-2 text-3xl md:text-4xl font-bold text-white">{{ $totalRuangan ?? 0 }}</p>
              <p class="mt-1 text-xs text-slate-500">Ruangan aktif</p>
            </div>
            <div class="flex items-center justify-center w-14 h-14 rounded-xl bg-purple-500 shadow-lg shadow-purple-500/30">
              <i class="fas fa-door-open text-white text-2xl"></i>
            </div>
          </div>
        </div>

        <!-- Total Pengguna -->
  <div class="group rounded-2xl border border-white/10 bg-linear-to-br from-green-500/20 to-green-600/10 backdrop-blur-sm p-5 md:p-6 hover:border-green-500/30 transition-all duration-300">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Total Pengguna</p>
              <p class="mt-2 text-3xl md:text-4xl font-bold text-white">{{ $totalUsers ?? 0 }}</p>
              <p class="mt-1 text-xs text-slate-500">Pengguna terdaftar</p>
            </div>
            <div class="flex items-center justify-center w-14 h-14 rounded-xl bg-green-500 shadow-lg shadow-green-500/30">
              <i class="fas fa-users text-white text-2xl"></i>
            </div>
          </div>
        </div>

        <!-- Menunggu Persetujuan -->
  <div class="group rounded-2xl border border-white/10 bg-linear-to-br from-orange-500/20 to-orange-600/10 backdrop-blur-sm p-5 md:p-6 hover:border-orange-500/30 transition-all duration-300">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Pending</p>
              <p class="mt-2 text-3xl md:text-4xl font-bold text-white">{{ $pendingCount ?? 0 }}</p>
              <p class="mt-1 text-xs text-slate-500">Menunggu approval</p>
            </div>
            <div class="flex items-center justify-center w-14 h-14 rounded-xl bg-orange-500 shadow-lg shadow-orange-500/30">
              <i class="fas fa-clock text-white text-2xl"></i>
            </div>
          </div>
        </div>
      </div>

      {{-- Status Overview & Quick Action --}}
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4">
        <!-- Approved -->
        <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm p-5 hover:bg-white/10 transition-colors">
          <div class="flex items-center justify-between">
            <div>
              <div class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Disetujui</div>
              <div class="mt-2 text-3xl md:text-4xl font-bold text-white">{{ $approvedCount ?? 0 }}</div>
              <p class="mt-1 text-xs text-slate-500">Peminjaman approved</p>
            </div>
            <div class="flex items-center justify-center w-14 h-14 rounded-xl bg-green-500 shadow-lg shadow-green-500/30">
              <i class="fas fa-check-circle text-white text-2xl"></i>
            </div>
          </div>
        </div>

        <!-- Rejected -->
        <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm p-5 hover:bg-white/10 transition-colors">
          <div class="flex items-center justify-between">
            <div>
              <div class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Ditolak</div>
              <div class="mt-2 text-3xl md:text-4xl font-bold text-white">{{ $rejectedCount ?? 0 }}</div>
              <p class="mt-1 text-xs text-slate-500">Peminjaman rejected</p>
            </div>
            <div class="flex items-center justify-center w-14 h-14 rounded-xl bg-red-500 shadow-lg shadow-red-500/30">
              <i class="fas fa-times-circle text-white text-2xl"></i>
            </div>
          </div>
        </div>

        <!-- Quick Action Button -->
  <a href="{{ route('admin.bookings.pending') }}" class="group rounded-2xl bg-gradient-to-br from-yellow-400 to-yellow-500 p-5 shadow-2xl shadow-yellow-500/40 hover:shadow-yellow-500/60 hover:scale-105 transition-all duration-300 flex items-center justify-center text-center sm:col-span-2 lg:col-span-1">
          <div class="flex flex-col sm:flex-row items-center gap-3">
            <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-white/30">
              <i class="fas fa-tasks text-white text-xl"></i>
            </div>
            <div class="text-center sm:text-left">
              <span class="block text-slate-900 font-bold text-base md:text-lg">Kelola Pending</span>
              <span class="block text-slate-800 text-xs mt-0.5">Tinjau pengajuan →</span>
            </div>
          </div>
        </a>
      </div>

      {{-- Pending Change Requests --}}
      <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm overflow-hidden">
        <div class="px-4 md:px-6 py-4 border-b border-white/10 flex items-center justify-between">
          <div class="flex items-center gap-3">
            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-yellow-400/15">
              <i class="fas fa-file-signature text-yellow-400"></i>
            </div>
            <div>
              <h3 class="text-base md:text-lg font-bold text-white">Pengajuan Perubahan Jadwal</h3>
              <p class="text-xs text-slate-400 hidden sm:block">Alasan edit/pembatalan dari pengatur ruangan</p>
            </div>
          </div>
          <span class="inline-flex items-center gap-2 rounded-full border border-yellow-400/40 bg-yellow-400/10 px-3 py-1 text-xs font-semibold text-yellow-300">
            <i class="fas fa-clock"></i>
            {{ ($pendingChangeRequests ?? collect())->count() }} pending
          </span>
        </div>

        <div class="hidden md:block overflow-x-auto">
          <table class="min-w-full text-sm">
            <thead class="bg-white/5 border-b border-white/10">
              <tr>
                <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Jadwal</th>
                <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Permintaan</th>
                <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Alasan</th>
                <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Diajukan Oleh</th>
                <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Masuk</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
            @forelse($pendingChangeRequests ?? [] as $request)
              <tr class="hover:bg-white/5 transition-colors">
                <td class="px-4 lg:px-6 py-4">
                  <div class="font-medium text-white">{{ optional($request->booking->room)->name ?? 'Ruangan tidak ditemukan' }}</div>
                  @if($request->booking)
                    <div class="text-xs text-slate-400 mt-1">
                      {{ \Illuminate\Support\Carbon::parse($request->booking->booking_date)->translatedFormat('d M Y') }} · {{ substr($request->booking->start_time, 0, 5) }}–{{ substr($request->booking->end_time, 0, 5) }}
                    </div>
                  @endif
                </td>
                <td class="px-4 lg:px-6 py-4">
                  @php
                    $typeConfig = match($request->type) {
                      \App\Models\BookingChangeRequest::TYPE_EDIT => ['label' => 'Perubahan Jadwal', 'bg' => 'bg-blue-500/10', 'text' => 'text-blue-300', 'border' => 'border-blue-500/30', 'icon' => 'pen'],
                      \App\Models\BookingChangeRequest::TYPE_CANCEL => ['label' => 'Pembatalan Jadwal', 'bg' => 'bg-red-500/10', 'text' => 'text-red-300', 'border' => 'border-red-500/30', 'icon' => 'ban'],
                      default => ['label' => ucfirst($request->type), 'bg' => 'bg-slate-500/10', 'text' => 'text-slate-300', 'border' => 'border-slate-500/30', 'icon' => 'info-circle']
                    };
                  @endphp
                  <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold border {{ $typeConfig['bg'] }} {{ $typeConfig['text'] }} {{ $typeConfig['border'] }}">
                    <i class="fas fa-{{ $typeConfig['icon'] }}"></i>
                    {{ $typeConfig['label'] }}
                  </span>
                </td>
                <td class="px-4 lg:px-6 py-4">
                  <p class="text-sm text-slate-200 whitespace-pre-line leading-relaxed">{{ $request->reason }}</p>
                </td>
                <td class="px-4 lg:px-6 py-4">
                  <div class="font-medium text-white">{{ optional($request->requester)->name ?? 'Tidak diketahui' }}</div>
                  <div class="text-xs text-slate-500">{{ optional($request->requester)->email }}</div>
                </td>
                <td class="px-4 lg:px-6 py-4 text-slate-400">
                  <div>{{ $request->created_at?->diffForHumans() }}</div>
                  <div class="text-xs text-slate-500">{{ $request->created_at?->format('d M Y H:i') }}</div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="px-6 py-8 text-center text-sm text-slate-500">Belum ada pengajuan perubahan baru.</td>
              </tr>
            @endforelse
            </tbody>
          </table>
        </div>

        <div class="md:hidden divide-y divide-white/5">
          @forelse($pendingChangeRequests ?? [] as $request)
            <div class="p-4 space-y-3">
              <div class="flex items-start justify-between">
                <div>
                  <div class="font-semibold text-white text-sm">{{ optional($request->booking->room)->name ?? 'Ruangan tidak ditemukan' }}</div>
                  @if($request->booking)
                    <div class="text-xs text-slate-400 mt-1">
                      {{ \Illuminate\Support\Carbon::parse($request->booking->booking_date)->translatedFormat('d M Y') }} · {{ substr($request->booking->start_time, 0, 5) }}–{{ substr($request->booking->end_time, 0, 5) }}
                    </div>
                  @endif
                </div>
                @php
                  $typeConfig = match($request->type) {
                    \App\Models\BookingChangeRequest::TYPE_EDIT => ['label' => 'Perubahan', 'bg' => 'bg-blue-500/10', 'text' => 'text-blue-300', 'border' => 'border-blue-500/30', 'icon' => 'pen'],
                    \App\Models\BookingChangeRequest::TYPE_CANCEL => ['label' => 'Pembatalan', 'bg' => 'bg-red-500/10', 'text' => 'text-red-300', 'border' => 'border-red-500/30', 'icon' => 'ban'],
                    default => ['label' => ucfirst($request->type), 'bg' => 'bg-slate-500/10', 'text' => 'text-slate-300', 'border' => 'border-slate-500/30', 'icon' => 'info-circle']
                  };
                @endphp
                <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold rounded-full border {{ $typeConfig['bg'] }} {{ $typeConfig['text'] }} {{ $typeConfig['border'] }}">
                  <i class="fas fa-{{ $typeConfig['icon'] }}"></i>
                  {{ $typeConfig['label'] }}
                </span>
              </div>
              <div class="rounded-xl bg-white/5 p-3 text-xs text-slate-200 whitespace-pre-line">{{ $request->reason }}</div>
              <div class="flex items-center justify-between text-xs text-slate-400">
                <span>{{ optional($request->requester)->name ?? 'Tidak diketahui' }}</span>
                <span>{{ $request->created_at?->diffForHumans() }}</span>
              </div>
            </div>
          @empty
            <div class="p-8 text-center text-slate-500 text-sm">Belum ada pengajuan perubahan baru.</div>
          @endforelse
        </div>
      </div>

      {{-- List User Non-Peminjam --}}
      <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm overflow-hidden mb-6">
        <div class="px-4 md:px-6 py-4 border-b border-white/10 flex items-center justify-between">
          <div class="flex items-center gap-3">
            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-green-500/10">
              <i class="fas fa-user-shield text-green-400"></i>
            </div>
            <div>
              <h3 class="text-base md:text-lg font-bold text-white">User Non-Peminjam</h3>
              <p class="text-xs text-slate-400 hidden sm:block">Admin, Kepala Sekolah, Cleaning Service</p>
            </div>
          </div>
        </div>

        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
          <table class="min-w-full text-sm">
            <thead class="bg-white/5 border-b border-white/10">
              <tr>
                <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">#</th>
                <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Nama</th>
                <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Email</th>
                <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">No. Telepon</th>
                <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Role</th>
                <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Status</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
            @foreach(\App\Models\User::where('role', '!=', 'peminjam')->where('role', '!=', 'guru')->get() as $u)
              <tr class="hover:bg-white/5 transition-colors">
                <td class="px-4 lg:px-6 py-4 text-slate-400">{{ $loop->iteration }}</td>
                <td class="px-4 lg:px-6 py-4">
                  <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-green-500 flex items-center justify-center text-white font-bold text-sm">
                      {{ strtoupper(substr($u->name, 0, 1)) }}
                    </div>
                    <span class="font-medium text-white">{{ $u->name }}</span>
                  </div>
                </td>
                <td class="px-4 lg:px-6 py-4 text-slate-300">{{ $u->email }}</td>
                <td class="px-4 lg:px-6 py-4 text-slate-400">{{ $u->phone ?? '-' }}</td>
                <td class="px-4 lg:px-6 py-4 text-slate-400">{{ $u->getRoleLabel() }}</td>
                <td class="px-4 lg:px-6 py-4">
                  @if($u->is_active)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-green-500/10 border border-green-500/30 text-green-400">
                      <i class="fas fa-check-circle"></i>
                      Aktif
                    </span>
                  @else
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-red-500/10 border border-red-500/30 text-red-400">
                      <i class="fas fa-times-circle"></i>
                      Nonaktif
                    </span>
                  @endif
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden divide-y divide-white/5">
          @forelse(\App\Models\User::where('role', '!=', 'peminjam')->where('role', '!=', 'guru')->get() as $u)
            <div class="p-4">
              <div class="flex items-start justify-between mb-2">
                <div class="flex items-center gap-3">
                  <div class="w-10 h-10 rounded-full bg-green-500 flex items-center justify-center text-white font-bold text-sm">
                    {{ strtoupper(substr($u->name, 0, 1)) }}
                  </div>
                  <div>
                    <div class="font-semibold text-white text-sm">{{ $u->name }}</div>
                    <div class="text-xs text-slate-400">{{ $u->getRoleLabel() }}</div>
                  </div>
                </div>
                @if($u->is_active)
                  <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-semibold rounded-full bg-green-500/10 border border-green-500/30 text-green-400">
                    <i class="fas fa-check-circle text-xs"></i>
                  </span>
                @else
                  <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-semibold rounded-full bg-red-500/10 border border-red-500/30 text-red-400">
                    <i class="fas fa-times-circle text-xs"></i>
                  </span>
                @endif
              </div>
              <div class="text-xs text-slate-400">{{ $u->email }}</div>
            </div>
          @empty
            <div class="p-6 text-center text-slate-500 text-sm">Tidak ada data user non-peminjam</div>
          @endforelse
        </div>
      </div>
      {{-- Recent Bookings - Mobile Optimized --}}
      <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm overflow-hidden">
        <div class="px-4 md:px-6 py-4 border-b border-white/10 flex items-center justify-between">
          <div class="flex items-center gap-3">
            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-blue-500/10">
              <i class="fas fa-history text-blue-400"></i>
            </div>
            <div>
              <h3 class="text-base md:text-lg font-bold text-white">Peminjaman Terbaru</h3>
              <p class="text-xs text-slate-400 hidden sm:block">Update realtime dari sistem</p>
            </div>
          </div>
          <span class="hidden lg:inline-flex items-center gap-2 text-xs text-slate-500">
            <span class="h-2 w-2 rounded-full bg-green-400 animate-pulse"></span>
            Live
          </span>
        </div>

        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
          <table class="min-w-full text-sm">
            <thead class="bg-white/5 border-b border-white/10">
              <tr>
                <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Peminjam</th>
                <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Ruangan</th>
                <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Tanggal</th>
                <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Waktu</th>
                <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Status</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
            @forelse($recentBookings ?? [] as $b)
              <tr class="hover:bg-white/5 transition-colors">
                <td class="px-4 lg:px-6 py-4">
                  <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold text-sm">
                      {{ strtoupper(substr($b->user->name ?? '?', 0, 1)) }}
                    </div>
                    <span class="font-medium text-white">{{ $b->user->name ?? '-' }}</span>
                  </div>
                </td>
                <td class="px-4 lg:px-6 py-4 text-slate-300">{{ $b->room->name ?? '-' }}</td>
                <td class="px-4 lg:px-6 py-4 text-slate-400">{{ \Illuminate\Support\Carbon::parse($b->booking_date)->format('d M Y') }}</td>
                <td class="px-4 lg:px-6 py-4 text-slate-400">{{ substr($b->start_time,0,5) }}–{{ substr($b->end_time,0,5) }}</td>
                <td class="px-4 lg:px-6 py-4">
                  @php
                    $statusConfig = match($b->status){
                      'approved' => ['bg' => 'bg-green-500/10', 'text' => 'text-green-400', 'border' => 'border-green-500/30', 'label' => 'Approved', 'icon' => 'check-circle'],
                      'rejected' => ['bg' => 'bg-red-500/10', 'text' => 'text-red-400', 'border' => 'border-red-500/30', 'label' => 'Rejected', 'icon' => 'times-circle'],
                      'pending'  => ['bg' => 'bg-yellow-500/10', 'text' => 'text-yellow-400', 'border' => 'border-yellow-500/30', 'label' => 'Pending', 'icon' => 'clock'],
                      default    => ['bg' => 'bg-slate-500/10', 'text' => 'text-slate-400', 'border' => 'border-slate-500/30', 'label' => ucfirst($b->status), 'icon' => 'info-circle']
                    };
                  @endphp
                  <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold border {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }} {{ $statusConfig['border'] }}">
                    <i class="fas fa-{{ $statusConfig['icon'] }}"></i>
                    {{ $statusConfig['label'] }}
                  </span>
                </td>
              </tr>
            @empty
              <tr><td colspan="5" class="px-6 py-12 text-center text-slate-500">
                <i class="fas fa-inbox text-4xl text-slate-700 mb-3"></i>
                <p>Belum ada data peminjaman</p>
              </td></tr>
            @endforelse
            </tbody>
          </table>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden divide-y divide-white/5">
          @forelse($recentBookings ?? [] as $b)
            <div class="p-4 hover:bg-white/5 transition-colors">
              <!-- Header: User & Status -->
              <div class="flex items-start justify-between mb-3">
                <div class="flex items-center gap-3">
                  <div class="w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">
                    {{ strtoupper(substr($b->user->name ?? '?', 0, 1)) }}
                  </div>
                  <div>
                    <div class="font-semibold text-white text-sm">{{ $b->user->name ?? '-' }}</div>
                    <div class="text-xs text-slate-500">Peminjam</div>
                  </div>
                </div>
                @php
                  $statusConfig = match($b->status){
                    'approved' => ['bg' => 'bg-green-500/10', 'text' => 'text-green-400', 'border' => 'border-green-500/30', 'label' => 'Approved', 'icon' => 'check-circle'],
                    'rejected' => ['bg' => 'bg-red-500/10', 'text' => 'text-red-400', 'border' => 'border-red-500/30', 'label' => 'Rejected', 'icon' => 'times-circle'],
                    'pending'  => ['bg' => 'bg-yellow-500/10', 'text' => 'text-yellow-400', 'border' => 'border-yellow-500/30', 'label' => 'Pending', 'icon' => 'clock'],
                    default    => ['bg' => 'bg-slate-500/10', 'text' => 'text-slate-400', 'border' => 'border-slate-500/30', 'label' => ucfirst($b->status), 'icon' => 'info-circle']
                  };
                @endphp
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold border {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }} {{ $statusConfig['border'] }}">
                  <i class="fas fa-{{ $statusConfig['icon'] }}"></i>
                  {{ $statusConfig['label'] }}
                </span>
              </div>

              <!-- Details Grid -->
              <div class="space-y-2">
                <!-- Ruangan -->
                <div class="flex items-center gap-3 rounded-xl bg-white/5 p-3">
                  <i class="fas fa-door-open text-slate-400"></i>
                  <div class="flex-1">
                    <div class="text-xs text-slate-500">Ruangan</div>
                    <div class="text-sm font-medium text-white">{{ $b->room->name ?? '-' }}</div>
                  </div>
                </div>

                <!-- Tanggal & Waktu -->
                <div class="grid grid-cols-2 gap-2">
                  <div class="flex items-center gap-3 rounded-xl bg-white/5 p-3">
                    <i class="fas fa-calendar text-slate-400"></i>
                    <div class="flex-1 min-w-0">
                      <div class="text-xs text-slate-500">Tanggal</div>
                      <div class="text-sm font-medium text-white truncate">{{ \Illuminate\Support\Carbon::parse($b->booking_date)->format('d M Y') }}</div>
                    </div>
                  </div>

                  <div class="flex items-center gap-3 rounded-xl bg-white/5 p-3">
                    <i class="fas fa-clock text-slate-400"></i>
                    <div class="flex-1 min-w-0">
                      <div class="text-xs text-slate-500">Waktu</div>
                      <div class="text-sm font-medium text-white truncate">{{ substr($b->start_time,0,5) }}–{{ substr($b->end_time,0,5) }}</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @empty
            <div class="p-12 text-center">
              <i class="fas fa-inbox text-5xl text-slate-700 mb-4"></i>
              <p class="text-slate-500 text-sm">Belum ada data peminjaman</p>
              <p class="text-slate-600 text-xs mt-1">Data akan muncul di sini</p>
            </div>
          @endforelse
        </div>
      </div>
</div>
@endsection
