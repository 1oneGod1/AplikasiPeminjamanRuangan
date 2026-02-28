@extends('layouts.app')

@section('title', 'Jadwal Mendatang - Room Manager')

@section('content')
<div class="bg-linear-to-b from-slate-950 via-slate-950/95 to-slate-950 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <header class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.4em] text-yellow-400/80">Room Manager</p>
                <h1 class="mt-2 text-3xl font-semibold text-white">Jadwal Mendatang</h1>
                <p class="mt-2 text-sm text-slate-400 max-w-3xl">Lihat seluruh peminjaman yang telah disetujui untuk ruangan yang Anda kelola. Gunakan filter untuk fokus pada ruangan tertentu.</p>
            </div>
            <div class="flex flex-col gap-2 md:items-end">
                <a href="{{ route('room-manager.dashboard') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-700/70 bg-slate-900/60 px-5 py-2.5 text-sm font-semibold text-slate-200 transition hover:bg-slate-800">Kembali ke Dashboard</a>
            </div>
        </header>

        <section class="rounded-3xl border border-white/5 bg-slate-900/60 p-6 shadow-xl shadow-black/30 space-y-6">
            @if (session('success'))
                <div class="rounded-2xl border border-emerald-500/40 bg-emerald-500/15 px-4 py-3 text-sm font-medium text-emerald-200 shadow-inner shadow-emerald-500/20">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="rounded-2xl border border-red-500/40 bg-red-500/10 px-4 py-3 text-sm font-medium text-red-200 shadow-inner shadow-red-500/20">
                    {{ session('error') }}
                </div>
            @endif
            <form method="GET" class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-3">
                    <label for="room_id" class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-400">Filter Ruangan</label>
                    <select name="room_id" id="room_id" class="rounded-2xl border border-slate-700/60 bg-slate-950/70 px-4 py-2 text-sm text-slate-100 shadow-inner shadow-black/30 focus:border-yellow-400/80 focus:outline-none focus:ring-2 focus:ring-yellow-400/20">
                        <option value="">Semua Ruangan</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}" @selected(request('room_id') == $room->id)>{{ $room->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="inline-flex items-center gap-2 rounded-2xl bg-yellow-400 px-5 py-2.5 text-sm font-semibold text-slate-950 shadow-lg shadow-yellow-500/20 transition hover:bg-yellow-300">Terapkan</button>
                    @if(request()->has('room_id') && request('room_id') !== null && request('room_id') !== '')
                        <a href="{{ route('room-manager.upcoming-bookings') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-700/70 bg-slate-900/60 px-5 py-2.5 text-sm font-semibold text-slate-200 transition hover:bg-slate-800">Reset</a>
                    @endif
                </div>
            </form>

            <div class="overflow-hidden rounded-3xl border border-white/5 bg-slate-900/70 shadow-inner shadow-black/30">
                <table class="min-w-full divide-y divide-slate-800/70 text-sm text-slate-200">
                    <thead class="bg-slate-900/80 text-xs uppercase tracking-[0.25em] text-slate-400">
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
                            <tr class="hover:bg-slate-900/50 transition">
                                @php
                                    $pendingRequests = $booking->changeRequests
                                        ->where('status', \App\Models\BookingChangeRequest::STATUS_PENDING)
                                        ->keyBy('type');
                                    $editPending = $pendingRequests->has(\App\Models\BookingChangeRequest::TYPE_EDIT);
                                    $cancelPending = $pendingRequests->has(\App\Models\BookingChangeRequest::TYPE_CANCEL);
                                    $editReason = $editPending ? $pendingRequests[\App\Models\BookingChangeRequest::TYPE_EDIT]->reason : null;
                                    $cancelReason = $cancelPending ? $pendingRequests[\App\Models\BookingChangeRequest::TYPE_CANCEL]->reason : null;
                                @endphp
                                <td class="px-4 py-4">
                                    <div class="font-semibold text-white">{{ $booking->room->name }}</div>
                                    <div class="text-xs text-slate-400 uppercase tracking-[0.25em]">{{ str_replace('_', ' ', $booking->room->type) }}</div>
                                </td>
                                <td class="px-4 py-4">
                                    {{ \Illuminate\Support\Carbon::parse($booking->booking_date)->translatedFormat('d M Y') }}
                                </td>
                                <td class="px-4 py-4">{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                                <td class="px-4 py-4">
                                    <div class="font-medium">{{ $booking->user->name }}</div>
                                    <div class="text-xs text-slate-400">{{ $booking->user->email }}</div>
                                </td>
                                <td class="px-4 py-4">
                                    @if($booking->purpose)
                                        <button type="button"
                                            data-purpose-modal-trigger
                                            data-purpose="{{ e($booking->purpose) }}"
                                            data-purpose-title="Keperluan · {{ $booking->room->name }}"
                                            class="inline-flex items-center gap-2 rounded-xl border border-slate-700/60 bg-slate-950/40 px-3 py-1.5 text-xs font-semibold text-slate-200 transition hover:border-yellow-400/60 hover:bg-slate-900/60">
                                            <i class="fas fa-eye"></i>
                                            <span>Lihat Keperluan</span>
                                        </button>
                                    @else
                                        <span class="text-xs text-slate-500">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <button type="button"
                                            data-change-request-trigger
                                            data-action="{{ route('room-manager.change-request', $booking) }}"
                                            data-type="{{ \App\Models\BookingChangeRequest::TYPE_EDIT }}"
                                            data-modal-title="Ajukan Perubahan Jadwal"
                                            data-placeholder="Jelaskan perubahan yang diinginkan"
                                            data-pending="{{ $editPending ? 'true' : 'false' }}"
                                            @if($editPending) disabled aria-disabled="true" title="Menunggu admin · {{ \Illuminate\Support\Str::limit($editReason, 80) }}" @endif
                                            @class([
                                                'inline-flex items-center gap-2 rounded-xl border px-3 py-1.5 text-xs font-semibold transition',
                                                'border-yellow-400/50 bg-yellow-400 text-slate-950 shadow-yellow-500/20 shadow-lg hover:bg-yellow-300' => !$editPending,
                                                'border-slate-700/60 bg-slate-900/40 text-slate-400 cursor-not-allowed' => $editPending,
                                            ])>
                                            <i class="fas fa-pen"></i>
                                            <span>{{ $editPending ? 'Menunggu Admin' : 'Ajukan Edit' }}</span>
                                        </button>
                                        <button type="button"
                                            data-change-request-trigger
                                            data-action="{{ route('room-manager.change-request', $booking) }}"
                                            data-type="{{ \App\Models\BookingChangeRequest::TYPE_CANCEL }}"
                                            data-modal-title="Ajukan Pembatalan Jadwal"
                                            data-placeholder="Tuliskan alasan pembatalan jadwal"
                                            data-pending="{{ $cancelPending ? 'true' : 'false' }}"
                                            @if($cancelPending) disabled aria-disabled="true" title="Menunggu admin · {{ \Illuminate\Support\Str::limit($cancelReason, 80) }}" @endif
                                            @class([
                                                'inline-flex items-center gap-2 rounded-xl border px-3 py-1.5 text-xs font-semibold transition',
                                                'border-red-400/50 bg-red-500/90 text-white shadow-red-500/20 shadow-lg hover:bg-red-400' => !$cancelPending,
                                                'border-slate-700/60 bg-slate-900/40 text-slate-400 cursor-not-allowed' => $cancelPending,
                                            ])>
                                            <i class="fas fa-ban"></i>
                                            <span>{{ $cancelPending ? 'Menunggu Admin' : 'Ajukan Pembatalan' }}</span>
                                        </button>
                                    </div>
                                    @if($editPending || $cancelPending)
                                        <p class="mt-2 text-xs text-slate-400/80">
                                            @if($editPending)
                                                Edit: "{{ \Illuminate\Support\Str::limit($editReason, 90) }}"
                                            @endif
                                            @if($editPending && $cancelPending)
                                                <span class="mx-1 text-slate-700">·</span>
                                            @endif
                                            @if($cancelPending)
                                                Batal: "{{ \Illuminate\Support\Str::limit($cancelReason, 90) }}"
                                            @endif
                                        </p>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-10 text-center text-sm text-slate-400">Belum ada jadwal mendatang untuk ruangan yang Anda kelola.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div>
                {{ $bookings->links() }}
            </div>
        </section>
    </div>
</div>
@endsection

@include('components.purpose-modal')

<div id="change-request-modal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
    <div data-change-request-overlay class="absolute inset-0 bg-slate-900/70 backdrop-blur-sm"></div>
    <div class="relative z-10 flex min-h-full items-center justify-center p-4">
        <div class="w-full max-w-lg rounded-3xl border border-slate-200 bg-white shadow-2xl dark:border-slate-800 dark:bg-slate-900">
            <div class="flex items-start justify-between gap-4 border-b border-slate-100 px-6 py-4 dark:border-slate-800">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.4em] text-slate-400 dark:text-slate-500">Pengajuan</p>
                    <h3 data-change-request-title class="mt-2 text-lg font-semibold text-slate-900 dark:text-white">Ajukan Perubahan Jadwal</h3>
                </div>
                <button type="button" data-change-request-close class="rounded-full bg-slate-100 p-2 text-slate-600 transition hover:bg-slate-200 focus:outline-none focus:ring-2 focus:ring-yellow-400 dark:bg-slate-800 dark:text-slate-300 dark:hover:bg-slate-700" aria-label="Tutup">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-4 w-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form method="POST" data-change-request-form class="px-6 py-5 space-y-4">
                @csrf
                <input type="hidden" name="type" value="">
                <div class="space-y-2">
                    <label for="change-request-reason" class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-500 dark:text-slate-400">Alasan Pengajuan</label>
                    <textarea id="change-request-reason" name="reason" rows="4" required class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-inner focus:border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400/30 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200" placeholder="Jelaskan alasan Anda secara ringkas dan jelas"></textarea>
                    <p data-change-request-helper class="text-xs text-slate-400 dark:text-slate-500">Jelaskan alasan Anda secara ringkas dan jelas.</p>
                </div>
                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-end">
                    <button type="button" data-change-request-close class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 focus:outline-none dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">
                        Batalkan
                    </button>
                    <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-yellow-400 px-5 py-2.5 text-sm font-semibold text-slate-950 shadow-lg shadow-yellow-500/20 transition hover:bg-yellow-300 focus:outline-none">
                        Kirim Pengajuan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
