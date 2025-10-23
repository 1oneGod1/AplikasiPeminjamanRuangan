<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $__env->yieldContent('title', 'Admin Dashboard'); ?> - Sistem Peminjaman Ruangan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="min-h-screen bg-slate-950 text-slate-100">
  <div class="flex h-screen overflow-hidden">
    <!-- Sidebar Desktop -->
    <aside class="hidden lg:flex w-64 bg-gradient-to-b from-slate-900 to-slate-950 border-r border-white/10 flex-col">
      <div class="px-6 py-5 border-b border-white/10">
        <div class="flex items-center gap-3">
          <img src="https://static.wixstatic.com/media/07639e_83549958900b44ad9fea05d99e380dd5~mv2.png/v1/fill/w_559,h_512,al_c/07639e_83549958900b44ad9fea05d99e380dd5~mv2.png" alt="SPH Logo" class="h-10 w-10 rounded-xl border border-white/10 bg-white/10 p-1 object-contain">
          <div>
            <h1 class="text-lg font-bold text-white">Admin Dashboard</h1>
            <p class="text-xs text-slate-400">Sekolah Palembang Harapan</p>
          </div>
        </div>
      </div>

      <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-300 hover:bg-white/5 hover:text-white'); ?> transition-all">
          <i class="fas fa-home w-5"></i>
          <span>Beranda</span>
        </a>
        <a href="<?php echo e(route('admin.bookings.pending')); ?>" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium <?php echo e(request()->routeIs('admin.bookings.*') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-300 hover:bg-white/5 hover:text-white'); ?> transition-all">
          <i class="fas fa-clipboard-list w-5"></i>
          <span>Peminjaman Pending</span>
        </a>
        <a href="<?php echo e(route('admin.password-change.index')); ?>" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium <?php echo e(request()->routeIs('admin.password-change.*') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-300 hover:bg-white/5 hover:text-white'); ?> transition-all">
          <i class="fas fa-key w-5"></i>
          <span>Pengajuan Password</span>
        </a>
        
        <div class="mt-6 mb-3 px-4 text-xs uppercase tracking-[0.2em] font-semibold text-slate-500">Master Data</div>
        <a href="<?php echo e(route('admin.rooms.index')); ?>" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium <?php echo e(request()->routeIs('admin.rooms.*') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-300 hover:bg-white/5 hover:text-white'); ?> transition-all">
          <i class="fas fa-door-open w-5"></i>
          <span>Ruangan</span>
        </a>
        <a href="<?php echo e(route('admin.users.peminjam')); ?>" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium <?php echo e(request()->routeIs('admin.users.peminjam') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-300 hover:bg-white/5 hover:text-white'); ?> transition-all">
          <i class="fas fa-users w-5"></i>
          <span>Peminjam</span>
        </a>
        <a href="<?php echo e(route('admin.users.nonpeminjam')); ?>" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium <?php echo e(request()->routeIs('admin.users.nonpeminjam') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-300 hover:bg-white/5 hover:text-white'); ?> transition-all">
          <i class="fas fa-user-shield w-5"></i>
          <span>User Non-Peminjam</span>
        </a>
        <a href="<?php echo e(route('admin.settings.index')); ?>" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium <?php echo e(request()->routeIs('admin.settings.*') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-300 hover:bg-white/5 hover:text-white'); ?> transition-all">
          <i class="fas fa-cog w-5"></i>
          <span>Pengaturan</span>
        </a>
      </nav>

      <div class="p-4 border-t border-white/10">
        <form method="POST" action="<?php echo e(route('logout')); ?>">
          <?php echo csrf_field(); ?>
          <button type="submit" class="flex items-center gap-3 w-full rounded-xl px-4 py-3 text-sm font-medium text-red-400 hover:text-red-300 hover:bg-red-500/10 transition-all">
            <i class="fas fa-sign-out-alt w-5"></i>
            <span>Keluar</span>
          </button>
        </form>
      </div>
    </aside>

    <!-- Mobile Menu Button & Overlay -->
    <div class="lg:hidden fixed top-4 left-4 z-50">
      <button id="mobile-menu-btn" class="rounded-xl bg-slate-900 border border-white/10 p-3 text-white hover:bg-slate-800 transition-colors">
        <i class="fas fa-bars text-lg"></i>
      </button>
    </div>

    <!-- Mobile Sidebar -->
    <aside id="mobile-sidebar" class="lg:hidden fixed inset-0 z-40 transform -translate-x-full transition-transform duration-300 ease-in-out">
      <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" id="mobile-overlay"></div>
      <div class="relative w-72 h-full bg-gradient-to-b from-slate-900 to-slate-950 border-r border-white/10 flex flex-col shadow-2xl">
        <div class="px-6 py-5 border-b border-white/10 flex items-center justify-between">
          <div class="flex items-center gap-3">
            <img src="https://static.wixstatic.com/media/07639e_83549958900b44ad9fea05d99e380dd5~mv2.png/v1/fill/w_559,h_512,al_c/07639e_83549958900b44ad9fea05d99e380dd5~mv2.png" alt="SPH Logo" class="h-10 w-10 rounded-xl border border-white/10 bg-white/10 p-1 object-contain">
            <div>
              <h1 class="text-lg font-bold text-white">Admin</h1>
              <p class="text-xs text-slate-400">SPH</p>
            </div>
          </div>
          <button id="mobile-close-btn" class="text-slate-400 hover:text-white">
            <i class="fas fa-times text-xl"></i>
          </button>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
          <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-300 hover:bg-white/5 hover:text-white'); ?> transition-all">
            <i class="fas fa-home w-5"></i>
            <span>Beranda</span>
          </a>
          <a href="<?php echo e(route('admin.bookings.pending')); ?>" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium <?php echo e(request()->routeIs('admin.bookings.*') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-300 hover:bg-white/5 hover:text-white'); ?> transition-all">
            <i class="fas fa-clipboard-list w-5"></i>
            <span>Peminjaman Pending</span>
          </a>
          <a href="<?php echo e(route('admin.password-change.index')); ?>" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium <?php echo e(request()->routeIs('admin.password-change.*') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-300 hover:bg-white/5 hover:text-white'); ?> transition-all">
            <i class="fas fa-key w-5"></i>
            <span>Pengajuan Password</span>
          </a>
          
          <div class="mt-6 mb-3 px-4 text-xs uppercase tracking-[0.2em] font-semibold text-slate-500">Master Data</div>
          <a href="<?php echo e(route('admin.rooms.index')); ?>" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium <?php echo e(request()->routeIs('admin.rooms.*') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-300 hover:bg-white/5 hover:text-white'); ?> transition-all">
            <i class="fas fa-door-open w-5"></i>
            <span>Ruangan</span>
          </a>
          <a href="<?php echo e(route('admin.users.peminjam')); ?>" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium <?php echo e(request()->routeIs('admin.users.peminjam') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-300 hover:bg-white/5 hover:text-white'); ?> transition-all">
            <i class="fas fa-users w-5"></i>
            <span>Peminjam</span>
          </a>
          <a href="<?php echo e(route('admin.users.nonpeminjam')); ?>" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium <?php echo e(request()->routeIs('admin.users.nonpeminjam') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-300 hover:bg-white/5 hover:text-white'); ?> transition-all">
            <i class="fas fa-user-shield w-5"></i>
            <span>User Non-Peminjam</span>
          </a>
          <a href="<?php echo e(route('admin.settings.index')); ?>" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium <?php echo e(request()->routeIs('admin.settings.*') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-300 hover:bg-white/5 hover:text-white'); ?> transition-all">
            <i class="fas fa-cog w-5"></i>
            <span>Pengaturan</span>
          </a>
        </nav>

        <div class="p-4 border-t border-white/10">
          <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" class="flex items-center gap-3 w-full rounded-xl px-4 py-3 text-sm font-medium text-red-400 hover:text-red-300 hover:bg-red-500/10 transition-all">
              <i class="fas fa-sign-out-alt w-5"></i>
              <span>Keluar</span>
            </button>
          </form>
        </div>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto bg-slate-950">
      <!-- Header -->
      <header class="sticky top-0 z-30 flex items-center justify-between bg-gradient-to-r from-slate-900 via-slate-900/95 to-slate-900/90 border-b border-white/10 px-4 lg:px-6 py-4 backdrop-blur-sm">
        <div class="flex items-center gap-4">
          <div class="lg:hidden w-12"></div>
          <div>
            <h2 class="text-base lg:text-lg font-bold text-white"><?php echo $__env->yieldContent('header', 'Dashboard'); ?></h2>
            <p class="text-xs text-slate-400 hidden sm:block">Sekolah Palembang Harapan</p>
          </div>
        </div>
        <div class="flex items-center gap-3">
          <div class="hidden sm:block text-right">
            <p class="text-sm font-medium text-white"><?php echo e(Auth::user()->name); ?></p>
            <p class="text-xs text-slate-400">Administrator</p>
          </div>
          <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold text-sm border-2 border-white/20">
            <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

          </div>
        </div>
      </header>

      <!-- Flash Messages -->
      <?php if(session('success')): ?>
        <div class="mx-4 lg:mx-6 mt-4 rounded-xl bg-green-500/10 border border-green-500/30 p-4">
          <div class="flex items-center gap-2">
            <i class="fas fa-check-circle text-green-400"></i>
            <p class="text-sm text-green-300"><?php echo e(session('success')); ?></p>
          </div>
        </div>
      <?php endif; ?>

      <?php if(session('error')): ?>
        <div class="mx-4 lg:mx-6 mt-4 rounded-xl bg-red-500/10 border border-red-500/30 p-4">
          <div class="flex items-center gap-2">
            <i class="fas fa-exclamation-circle text-red-400"></i>
            <p class="text-sm text-red-300"><?php echo e(session('error')); ?></p>
          </div>
        </div>
      <?php endif; ?>

      <!-- Page Content -->
      <section class="p-4 lg:p-6">
        <?php echo $__env->yieldContent('content'); ?>
      </section>
    </main>
  </div>

  <script>
    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileCloseBtn = document.getElementById('mobile-close-btn');
    const mobileSidebar = document.getElementById('mobile-sidebar');
    const mobileOverlay = document.getElementById('mobile-overlay');

    function openMobileMenu() {
      mobileSidebar.classList.remove('-translate-x-full');
    }

    function closeMobileMenu() {
      mobileSidebar.classList.add('-translate-x-full');
    }

    if (mobileMenuBtn) mobileMenuBtn.addEventListener('click', openMobileMenu);
    if (mobileCloseBtn) mobileCloseBtn.addEventListener('click', closeMobileMenu);
    if (mobileOverlay) mobileOverlay.addEventListener('click', closeMobileMenu);
  </script>

  <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH E:\Semester 4\ENG\ALP\Booking-Ruangan\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>