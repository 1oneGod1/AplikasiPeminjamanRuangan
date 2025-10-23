

<?php $__env->startSection('title', 'Daftar Ruangan'); ?>
<?php $__env->startSection('header', 'Manajemen Ruangan'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-4 md:space-y-6">
  <!-- Header -->
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
      <h3 class="text-xl md:text-2xl font-bold text-white">Manajemen Ruangan</h3>
      <p class="mt-1 text-sm text-slate-400">Kelola semua ruangan yang tersedia untuk dipinjam</p>
    </div>
    <a href="<?php echo e(route('admin.rooms.create')); ?>" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-500 text-white rounded-xl font-semibold hover:bg-blue-600 transition-colors shadow-lg shadow-blue-500/30">
      <i class="fas fa-plus"></i>
      <span>Tambah Ruangan</span>
    </a>
  </div>

  <!-- Stats Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
    <div class="rounded-2xl border border-white/10 bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-sm p-6">
      <div class="flex items-center gap-4">
        <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-blue-500/20">
          <i class="fas fa-door-open text-blue-400 text-xl"></i>
        </div>
        <div>
          <h4 class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Ruangan</h4>
          <p class="text-3xl font-bold text-white mt-1"><?php echo e($rooms->total()); ?></p>
        </div>
      </div>
    </div>
    <div class="rounded-2xl border border-white/10 bg-gradient-to-br from-green-500/20 to-green-500/10 backdrop-blur-sm p-6">
      <div class="flex items-center gap-4">
        <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-green-500/20">
          <i class="fas fa-check-circle text-green-400 text-xl"></i>
        </div>
        <div>
          <h4 class="text-xs font-semibold text-green-300 uppercase tracking-wider">Ruangan Tersedia</h4>
          <p class="text-3xl font-bold text-white mt-1"><?php echo e($rooms->where('is_active', true)->count()); ?></p>
        </div>
      </div>
    </div>
    <div class="rounded-2xl border border-white/10 bg-gradient-to-br from-red-500/20 to-red-500/10 backdrop-blur-sm p-6">
      <div class="flex items-center gap-4">
        <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-red-500/20">
          <i class="fas fa-times-circle text-red-400 text-xl"></i>
        </div>
        <div>
          <h4 class="text-xs font-semibold text-red-300 uppercase tracking-wider">Tidak Tersedia</h4>
          <p class="text-3xl font-bold text-white mt-1"><?php echo e($rooms->where('is_active', false)->count()); ?></p>
        </div>
      </div>
    </div>
  </div>

  <!-- Desktop Table View -->
  <div class="hidden md:block rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm overflow-hidden">
    <div class="bg-gradient-to-r from-slate-800 to-slate-900 px-4 md:px-6 py-4">
      <div class="flex items-center gap-3">
        <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-white/10">
          <i class="fas fa-list text-white"></i>
        </div>
        <h2 class="text-lg font-bold text-white">Semua Ruangan</h2>
      </div>
    </div>
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead class="bg-white/5 border-b border-white/10">
          <tr>
            <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">#</th>
            <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Nama Ruangan</th>
            <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Kapasitas</th>
            <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Fasilitas</th>
            <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Status</th>
            <th class="px-4 lg:px-6 py-3 text-center font-semibold text-slate-300">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
          <?php $__empty_1 = true; $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="hover:bg-white/5 transition-colors">
              <td class="px-4 lg:px-6 py-4 text-slate-400"><?php echo e($loop->iteration + ($rooms->currentPage() - 1) * $rooms->perPage()); ?></td>
              <td class="px-4 lg:px-6 py-4 font-semibold text-white"><?php echo e($room->name); ?></td>
              <td class="px-4 lg:px-6 py-4 text-slate-300"><?php echo e($room->capacity); ?> orang</td>
              <td class="px-4 lg:px-6 py-4 text-slate-400 text-xs max-w-xs truncate"><?php echo e($room->facilities ?? '-'); ?></td>
              <td class="px-4 lg:px-6 py-4">
                <?php if($room->is_active): ?>
                  <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-green-500/10 border border-green-500/30 text-green-400">
                    <i class="fas fa-check-circle"></i>
                    Tersedia
                  </span>
                <?php else: ?>
                  <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-red-500/10 border border-red-500/30 text-red-400">
                    <i class="fas fa-times-circle"></i>
                    Tidak Tersedia
                  </span>
                <?php endif; ?>
              </td>
              <td class="px-4 lg:px-6 py-4">
                <div class="flex items-center justify-center gap-2">
                  <a href="<?php echo e(route('admin.rooms.show', $room)); ?>" class="text-blue-400 hover:text-blue-300 font-medium transition-colors">Lihat</a>
                  <span class="text-slate-700">·</span>
                  <a href="<?php echo e(route('admin.rooms.edit', $room)); ?>" class="text-yellow-400 hover:text-yellow-300 font-medium transition-colors">Edit</a>
                  <span class="text-slate-700">·</span>
                  <form action="<?php echo e(route('admin.rooms.destroy', $room)); ?>" method="POST" class="inline" onsubmit="return confirm('Yakin hapus ruangan ini?')">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="text-red-400 hover:text-red-300 font-medium transition-colors">Hapus</button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
              <td colspan="6" class="px-6 py-12 text-center">
                <i class="fas fa-inbox text-6xl text-slate-700 mb-4"></i>
                <p class="text-slate-500 font-medium">Belum ada ruangan</p>
                <a href="<?php echo e(route('admin.rooms.create')); ?>" class="inline-flex items-center gap-2 mt-4 px-4 py-2 bg-blue-500 text-white rounded-xl hover:bg-blue-600 transition-colors">
                  <i class="fas fa-plus"></i>
                  Tambah sekarang
                </a>
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <?php if($rooms->hasPages()): ?>
      <div class="px-6 py-4 border-t border-white/10">
        <?php echo e($rooms->links()); ?>

      </div>
    <?php endif; ?>
  </div>

  <!-- Mobile Card View -->
  <div class="md:hidden space-y-3">
    <?php $__empty_1 = true; $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="rounded-xl border border-white/10 bg-white/5 backdrop-blur-sm p-4 space-y-3">
        <!-- Header -->
        <div class="flex items-start justify-between">
          <div class="flex-1">
            <div class="flex items-center gap-2">
              <h3 class="font-bold text-white"><?php echo e($room->name); ?></h3>
              <?php if($room->is_active): ?>
                <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-semibold rounded-full bg-green-500/10 border border-green-500/30 text-green-400">
                  <i class="fas fa-check-circle text-xs"></i>
                  Tersedia
                </span>
              <?php else: ?>
                <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-semibold rounded-full bg-red-500/10 border border-red-500/30 text-red-400">
                  <i class="fas fa-times-circle text-xs"></i>
                  Tidak Tersedia
                </span>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <!-- Details -->
        <div class="space-y-2">
          <div class="flex items-center gap-2 text-sm text-slate-300">
            <i class="fas fa-users text-blue-400 w-4"></i>
            <span>Kapasitas: <strong><?php echo e($room->capacity); ?> orang</strong></span>
          </div>
          <div class="flex items-start gap-2 text-sm text-slate-400">
            <i class="fas fa-clipboard-list text-green-400 w-4 mt-0.5"></i>
            <span class="flex-1"><?php echo e($room->facilities ?? 'Tidak ada fasilitas'); ?></span>
          </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center gap-2 pt-2 border-t border-white/10">
          <a href="<?php echo e(route('admin.rooms.show', $room)); ?>" class="flex-1 inline-flex items-center justify-center gap-2 px-3 py-2 rounded-lg bg-blue-500 text-white text-sm font-semibold hover:bg-blue-600 transition-colors">
            <i class="fas fa-eye"></i>
            <span>Lihat</span>
          </a>
          <a href="<?php echo e(route('admin.rooms.edit', $room)); ?>" class="flex-1 inline-flex items-center justify-center gap-2 px-3 py-2 rounded-lg bg-yellow-500 text-white text-sm font-semibold hover:bg-yellow-600 transition-colors">
            <i class="fas fa-edit"></i>
            <span>Edit</span>
          </a>
          <form action="<?php echo e(route('admin.rooms.destroy', $room)); ?>" method="POST" class="flex-1" onsubmit="return confirm('Yakin hapus ruangan ini?')">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 rounded-lg bg-red-500 text-white text-sm font-semibold hover:bg-red-600 transition-colors">
              <i class="fas fa-trash"></i>
              <span>Hapus</span>
            </button>
          </form>
        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <div class="rounded-xl border border-white/10 bg-white/5 p-8 text-center">
        <i class="fas fa-inbox text-5xl text-slate-700 mb-4"></i>
        <p class="text-slate-500 font-medium">Belum ada ruangan</p>
        <a href="<?php echo e(route('admin.rooms.create')); ?>" class="inline-flex items-center gap-2 mt-4 px-4 py-2 bg-blue-500 text-white rounded-xl hover:bg-blue-600 transition-colors">
          <i class="fas fa-plus"></i>
          Tambah sekarang
        </a>
      </div>
    <?php endif; ?>

    <!-- Mobile Pagination -->
    <?php if($rooms->hasPages()): ?>
      <div class="pt-2">
        <?php echo e($rooms->links()); ?>

      </div>
    <?php endif; ?>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Semester 4\ENG\ALP\Booking-Ruangan\resources\views/admin/rooms/index.blade.php ENDPATH**/ ?>