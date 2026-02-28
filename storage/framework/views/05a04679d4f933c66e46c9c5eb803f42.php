

<?php $__env->startSection('title', 'Edit Jenis Ruangan'); ?>
<?php $__env->startSection('header', 'Edit Jenis Ruangan'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto">
  <?php
    $adminFormDefaults = config('admin_form');
    $adminFormCardClass = $adminFormCardClass ?? $adminFormDefaults['card'];
    $adminFormHeaderClass = $adminFormHeaderClass ?? $adminFormDefaults['header'];
    $adminFormSubtextClass = $adminFormSubtextClass ?? $adminFormDefaults['subtext'];
    $adminLabelClass = $adminLabelClass ?? $adminFormDefaults['label'];
    $adminHelperTextClass = $adminHelperTextClass ?? $adminFormDefaults['helper'];
    $adminInputClass = $adminInputClass ?? $adminFormDefaults['input'];
    $adminTextareaClass = $adminTextareaClass ?? $adminFormDefaults['textarea'];
    $adminSelectClass = $adminSelectClass ?? $adminFormDefaults['select'];
    $adminCheckboxClass = $adminCheckboxClass ?? $adminFormDefaults['checkbox'];
    $adminPrimaryButtonClass = $adminPrimaryButtonClass ?? $adminFormDefaults['primary_button'];
    $adminSecondaryButtonClass = $adminSecondaryButtonClass ?? $adminFormDefaults['secondary_button'];
    $adminFormSectionDivider = $adminFormSectionDivider ?? $adminFormDefaults['divider'];
  ?>
  <div class="<?php echo e($adminFormCardClass); ?>">
    <form action="<?php echo e(route('admin.room-types.update', $roomType)); ?>" method="POST" class="space-y-8">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PUT'); ?>
      <div class="space-y-6">
        <div class="space-y-3">
          <h3 class="<?php echo e($adminFormHeaderClass); ?>">Perbarui jenis ruangan</h3>
          <p class="<?php echo e($adminFormSubtextClass); ?>">Sesuaikan informasi teks agar sesuai dengan nomenklatur terbaru di sekolah.</p>
        </div>
        <div class="space-y-2">
          <label for="name" class="<?php echo e($adminLabelClass); ?>">Nama Jenis (unik, untuk sistem) <span class="text-rose-400">*</span></label>
          <input type="text" id="name" name="name" value="<?php echo e(old('name', $roomType->name)); ?>" required
              class="class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                $adminInputClass,
                'border-rose-500/80 bg-rose-900/30 text-rose-100 placeholder-rose-200 focus:border-rose-400 focus:ring-rose-400/40' => $errors->has('name'),
              ]); ?>""
                 placeholder="Contoh: laboratorium">
          <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-xs text-rose-400"><?php echo e($message); ?></p>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="space-y-2">
          <label for="label" class="<?php echo e($adminLabelClass); ?>">Label Tampilan <span class="text-rose-400">*</span></label>
          <input type="text" id="label" name="label" value="<?php echo e(old('label', $roomType->label)); ?>" required
              class="class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                $adminInputClass,
                'border-rose-500/80 bg-rose-900/30 text-rose-100 placeholder-rose-200 focus:border-rose-400 focus:ring-rose-400/40' => $errors->has('label'),
              ]); ?>""
                 placeholder="Contoh: Laboratorium">
          <?php $__errorArgs = ['label'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-xs text-rose-400"><?php echo e($message); ?></p>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="space-y-2">
          <label for="description" class="<?php echo e($adminLabelClass); ?>">Deskripsi</label>
          <textarea id="description" name="description" rows="3"
              class="class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                $adminTextareaClass,
                'border-rose-500/80 bg-rose-900/30 text-rose-100 placeholder-rose-200 focus:border-rose-400 focus:ring-rose-400/40' => $errors->has('description'),
              ]); ?>""
                    placeholder="Contoh: Ruangan untuk praktikum dan eksperimen"><?php echo e(old('description', $roomType->description)); ?></textarea>
          <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-xs text-rose-400"><?php echo e($message); ?></p>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <label class="flex flex-col gap-2 rounded-2xl border border-slate-700/70 bg-slate-800/50 p-5 text-sm text-slate-200 shadow-inner shadow-black/30">
          <span class="flex items-center justify-between text-xs font-semibold uppercase tracking-[0.18em] text-slate-400">Status Jenis</span>
          <span class="flex items-center gap-3 text-base font-semibold text-white">
            <input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active', $roomType->is_active) ? 'checked' : ''); ?> class="<?php echo e($adminCheckboxClass); ?>">
            Aktif (bisa dipilih)
          </span>
          <span class="<?php echo e($adminHelperTextClass); ?>">Nonaktifkan jika tidak ingin ditampilkan sementara waktu.</span>
        </label>
        <div class="flex flex-col gap-3 pt-6 sm:flex-row sm:items-center <?php echo e($adminFormSectionDivider); ?>">
          <button type="submit" class="<?php echo e($adminPrimaryButtonClass); ?>">
            Perbarui Jenis
          </button>
          <a href="<?php echo e(route('admin.room-types.index')); ?>" class="<?php echo e($adminSecondaryButtonClass); ?>">
            Batal
          </a>
        </div>
      </div>
    </form>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Semester 4\ENG\ALP\Booking-Ruangan\resources\views/admin/room-types/edit.blade.php ENDPATH**/ ?>