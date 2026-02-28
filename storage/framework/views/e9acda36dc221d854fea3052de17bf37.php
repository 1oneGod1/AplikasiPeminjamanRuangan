

<?php $__env->startSection('title', 'Kelola Pengajuan Perubahan Password'); ?>
<?php $__env->startSection('header', 'Kelola Pengajuan Perubahan Password'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-4 md:space-y-6">
    <!-- Header -->
    <div>
        <div class="flex items-center gap-3">
            <h1 class="text-xl md:text-2xl font-bold text-white">Kelola Pengajuan Perubahan Password</h1>
            <span class="inline-flex items-center justify-center h-8 min-w-8 px-2 rounded-full bg-yellow-500 text-black text-sm font-bold">
                <?php echo e($pendingRequests->count()); ?>

            </span>
        </div>
        <p class="mt-1 text-sm text-slate-400">Setujui atau tolak pengajuan perubahan password dari pengguna</p>
    </div>

    <!-- Pending Requests -->
    <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm overflow-hidden">
    <div class="bg-linear-to-r from-yellow-500 to-orange-500 px-4 md:px-6 py-4">
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-white/20">
                    <i class="fas fa-clock text-white"></i>
                </div>
                <h2 class="text-lg font-bold text-white">Pengajuan Menunggu Persetujuan (<?php echo e($pendingRequests->count()); ?>)</h2>
            </div>
        </div>
        <div class="p-4 md:p-6">
            <?php if($pendingRequests->isEmpty()): ?>
                <div class="text-center py-12">
                    <i class="fas fa-check-circle text-6xl text-slate-700 mb-4"></i>
                    <p class="text-slate-500 font-medium">Tidak ada pengajuan yang menunggu persetujuan</p>
                    <p class="text-slate-600 text-xs mt-1">Semua pengajuan sudah diproses</p>
                </div>
            <?php else: ?>
                <!-- Desktop View -->
                <div class="hidden md:block space-y-3">
                    <?php $__currentLoopData = $pendingRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="rounded-xl border border-white/10 bg-white/5 p-5 hover:bg-white/10 transition-colors">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex items-start gap-4 flex-1">
                                    <div class="w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold shrink-0">
                                        <?php echo e(strtoupper(substr($request->user->name, 0, 1))); ?>

                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <h3 class="text-lg font-bold text-white"><?php echo e($request->user->name); ?></h3>
                                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-yellow-500/10 border border-yellow-500/30 text-yellow-400">
                                                <?php echo e(ucfirst($request->user->role)); ?>

                                            </span>
                                        </div>
                                        <p class="text-sm text-slate-400 mt-1 flex items-center gap-2">
                                            <i class="fas fa-envelope text-xs"></i>
                                            <?php echo e($request->user->email); ?>

                                        </p>
                                        <p class="text-xs text-slate-500 mt-2 flex items-center gap-2">
                                            <i class="fas fa-calendar text-xs"></i>
                                            Diajukan: <?php echo e($request->created_at->format('d M Y, H:i')); ?> (<?php echo e($request->created_at->diffForHumans()); ?>)
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 shrink-0">
                                    <form action="<?php echo e(route('admin.password-change.approve', $request)); ?>" method="POST" class="inline">
                                        <?php echo csrf_field(); ?>
                                        <button 
                                            type="submit" 
                                            class="inline-flex items-center gap-2 px-4 py-2.5 bg-green-500 text-white rounded-xl font-semibold hover:bg-green-600 transition-colors shadow-lg shadow-green-500/30"
                                            onclick="return confirm('Apakah Anda yakin ingin menyetujui perubahan password untuk <?php echo e($request->user->name); ?>?')"
                                        >
                                            <i class="fas fa-check"></i>
                                            <span>Setujui</span>
                                        </button>
                                    </form>
                                    <button 
                                        type="button"
                                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-red-500 text-white rounded-xl font-semibold hover:bg-red-600 transition-colors shadow-lg shadow-red-500/30"
                                        onclick="showRejectModal(<?php echo e($request->id); ?>)"
                                    >
                                        <i class="fas fa-times"></i>
                                        <span>Tolak</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Mobile View -->
                <div class="md:hidden space-y-3">
                    <?php $__currentLoopData = $pendingRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="rounded-xl border border-white/10 bg-white/5 p-4 space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold shrink-0">
                                    <?php echo e(strtoupper(substr($request->user->name, 0, 1))); ?>

                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold text-white truncate"><?php echo e($request->user->name); ?></h3>
                                    <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-yellow-500/10 border border-yellow-500/30 text-yellow-400 mt-1">
                                        <?php echo e(ucfirst($request->user->role)); ?>

                                    </span>
                                </div>
                            </div>
                            <div class="space-y-2 text-sm">
                                <div class="flex items-center gap-2 text-slate-400">
                                    <i class="fas fa-envelope text-xs"></i>
                                    <span class="truncate"><?php echo e($request->user->email); ?></span>
                                </div>
                                <div class="flex items-center gap-2 text-slate-500 text-xs">
                                    <i class="fas fa-calendar"></i>
                                    <span><?php echo e($request->created_at->format('d M Y, H:i')); ?></span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 pt-2 border-t border-white/10">
                                <form action="<?php echo e(route('admin.password-change.approve', $request)); ?>" method="POST" class="flex-1">
                                    <?php echo csrf_field(); ?>
                                    <button 
                                        type="submit" 
                                        class="w-full text-green-400 hover:text-green-300 font-medium transition-colors text-center"
                                        onclick="return confirm('Apakah Anda yakin ingin menyetujui perubahan password untuk <?php echo e($request->user->name); ?>?')"
                                    >
                                        Setujui
                                    </button>
                                </form>
                                <span class="text-slate-700">·</span>
                                <button 
                                    type="button"
                                    class="flex-1 text-red-400 hover:text-red-300 font-medium transition-colors text-center"
                                    onclick="showRejectModal(<?php echo e($request->id); ?>)"
                                >
                                    Tolak
                                </button>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Recent Processed Requests -->
    <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm overflow-hidden">
    <div class="bg-linear-to-r from-slate-800 to-slate-900 px-4 md:px-6 py-4">
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-white/10">
                    <i class="fas fa-history text-white"></i>
                </div>
                <h2 class="text-lg font-bold text-white">Riwayat Pengajuan Terbaru</h2>
            </div>
        </div>
        <div class="p-4 md:p-6">
            <?php if($recentRequests->isEmpty()): ?>
                <div class="text-center py-12">
                    <i class="fas fa-inbox text-6xl text-slate-700 mb-4"></i>
                    <p class="text-slate-500 font-medium">Belum ada riwayat pengajuan</p>
                </div>
            <?php else: ?>
                <!-- Desktop Table -->
                <div class="hidden md:block overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-white/5 border-b border-white/10">
                            <tr>
                                <th class="px-6 py-3 text-left font-semibold text-slate-300">Pengguna</th>
                                <th class="px-6 py-3 text-left font-semibold text-slate-300">Status</th>
                                <th class="px-6 py-3 text-left font-semibold text-slate-300">Diproses Oleh</th>
                                <th class="px-6 py-3 text-left font-semibold text-slate-300">Tanggal</th>
                                <th class="px-6 py-3 text-left font-semibold text-slate-300">Catatan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            <?php $__currentLoopData = $recentRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-white/5 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-white"><?php echo e($request->user->name); ?></div>
                                        <div class="text-sm text-slate-400"><?php echo e($request->user->email); ?></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php if($request->status === 'approved'): ?>
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-green-500/10 border border-green-500/30 text-green-400">
                                                <i class="fas fa-check-circle"></i>
                                                Disetujui
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-red-500/10 border border-red-500/30 text-red-400">
                                                <i class="fas fa-times-circle"></i>
                                                Ditolak
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 text-slate-400">
                                        <?php echo e($request->processedBy->name ?? '-'); ?>

                                    </td>
                                    <td class="px-6 py-4 text-slate-400">
                                        <?php echo e($request->processed_at->format('d M Y, H:i')); ?>

                                    </td>
                                    <td class="px-6 py-4 text-slate-400">
                                        <?php echo e($request->admin_notes ?? '-'); ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Cards -->
                <div class="md:hidden space-y-3">
                    <?php $__currentLoopData = $recentRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="rounded-xl border border-white/10 bg-white/5 p-4 space-y-3">
                            <div class="flex items-start justify-between">
                                <div>
                                    <div class="font-semibold text-white"><?php echo e($request->user->name); ?></div>
                                    <div class="text-sm text-slate-400"><?php echo e($request->user->email); ?></div>
                                </div>
                                <?php if($request->status === 'approved'): ?>
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold rounded-full bg-green-500/10 border border-green-500/30 text-green-400">
                                        <i class="fas fa-check-circle"></i>
                                        Disetujui
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold rounded-full bg-red-500/10 border border-red-500/30 text-red-400">
                                        <i class="fas fa-times-circle"></i>
                                        Ditolak
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="text-xs space-y-1">
                                <div class="flex items-center gap-2 text-slate-400">
                                    <i class="fas fa-user"></i>
                                    <span>Diproses: <?php echo e($request->processedBy->name ?? '-'); ?></span>
                                </div>
                                <div class="flex items-center gap-2 text-slate-400">
                                    <i class="fas fa-calendar"></i>
                                    <span><?php echo e($request->processed_at->format('d M Y, H:i')); ?></span>
                                </div>
                                <?php if($request->admin_notes): ?>
                                    <div class="flex items-start gap-2 text-slate-400 mt-2 pt-2 border-t border-white/10">
                                        <i class="fas fa-sticky-note mt-0.5"></i>
                                        <span><?php echo e($request->admin_notes); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm overflow-y-auto z-50">
    <div class="flex min-h-screen items-center justify-center p-4">
        <div class="relative bg-slate-900 rounded-2xl border border-white/10 shadow-2xl max-w-md w-full p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-white">Alasan Penolakan</h3>
                <button onclick="closeRejectModal()" class="text-slate-400 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="rejectForm" method="POST">
                <?php echo csrf_field(); ?>
                <div class="space-y-4">
                    <div>
                        <label for="admin_notes" class="block text-sm font-semibold text-slate-300 mb-2">
                            Masukkan alasan penolakan <span class="text-red-400">*</span>
                        </label>
                        <textarea 
                            name="admin_notes" 
                            id="admin_notes" 
                            rows="4" 
                            required
                            class="w-full rounded-xl border border-white/20 bg-white/5 px-4 py-3 text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30 transition-colors"
                            placeholder="Contoh: Password terlalu sederhana, silakan gunakan kombinasi yang lebih kuat."
                        ></textarea>
                        <p class="mt-2 text-xs text-slate-500">Alasan ini akan diberitahukan kepada pengguna</p>
                    </div>
                    <div class="flex items-center gap-3 pt-2">
                        <button 
                            type="button" 
                            onclick="closeRejectModal()"
                            class="flex-1 px-4 py-3 rounded-xl border border-white/20 bg-white/5 text-white font-semibold hover:bg-white/10 transition-colors"
                        >
                            Batal
                        </button>
                        <button 
                            type="submit"
                            class="flex-1 px-4 py-3 rounded-xl bg-red-500 text-white font-bold hover:bg-red-600 transition-colors shadow-lg shadow-red-500/30"
                        >
                            Tolak Pengajuan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function showRejectModal(requestId) {
    const modal = document.getElementById('rejectModal');
    const form = document.getElementById('rejectForm');
    form.action = `/admin/password-change-requests/${requestId}/reject`;
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeRejectModal() {
    const modal = document.getElementById('rejectModal');
    const form = document.getElementById('rejectForm');
    form.reset();
    modal.classList.add('hidden');
    document.body.style.overflow = '';
}

// Close modal when clicking backdrop
document.getElementById('rejectModal').addEventListener('click', function(e) {
    if (e.target === this || e.target.classList.contains('backdrop-blur-sm')) {
        closeRejectModal();
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Semester 4\ENG\ALP\Booking-Ruangan\resources\views/admin/password-change/index.blade.php ENDPATH**/ ?>