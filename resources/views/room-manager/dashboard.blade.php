@extends('layouts.app')

@section('title', 'Dashboard Pengatur Ruangan')

@section('content')
<div class="bg-linear-to-b from-slate-950 via-slate-950/95 to-slate-950 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        <header class="space-y-4">
            <p class="text-xs font-semibold uppercase tracking-[0.4em] text-yellow-400/80">Room Manager</p>
            <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                <div>
                    <h1 class="text-3xl sm:text-4xl font-semibold text-white">Dashboard Pengatur Ruangan</h1>
                    <p class="mt-2 text-sm text-slate-400 max-w-3xl">Pantau ruangan yang Anda kelola, tindak lanjuti pengajuan peminjaman, dan pastikan aktivitas berjalan tertib.</p>
                </div>
                <div class="flex gap-3">
                    @if($managedRooms->isNotEmpty())
                        <a href="{{ route('room-manager.rooms') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-700/70 bg-slate-900/60 px-5 py-2.5 text-sm font-semibold text-slate-200 transition hover:bg-slate-800">Daftar Ruangan</a>
                    @endif
                    <a href="{{ route('room-manager.pending-bookings') }}" class="inline-flex items-center gap-2 rounded-2xl bg-yellow-400 px-5 py-2.5 text-sm font-semibold text-slate-950 shadow-lg shadow-yellow-500/20 transition hover:bg-yellow-300">Pengajuan Pending</a>
                </div>
            </div>
        </header>

        <section class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <article class="rounded-3xl border border-white/10 bg-slate-900/40 p-6 shadow-2xl shadow-black/40 backdrop-blur">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-400">Ruangan Dikelola</p>
                <p class="mt-3 text-4xl font-bold text-white">{{ $totalManagedRooms }}</p>
                <p class="mt-2 text-sm text-slate-400">Total ruangan yang dipercayakan kepada Anda.</p>
            </article>
            <article class="rounded-3xl border border-white/10 bg-slate-900/40 p-6 shadow-2xl shadow-black/40 backdrop-blur">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-400">Butuh Persetujuan</p>
                <p class="mt-3 text-4xl font-bold text-white">{{ $totalPendingBookings }}</p>
                <p class="mt-2 text-sm text-slate-400">Pengajuan yang menunggu tindakan Anda.</p>
            </article>
            <article class="rounded-3xl border border-white/10 bg-slate-900/40 p-6 shadow-2xl shadow-black/40 backdrop-blur">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-400">Terjadwal</p>
                <p class="mt-3 text-4xl font-bold text-white">{{ $totalApprovedBookings }}</p>
                <p class="mt-2 text-sm text-slate-400">Jadwal mendatang yang telah disetujui.</p>
            </article>
        </section>

        <section class="grid gap-6 lg:grid-cols-2">
            <div class="rounded-3xl border border-white/10 bg-slate-900/50 p-6 shadow-inner shadow-black/30">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <h2 class="text-lg font-semibold text-white">Ruangan yang Anda Kelola</h2>
                        <p class="text-sm text-slate-400">Klik nama ruangan untuk melihat detail peminjaman.</p>
                    </div>
                    <a href="{{ route('room-manager.rooms') }}" class="text-xs font-semibold uppercase tracking-[0.28em] text-yellow-400">Lihat Semua</a>
                </div>
                <div class="mt-5 space-y-3">
                    @forelse($managedRooms as $room)
                        <a href="{{ route('room-manager.show-room', $room->id) }}" class="flex items-center justify-between rounded-2xl border border-slate-800/80 bg-slate-950/50 px-4 py-3 text-sm text-slate-200 transition hover:border-yellow-400/60 hover:text-white">
                            <div>
                                <p class="font-semibold">{{ $room->name }}</p>
                                <p class="text-xs text-slate-400">{{ strtoupper(str_replace('_', ' ', $room->type)) }}</p>
                            </div>
                            <div class="text-right text-xs text-slate-400">
                                <span>{{ $room->upcoming_bookings_count ?? 0 }} jadwal aktif</span>
                            </div>
                        </a>
                    @empty
                        <div class="rounded-2xl border border-dashed border-slate-700 px-4 py-8 text-center text-sm text-slate-400">
                            Belum ada ruangan yang Anda kelola saat ini.
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="rounded-3xl border border-white/10 bg-slate-900/50 p-6 shadow-inner shadow-black/30">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <h2 class="text-lg font-semibold text-white">Jadwal Mendatang</h2>
                        <p class="text-sm text-slate-400">Booking yang sudah Anda approve dan segera berlangsung.</p>
                    </div>
                    <a href="{{ route('room-manager.upcoming-bookings') }}" class="text-xs font-semibold uppercase tracking-[0.28em] text-yellow-400">Jadwal Lengkap</a>
                </div>
                <div class="mt-5 space-y-4">
                    @forelse($approvedBookings as $booking)
                        <div class="rounded-2xl border border-slate-800/80 bg-slate-950/40 px-4 py-3 text-sm text-slate-200">
                            <div class="flex items-center justify-between">
                                <p class="font-semibold">{{ $booking->room->name }}</p>
                                <span class="rounded-full bg-emerald-500/15 px-3 py-1 text-xs font-semibold text-emerald-300">Disetujui</span>
                            </div>
                            <div class="mt-2 flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-slate-400">
                                <span>{{ \Illuminate\Support\Carbon::parse($booking->booking_date)->translatedFormat('d M Y') }}</span>
                                <span>{{ $booking->start_time }} - {{ $booking->end_time }}</span>
                                <span>Peminjam: {{ $booking->user->name }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-2xl border border-dashed border-slate-700 px-4 py-8 text-center text-sm text-slate-400">
                            Belum ada jadwal mendatang.
                        </div>
                    @endforelse
                </div>
                <div class="mt-4">{{ $approvedBookings->links() }}</div>
            </div>
        </section>

        <section class="rounded-3xl border border-white/10 bg-slate-900/60 p-6 shadow-inner shadow-black/30">
            <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-white">Pengajuan Pending</h2>
                    <p class="text-sm text-slate-400">Tinjau permintaan peminjaman yang menunggu keputusan Anda.</p>
                </div>
                <a href="{{ route('room-manager.pending-bookings') }}" class="text-xs font-semibold uppercase tracking-[0.28em] text-yellow-400">Kelola Lebih Lengkap</a>
            </div>

            <div class="mt-6 overflow-hidden rounded-2xl border border-slate-800/60 bg-slate-950/40">
                <table class="min-w-full divide-y divide-slate-800/80 text-sm text-slate-200">
                    <thead class="bg-slate-900/80 text-xs uppercase tracking-wide text-slate-400">
                        <tr>
                            <th class="px-4 py-3 text-left">Ruangan</th>
                            <th class="px-4 py-3 text-left">Tanggal</th>
                            <th class="px-4 py-3 text-left">Waktu</th>
                            <th class="px-4 py-3 text-left">Peminjam</th>
                            <th class="px-4 py-3 text-left">Catatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/60">
                        @forelse($pendingBookings as $booking)
                            <tr class="hover:bg-slate-900/50 transition">
                                <td class="px-4 py-3 font-medium text-white">{{ $booking->room->name }}</td>
                                <td class="px-4 py-3">{{ \Illuminate\Support\Carbon::parse($booking->booking_date)->translatedFormat('d M Y') }}</td>
                                <td class="px-4 py-3">{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                                <td class="px-4 py-3">{{ $booking->user->name }}</td>
                                <td class="px-4 py-3 text-slate-400">{{ $booking->purpose ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-sm text-slate-400">Tidak ada pengajuan pending saat ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $pendingBookings->links() }}</div>
        </section>
    </div>
</div>
@endsection
