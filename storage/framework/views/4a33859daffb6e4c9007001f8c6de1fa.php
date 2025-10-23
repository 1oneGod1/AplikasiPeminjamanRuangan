

<?php $__env->startSection('title', 'Pending Approval'); ?>
<?php $__env->startSection('header', 'Pengajuan Menunggu Persetujuan'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-4 md:space-y-6">
  <!-- Header with Count Badge -->
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
      <div class="flex items-center gap-3">
        <h3 class="text-xl md:text-2xl font-bold text-white">Pending Approval</h3>
        <span class="inline-flex items-center justify-center h-8 min-w-8 px-2 rounded-full bg-orange-500 text-white text-sm font-bold">
          <?php echo e($bookings->total()); ?>

        </span>
      </div>
      <p class="mt-1 text-sm text-slate-400">Kelola pengajuan peminjaman ruangan yang menunggu persetujuan</p>
    </div>
  </div>

  <!-- Desktop Table View -->
  <div class="hidden md:block rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm overflow-hidden">
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead class="bg-white/5 border-b border-white/10">
          <tr>
            <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">ID</th>
            <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Peminjam</th>
            <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Ruangan</th>
            <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Tanggal</th>
            <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Waktu</th>
            <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Tujuan</th>
            <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
        <?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr class="hover:bg-white/5 transition-colors">
            <td class="px-4 lg:px-6 py-4">
              <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-blue-500/10 border border-blue-500/30 text-blue-400 text-xs font-semibold">
                <i class="fas fa-hashtag"></i>
                <?php echo e($b->id); ?>

              </span>
            </td>
            <td class="px-4 lg:px-6 py-4">
              <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold text-sm">
                  <?php echo e(strtoupper(substr($b->user->name ?? '?', 0, 1))); ?>

                </div>
                <span class="font-medium text-white"><?php echo e($b->user->name ?? '-'); ?></span>
              </div>
            </td>
            <td class="px-4 lg:px-6 py-4 text-slate-300"><?php echo e($b->room->name ?? '-'); ?></td>
            <td class="px-4 lg:px-6 py-4 text-slate-400"><?php echo e(\Illuminate\Support\Carbon::parse($b->booking_date)->format('d M Y')); ?></td>
            <td class="px-4 lg:px-6 py-4 text-slate-400"><?php echo e(substr($b->start_time,0,5)); ?>–<?php echo e(substr($b->end_time,0,5)); ?></td>
            <td class="px-4 lg:px-6 py-4">
              <?php if($b->purpose): ?>
                <button type="button" data-purpose-modal-trigger data-purpose="<?php echo e(e($b->purpose)); ?>" data-purpose-title="Tujuan · Pengajuan #<?php echo e($b->id); ?>" class="inline-flex items-center gap-2 rounded-lg border border-white/20 bg-white/5 px-3 py-1.5 text-xs font-semibold text-slate-300 transition hover:bg-white/10 hover:border-white/30">
                  <i class="fas fa-eye"></i>
                  <span>Lihat tujuan</span>
                </button>
              <?php else: ?>
                <span class="text-xs text-slate-500">-</span>
              <?php endif; ?>
            </td>
            <td class="px-4 lg:px-6 py-4">
              <div class="flex items-center justify-center gap-3">
                <button type="button" onclick="showApproveConfirm(<?php echo e($b->id); ?>)" class="text-green-400 hover:text-green-300 font-medium transition-colors">Setujui</button>
                <span class="text-slate-700">·</span>
                <button type="button" onclick="showRejectModal(<?php echo e($b->id); ?>)" class="text-red-400 hover:text-red-300 font-medium transition-colors">Tolak</button>
              </div>
            </td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <tr>
            <td colspan="7" class="px-6 py-12 text-center">
              <i class="fas fa-check-circle text-5xl text-slate-700 mb-4"></i>
              <p class="text-slate-500">Tidak ada pengajuan pending</p>
              <p class="text-slate-600 text-xs mt-1">Semua pengajuan sudah diproses</p>
            </td>
          </tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Mobile Card View -->
  <div class="md:hidden space-y-3">
    <?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="rounded-xl border border-white/10 bg-white/5 backdrop-blur-sm p-4 space-y-3">
        <!-- Header -->
        <div class="flex items-start justify-between">
          <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">
              <?php echo e(strtoupper(substr($b->user->name ?? '?', 0, 1))); ?>

            </div>
            <div>
              <div class="font-semibold text-white text-sm"><?php echo e($b->user->name ?? '-'); ?></div>
              <div class="text-xs text-slate-500">Pengajuan #<?php echo e($b->id); ?></div>
            </div>
          </div>
        </div>

        <!-- Details -->
        <div class="space-y-2">
          <div class="flex items-center gap-2 text-sm text-slate-300">
            <i class="fas fa-door-open text-blue-400 w-4"></i>
            <span><strong><?php echo e($b->room->name ?? '-'); ?></strong></span>
          </div>
          <div class="grid grid-cols-2 gap-2 text-xs text-slate-400">
            <div class="flex items-center gap-2">
              <i class="fas fa-calendar text-slate-500 w-4"></i>
              <span><?php echo e(\Illuminate\Support\Carbon::parse($b->booking_date)->format('d M Y')); ?></span>
            </div>
            <div class="flex items-center gap-2">
              <i class="fas fa-clock text-slate-500 w-4"></i>
              <span><?php echo e(substr($b->start_time,0,5)); ?>–<?php echo e(substr($b->end_time,0,5)); ?></span>
            </div>
          </div>
          <?php if($b->purpose): ?>
            <button type="button" data-purpose-modal-trigger data-purpose="<?php echo e(e($b->purpose)); ?>" data-purpose-title="Tujuan · Pengajuan #<?php echo e($b->id); ?>" class="w-full flex items-center justify-center gap-2 rounded-lg border border-white/20 bg-white/5 px-3 py-2 text-xs font-semibold text-slate-300 transition hover:bg-white/10">
              <i class="fas fa-eye"></i>
              <span>Lihat Tujuan</span>
            </button>
          <?php endif; ?>
        </div>

        <!-- Actions -->
        <div class="flex items-center gap-2 pt-2 border-t border-white/10 text-sm">
          <button type="button" onclick="showApproveConfirm(<?php echo e($b->id); ?>)" class="flex-1 text-green-400 hover:text-green-300 font-medium transition-colors">Setujui</button>
          <span class="text-slate-700">·</span>
          <button type="button" onclick="showRejectModal(<?php echo e($b->id); ?>)" class="flex-1 text-red-400 hover:text-red-300 font-medium transition-colors">Tolak</button>
        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <div class="rounded-xl border border-white/10 bg-white/5 p-8 text-center">
        <i class="fas fa-check-circle text-5xl text-slate-700 mb-4"></i>
        <p class="text-slate-500 text-sm font-medium">Tidak ada pengajuan pending</p>
        <p class="text-slate-600 text-xs mt-1">Semua pengajuan sudah diproses</p>
      </div>
    <?php endif; ?>
  </div>

  <!-- Pagination -->
  <?php if($bookings->hasPages()): ?>
    <div class="flex justify-center">
      <?php echo e($bookings->links()); ?>

    </div>
  <?php endif; ?>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
  <div class="flex min-h-screen items-center justify-center p-4">
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" onclick="closeRejectModal()"></div>
    <div class="relative bg-slate-900 rounded-2xl border border-white/10 shadow-2xl max-w-md w-full p-6">
      <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-bold text-white">Tolak Pengajuan</h3>
        <button onclick="closeRejectModal()" class="text-slate-400 hover:text-white">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <form id="rejectForm" method="POST" action="">
        <?php echo csrf_field(); ?>
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-semibold text-slate-300 mb-2">Alasan Penolakan</label>
            <textarea name="reason" required rows="4" class="w-full rounded-xl border border-white/20 bg-white/5 px-4 py-3 text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30 transition-colors" placeholder="Jelaskan alasan penolakan..."></textarea>
          </div>
          <div class="flex items-center gap-3">
            <button type="button" onclick="closeRejectModal()" class="flex-1 px-4 py-3 rounded-xl border border-white/20 bg-white/5 text-white font-semibold hover:bg-white/10 transition-colors">
              Batal
            </button>
            <button type="submit" class="flex-1 px-4 py-3 rounded-xl bg-red-500 text-white font-bold hover:bg-red-600 transition-colors shadow-lg shadow-red-500/30">
              Tolak Pengajuan
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
function showApproveConfirm(bookingId) {
  if (confirm('Setujui pengajuan peminjaman ini?')) {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = `/admin/bookings/${bookingId}/approve`;
    form.innerHTML = '<?php echo csrf_field(); ?>';
    document.body.appendChild(form);
    form.submit();
  }
}

function showRejectModal(bookingId) {
  const modal = document.getElementById('rejectModal');
  const form = document.getElementById('rejectForm');
  form.action = `/admin/bookings/${bookingId}/reject`;
  modal.classList.remove('hidden');
  document.body.style.overflow = 'hidden';
}

function closeRejectModal() {
  const modal = document.getElementById('rejectModal');
  modal.classList.add('hidden');
  document.body.style.overflow = '';
}
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('components.purpose-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Semester 4\ENG\ALP\Booking-Ruangan\resources\views/admin/pending.blade.php ENDPATH**/ ?>