(() => {
    let modalInitialized = false;

    const initModal = () => {
        if (modalInitialized) {
            return;
        }
        modalInitialized = true;

        const modal = document.getElementById('change-request-modal');
        if (!modal) {
            return;
        }

        const overlay = modal.querySelector('[data-change-request-overlay]');
        const closeButtons = modal.querySelectorAll('[data-change-request-close]');
        const form = modal.querySelector('[data-change-request-form]');
        const titleEl = modal.querySelector('[data-change-request-title]');
        const helperEl = modal.querySelector('[data-change-request-helper]');
        const reasonInput = modal.querySelector('#change-request-reason');
        const typeInput = form?.querySelector('input[name="type"]');

        const openModal = ({ action, type, title, placeholder }) => {
            if (!form || !reasonInput || !typeInput) {
                return;
            }

            form.setAttribute('action', action);
            typeInput.value = type;
            reasonInput.value = '';
            reasonInput.placeholder = placeholder || 'Tuliskan alasan Anda secara ringkas.';

            if (titleEl) {
                titleEl.textContent = title || 'Ajukan Perubahan Jadwal';
            }

            if (helperEl) {
                helperEl.textContent = 'Alasan akan diteruskan ke admin dan tampil pada dashboard mereka.';
            }

            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
            reasonInput.focus();
        };

        const closeModal = () => {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        };

        document.addEventListener('click', (event) => {
            const trigger = event.target.closest('[data-change-request-trigger]');
            if (trigger) {
                const isPending = trigger.getAttribute('data-pending') === 'true';
                if (isPending) {
                    return;
                }

                event.preventDefault();
                openModal({
                    action: trigger.getAttribute('data-action'),
                    type: trigger.getAttribute('data-type'),
                    title: trigger.getAttribute('data-modal-title'),
                    placeholder: trigger.getAttribute('data-placeholder'),
                });
            }

            if (event.target.closest('[data-change-request-close]')) {
                event.preventDefault();
                closeModal();
            }
        });

        overlay?.addEventListener('click', closeModal);
        closeButtons.forEach((button) => button.addEventListener('click', closeModal));
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });
    };

    document.addEventListener('DOMContentLoaded', initModal);
})();
</script>
@endpush
