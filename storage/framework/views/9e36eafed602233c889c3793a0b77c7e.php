<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Peminjaman Ruangan - Sekolah Palembang Harapan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-950 text-slate-100">
    
    <header class="bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-3">
                    <img src="https://static.wixstatic.com/media/07639e_83549958900b44ad9fea05d99e380dd5~mv2.png/v1/fill/w_559,h_512,al_c/07639e_83549958900b44ad9fea05d99e380dd5~mv2.png" alt="Logo Sekolah Palembang Harapan" class="h-10 w-10 rounded-xl border border-slate-200 bg-white object-cover p-1 dark:border-slate-700 dark:bg-slate-900" loading="lazy">
                    <div>
                        <p class="text-sm font-semibold text-slate-900 dark:text-white">Peminjaman Ruangan</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Sekolah Palembang Harapan</p>
                    </div>
                </div>

                <div class="flex items-center gap-3 text-sm">
                    <a href="<?php echo e(route('login')); ?>" class="hidden sm:inline-flex items-center rounded-xl border border-slate-200 px-4 py-2 text-slate-600 dark:border-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition">Masuk</a>
                    <a href="<?php echo e(route('register')); ?>" class="inline-flex items-center rounded-xl bg-blue-600 px-4 py-2 text-white font-semibold hover:bg-blue-700 transition shadow-lg shadow-blue-500/30">Daftar</a>
                </div>
            </div>
        </div>
    </header>

    <section class="relative overflow-hidden bg-linear-to-b from-slate-950 via-slate-900 to-slate-950/80 py-20">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_50%,rgba(59,130,246,0.08),transparent_50%)]"></div>
        <div class="relative mx-auto max-w-6xl px-6 text-center">
            <div class="mb-4">
                <span class="inline-flex items-center justify-center rounded-full border border-blue-500/20 bg-blue-500/10 px-4 py-1.5 text-xs font-bold uppercase tracking-[0.35em] text-blue-300">Sistem Terpadu</span>
            </div>
            <h2 class="text-5xl font-extrabold leading-tight text-white lg:text-6xl">
                Kelola Peminjaman Ruangan<br><span class="bg-linear-to-r from-blue-400 to-blue-600 bg-clip-text text-transparent">Lebih Praktis</span>
            </h2>
            <p class="mx-auto mt-6 max-w-2xl text-lg leading-relaxed text-slate-300">Platform modern untuk mengelola jadwal peminjaman ruangan di lingkungan Sekolah Palembang Harapan. Proses cepat, transparan, dan terintegrasi.</p>
            <div class="mt-10 flex flex-wrap items-center justify-center gap-4">
                <a href="<?php echo e(route('register')); ?>" class="rounded-xl bg-blue-500 px-8 py-3.5 text-base font-bold text-white shadow-lg shadow-blue-500/30 transition hover:bg-blue-600 hover:shadow-blue-500/50">Mulai Sekarang</a>
                <a href="<?php echo e(route('login')); ?>" class="rounded-xl border border-white/20 bg-white/5 px-8 py-3.5 text-base font-bold text-white backdrop-blur transition hover:bg-white/10">Lihat Detail</a>
            </div>
        </div>
    </section>

    <section class="border-b border-white/5 bg-slate-950 py-12">
        <div class="mx-auto max-w-6xl px-6">
            <div class="grid gap-6 sm:grid-cols-3">
                <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-sm p-8 text-center shadow-xl">
                    <div class="text-4xl font-extrabold text-blue-400"><?php echo e($stats['rooms'] ?? 0); ?></div>
                    <div class="mt-2 text-xs uppercase tracking-[0.35em] text-slate-400">Ruangan Aktif</div>
                </div>
                <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-sm p-8 text-center shadow-xl">
                    <div class="text-4xl font-extrabold text-blue-400"><?php echo e($stats['bookings'] ?? 0); ?></div>
                    <div class="mt-2 text-xs uppercase tracking-[0.35em] text-slate-400">Total Peminjaman</div>
                </div>
                <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-sm p-8 text-center shadow-xl">
                    <div class="text-4xl font-extrabold text-blue-400"><?php echo e($stats['room_types'] ?? 0); ?></div>
                    <div class="mt-2 text-xs uppercase tracking-[0.35em] text-slate-400">Tipe Ruangan</div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-slate-950 py-20">
        <div class="mx-auto max-w-6xl px-6">
            <div class="mb-12 text-center">
                <span class="inline-flex items-center justify-center rounded-full border border-blue-500/20 bg-blue-500/10 px-4 py-1.5 text-xs font-bold uppercase tracking-[0.35em] text-blue-300">Fitur Unggulan</span>
                <h2 class="mt-4 text-4xl font-bold text-white">Dirancang untuk Kemudahan</h2>
                <p class="mt-3 text-lg text-slate-300">Sistem lengkap dengan dashboard untuk setiap peran pengguna</p>
            </div>
            <div class="grid gap-8 md:grid-cols-3">
                <article class="group rounded-3xl border border-white/10 bg-white/5 backdrop-blur-sm p-8 shadow-xl transition hover:bg-white/10 hover:scale-105">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-500 shadow-lg shadow-blue-500/30">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-7 w-7 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white">Pemesanan Real-Time</h3>
                    <p class="mt-3 text-sm leading-relaxed text-slate-300">Cek ketersediaan ruangan secara langsung dan ajukan booking dalam hitungan detik.</p>
                </article>
                <article class="group rounded-3xl border border-white/10 bg-white/5 backdrop-blur-sm p-8 shadow-xl transition hover:bg-white/10 hover:scale-105">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-500 shadow-lg shadow-blue-500/30">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-7 w-7 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white">Approval Otomatis</h3>
                    <p class="mt-3 text-sm leading-relaxed text-slate-300">Sistem notifikasi terintegrasi untuk proses persetujuan yang cepat dan terstruktur.</p>
                </article>
                <article class="group rounded-3xl border border-white/10 bg-white/5 backdrop-blur-sm p-8 shadow-xl transition hover:bg-white/10 hover:scale-105">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-500 shadow-lg shadow-blue-500/30">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-7 w-7 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white">Rekap Laporan Lengkap</h3>
                    <p class="mt-3 text-sm leading-relaxed text-slate-300">Export laporan pemakaian ruangan ke PDF atau Excel untuk rapat evaluasi bulanan.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="border-t border-white/5 bg-black/20 py-20">
        <div class="mx-auto max-w-6xl px-6">
            <div class="mb-12 flex flex-col items-center gap-4 text-center lg:flex-row lg:items-start lg:text-left">
                <div class="flex-1">
                    <span class="inline-flex items-center justify-center rounded-full bg-blue-500 px-5 py-2 text-xs font-bold uppercase tracking-[0.35em] text-white shadow-lg shadow-blue-500/30">Ruangan Favorit</span>
                    <h2 class="mt-4 text-4xl font-bold text-white">Contoh ruangan aktif yang siap dijadwalkan.</h2>
                    <p class="mt-3 text-lg text-slate-300">Daftar di bawah diambil langsung dari database. Masuk untuk melihat ketersediaan berdasarkan tanggal dan jam yang Anda butuhkan.</p>
                </div>
            </div>
            <div class="grid gap-6 sm:grid-cols-2">
                <?php $__empty_1 = true; $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-sm p-6 shadow-xl hover:bg-white/10 transition">
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-400 font-semibold"><?php echo e($room->type ?? 'Ruangan'); ?></p>
                        <h3 class="mt-2 text-xl font-bold text-white"><?php echo e($room->name); ?></h3>
                        <dl class="mt-4 space-y-2 text-sm text-slate-300">
                            <?php if(!empty($room->capacity)): ?>
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4 text-blue-400">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                    </svg>
                                    <span>Kapasitas <?php echo e($room->capacity); ?> orang</span>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($room->location)): ?>
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4 text-blue-400">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.5-7.5 11.25-7.5 11.25S4.5 18 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>
                                    <span><?php echo e($room->location); ?></span>
                                </div>
                            <?php endif; ?>
                        </dl>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-span-2 rounded-3xl border border-dashed border-white/20 bg-white/5 backdrop-blur p-8 text-center text-sm text-slate-400">
                        Belum ada data ruangan aktif. Admin dapat menambahkan dari panel Admin &gt; Ruangan.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="bg-linear-to-br from-blue-600 via-blue-500 to-blue-400 py-16">
        <div class="mx-auto max-w-4xl px-6 text-center">
            <h2 class="text-3xl font-extrabold text-white lg:text-4xl">Siap Merasakan Kemudahan Peminjaman Ruangan?</h2>
            <p class="mt-4 text-lg text-blue-50">Daftar sekarang dan kelola jadwal peminjaman dengan lebih efisien.</p>
            <div class="mt-8">
                <a href="<?php echo e(route('register')); ?>" class="inline-flex items-center gap-2 rounded-xl bg-white px-8 py-3.5 text-base font-bold text-blue-600 shadow-2xl transition hover:bg-slate-50">
                    Buat Akun Gratis
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <footer class="border-t border-white/10 bg-slate-950 py-8">
        <div class="mx-auto max-w-6xl px-6">
            <div class="flex flex-col items-center justify-between gap-4 text-center sm:flex-row sm:text-left">
                <p class="text-sm text-slate-400">&copy; <?php echo e(date('Y')); ?> Sekolah Palembang Harapan. All rights reserved.</p>
                <div class="flex items-center gap-6">
                    <a href="#" class="text-sm text-slate-400 transition hover:text-white">Bantuan</a>
                    <a href="#" class="text-sm text-slate-400 transition hover:text-white">Kebijakan</a>
                    <a href="#" class="text-sm text-slate-400 transition hover:text-white">Kontak</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
<?php /**PATH E:\Semester 4\ENG\ALP\Booking-Ruangan\resources\views/landing.blade.php ENDPATH**/ ?>