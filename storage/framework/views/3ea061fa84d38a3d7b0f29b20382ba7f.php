

<?php $__env->startSection('title', 'Pengaturan Sistem'); ?>
<?php $__env->startSection('header', 'Pengaturan'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl space-y-6">
  <!-- General Settings -->
  <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm p-6">
  <h3 class="text-lg font-bold text-white mb-4">Pengaturan Umum</h3>
    <form action="<?php echo e(route('admin.settings.update')); ?>" method="POST">
      <?php echo csrf_field(); ?>
      
      <div class="space-y-6">
        <!-- School Name -->
        <div>
     <label for="school_name" class="block text-sm font-semibold text-slate-100 mb-2">Nama Sekolah</label>
     <input type="text" id="school_name" name="school_name" value="<?php echo e(old('school_name', 'Sekolah Palembang Harapan')); ?>"
       class="w-full px-4 py-2 border border-white/20 bg-white/10 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Contact Email -->
        <div>
     <label for="contact_email" class="block text-sm font-semibold text-slate-100 mb-2">Email Kontak</label>
     <input type="email" id="contact_email" name="contact_email" value="<?php echo e(old('contact_email', 'admin@palembangharapan.sch.id')); ?>"
       class="w-full px-4 py-2 border border-white/20 bg-white/10 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Phone -->
        <div>
     <label for="phone" class="block text-sm font-semibold text-slate-100 mb-2">Nomor Telepon</label>
     <input type="text" id="phone" name="phone" value="<?php echo e(old('phone', '0711-123456')); ?>"
       class="w-full px-4 py-2 border border-white/20 bg-white/10 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Address -->
        <div>
          <label for="address" class="block text-sm font-semibold text-slate-100 mb-2">Alamat</label>
          <textarea id="address" name="address" rows="3"
                    class="w-full px-4 py-2 border border-white/20 bg-white/10 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"><?php echo e(old('address', 'Jl. Contoh No. 123, Palembang')); ?></textarea>
        </div>
      </div>

      <div class="mt-6 pt-6 border-t">
  <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-xl font-semibold hover:bg-blue-600 transition-colors shadow-lg shadow-blue-500/30">
          Simpan Perubahan
        </button>
      </div>
    </form>
  </div>

  <!-- Booking Settings -->
  <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm p-6">
  <h3 class="text-lg font-bold text-white mb-4">Pengaturan Peminjaman</h3>
    <form action="<?php echo e(route('admin.settings.update')); ?>" method="POST">
      <?php echo csrf_field(); ?>
      
      <div class="space-y-6">
        <!-- Max Days Advance Booking -->
        <div>
          <label for="max_advance_days" class="block text-sm font-semibold text-slate-100 mb-2">
            Maksimal Hari Peminjaman di Muka
          </label>
     <input type="number" id="max_advance_days" name="max_advance_days" value="<?php echo e(old('max_advance_days', 30)); ?>" min="1"
       class="w-full px-4 py-2 border border-white/20 bg-white/10 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
     <p class="mt-1 text-xs text-slate-400">Berapa hari ke depan user bisa booking ruangan</p>
        </div>

        <!-- Min Booking Duration -->
        <div>
          <label for="min_duration" class="block text-sm font-semibold text-slate-100 mb-2">
            Durasi Minimum Peminjaman (Menit)
          </label>
     <input type="number" id="min_duration" name="min_duration" value="<?php echo e(old('min_duration', 60)); ?>" min="15" step="15"
       class="w-full px-4 py-2 border border-white/20 bg-white/10 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Auto Approve -->
        <div>
          <label class="flex items-center gap-3">
            <input type="checkbox" name="auto_approve" value="1" <?php echo e(old('auto_approve', false) ? 'checked' : ''); ?>

                   class="w-4 h-4 text-blue-500 border-white/20 rounded focus:ring-blue-500">
            <span class="text-sm font-semibold text-slate-100">Otomatis Approve Peminjaman</span>
          </label>
          <p class="mt-1 text-xs text-slate-400 ml-7">Jika diaktifkan, peminjaman akan langsung disetujui tanpa perlu approval admin</p>
        </div>

        <!-- Notifications -->
        <div>
          <label class="flex items-center gap-3">
            <input type="checkbox" name="email_notifications" value="1" <?php echo e(old('email_notifications', true) ? 'checked' : ''); ?>

                   class="w-4 h-4 text-blue-500 border-white/20 rounded focus:ring-blue-500">
            <span class="text-sm font-semibold text-slate-100">Kirim Notifikasi Email</span>
          </label>
        </div>
      </div>

      <div class="mt-6 pt-6 border-t">
  <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-xl font-semibold hover:bg-blue-600 transition-colors shadow-lg shadow-blue-500/30">
          Simpan Perubahan
        </button>
      </div>
    </form>
  </div>

  <!-- System Info -->
  <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm p-6">
  <h3 class="text-lg font-bold text-white mb-4">Informasi Sistem</h3>
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
  <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm p-6">
  <h3 class="text-lg font-bold text-white mb-4">Manajemen Cache</h3>
  <p class="text-sm text-slate-400 mb-4">Bersihkan cache aplikasi jika mengalami masalah</p>
    <div class="flex gap-3">
      <button onclick="alert('Fitur ini memerlukan implementasi backend')" class="px-4 py-2 border border-white/20 text-slate-100 rounded-xl hover:bg-white/10 transition-colors text-sm">
        Clear Cache
      </button>
      <button onclick="alert('Fitur ini memerlukan implementasi backend')" class="px-4 py-2 border border-white/20 text-slate-100 rounded-xl hover:bg-white/10 transition-colors text-sm">
        Clear Config
      </button>
      <button onclick="alert('Fitur ini memerlukan implementasi backend')" class="px-4 py-2 border border-white/20 text-slate-100 rounded-xl hover:bg-white/10 transition-colors text-sm">
        Clear Routes
      </button>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Semester 4\ENG\ALP\Booking-Ruangan\resources\views/admin/settings/index.blade.php ENDPATH**/ ?>