@extends('layouts.app')

@section('title', 'Ruangan yang Dikelola')

@section('content')
<div class="bg-gradient-to-b from-slate-950 via-slate-950/95 to-slate-950 py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <header class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.4em] text-yellow-400/80">Room Manager</p>
                <h1 class="mt-2 text-3xl font-semibold text-white">Ruangan yang Anda Kelola</h1>
                <p class="mt-2 text-sm text-slate-400 max-w-2xl">Lihat detail ruangan, pantau status ketersediaan, dan akses riwayat peminjaman.
                </p>
            </div>
            <a href="{{ route('room-manager.dashboard') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-700/70 bg-slate-900/60 px-5 py-2.5 text-sm font-semibold text-slate-200 transition hover:bg-slate-800">
                Kembali ke Dashboard
            </a>
        </header>

        <div class="space-y-4">
            @forelse($managedRooms as $room)
                <article class="rounded-3xl border border-white/10 bg-slate-900/40 p-6 shadow-lg shadow-black/30 transition hover:border-yellow-400/70">
                    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                        <div>
                            <div class="flex items-center gap-2 text-xs uppercase tracking-[0.28em] text-yellow-400">
                                <span>{{ strtoupper(str_replace('_', ' ', $room->type)) }}</span>
                                <span class="inline-flex h-1 w-1 rounded-full bg-yellow-400"></span>
                                <span>{{ $room->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                            </div>
                            <h2 class="mt-2 text-2xl font-semibold text-white">{{ $room->name }}</h2>
                            <p class="mt-2 text-sm text-slate-400">Lokasi: {{ $room->location }}</p>
                            @if($room->facilities)
                                <p class="mt-1 text-sm text-slate-500">Fasilitas: {{ $room->facilities }}</p>
                            @endif
                        </div>
                        <div class="text-sm text-slate-400 space-y-2">
                            <div class="rounded-2xl border border-slate-700/70 bg-slate-950/60 px-4 py-3 text-center">
                                <p class="text-xs uppercase tracking-[0.28em] text-slate-500">Jadwal Aktif</p>
                                <p class="mt-1 text-xl font-semibold text-white">{{ $room->upcoming_bookings_count ?? 0 }}</p>
                            </div>
                            <a href="{{ route('room-manager.show-room', $room->id) }}" class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-yellow-400 px-4 py-2 font-semibold text-slate-950 shadow-lg shadow-yellow-500/25 transition hover:bg-yellow-300">Lihat Detail</a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="rounded-3xl border border-dashed border-slate-700 px-6 py-12 text-center text-sm text-slate-400">
                    Belum ada ruangan yang Anda kelola saat ini.
                </div>
            @endforelse
        </div>

        <div>
            {{ $managedRooms->links() }}
        </div>
    </div>
</div>
@endsection
