@extends('layouts.app')

@section('title', 'Pengajuan Pending - Room Manager')

@section('content')
<div class="bg-gradient-to-b from-slate-950 via-slate-950/95 to-slate-950 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <header class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.4em] text-yellow-400/80">Room Manager</p>
                <h1 class="mt-2 text-3xl font-semibold text-white">Pengajuan Pending</h1>
                <p class="mt-2 text-sm text-slate-400 max-w-3xl">Tinjau setiap pengajuan peminjaman untuk ruangan yang Anda kelola. Pastikan jadwal tidak berbenturan sebelum meng-approve.</p>
            </div>
            <a href="{{ route('room-manager.dashboard') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-700/70 bg-slate-900/60 px-5 py-2.5 text-sm font-semibold text-slate-200 transition hover:bg-slate-800">Kembali ke Dashboard</a>
        </header>

        @if(session('success'))
            <div class="rounded-2xl border border-emerald-400/40 bg-emerald-500/15 px-4 py-3 text-sm text-emerald-200">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="rounded-2xl border border-rose-400/40 bg-rose-500/15 px-4 py-3 text-sm text-rose-200">{{ session('error') }}</div>
        @endif

        <div class="overflow-hidden rounded-3xl border border-white/5 bg-slate-900/60 shadow-xl shadow-black/30">
            <table class="min-w-full divide-y divide-slate-800/80 text-sm text-slate-200">
                <thead class="bg-slate-900/80 text-xs uppercase tracking-wide text-slate-400">
                    <tr>
                        <th class="px-4 py-3 text-left">Ruangan</th>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                        <th class="px-4 py-3 text-left">Waktu</th>
                        <th class="px-4 py-3 text-left">Peminjam</th>
                        <th class="px-4 py-3 text-left">Keperluan</th>
                        <th class="px-4 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60">
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-slate-900/40 transition">
                            <td class="px-4 py-4">
                                <div class="font-semibold text-white">{{ $booking->room->name }}</div>
                                <div class="text-xs text-slate-400">{{ strtoupper(str_replace('_', ' ', $booking->room->type)) }}</div>
                            </td>
                            <td class="px-4 py-4">
                                <div>{{ \Illuminate\Support\Carbon::parse($booking->booking_date)->translatedFormat('d M Y') }}</div>
                                <div class="text-xs text-slate-400">Diajukan {{ $booking->created_at->diffForHumans() }}</div>
                            </td>
                            <td class="px-4 py-4">{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                            <td class="px-4 py-4">
                                <div class="font-medium">{{ $booking->user->name }}</div>
                                <div class="text-xs text-slate-400">{{ $booking->user->email }}</div>
                            </td>
                            <td class="px-4 py-4 text-slate-300">{{ $booking->purpose ?? '-' }}</td>
                            <td class="px-4 py-4">
                                <div class="flex flex-col gap-2">
                                    <form method="POST" action="{{ route('room-manager.approve-booking', $booking->id) }}">
                                        @csrf
                                        <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-emerald-500 px-3 py-2 text-xs font-semibold uppercase tracking-[0.2em] text-emerald-950 shadow-lg shadow-emerald-500/25 transition hover:bg-emerald-400" onclick="return confirm('Setujui peminjaman untuk {{ $booking->room->name }}?')">
                                            Setujui
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('room-manager.reject-booking', $booking->id) }}" data-reject-form>
                                        @csrf
                                        <input type="hidden" name="reason" value="">
                                        <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-2xl border border-rose-400/40 bg-rose-500/15 px-3 py-2 text-xs font-semibold uppercase tracking-[0.2em] text-rose-200 transition hover:bg-rose-500/25" onclick="return handleReject(this)">
                                            Tolak
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-10 text-center text-sm text-slate-400">Tidak ada pengajuan pending saat ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>
            {{ $bookings->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function handleReject(button) {
        const form = button.closest('form[data-reject-form]');
        if (!form) return false;

        const reason = prompt('Tuliskan alasan penolakan (opsional):');
        if (reason === null) {
            return false;
        }

        form.querySelector('input[name="reason"]').value = reason;
        return true;
    }
</script>
@endpush
