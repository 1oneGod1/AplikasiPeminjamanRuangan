

<?php $__env->startSection('title', 'Pengajuan Pending - Room Manager'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-gradient-to-b from-slate-950 via-slate-950/95 to-slate-950 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <header class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.4em] text-yellow-400/80">Room Manager</p>
                <h1 class="mt-2 text-3xl font-semibold text-white">Pengajuan Pending</h1>
                <p class="mt-2 text-sm text-slate-400 max-w-3xl">Tinjau setiap pengajuan peminjaman untuk ruangan yang Anda kelola. Pastikan jadwal tidak berbenturan sebelum meng-approve.</p>
            </div>
            <a href="<?php echo e(route('room-manager.dashboard')); ?>" class="inline-flex items-center gap-2 rounded-2xl border border-slate-700/70 bg-slate-900/60 px-5 py-2.5 text-sm font-semibold text-slate-200 transition hover:bg-slate-800">Kembali ke Dashboard</a>
        </header>

        <?php if(session('success')): ?>
            <div class="rounded-2xl border border-emerald-400/40 bg-emerald-500/15 px-4 py-3 text-sm text-emerald-200"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="rounded-2xl border border-rose-400/40 bg-rose-500/15 px-4 py-3 text-sm text-rose-200"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

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
                    <?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-slate-900/40 transition">
                            <td class="px-4 py-4">
                                <div class="font-semibold text-white"><?php echo e($booking->room->name); ?></div>
                                <div class="text-xs text-slate-400"><?php echo e(strtoupper(str_replace('_', ' ', $booking->room->type))); ?></div>
                            </td>
                            <td class="px-4 py-4">
                                <div><?php echo e(\Illuminate\Support\Carbon::parse($booking->booking_date)->translatedFormat('d M Y')); ?></div>
                                <div class="text-xs text-slate-400">Diajukan <?php echo e($booking->created_at->diffForHumans()); ?></div>
                            </td>
                            <td class="px-4 py-4"><?php echo e($booking->start_time); ?> - <?php echo e($booking->end_time); ?></td>
                            <td class="px-4 py-4">
                                <div class="font-medium"><?php echo e($booking->user->name); ?></div>
                                <div class="text-xs text-slate-400"><?php echo e($booking->user->email); ?></div>
                            </td>
                            <td class="px-4 py-4 text-slate-300"><?php echo e($booking->purpose ?? '-'); ?></td>
                            <td class="px-4 py-4">
                                <div class="flex flex-col gap-2">
                                    <form method="POST" action="<?php echo e(route('room-manager.approve-booking', $booking->id)); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-emerald-500 px-3 py-2 text-xs font-semibold uppercase tracking-[0.2em] text-emerald-950 shadow-lg shadow-emerald-500/25 transition hover:bg-emerald-400" onclick="return confirm('Setujui peminjaman untuk <?php echo e($booking->room->name); ?>?')">
                                            Setujui
                                        </button>
                                    </form>
                                    <form method="POST" action="<?php echo e(route('room-manager.reject-booking', $booking->id)); ?>" data-reject-form>
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="reason" value="">
                                        <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-2xl border border-rose-400/40 bg-rose-500/15 px-3 py-2 text-xs font-semibold uppercase tracking-[0.2em] text-rose-200 transition hover:bg-rose-500/25" onclick="return handleReject(this)">
                                            Tolak
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-4 py-10 text-center text-sm text-slate-400">Tidak ada pengajuan pending saat ini.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div>
            <?php echo e($bookings->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Semester 4\ENG\ALP\Booking-Ruangan\resources\views/room-manager/pending-bookings.blade.php ENDPATH**/ ?>