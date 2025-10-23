

<?php $__env->startSection('title', 'Kelola Jenis Ruangan'); ?>
<?php $__env->startSection('header', 'Kelola Jenis Ruangan'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-4 md:space-y-6">
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
      <h3 class="text-xl md:text-2xl font-bold text-white">Kelola Jenis Ruangan</h3>
      <p class="mt-1 text-sm text-slate-400">Tambah, edit, atau hapus jenis ruangan yang tersedia</p>
    </div>
    <a href="<?php echo e(route('admin.room-types.create')); ?>" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-500 text-white rounded-xl font-semibold hover:bg-blue-600 transition-colors shadow-lg shadow-blue-500/30">
      <i class="fas fa-plus"></i>
      <span>Tambah Jenis</span>
    </a>
  </div>

  <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm overflow-hidden">
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead class="bg-white/5 border-b border-white/10">
          <tr>
            <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Nama</th>
            <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Label</th>
            <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Deskripsi</th>
            <th class="px-4 lg:px-6 py-3 text-center font-semibold text-slate-300">Status</th>
            <th class="px-4 lg:px-6 py-3 text-center font-semibold text-slate-300">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
          <?php $__empty_1 = true; $__currentLoopData = $roomTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="hover:bg-white/5 transition-colors">
              <td class="px-4 lg:px-6 py-4 text-slate-100 font-semibold"><?php echo e($type->name); ?></td>
              <td class="px-4 lg:px-6 py-4 text-blue-400 font-bold"><?php echo e($type->label); ?></td>
              <td class="px-4 lg:px-6 py-4 text-slate-300"><?php echo e($type->description); ?></td>
              <td class="px-4 lg:px-6 py-4 text-center">
                <?php if($type->is_active): ?>
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
              <td class="px-4 lg:px-6 py-4 text-center">
                <a href="<?php echo e(route('admin.room-types.edit', $type)); ?>" class="text-yellow-400 hover:text-yellow-300 font-medium transition-colors">Edit</a>
                <span class="text-slate-700">·</span>
                <form action="<?php echo e(route('admin.room-types.destroy', $type)); ?>" method="POST" class="inline" onsubmit="return confirm('Yakin hapus jenis ruangan ini?')">
                  <?php echo csrf_field(); ?>
                  <?php echo method_field('DELETE'); ?>
                  <button type="submit" class="text-red-400 hover:text-red-300 font-medium transition-colors">Hapus</button>
                </form>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
              <td colspan="5" class="px-6 py-12 text-center">
                <i class="fas fa-inbox text-6xl text-slate-700 mb-4"></i>
                <p class="text-slate-500 font-medium">Belum ada jenis ruangan</p>
                <a href="<?php echo e(route('admin.room-types.create')); ?>" class="inline-flex items-center gap-2 mt-4 px-4 py-2 bg-blue-500 text-white rounded-xl hover:bg-blue-600 transition-colors">
                  <i class="fas fa-plus"></i>
                  Tambah sekarang
                </a>
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Semester 4\ENG\ALP\Booking-Ruangan\resources\views/admin/room-types/index.blade.php ENDPATH**/ ?>