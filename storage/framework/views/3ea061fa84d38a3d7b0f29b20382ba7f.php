

<?php $__env->startSection('title', 'Pengaturan Sistem'); ?>
<?php $__env->startSection('header', 'Pengaturan'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl space-y-8">
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

  <!-- General Settings -->
  <div class="<?php echo e($adminFormCardClass); ?>">
  <h3 class="text-xl font-semibold text-white">Pengaturan Umum</h3>
  <p class="mt-2 text-sm text-slate-400">Perbarui identitas sekolah yang muncul di seluruh portal peminjaman.</p>
    <form action="<?php echo e(route('admin.settings.update')); ?>" method="POST" class="mt-8 space-y-8">
      <?php echo csrf_field(); ?>
      
      <div class="space-y-6">
        <!-- School Name -->
        <div class="space-y-2">
     <label for="school_name" class="<?php echo e($adminLabelClass); ?>">Nama Sekolah</label>
     <input type="text" id="school_name" name="school_name" value="<?php echo e(old('school_name', 'Sekolah Palembang Harapan')); ?>"
       class="<?php echo e($adminInputClass); ?>" placeholder="Nama sekolah">
        </div>

        <!-- Contact Email -->
        <div class="space-y-2">
     <label for="contact_email" class="<?php echo e($adminLabelClass); ?>">Email Kontak</label>
     <input type="email" id="contact_email" name="contact_email" value="<?php echo e(old('contact_email', 'admin@palembangharapan.sch.id')); ?>"
       class="<?php echo e($adminInputClass); ?>" placeholder="admin@palembangharapan.sch.id">
        </div>

        <!-- Phone -->
        <div class="space-y-2">
     <label for="phone" class="<?php echo e($adminLabelClass); ?>">Nomor Telepon</label>
     <input type="text" id="phone" name="phone" value="<?php echo e(old('phone', '0711-123456')); ?>"
       class="<?php echo e($adminInputClass); ?>" placeholder="0711-123456">
        </div>

        <!-- Address -->
        <div class="space-y-2">
          <label for="address" class="<?php echo e($adminLabelClass); ?>">Alamat</label>
          <textarea id="address" name="address" rows="3"
                    class="<?php echo e($adminTextareaClass); ?>" placeholder="Jl. Contoh No. 123, Palembang"><?php echo e(old('address', 'Jl. Contoh No. 123, Palembang')); ?></textarea>
        </div>
      </div>

      <div class="pt-6 <?php echo e($adminFormSectionDivider); ?> flex flex-col sm:flex-row gap-3">
        <button type="submit" class="<?php echo e($adminPrimaryButtonClass); ?>">
          Simpan Perubahan
        </button>
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="<?php echo e($adminSecondaryButtonClass); ?>">
          Batal
        </a>
      </div>
    </form>
  </div>

  <!-- Booking Settings -->
  <div class="<?php echo e($adminFormCardClass); ?>">
  <h3 class="text-xl font-semibold text-white">Pengaturan Peminjaman</h3>
  <p class="mt-2 text-sm text-slate-400">Atur kebijakan peminjaman agar sesuai dengan aturan internal sekolah.</p>
    <form action="<?php echo e(route('admin.settings.update')); ?>" method="POST" class="mt-8 space-y-8">
      <?php echo csrf_field(); ?>
      
      <div class="space-y-6">
        <!-- Max Days Advance Booking -->
        <div class="space-y-2">
          <label for="max_advance_days" class="<?php echo e($adminLabelClass); ?>">
            Maksimal Hari Peminjaman di Muka
          </label>
     <input type="number" id="max_advance_days" name="max_advance_days" value="<?php echo e(old('max_advance_days', 30)); ?>" min="1"
       class="<?php echo e($adminInputClass); ?>" placeholder="30">
     <p class="<?php echo e($adminHelperTextClass); ?>">Berapa hari ke depan user bisa booking ruangan.</p>
        </div>

        <!-- Min Booking Duration -->
        <div class="space-y-2">
          <label for="min_duration" class="<?php echo e($adminLabelClass); ?>">
            Durasi Minimum Peminjaman (Menit)
          </label>
     <input type="number" id="min_duration" name="min_duration" value="<?php echo e(old('min_duration', 60)); ?>" min="15" step="15"
       class="<?php echo e($adminInputClass); ?>" placeholder="60">
        </div>

        <!-- Auto Approve -->
        <label class="flex flex-col gap-2 rounded-2xl border border-slate-700/70 bg-slate-800/50 p-5 text-sm text-slate-200 shadow-inner shadow-black/30">
          <span class="flex items-center justify-between text-xs font-semibold uppercase tracking-[0.18em] text-slate-400">Otomatisasi Persetujuan</span>
          <span class="flex items-center gap-3 text-base font-semibold text-white">
            <input type="checkbox" name="auto_approve" value="1" <?php echo e(old('auto_approve', false) ? 'checked' : ''); ?>

                   class="<?php echo e($adminCheckboxClass); ?>">
            Otomatis approve peminjaman
          </span>
          <span class="<?php echo e($adminHelperTextClass); ?>">Jika aktif, peminjaman langsung disetujui tanpa perlu tinjauan admin.</span>
        </label>

        <!-- Notifications -->
        <label class="flex items-center gap-3 text-sm font-semibold text-slate-200">
          <input type="checkbox" name="email_notifications" value="1" <?php echo e(old('email_notifications', true) ? 'checked' : ''); ?>

                 class="<?php echo e($adminCheckboxClass); ?>">
          Kirim Notifikasi Email
        </label>
      </div>

      <div class="pt-6 <?php echo e($adminFormSectionDivider); ?> flex flex-col sm:flex-row gap-3">
        <button type="submit" class="<?php echo e($adminPrimaryButtonClass); ?>">
          Simpan Perubahan
        </button>
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="<?php echo e($adminSecondaryButtonClass); ?>">
          Batal
        </a>
      </div>
    </form>
  </div>

  <!-- System Info -->
  <div class="rounded-[28px] border border-white/10 bg-slate-900/80 p-8 text-slate-200 shadow-2xl shadow-black/25">
  <h3 class="text-xl font-semibold text-white mb-4">Informasi Sistem</h3>
    <div class="space-y-3 text-sm">
      <div class="flex justify-between py-2 border-b">
        <span class="text-slate-400">Versi Laravel</span>
        <span class="font-medium text-white"><?php echo e(app()->version()); ?></span>
      </div>
      <div class="flex justify-between py-2 border-b">
        <span class="text-slate-400">Versi PHP</span>
        <span class="font-medium text-white"><?php echo e(phpversion()); ?></span>
      </div>
      <div class="flex justify-between py-2 border-b">
        <span class="text-slate-400">Database</span>
        <span class="font-medium text-white"><?php echo e(config('database.default')); ?></span>
      </div>
      <div class="flex justify-between py-2">
        <span class="text-slate-400">Timezone</span>
        <span class="font-medium text-white"><?php echo e(config('app.timezone')); ?></span>
      </div>
    </div>
  </div>

  <!-- Cache Management -->
  <div class="rounded-[28px] border border-white/10 bg-slate-900/80 p-8 text-slate-200 shadow-2xl shadow-black/25">
  <h3 class="text-xl font-semibold text-white mb-3">Manajemen Cache</h3>
  <p class="text-sm text-slate-400 mb-6">Bersihkan cache aplikasi jika mengalami masalah.</p>
    <div class="flex flex-wrap gap-3">
      <button onclick="alert('Fitur ini memerlukan implementasi backend')" class="<?php echo e($adminSecondaryButtonClass); ?> text-sm">
        Clear Cache
      </button>
      <button onclick="alert('Fitur ini memerlukan implementasi backend')" class="<?php echo e($adminSecondaryButtonClass); ?> text-sm">
        Clear Config
      </button>
      <button onclick="alert('Fitur ini memerlukan implementasi backend')" class="<?php echo e($adminSecondaryButtonClass); ?> text-sm">
        Clear Routes
      </button>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Semester 4\ENG\ALP\Booking-Ruangan\resources\views/admin/settings/index.blade.php ENDPATH**/ ?>