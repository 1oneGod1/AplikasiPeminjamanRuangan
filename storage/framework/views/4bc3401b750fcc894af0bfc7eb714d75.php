

<?php $__env->startSection('title', isset($room) ? 'Edit Ruangan' : 'Tambah Ruangan'); ?>
<?php $__env->startSection('header', isset($room) ? 'Edit Ruangan' : 'Tambah Ruangan Baru'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl">
  <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm p-6">
    <form action="<?php echo e(isset($room) ? route('admin.rooms.update', $room) : route('admin.rooms.store')); ?>" method="POST">
      <?php echo csrf_field(); ?>
      <?php if(isset($room)): ?>
        <?php echo method_field('PUT'); ?>
      <?php endif; ?>

  <div class="space-y-6">
        <!-- Nama Ruangan -->
        <div>
          <label for="name" class="block text-sm font-semibold text-slate-100 mb-2">Nama Ruangan <span class="text-red-400">*</span></label>
          <input type="text" id="name" name="name" value="<?php echo e(old('name', $room->name ?? '')); ?>" required
                 class="w-full px-4 py-2 border border-white/20 bg-white/10 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                 placeholder="Contoh: Lab Komputer 1">
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

        <!-- Jenis Ruangan -->
        <div>
          <div class="flex items-center justify-between mb-2">
            <label for="type" class="block text-sm font-semibold text-slate-100">Jenis Ruangan <span class="text-red-400">*</span></label>
            <a href="<?php echo e(route('admin.room-types.index')); ?>" class="text-xs text-blue-400 hover:underline">Kelola Jenis Ruangan</a>
          </div>
          <select id="type" name="type" required class="w-full px-4 py-2 border border-white/20 bg-slate-800 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
            <option value="" class="bg-slate-800 text-slate-400">Pilih Jenis</option>
            <?php $__currentLoopData = $roomTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($type->name); ?>" class="bg-slate-800 text-white" <?php echo e(old('type', $room->type ?? '') == $type->name ? 'selected' : ''); ?>><?php echo e($type->label); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
          <?php $__errorArgs = ['type'];
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

        <!-- Kapasitas -->
        <div>
          <label for="capacity" class="block text-sm font-semibold text-slate-100 mb-2">Kapasitas <span class="text-red-400">*</span></label>
          <input type="number" id="capacity" name="capacity" value="<?php echo e(old('capacity', $room->capacity ?? '')); ?>" required min="1"
                 class="w-full px-4 py-2 border border-white/20 bg-white/10 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 <?php $__errorArgs = ['capacity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                 placeholder="Jumlah orang">
          <?php $__errorArgs = ['capacity'];
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

        <!-- Lokasi -->
        <div>
          <label for="location" class="block text-sm font-semibold text-slate-100 mb-2">Lokasi</label>
          <input type="text" id="location" name="location" value="<?php echo e(old('location', $room->location ?? '')); ?>"
                 class="w-full px-4 py-2 border border-white/20 bg-white/10 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                 placeholder="Contoh: Lantai 2, Gedung A">
          <?php $__errorArgs = ['location'];
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

        <!-- Fasilitas -->
        <div>
          <label for="facilities" class="block text-sm font-semibold text-slate-100 mb-2">Fasilitas</label>
          <textarea id="facilities" name="facilities" rows="3"
                    class="w-full px-4 py-2 border border-white/20 bg-white/10 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 <?php $__errorArgs = ['facilities'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    placeholder="Contoh: Proyektor, AC, Whiteboard, 30 Komputer"><?php echo e(old('facilities', $room->facilities ?? '')); ?></textarea>
          <?php $__errorArgs = ['facilities'];
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

        <!-- Status Aktif -->
        <div>
          <label class="flex items-center gap-3">
            <input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active', $room->is_active ?? true) ? 'checked' : ''); ?>

                   class="w-4 h-4 text-blue-500 border-white/20 rounded focus:ring-blue-500">
            <span class="text-sm font-semibold text-slate-100">Ruangan Aktif (bisa dipinjam)</span>
          </label>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center gap-3 pt-4 border-t border-white/10">
          <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-xl font-semibold hover:bg-blue-600 transition-colors shadow-lg shadow-blue-500/30">
            <?php echo e(isset($room) ? 'Perbarui' : 'Simpan'); ?>

          </button>
          <a href="<?php echo e(route('admin.rooms.index')); ?>" class="px-6 py-2 border border-white/20 text-slate-100 rounded-xl hover:bg-white/10 transition-colors">
            Batal
          </a>
        </div>
      </div>
    </form>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Semester 4\ENG\ALP\Booking-Ruangan\resources\views/admin/rooms/create.blade.php ENDPATH**/ ?>