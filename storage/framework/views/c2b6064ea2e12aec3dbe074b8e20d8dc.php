

<?php $__env->startSection('title', 'Detail Ruangan - Room Manager'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-gradient-to-b from-slate-950 via-slate-950/95 to-slate-950">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-8">
        <header class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.4em] text-yellow-400/80">Room Manager</p>
                <h1 class="mt-2 text-3xl font-semibold text-white"><?php echo e($room->name); ?></h1>
                <div class="mt-2 flex flex-wrap items-center gap-3 text-sm text-slate-300">
                    <span class="rounded-full bg-yellow-500/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.25em] text-yellow-300"><?php echo e(strtoupper(str_replace('_', ' ', $room->type))); ?></span>
                    <span class="inline-flex items-center gap-2 rounded-full bg-slate-900/80 px-3 py-1 text-xs text-slate-300">
                        <span class="size-2 rounded-full <?php echo e($room->is_active ? 'bg-emerald-400' : 'bg-rose-400'); ?>"></span>
                        <?php echo e($room->is_active ? 'Aktif' : 'Tidak Aktif'); ?>

                    </span>
                </div>
                <p class="mt-4 max-w-2xl text-sm text-slate-400"><?php echo e($room->description ?? 'Ruangan belum memiliki deskripsi.'); ?></p>
            </div>
            <div class="flex flex-col gap-2 md:items-end">
                <a href="<?php echo e(route('room-manager.rooms')); ?>" class="inline-flex items-center gap-2 rounded-2xl border border-slate-700/70 bg-slate-900/60 px-5 py-2.5 text-sm font-semibold text-slate-200 transition hover:bg-slate-800">Kembali ke Daftar Ruangan</a>
                <?php if($room->capacity): ?>
                    <span class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-500">Kapasitas <span class="ml-2 text-slate-200"><?php echo e($room->capacity); ?> orang</span></span>
                <?php endif; ?>
            </div>
        </header>

        <section class="grid gap-6 md:grid-cols-2">
            <article class="rounded-3xl border border-white/5 bg-slate-900/60 p-6 shadow-xl shadow-black/30">
                <h2 class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-400">Jadwal Mendatang</h2>
                <div class="mt-4 space-y-4">
                    <?php $__empty_1 = true; $__currentLoopData = $upcomingBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="rounded-2xl bg-slate-900/70 p-4">
                            <div class="flex flex-wrap items-center justify-between gap-3">
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-yellow-400/80"><?php echo e(\Illuminate\Support\Carbon::parse($booking->booking_date)->translatedFormat('d M Y')); ?></p>
                                    <p class="mt-1 text-lg font-semibold text-white"><?php echo e($booking->start_time); ?> - <?php echo e($booking->end_time); ?></p>
                                </div>
                                <div class="flex flex-col gap-1 text-right text-sm text-slate-300">
                                    <p class="font-semibold text-white"><?php echo e($booking->user->name); ?></p>
                                    <p><?php echo e($booking->purpose ?? 'Tidak ada keperluan'); ?></p>
                                    <span class="self-end rounded-full bg-emerald-500/15 px-3 py-1 text-xs font-semibold uppercase tracking-[0.25em] text-emerald-300"><?php echo e(strtoupper($booking->status)); ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-sm text-slate-400">Tidak ada jadwal mendatang.</p>
                    <?php endif; ?>
                </div>
            </article>

            <article class="rounded-3xl border border-white/5 bg-slate-900/60 p-6 shadow-xl shadow-black/30">
                <h2 class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-400">Riwayat Terakhir</h2>
                <div class="mt-4 space-y-4">
                    <?php $__empty_1 = true; $__currentLoopData = $recentHistories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="rounded-2xl border border-slate-800/60 bg-slate-900/70 p-4">
                            <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500"><?php echo e($history->created_at?->diffForHumans() ?? 'Baru saja'); ?></p>
                            <p class="mt-1 text-sm text-slate-300"><?php echo e($history->notes ?? $history->getFormattedHistory()); ?></p>
                            <?php if($history->changedBy): ?>
                                <p class="mt-1 text-xs text-slate-500">Oleh: <?php echo e($history->changedBy->name); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-sm text-slate-400">Belum ada riwayat perubahan.</p>
                    <?php endif; ?>
                </div>
            </article>
        </section>

        <section class="rounded-3xl border border-white/5 bg-slate-900/60 p-6 shadow-xl shadow-black/30">
            <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <h2 class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-400">Ringkasan Penggunaan</h2>
                <div class="text-xs text-slate-400">Total peminjaman disetujui: <span class="font-semibold text-emerald-300"><?php echo e($approvedBookingsCount); ?></span></div>
            </div>
            <div class="mt-6 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                <div class="rounded-2xl border border-slate-800/60 bg-slate-900/70 p-4">
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-500">Manager Lain</p>
                    <div class="mt-2 space-y-2">
                        <?php $__empty_1 = true; $__currentLoopData = $otherManagers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manager): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="flex items-center gap-3">
                                <div class="flex size-8 items-center justify-center rounded-full bg-slate-800 text-xs font-semibold text-slate-300"><?php echo e(strtoupper(substr($manager->name, 0, 2))); ?></div>
                                <div>
                                    <p class="text-sm font-medium text-white"><?php echo e($manager->name); ?></p>
                                    <p class="text-xs text-slate-400"><?php echo e($manager->email); ?></p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-sm text-slate-400">Anda adalah satu-satunya manager ruangan ini.</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="rounded-2xl border border-slate-800/60 bg-slate-900/70 p-4">
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-500">Fasilitas</p>
                    <div class="mt-2 text-sm text-slate-300">
                        <?php if($room->facilities): ?>
                            <?php
                                $facilities = array_filter(array_map('trim', explode(',', $room->facilities)));
                            ?>
                            <?php if(count($facilities)): ?>
                                <ul class="list-disc space-y-1 pl-5">
                                    <?php $__currentLoopData = $facilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($facility); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php else: ?>
                                <p>Belum ada data fasilitas.</p>
                            <?php endif; ?>
                        <?php else: ?>
                            <p>Belum ada data fasilitas.</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="rounded-2xl border border-slate-800/60 bg-slate-900/70 p-4">
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-500">Catatan Terakhir</p>
                    <p class="mt-2 text-sm text-slate-300"><?php echo e($room->notes ?? 'Belum ada catatan tambahan.'); ?></p>
                    <p class="mt-3 text-xs text-slate-500">Total booking disetujui: <span class="font-semibold text-emerald-300"><?php echo e($approvedBookingsCount); ?></span></p>
                </div>
            </div>
        </section>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Semester 4\ENG\ALP\Booking-Ruangan\resources\views/room-manager/show-room.blade.php ENDPATH**/ ?>