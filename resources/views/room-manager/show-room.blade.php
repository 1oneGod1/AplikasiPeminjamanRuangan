@extends('layouts.app')

@section('title', 'Detail Ruangan - Room Manager')

@section('content')
<div class="bg-gradient-to-b from-slate-950 via-slate-950/95 to-slate-950">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-8">
        <header class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.4em] text-yellow-400/80">Room Manager</p>
                <h1 class="mt-2 text-3xl font-semibold text-white">{{ $room->name }}</h1>
                <div class="mt-2 flex flex-wrap items-center gap-3 text-sm text-slate-300">
                    <span class="rounded-full bg-yellow-500/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.25em] text-yellow-300">{{ strtoupper(str_replace('_', ' ', $room->type)) }}</span>
                    <span class="inline-flex items-center gap-2 rounded-full bg-slate-900/80 px-3 py-1 text-xs text-slate-300">
                        <span class="size-2 rounded-full {{ $room->is_active ? 'bg-emerald-400' : 'bg-rose-400' }}"></span>
                        {{ $room->is_active ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                </div>
                <p class="mt-4 max-w-2xl text-sm text-slate-400">{{ $room->description ?? 'Ruangan belum memiliki deskripsi.' }}</p>
            </div>
            <div class="flex flex-col gap-2 md:items-end">
                <a href="{{ route('room-manager.rooms') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-700/70 bg-slate-900/60 px-5 py-2.5 text-sm font-semibold text-slate-200 transition hover:bg-slate-800">Kembali ke Daftar Ruangan</a>
                @if($room->capacity)
                    <span class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-500">Kapasitas <span class="ml-2 text-slate-200">{{ $room->capacity }} orang</span></span>
                @endif
            </div>
        </header>

        <section class="grid gap-6 md:grid-cols-2">
            <article class="rounded-3xl border border-white/5 bg-slate-900/60 p-6 shadow-xl shadow-black/30">
                <h2 class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-400">Jadwal Mendatang</h2>
                <div class="mt-4 space-y-4">
                    @forelse($upcomingBookings as $booking)
                        <div class="rounded-2xl bg-slate-900/70 p-4">
                            <div class="flex flex-wrap items-center justify-between gap-3">
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-yellow-400/80">{{ \Illuminate\Support\Carbon::parse($booking->booking_date)->translatedFormat('d M Y') }}</p>
                                    <p class="mt-1 text-lg font-semibold text-white">{{ $booking->start_time }} - {{ $booking->end_time }}</p>
                                </div>
                                <div class="flex flex-col gap-1 text-right text-sm text-slate-300">
                                    <p class="font-semibold text-white">{{ $booking->user->name }}</p>
                                    <p>{{ $booking->purpose ?? 'Tidak ada keperluan' }}</p>
                                    <span class="self-end rounded-full bg-emerald-500/15 px-3 py-1 text-xs font-semibold uppercase tracking-[0.25em] text-emerald-300">{{ strtoupper($booking->status) }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-slate-400">Tidak ada jadwal mendatang.</p>
                    @endforelse
                </div>
            </article>

            <article class="rounded-3xl border border-white/5 bg-slate-900/60 p-6 shadow-xl shadow-black/30">
                <h2 class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-400">Riwayat Terakhir</h2>
                <div class="mt-4 space-y-4">
                    @forelse($recentHistories as $history)
                        <div class="rounded-2xl border border-slate-800/60 bg-slate-900/70 p-4">
                            <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">{{ $history->created_at?->diffForHumans() ?? 'Baru saja' }}</p>
                            <p class="mt-1 text-sm text-slate-300">{{ $history->notes ?? $history->getFormattedHistory() }}</p>
                            @if($history->changedBy)
                                <p class="mt-1 text-xs text-slate-500">Oleh: {{ $history->changedBy->name }}</p>
                            @endif
                        </div>
                    @empty
                        <p class="text-sm text-slate-400">Belum ada riwayat perubahan.</p>
                    @endforelse
                </div>
            </article>
        </section>

        <section class="rounded-3xl border border-white/5 bg-slate-900/60 p-6 shadow-xl shadow-black/30">
            <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <h2 class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-400">Ringkasan Penggunaan</h2>
                <div class="text-xs text-slate-400">Total peminjaman disetujui: <span class="font-semibold text-emerald-300">{{ $approvedBookingsCount }}</span></div>
            </div>
            <div class="mt-6 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                <div class="rounded-2xl border border-slate-800/60 bg-slate-900/70 p-4">
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-500">Manager Lain</p>
                    <div class="mt-2 space-y-2">
                        @forelse($otherManagers as $manager)
                            <div class="flex items-center gap-3">
                                <div class="flex size-8 items-center justify-center rounded-full bg-slate-800 text-xs font-semibold text-slate-300">{{ strtoupper(substr($manager->name, 0, 2)) }}</div>
                                <div>
                                    <p class="text-sm font-medium text-white">{{ $manager->name }}</p>
                                    <p class="text-xs text-slate-400">{{ $manager->email }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-slate-400">Anda adalah satu-satunya manager ruangan ini.</p>
                        @endforelse
                    </div>
                </div>
                <div class="rounded-2xl border border-slate-800/60 bg-slate-900/70 p-4">
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-500">Fasilitas</p>
                    <div class="mt-2 text-sm text-slate-300">
                        @if($room->facilities)
                            @php
                                $facilities = array_filter(array_map('trim', explode(',', $room->facilities)));
                            @endphp
                            @if(count($facilities))
                                <ul class="list-disc space-y-1 pl-5">
                                    @foreach($facilities as $facility)
                                        <li>{{ $facility }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p>Belum ada data fasilitas.</p>
                            @endif
                        @else
                            <p>Belum ada data fasilitas.</p>
                        @endif
                    </div>
                </div>
                <div class="rounded-2xl border border-slate-800/60 bg-slate-900/70 p-4">
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-500">Catatan Terakhir</p>
                    <p class="mt-2 text-sm text-slate-300">{{ $room->notes ?? 'Belum ada catatan tambahan.' }}</p>
                    <p class="mt-3 text-xs text-slate-500">Total booking disetujui: <span class="font-semibold text-emerald-300">{{ $approvedBookingsCount }}</span></p>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
