<!DOCTYPE html>
<html lang="id" class="h-full bg-white">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Sistem Peminjaman Ruangan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
  <style> body{ font-family: 'Inter', sans-serif; } </style>
</head>
<body class="h-full">
  <main class="relative min-h-screen flex items-center justify-center overflow-hidden bg-black text-white">
    <img src="https://proditp.unismuh.ac.id/wp-content/uploads/2023/01/Lab-Komputer-SMP-Negeri-12-Binjai-Gambar-Ilustrasi-768x439.jpg" alt="Lab Komputer Sekolah Palembang Harapan" class="absolute inset-0 h-full w-full object-cover object-center opacity-40" />
    <div class="absolute inset-0 bg-linear-to-br from-slate-950/90 via-slate-900/65 to-blue-900/70"></div>

    <div class="relative z-10 w-full max-w-5xl px-4">
      <div class="grid gap-10 rounded-[30px] border border-white/10 bg-slate-950/60 p-10 shadow-2xl shadow-blue-900/30 backdrop-blur-xl lg:grid-cols-[1.2fr_0.9fr]">
        <div class="flex flex-col justify-between gap-10">
          <div class="space-y-8">
            <div class="flex flex-col gap-6 text-slate-300">
              <div class="flex flex-wrap items-center gap-4">
                <img src="https://static.wixstatic.com/media/07639e_83549958900b44ad9fea05d99e380dd5~mv2.png/v1/fill/w_559,h_512,al_c/07639e_83549958900b44ad9fea05d99e380dd5~mv2.png" alt="Logo Sekolah Palembang Harapan" class="h-16 w-16 object-contain" loading="lazy">
                <span class="text-[11px] font-semibold uppercase tracking-[0.42em] text-slate-400">Portal Peminjaman</span>
              </div>
              <div class="space-y-3 text-left">
                <h1 class="text-3xl font-semibold tracking-tight text-white">Daftar Akun Peminjaman</h1>
                <p class="text-sm leading-relaxed text-slate-300">Bergabung sebagai peminjam untuk mengajukan jadwal ruangan, memantau status persetujuan, dan menerima notifikasi terbaru.</p>
              </div>
            </div>

            <ul class="space-y-5 text-sm text-slate-200">
              <li class="flex gap-4">
                <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-slate-900/70 text-yellow-400 shadow-inner shadow-blue-900/40">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-6 w-6">
                    <rect x="3" y="4.5" width="18" height="16" rx="2.25" ry="2.25" />
                    <path d="M3 9.5h18" />
                    <path d="M8.5 3v3" />
                    <path d="M15.5 3v3" />
                    <circle cx="12" cy="13.5" r="2.5" />
                  </svg>
                </span>
                <div class="space-y-1">
                  <p class="text-base font-semibold text-white">Akses kalender peminjaman</p>
                  <p class="text-slate-400">Lihat ketersediaan ruangan secara real-time dan pilih slot yang sesuai.</p>
                </div>
              </li>
              <li class="flex gap-4">
                <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-slate-900/70 text-yellow-400 shadow-inner shadow-blue-900/40">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-6 w-6">
                    <path d="M18 8a6 6 0 1 0-12 0v4a6 6 0 0 0 12 0V8Z" />
                    <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                  </svg>
                </span>
                <div class="space-y-1">
                  <p class="text-base font-semibold text-white">Notifikasi otomatis</p>
                  <p class="text-slate-400">Dapatkan update instan saat peminjaman disetujui atau membutuhkan revisi.</p>
                </div>
              </li>
              <li class="flex gap-4">
                <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-slate-900/70 text-yellow-400 shadow-inner shadow-blue-900/40">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-6 w-6">
                    <path d="M5 7.5A2.5 2.5 0 0 1 7.5 5h9A2.5 2.5 0 0 1 19 7.5V18a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.5Z" />
                    <path d="M9 9.5h6" />
                    <path d="M9 13h6" />
                  </svg>
                </span>
                <div class="space-y-1">
                  <p class="text-base font-semibold text-white">Histori terarsip rapi</p>
                  <p class="text-slate-400">Pantau seluruh riwayat pengajuan dalam satu tempat untuk evaluasi berkala.</p>
                </div>
              </li>
            </ul>
          </div>

          <p class="text-xs text-slate-500">Dengan mendaftar, Anda menyetujui tata tertib penggunaan fasilitas Sekolah Palembang Harapan.</p>
        </div>

        <div class="space-y-6 rounded-2xl border border-white/10 bg-slate-950/55 p-8 shadow-lg shadow-black/20">
          <?php if(session('status')): ?>
            <div class="rounded-xl border border-blue-500/40 bg-blue-500/15 p-4 text-sm text-blue-100"><?php echo e(session('status')); ?></div>
          <?php endif; ?>

          <form id="register-form" action="<?php echo e(route('register')); ?>" method="POST" class="space-y-6" novalidate>
            <?php echo csrf_field(); ?>
            <input type="hidden" id="role" name="role" value="peminjam">

            <div>
              <label for="name" class="block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Nama Lengkap</label>
              <input id="name" name="name" type="text" autocomplete="name" required value="<?php echo e(old('name')); ?>" placeholder="Nama lengkap"
                     class="mt-2 w-full rounded-xl border px-4 py-3 text-sm text-white placeholder-slate-400 shadow-inner shadow-slate-900/40 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/60 <?php echo e($errors->has('name') ? 'border-rose-400 bg-rose-500/20' : 'border-white/10 bg-slate-900/70'); ?>">
              <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="mt-2 text-xs text-rose-300"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
              <label for="email" class="block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Alamat Email</label>
              <input id="email" name="email" type="email" inputmode="email" autocomplete="email" required value="<?php echo e(old('email')); ?>" placeholder="nama@sekolah.sch.id"
                     class="mt-2 w-full rounded-xl border px-4 py-3 text-sm text-white placeholder-slate-400 shadow-inner shadow-slate-900/40 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/60 <?php echo e($errors->has('email') ? 'border-rose-400 bg-rose-500/20' : 'border-white/10 bg-slate-900/70'); ?>">
              <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="mt-2 text-xs text-rose-300"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
              <div class="flex items-center justify-between">
                <label for="password" class="block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Kata Sandi</label>
                <button type="button" id="togglePassword" class="flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400 transition hover:text-white" aria-pressed="false">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-4 w-4">
                    <path d="M1.5 12s4-7 10.5-7 10.5 7 10.5 7-4 7-10.5 7S1.5 12 1.5 12Z" />
                    <circle cx="12" cy="12" r="2.5" />
                  </svg>
                  <span>Tampilkan</span>
                </button>
              </div>
              <input id="password" name="password" type="password" autocomplete="new-password" required placeholder="••••••••"
                     class="mt-2 w-full rounded-xl border px-4 py-3 text-sm text-white placeholder-slate-400 shadow-inner shadow-slate-900/40 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/60 <?php echo e($errors->has('password') ? 'border-rose-400 bg-rose-500/20' : 'border-white/10 bg-slate-900/70'); ?>">
              <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="mt-2 text-xs text-rose-300"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
              <div class="flex items-center justify-between">
                <label for="password_confirmation" class="block text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Konfirmasi Kata Sandi</label>
                <button type="button" id="toggleConfirm" class="flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400 transition hover:text-white" aria-pressed="false">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-4 w-4">
                    <path d="M1.5 12s4-7 10.5-7 10.5 7 10.5 7-4 7-10.5 7S1.5 12 1.5 12Z" />
                    <circle cx="12" cy="12" r="2.5" />
                  </svg>
                  <span>Tampilkan</span>
                </button>
              </div>
              <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required placeholder="••••••••"
                     class="mt-2 w-full rounded-xl border px-4 py-3 text-sm text-white placeholder-slate-400 shadow-inner shadow-slate-900/40 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/60 <?php echo e($errors->has('password_confirmation') ? 'border-rose-400 bg-rose-500/20' : 'border-white/10 bg-slate-900/70'); ?>">
              <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="mt-2 text-xs text-rose-300"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <button type="submit" id="submit-btn"
                    class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-yellow-400 px-4 py-3 text-sm font-semibold text-slate-900 shadow-lg shadow-yellow-500/30 transition hover:bg-yellow-300 focus:outline-none focus:ring-4 focus:ring-yellow-400/40">
              Daftar Akun
            </button>

            <p class="text-center text-sm text-slate-300">Sudah punya akun? <a href="<?php echo e(route('login')); ?>" class="font-semibold text-yellow-400 hover:text-yellow-300">Masuk</a></p>
          </form>

          <div class="border-t border-white/10 pt-6 text-xs text-slate-500">
            © <?php echo e(date('Y')); ?> Sekolah Palembang Harapan · Sistem Peminjaman Ruangan
          </div>
        </div>
      </div>
    </div>
  </main>

  <script>
    // Toggle password visibility
    (function(){
      const t=document.getElementById('togglePassword');
      const p=document.getElementById('password');
      if(t&&p){
        const label=t.querySelector('span');
        t.addEventListener('click',()=>{
          const hidden=p.type==='password';
          p.type=hidden?'text':'password';
          t.setAttribute('aria-pressed',hidden.toString());
          if(label){label.textContent=hidden?'Sembunyikan':'Tampilkan';}
        });
      }
      const tc=document.getElementById('toggleConfirm');
      const pc=document.getElementById('password_confirmation');
      if(tc&&pc){
        const label=tc.querySelector('span');
        tc.addEventListener('click',()=>{
          const hidden=pc.type==='password';
          pc.type=hidden?'text':'password';
          tc.setAttribute('aria-pressed',hidden.toString());
          if(label){label.textContent=hidden?'Sembunyikan':'Tampilkan';}
        });
      }
    })();
  </script>
</body>
</html><?php /**PATH E:\Semester 4\ENG\ALP\Booking-Ruangan\resources\views/auth/register.blade.php ENDPATH**/ ?>