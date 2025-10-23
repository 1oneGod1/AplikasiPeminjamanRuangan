

<?php $__env->startSection('title', 'Tambah Jenis Ruangan'); ?>
<?php $__env->startSection('header', 'Tambah Jenis Ruangan'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-xl mx-auto">
  <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm p-6">
    <form action="<?php echo e(route('admin.room-types.store')); ?>" method="POST">
      <?php echo csrf_field(); ?>
      <div class="space-y-6">
        <div>
          <label for="name" class="block text-sm font-semibold text-slate-100 mb-2">Nama Jenis (unik, untuk sistem) <span class="text-red-400">*</span></label>
          <input type="text" id="name" name="name" value="<?php echo e(old('name')); ?>" required
                 class="w-full px-4 py-2 border border-white/20 bg-white/10 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                 placeholder="Contoh: laboratorium">
          <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="mt-1 text-sm text-red-400"><?php echo e($message); ?></p>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div>
          <label for="label" class="block text-sm font-semibold text-slate-100 mb-2">Label Tampilan <span class="text-red-400">*</span></label>
          <input type="text" id="label" name="label" value="<?php echo e(old('label')); ?>" required
                 class="w-full px-4 py-2 border border-white/20 bg-white/10 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 <?php $__errorArgs = ['label'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                 placeholder="Contoh: Laboratorium">
          <?php $__errorArgs = ['label'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="mt-1 text-sm text-red-400"><?php echo e($message); ?></p>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div>
          <label for="description" class="block text-sm font-semibold text-slate-100 mb-2">Deskripsi</label>
          <textarea id="description" name="description" rows="2"
                    class="w-full px-4 py-2 border border-white/20 bg-white/10 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    placeholder="Contoh: Ruangan untuk praktikum dan eksperimen"><?php echo e(old('description')); ?></textarea>
          <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="mt-1 text-sm text-red-400"><?php echo e($message); ?></p>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div>
          <label class="flex items-center gap-3">
            <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 text-blue-500 border-white/20 rounded focus:ring-blue-500">
            <span class="text-sm font-semibold text-slate-100">Aktif (bisa dipilih)</span>
          </label>
        </div>
        <div class="flex items-center gap-3 pt-4 border-t border-white/10">
          <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-xl font-semibold hover:bg-blue-600 transition-colors shadow-lg shadow-blue-500/30">
            Simpan Jenis
          </button>
          <a href="<?php echo e(route('admin.room-types.index')); ?>" class="px-6 py-2 border border-white/20 text-slate-100 rounded-xl hover:bg-white/10 transition-colors">
            Batal
          </a>
        </div>
      </div>
    </form>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Semester 4\ENG\ALP\Booking-Ruangan\resources\views/admin/room-types/create.blade.php ENDPATH**/ ?>