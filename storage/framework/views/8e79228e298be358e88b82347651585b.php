

<?php $__env->startSection('title', 'Daftar Peminjam'); ?>
<?php $__env->startSection('header', 'Manajemen Peminjam'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-4 md:space-y-6">
  <!-- Header -->
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
      <h3 class="text-xl md:text-2xl font-bold text-white">Manajemen Peminjam</h3>
      <p class="mt-1 text-sm text-slate-400">Kelola data peminjam ruangan yang terdaftar</p>
    </div>
    <button onclick="openCreateUserModal('peminjam')" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-500 text-white rounded-xl font-semibold hover:bg-blue-600 transition-colors shadow-lg shadow-blue-500/30">
      <i class="fas fa-plus"></i>
      <span>Tambah User</span>
    </button>
  </div>

  <!-- Stats Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
  <div class="rounded-2xl border border-white/10 bg-linear-to-br from-white/10 to-white/5 backdrop-blur-sm p-6">
      <div class="flex items-center gap-4">
        <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-blue-500/20">
          <i class="fas fa-users text-blue-400 text-xl"></i>
        </div>
        <div>
          <h4 class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Peminjam</h4>
          <p class="text-3xl font-bold text-white mt-1"><?php echo e($totalPeminjam); ?></p>
        </div>
      </div>
    </div>
  <div class="rounded-2xl border border-white/10 bg-linear-to-br from-green-500/20 to-green-500/10 backdrop-blur-sm p-6">
      <div class="flex items-center gap-4">
        <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-green-500/20">
          <i class="fas fa-user-check text-green-400 text-xl"></i>
        </div>
        <div>
          <h4 class="text-xs font-semibold text-green-300 uppercase tracking-wider">Peminjam Aktif</h4>
          <p class="text-3xl font-bold text-white mt-1"><?php echo e($activePeminjam); ?></p>
        </div>
      </div>
    </div>
  </div>

  <!-- Desktop Table View -->
  <div class="hidden md:block rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm overflow-hidden">
  <div class="bg-linear-to-r from-slate-800 to-slate-900 px-4 md:px-6 py-4">
      <div class="flex items-center gap-3">
        <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-white/10">
          <i class="fas fa-list text-white"></i>
        </div>
        <h2 class="text-lg font-bold text-white">Semua Peminjam</h2>
      </div>
    </div>
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead class="bg-white/5 border-b border-white/10">
          <tr>
            <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">#</th>
            <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Nama</th>
            <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Email</th>
            <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">No. Telepon</th>
            <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Status</th>
            <th class="px-4 lg:px-6 py-3 text-center font-semibold text-slate-300">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
          <?php $__empty_1 = true; $__currentLoopData = $peminjam; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="hover:bg-white/5 transition-colors">
              <td class="px-4 lg:px-6 py-4 text-slate-400"><?php echo e($loop->iteration + ($peminjam->currentPage() - 1) * $peminjam->perPage()); ?></td>
              <td class="px-4 lg:px-6 py-4">
                <div class="flex items-center gap-3">
                  <div class="w-9 h-9 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold text-sm">
                    <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                  </div>
                  <span class="font-semibold text-white"><?php echo e($user->name); ?></span>
                </div>
              </td>
              <td class="px-4 lg:px-6 py-4 text-slate-300"><?php echo e($user->email); ?></td>
              <td class="px-4 lg:px-6 py-4 text-slate-400"><?php echo e($user->phone ?? '-'); ?></td>
              <td class="px-4 lg:px-6 py-4">
                <?php if($user->is_active): ?>
                  <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-green-500/10 border border-green-500/30 text-green-400">
                    <i class="fas fa-check-circle"></i>
                    Aktif
                  </span>
                <?php else: ?>
                  <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-red-500/10 border border-red-500/30 text-red-400">
                    <i class="fas fa-times-circle"></i>
                    Nonaktif
                  </span>
                <?php endif; ?>
              </td>
              <td class="px-4 lg:px-6 py-4">
                <div class="flex items-center justify-center gap-2">
                  <button onclick="openEditUserModal(<?php echo e($user->id); ?>)" class="text-yellow-400 hover:text-yellow-300 font-medium transition-colors">Edit</button>
                  <span class="text-slate-700">·</span>
                  <form action="<?php echo e(route('admin.users.destroy', $user)); ?>" method="POST" class="inline" onsubmit="return confirm('Yakin hapus peminjam ini?')">
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
                <p class="text-slate-500 font-medium">Belum ada data peminjam</p>
                <a href="<?php echo e(route('admin.users.create', 'peminjam')); ?>" class="inline-flex items-center gap-2 mt-4 px-4 py-2 bg-blue-500 text-white rounded-xl hover:bg-blue-600 transition-colors">
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
    <?php if($peminjam->hasPages()): ?>
      <div class="px-6 py-4 border-t border-white/10">
        <?php echo e($peminjam->links()); ?>

      </div>
    <?php endif; ?>
  </div>

  <!-- Mobile Card View -->
  <div class="md:hidden space-y-3">
    <?php $__empty_1 = true; $__currentLoopData = $peminjam; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="rounded-xl border border-white/10 bg-white/5 backdrop-blur-sm p-4 space-y-3">
        <!-- Header -->
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-3 flex-1 min-w-0">
            <div class="w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold shrink-0">
              <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

            </div>
            <div class="flex-1 min-w-0">
              <h3 class="font-bold text-white truncate"><?php echo e($user->name); ?></h3>
              <?php if($user->is_active): ?>
                <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-semibold rounded-full bg-green-500/10 border border-green-500/30 text-green-400 mt-1">
                  <i class="fas fa-check-circle text-xs"></i>
                  Aktif
                </span>
              <?php else: ?>
                <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-semibold rounded-full bg-red-500/10 border border-red-500/30 text-red-400 mt-1">
                  <i class="fas fa-times-circle text-xs"></i>
                  Nonaktif
                </span>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <!-- Details -->
        <div class="space-y-2">
          <div class="flex items-center gap-2 text-sm text-slate-300">
            <i class="fas fa-envelope text-blue-400 w-4"></i>
            <span class="truncate"><?php echo e($user->email); ?></span>
          </div>
          <div class="flex items-center gap-2 text-sm text-slate-400">
            <i class="fas fa-phone text-green-400 w-4"></i>
            <span><?php echo e($user->phone ?? 'Tidak ada nomor telepon'); ?></span>
          </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center gap-2 pt-2 border-t border-white/10">
          <button onclick="openEditUserModal(<?php echo e($user->id); ?>)" class="flex-1 text-yellow-400 hover:text-yellow-300 font-medium transition-colors text-center">Edit</button>
          <span class="text-slate-700">·</span>
          <form action="<?php echo e(route('admin.users.destroy', $user)); ?>" method="POST" class="flex-1" onsubmit="return confirm('Yakin hapus peminjam ini?')">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit" class="w-full text-red-400 hover:text-red-300 font-medium transition-colors text-center">Hapus</button>
          </form>
        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <div class="rounded-xl border border-white/10 bg-white/5 p-8 text-center">
        <i class="fas fa-inbox text-5xl text-slate-700 mb-4"></i>
        <p class="text-slate-500 font-medium">Belum ada data peminjam</p>
        <a href="<?php echo e(route('admin.users.create', 'peminjam')); ?>" class="inline-flex items-center gap-2 mt-4 px-4 py-2 bg-blue-500 text-white rounded-xl hover:bg-blue-600 transition-colors">
          <i class="fas fa-plus"></i>
          Tambah sekarang
        </a>
      </div>
    <?php endif; ?>

    <!-- Mobile Pagination -->
    <?php if($peminjam->hasPages()): ?>
      <div class="pt-2">
        <?php echo e($peminjam->links()); ?>

      </div>
    <?php endif; ?>
  </div>
</div>

<?php echo $__env->make('admin.modals.create-user-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('admin.modals.edit-user-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Semester 4\ENG\ALP\Booking-Ruangan\resources\views/admin/users/peminjam.blade.php ENDPATH**/ ?>