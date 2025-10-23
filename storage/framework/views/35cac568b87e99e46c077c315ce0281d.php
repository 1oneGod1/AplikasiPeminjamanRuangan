

<?php $__env->startSection('title', 'Dashboard Admin'); ?>
<?php $__env->startSection('header', 'Selamat Datang, ' . auth()->user()->name); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-4 md:space-y-6">
      
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4">
        <!-- Total Peminjaman -->
        <div class="group rounded-2xl border border-white/10 bg-gradient-to-br from-blue-500/20 to-blue-600/10 backdrop-blur-sm p-5 md:p-6 hover:border-blue-500/30 transition-all duration-300">
          <div class="flex items-start justify-between">
            <div class="flex-1">
              <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Total Peminjaman</p>
              <p class="mt-2 md:mt-3 text-3xl md:text-4xl font-bold text-white"><?php echo e($totalPeminjaman ?? 0); ?></p>
              <p class="mt-1 text-xs text-slate-500">Seluruh pengajuan</p>
            </div>
            <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-blue-500 shadow-lg shadow-blue-500/30">
              <i class="fas fa-clipboard-list text-white text-lg"></i>
            </div>
          </div>
        </div>

        <!-- Total Ruangan -->
        <div class="group rounded-2xl border border-white/10 bg-gradient-to-br from-purple-500/20 to-purple-600/10 backdrop-blur-sm p-5 md:p-6 hover:border-purple-500/30 transition-all duration-300">
          <div class="flex items-start justify-between">
            <div class="flex-1">
              <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Total Ruangan</p>
              <p class="mt-2 md:mt-3 text-3xl md:text-4xl font-bold text-white"><?php echo e($totalRuangan ?? 0); ?></p>
              <p class="mt-1 text-xs text-slate-500">Ruangan aktif</p>
            </div>
            <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-purple-500 shadow-lg shadow-purple-500/30">
              <i class="fas fa-door-open text-white text-lg"></i>
            </div>
          </div>
        </div>

        <!-- Total Pengguna -->
        <div class="group rounded-2xl border border-white/10 bg-gradient-to-br from-green-500/20 to-green-600/10 backdrop-blur-sm p-5 md:p-6 hover:border-green-500/30 transition-all duration-300">
          <div class="flex items-start justify-between">
            <div class="flex-1">
              <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Total Pengguna</p>
              <p class="mt-2 md:mt-3 text-3xl md:text-4xl font-bold text-white"><?php echo e($totalUsers ?? 0); ?></p>
              <p class="mt-1 text-xs text-slate-500">Pengguna terdaftar</p>
            </div>
            <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-green-500 shadow-lg shadow-green-500/30">
              <i class="fas fa-users text-white text-lg"></i>
            </div>
          </div>
        </div>

        <!-- Menunggu Persetujuan -->
        <div class="group rounded-2xl border border-white/10 bg-gradient-to-br from-orange-500/20 to-orange-600/10 backdrop-blur-sm p-5 md:p-6 hover:border-orange-500/30 transition-all duration-300">
          <div class="flex items-start justify-between">
            <div class="flex-1">
              <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Pending</p>
              <p class="mt-2 md:mt-3 text-3xl md:text-4xl font-bold text-white"><?php echo e($pendingCount ?? 0); ?></p>
              <p class="mt-1 text-xs text-slate-500">Menunggu approval</p>
            </div>
            <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-orange-500 shadow-lg shadow-orange-500/30">
              <i class="fas fa-clock text-white text-lg"></i>
            </div>
          </div>
        </div>
      </div>

      
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4">
        <!-- Approved -->
        <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm p-5 hover:bg-white/10 transition-colors">
          <div class="flex items-center justify-between">
            <div>
              <div class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Disetujui</div>
              <div class="mt-2 text-3xl md:text-4xl font-bold text-green-400"><?php echo e($approvedCount ?? 0); ?></div>
              <p class="mt-1 text-xs text-slate-500">Peminjaman approved</p>
            </div>
            <div class="flex items-center justify-center w-14 h-14 rounded-xl bg-green-500/10">
              <i class="fas fa-check-circle text-green-400 text-2xl"></i>
            </div>
          </div>
        </div>

        <!-- Rejected -->
        <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm p-5 hover:bg-white/10 transition-colors">
          <div class="flex items-center justify-between">
            <div>
              <div class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Ditolak</div>
              <div class="mt-2 text-3xl md:text-4xl font-bold text-red-400"><?php echo e($rejectedCount ?? 0); ?></div>
              <p class="mt-1 text-xs text-slate-500">Peminjaman rejected</p>
            </div>
            <div class="flex items-center justify-center w-14 h-14 rounded-xl bg-red-500/10">
              <i class="fas fa-times-circle text-red-400 text-2xl"></i>
            </div>
          </div>
        </div>

        <!-- Quick Action Button -->
        <a href="<?php echo e(route('admin.bookings.pending')); ?>" class="group rounded-2xl bg-gradient-to-r from-blue-500 to-blue-600 p-5 shadow-xl hover:shadow-2xl hover:shadow-blue-500/30 transition-all duration-300 flex items-center justify-center text-center sm:col-span-2 lg:col-span-1">
          <div class="flex flex-col sm:flex-row items-center gap-3">
            <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-white/20">
              <i class="fas fa-tasks text-white text-xl"></i>
            </div>
            <div class="text-center sm:text-left">
              <span class="block text-white font-bold text-base md:text-lg">Kelola Pending</span>
              <span class="block text-blue-100 text-xs mt-0.5">Tinjau pengajuan →</span>
            </div>
          </div>
        </a>
      </div>

      
      <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm overflow-hidden mb-6">
        <div class="px-4 md:px-6 py-4 border-b border-white/10 flex items-center justify-between">
          <div class="flex items-center gap-3">
            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-green-500/10">
              <i class="fas fa-user-shield text-green-400"></i>
            </div>
            <div>
              <h3 class="text-base md:text-lg font-bold text-white">User Non-Peminjam</h3>
              <p class="text-xs text-slate-400 hidden sm:block">Admin, Kepala Sekolah, Cleaning Service</p>
            </div>
          </div>
        </div>

        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
          <table class="min-w-full text-sm">
            <thead class="bg-white/5 border-b border-white/10">
              <tr>
                <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">#</th>
                <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Nama</th>
                <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Email</th>
                <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">No. Telepon</th>
                <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Role</th>
                <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Status</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
            <?php $__currentLoopData = \App\Models\User::where('role', '!=', 'peminjam')->where('role', '!=', 'guru')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr class="hover:bg-white/5 transition-colors">
                <td class="px-4 lg:px-6 py-4 text-slate-400"><?php echo e($loop->iteration); ?></td>
                <td class="px-4 lg:px-6 py-4">
                  <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-green-500 flex items-center justify-center text-white font-bold text-sm">
                      <?php echo e(strtoupper(substr($u->name, 0, 1))); ?>

                    </div>
                    <span class="font-medium text-white"><?php echo e($u->name); ?></span>
                  </div>
                </td>
                <td class="px-4 lg:px-6 py-4 text-slate-300"><?php echo e($u->email); ?></td>
                <td class="px-4 lg:px-6 py-4 text-slate-400"><?php echo e($u->phone ?? '-'); ?></td>
                <td class="px-4 lg:px-6 py-4 text-slate-400"><?php echo e(ucfirst(str_replace('_', ' ', $u->role))); ?></td>
                <td class="px-4 lg:px-6 py-4">
                  <?php if($u->is_active): ?>
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
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden divide-y divide-white/5">
          <?php $__empty_1 = true; $__currentLoopData = \App\Models\User::where('role', '!=', 'peminjam')->where('role', '!=', 'guru')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="p-4">
              <div class="flex items-start justify-between mb-2">
                <div class="flex items-center gap-3">
                  <div class="w-10 h-10 rounded-full bg-green-500 flex items-center justify-center text-white font-bold text-sm">
                    <?php echo e(strtoupper(substr($u->name, 0, 1))); ?>

                  </div>
                  <div>
                    <div class="font-semibold text-white text-sm"><?php echo e($u->name); ?></div>
                    <div class="text-xs text-slate-400"><?php echo e(ucfirst(str_replace('_', ' ', $u->role))); ?></div>
                  </div>
                </div>
                <?php if($u->is_active): ?>
                  <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-semibold rounded-full bg-green-500/10 border border-green-500/30 text-green-400">
                    <i class="fas fa-check-circle text-xs"></i>
                  </span>
                <?php else: ?>
                  <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-semibold rounded-full bg-red-500/10 border border-red-500/30 text-red-400">
                    <i class="fas fa-times-circle text-xs"></i>
                  </span>
                <?php endif; ?>
              </div>
              <div class="text-xs text-slate-400"><?php echo e($u->email); ?></div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="p-6 text-center text-slate-500 text-sm">Tidak ada data user non-peminjam</div>
          <?php endif; ?>
        </div>
      </div>
      
      <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm overflow-hidden">
        <div class="px-4 md:px-6 py-4 border-b border-white/10 flex items-center justify-between">
          <div class="flex items-center gap-3">
            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-blue-500/10">
              <i class="fas fa-history text-blue-400"></i>
            </div>
            <div>
              <h3 class="text-base md:text-lg font-bold text-white">Peminjaman Terbaru</h3>
              <p class="text-xs text-slate-400 hidden sm:block">Update realtime dari sistem</p>
            </div>
          </div>
          <span class="hidden lg:inline-flex items-center gap-2 text-xs text-slate-500">
            <span class="h-2 w-2 rounded-full bg-green-400 animate-pulse"></span>
            Live
          </span>
        </div>

        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
          <table class="min-w-full text-sm">
            <thead class="bg-white/5 border-b border-white/10">
              <tr>
                <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Peminjam</th>
                <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Ruangan</th>
                <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Tanggal</th>
                <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Waktu</th>
                <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Status</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
            <?php $__empty_1 = true; $__currentLoopData = $recentBookings ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <tr class="hover:bg-white/5 transition-colors">
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
                  <?php
                    $statusConfig = match($b->status){
                      'approved' => ['bg' => 'bg-green-500/10', 'text' => 'text-green-400', 'border' => 'border-green-500/30', 'label' => 'Approved', 'icon' => 'check-circle'],
                      'rejected' => ['bg' => 'bg-red-500/10', 'text' => 'text-red-400', 'border' => 'border-red-500/30', 'label' => 'Rejected', 'icon' => 'times-circle'],
                      'pending'  => ['bg' => 'bg-yellow-500/10', 'text' => 'text-yellow-400', 'border' => 'border-yellow-500/30', 'label' => 'Pending', 'icon' => 'clock'],
                      default    => ['bg' => 'bg-slate-500/10', 'text' => 'text-slate-400', 'border' => 'border-slate-500/30', 'label' => ucfirst($b->status), 'icon' => 'info-circle']
                    };
                  ?>
                  <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold border <?php echo e($statusConfig['bg']); ?> <?php echo e($statusConfig['text']); ?> <?php echo e($statusConfig['border']); ?>">
                    <i class="fas fa-<?php echo e($statusConfig['icon']); ?>"></i>
                    <?php echo e($statusConfig['label']); ?>

                  </span>
                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <tr><td colspan="5" class="px-6 py-12 text-center text-slate-500">
                <i class="fas fa-inbox text-4xl text-slate-700 mb-3"></i>
                <p>Belum ada data peminjaman</p>
              </td></tr>
            <?php endif; ?>
            </tbody>
          </table>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden divide-y divide-white/5">
          <?php $__empty_1 = true; $__currentLoopData = $recentBookings ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="p-4 hover:bg-white/5 transition-colors">
              <!-- Header: User & Status -->
              <div class="flex items-start justify-between mb-3">
                <div class="flex items-center gap-3">
                  <div class="w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">
                    <?php echo e(strtoupper(substr($b->user->name ?? '?', 0, 1))); ?>

                  </div>
                  <div>
                    <div class="font-semibold text-white text-sm"><?php echo e($b->user->name ?? '-'); ?></div>
                    <div class="text-xs text-slate-500">Peminjam</div>
                  </div>
                </div>
                <?php
                  $statusConfig = match($b->status){
                    'approved' => ['bg' => 'bg-green-500/10', 'text' => 'text-green-400', 'border' => 'border-green-500/30', 'label' => 'Approved', 'icon' => 'check-circle'],
                    'rejected' => ['bg' => 'bg-red-500/10', 'text' => 'text-red-400', 'border' => 'border-red-500/30', 'label' => 'Rejected', 'icon' => 'times-circle'],
                    'pending'  => ['bg' => 'bg-yellow-500/10', 'text' => 'text-yellow-400', 'border' => 'border-yellow-500/30', 'label' => 'Pending', 'icon' => 'clock'],
                    default    => ['bg' => 'bg-slate-500/10', 'text' => 'text-slate-400', 'border' => 'border-slate-500/30', 'label' => ucfirst($b->status), 'icon' => 'info-circle']
                  };
                ?>
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold border <?php echo e($statusConfig['bg']); ?> <?php echo e($statusConfig['text']); ?> <?php echo e($statusConfig['border']); ?>">
                  <i class="fas fa-<?php echo e($statusConfig['icon']); ?>"></i>
                  <?php echo e($statusConfig['label']); ?>

                </span>
              </div>

              <!-- Details Grid -->
              <div class="space-y-2">
                <!-- Ruangan -->
                <div class="flex items-center gap-3 rounded-xl bg-white/5 p-3">
                  <i class="fas fa-door-open text-slate-400"></i>
                  <div class="flex-1">
                    <div class="text-xs text-slate-500">Ruangan</div>
                    <div class="text-sm font-medium text-white"><?php echo e($b->room->name ?? '-'); ?></div>
                  </div>
                </div>

                <!-- Tanggal & Waktu -->
                <div class="grid grid-cols-2 gap-2">
                  <div class="flex items-center gap-3 rounded-xl bg-white/5 p-3">
                    <i class="fas fa-calendar text-slate-400"></i>
                    <div class="flex-1 min-w-0">
                      <div class="text-xs text-slate-500">Tanggal</div>
                      <div class="text-sm font-medium text-white truncate"><?php echo e(\Illuminate\Support\Carbon::parse($b->booking_date)->format('d M Y')); ?></div>
                    </div>
                  </div>

                  <div class="flex items-center gap-3 rounded-xl bg-white/5 p-3">
                    <i class="fas fa-clock text-slate-400"></i>
                    <div class="flex-1 min-w-0">
                      <div class="text-xs text-slate-500">Waktu</div>
                      <div class="text-sm font-medium text-white truncate"><?php echo e(substr($b->start_time,0,5)); ?>–<?php echo e(substr($b->end_time,0,5)); ?></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="p-12 text-center">
              <i class="fas fa-inbox text-5xl text-slate-700 mb-4"></i>
              <p class="text-slate-500 text-sm">Belum ada data peminjaman</p>
              <p class="text-slate-600 text-xs mt-1">Data akan muncul di sini</p>
            </div>
          <?php endif; ?>
        </div>
      </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Semester 4\ENG\ALP\Booking-Ruangan\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>