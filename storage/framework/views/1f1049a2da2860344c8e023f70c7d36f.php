<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Dashboard Pengguna'); ?> - Sistem Peminjaman Ruangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        window.tailwind.config = {
            darkMode: 'class',
        }
    </script>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <style>
        body{font-family:'Inter',sans-serif;}

        input:not([type='checkbox']):not([type='radio']):not([type='range']):not([type='color']):not([type='file']),
        select,
        textarea{
            border-radius:16px;
            border:1px solid rgba(71,85,105,.75);
            background-color:rgba(15,23,42,.82)!important;
            color:#f8fafc!important;
            padding:0.75rem 1rem;
            font-size:0.95rem;
            line-height:1.4;
            box-shadow:inset 0 0 0 1px rgba(15,23,42,.25),inset 0 20px 48px rgba(15,23,42,.35);
            backdrop-filter:blur(4px);
            transition:border-color .18s ease,box-shadow .18s ease,background-color .18s ease;
        }

        input:not([type='checkbox']):not([type='radio']):not([type='range']):not([type='color']):not([type='file']):focus,
        select:focus,
        textarea:focus{
            border-color:rgba(250,204,21,.75);
            background-color:rgba(15,23,42,.9);
            box-shadow:0 0 0 2px rgba(250,204,21,.25),inset 0 0 0 1px rgba(250,204,21,.2);
            outline:none;
        }

        input::placeholder,
        textarea::placeholder{
            color:#94a3b8!important;
        }

        select{
            padding-right:3rem;
            appearance:none;
            background-image:linear-gradient(45deg,transparent 50%,rgba(250,204,21,.65) 50%),linear-gradient(135deg,rgba(250,204,21,.65) 50%,transparent 50%),linear-gradient(to right,rgba(250,204,21,.4),rgba(250,204,21,.4));
            background-position:calc(100% - 20px) calc(1.2rem),calc(100% - 14px) calc(1.2rem),calc(100% - 2.5rem) .9rem;
            background-size:10px 10px,10px 10px,1px 1.6rem;
            background-repeat:no-repeat;
        }

        select option{
            background-color:#0f172a;
            color:#f8fafc;
        }

        input[type='checkbox'],
        input[type='radio']{
            background-color:rgba(15,23,42,.9)!important;
            border:1px solid rgba(71,85,105,.8);
            accent-color:rgba(250,204,21,.9);
        }

        input:-webkit-autofill,
        textarea:-webkit-autofill,
        select:-webkit-autofill{
            -webkit-text-fill-color:#f8fafc!important;
            box-shadow:0 0 0px 1000px rgba(15,23,42,.82) inset;
            border-radius:16px;
        }

        /* 2D Hero Animations - Bold & Eye-catching */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-60px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.85);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes pulse-glow {
            0%, 100% {
                box-shadow: 0 0 15px rgba(250, 204, 21, 0.4), 0 0 30px rgba(56, 189, 248, 0.15), inset 0 0 0 1px rgba(255, 255, 255, 0.08);
            }
            50% {
                box-shadow: 0 0 35px rgba(250, 204, 21, 0.7), 0 0 60px rgba(56, 189, 248, 0.4), inset 0 0 0 1px rgba(255, 255, 255, 0.15);
            }
        }

        @keyframes float-smooth {
            0%, 100% {
                transform: translateY(0px) translateX(0px);
                opacity: 0.6;
            }
            25% {
                transform: translateY(-20px) translateX(15px);
                opacity: 0.7;
            }
            50% {
                transform: translateY(-40px) translateX(0px);
                opacity: 0.8;
            }
            75% {
                transform: translateY(-20px) translateX(-15px);
                opacity: 0.7;
            }
        }

        @keyframes shimmer-shine {
            0% {
                background-position: -1000px 0;
            }
            100% {
                background-position: 1000px 0;
            }
        }

        @keyframes smoothBounceIn {
            0% {
                opacity: 0;
                transform: scale(0.6) translateY(30px);
            }
            60% {
                opacity: 1;
                transform: scale(1.05);
            }
            80% {
                transform: scale(0.95);
            }
            100% {
                transform: scale(1) translateY(0);
            }
        }

        @keyframes gentleFloat {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-6px);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .animate-slide-in-down {
            animation: slideInDown 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .animate-slide-in-left {
            animation: slideInLeft 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .animate-scale-in {
            animation: scaleIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .animate-pulse-glow {
            animation: pulse-glow 2.5s ease-in-out infinite;
        }

        .animate-float {
            animation: float-smooth 6s ease-in-out infinite;
        }

        .hero-badge {
            display: inline-block;
            padding: 0.65rem 1.25rem;
            background: linear-gradient(135deg, rgba(250, 204, 21, 0.25), rgba(56, 189, 248, 0.15));
            border: 1.5px solid rgba(250, 204, 21, 0.5);
            border-radius: 999px;
            color: rgba(250, 204, 21, 1);
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            animation: slideInDown 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 0 20px rgba(250, 204, 21, 0.3);
        }

        .hero-stat-card {
            animation: smoothBounceIn 0.7s cubic-bezier(0.34, 1.26, 0.64, 1);
            animation-fill-mode: both;
            transform-origin: center;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease-out;
        }

        .hero-stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        .hero-stat-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.15) 50%, transparent 70%);
            animation: shimmer-shine 4s infinite;
            opacity: 0;
        }

        .hero-stat-card:hover::before {
            opacity: 1;
        }

        .hero-stat-card:nth-child(1) { animation-delay: 0.1s; }
        .hero-stat-card:nth-child(2) { animation-delay: 0.25s; }
        .hero-stat-card:nth-child(3) { animation-delay: 0.4s; }
        .hero-stat-card:nth-child(4) { animation-delay: 0.55s; }
    </style>
    <script>
        (() => {
            const storedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (storedTheme === 'dark' || (!storedTheme && prefersDark)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
</head>
<body class="bg-slate-100 dark:bg-slate-950 min-h-screen text-slate-900 dark:text-slate-100">
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
                    <button type="button" class="inline-flex items-center justify-center rounded-xl border border-slate-200 p-2 text-slate-600 transition hover:bg-slate-100 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 sm:hidden" data-mobile-nav-toggle aria-expanded="false" aria-label="Buka menu navigasi">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-5 w-5" data-mobile-nav-icon="open">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="hidden h-5 w-5" data-mobile-nav-icon="close">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <?php ($notificationActive = request()->routeIs('notifications.*')); ?>
                    <a href="<?php echo e(route('notifications.index')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'hidden sm:inline-flex items-center gap-2 rounded-xl px-4 py-2 transition relative',
                        'bg-slate-900 text-white hover:bg-slate-800' => $notificationActive,
                        'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' => !$notificationActive,
                    ]); ?>">
                        <span>Notifikasi</span>
                        <?php if(($headerUnreadNotifications ?? 0) > 0): ?>
                            <span class="absolute -top-2 -right-2 inline-flex h-5 min-w-5 items-center justify-center rounded-full bg-red-500 px-1 text-[11px] font-semibold text-white">
                                <?php echo e($headerUnreadNotifications > 99 ? '99+' : $headerUnreadNotifications); ?>

                            </span>
                        <?php endif; ?>
                    </a>
                    <?php ($calendarActive = request()->routeIs('bookings.calendar')); ?>
                    <a href="<?php echo e(route('bookings.calendar')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'hidden sm:inline-flex items-center gap-2 rounded-xl px-4 py-2 transition',
                        'bg-slate-900 text-white hover:bg-slate-800' => $calendarActive,
                        'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' => !$calendarActive,
                    ]); ?>">
                        <span>Kalender</span>
                    </a>
                    <?php ($historyActive = request()->routeIs('bookings.history')); ?>
                    <a href="<?php echo e(route('bookings.history')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'hidden sm:inline-flex items-center gap-2 rounded-xl px-4 py-2 transition',
                        'bg-slate-900 text-white hover:bg-slate-800' => $historyActive,
                        'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' => !$historyActive,
                    ]); ?>">
                        <span>Riwayat</span>
                    </a>
                    <?php ($roomManagerActive = request()->routeIs('room-manager.*')); ?>
                    <?php if(auth()->check() && auth()->user()->isRoomManager()): ?>
                        <a href="<?php echo e(route('room-manager.dashboard')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                            'hidden sm:inline-flex items-center gap-2 rounded-xl px-4 py-2 transition',
                            'bg-yellow-400 text-slate-950 hover:bg-yellow-300' => $roomManagerActive,
                            'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' => !$roomManagerActive,
                        ]); ?>">
                            <span>Kelola Ruangan</span>
                        </a>
                    <?php endif; ?>
                    <button type="button" data-darkmode-toggle class="hidden md:inline-flex items-center justify-center rounded-xl border border-slate-200 dark:border-slate-700 p-2 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition" aria-label="Toggle dark mode" aria-pressed="false">
                        <span class="sr-only">Toggle dark mode</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-5 w-5 dark:hidden">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-5 w-5 hidden dark:block">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1.5m0 15V21m9-9h-1.5m-15 0H3m15.364-6.364l-1.06 1.06M6.696 17.303l-1.06 1.06m0-12.728l1.06 1.06m11.668 11.668l1.06 1.06M12 8.25a3.75 3.75 0 100 7.5 3.75 3.75 0 000-7.5z" />
                        </svg>
                    </button>
                    <div class="h-6 w-px bg-slate-200 dark:bg-slate-700"></div>
                    <div class="hidden sm:flex flex-col text-right">
                        <span class="text-xs uppercase tracking-wide text-slate-400">Masuk sebagai</span>
                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-200"><?php echo e(auth()->user()->name ?? ''); ?></span>
                    </div>
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="inline-flex items-center rounded-xl bg-slate-900 px-4 py-2 text-white font-semibold hover:bg-slate-800 transition">Keluar</button>
                    </form>
                </div>
            </div>
        </div>
        <div id="mobile-nav" class="sm:hidden hidden border-t border-slate-200 bg-white shadow-lg dark:border-slate-800 dark:bg-slate-900">
            <div class="px-4 py-4 space-y-3 text-sm">
                <div class="flex flex-col gap-1 text-slate-500 dark:text-slate-400">
                    <span class="text-[11px] uppercase tracking-wide">Navigasi</span>
                </div>
                <a href="<?php echo e(route('notifications.index')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                    'flex items-center justify-between rounded-xl border px-4 py-3 font-semibold',
                    'border-slate-900 bg-slate-900 text-white' => $notificationActive,
                    'border-slate-200 text-slate-700 hover:bg-slate-100 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800' => !$notificationActive,
                ]); ?>">
                    <span>Notifikasi</span>
                    <?php if(($headerUnreadNotifications ?? 0) > 0): ?>
                        <span class="inline-flex h-5 min-w-5 items-center justify-center rounded-full bg-red-500 px-1 text-[11px] font-semibold text-white">
                            <?php echo e($headerUnreadNotifications > 99 ? '99+' : $headerUnreadNotifications); ?>

                        </span>
                    <?php endif; ?>
                </a>
                <a href="<?php echo e(route('bookings.calendar')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                    'flex items-center justify-between rounded-xl border px-4 py-3 font-semibold',
                    'border-slate-900 bg-slate-900 text-white' => $calendarActive,
                    'border-slate-200 text-slate-700 hover:bg-slate-100 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800' => !$calendarActive,
                ]); ?>">
                    <span>Kalender</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-4 w-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75l2.25 2.25L15 9.75" />
                    </svg>
                </a>
                <a href="<?php echo e(route('bookings.history')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                    'flex items-center justify-between rounded-xl border px-4 py-3 font-semibold',
                    'border-slate-900 bg-slate-900 text-white' => $historyActive,
                    'border-slate-200 text-slate-700 hover:bg-slate-100 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800' => !$historyActive,
                ]); ?>">
                    <span>Riwayat</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-4 w-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l3 3" />
                    </svg>
                </a>
                <?php if(auth()->check() && auth()->user()->isRoomManager()): ?>
                    <a href="<?php echo e(route('room-manager.dashboard')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'flex items-center justify-between rounded-xl border px-4 py-3 font-semibold',
                        'border-yellow-400 bg-yellow-400 text-slate-950' => $roomManagerActive,
                        'border-slate-200 text-slate-700 hover:bg-slate-100 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800' => !$roomManagerActive,
                    ]); ?>">
                        <span>Kelola Ruangan</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-4 w-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75l2.25 2.25L15 9.75" />
                        </svg>
                    </a>
                <?php endif; ?>
                <button type="button" data-darkmode-toggle class="flex w-full items-center justify-between rounded-xl border border-slate-200 px-4 py-3 font-semibold text-slate-700 hover:bg-slate-100 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800" aria-pressed="false">
                    <span>Mode Gelap</span>
                    <span class="flex items-center gap-2 text-xs" data-darkmode-state>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-4 w-4 dark:hidden">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="hidden h-4 w-4 dark:block">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1.5m0 15V21m9-9h-1.5m-15 0H3m15.364-6.364l-1.06 1.06M6.696 17.303l-1.06 1.06m0-12.728l1.06 1.06m11.668 11.668l1.06 1.06M12 8.25a3.75 3.75 0 100 7.5 3.75 3.75 0 000-7.5z" />
                        </svg>
                        <span data-darkmode-label>Off</span>
                    </span>
                </button>
                <div class="flex items-center justify-between rounded-xl border border-dashed border-slate-200 px-4 py-3 text-xs text-slate-500 dark:border-slate-700 dark:text-slate-400">
                    <span>Masuk sebagai</span>
                    <span class="font-semibold text-slate-700 dark:text-slate-200"><?php echo e(auth()->user()->name ?? ''); ?></span>
                </div>
            </div>
        </div>
    </header>

    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const darkModeToggles = document.querySelectorAll('[data-darkmode-toggle]');

            const setTheme = (isDark) => {
                document.documentElement.classList.toggle('dark', isDark);
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
                darkModeToggles.forEach((btn) => btn.setAttribute('aria-pressed', String(isDark)));
                document.querySelectorAll('[data-darkmode-label]').forEach((label) => {
                    label.textContent = isDark ? 'On' : 'Off';
                });
            };

            if (darkModeToggles.length > 0) {
                const storedTheme = localStorage.getItem('theme');
                const initialIsDark = storedTheme ? storedTheme === 'dark' : document.documentElement.classList.contains('dark');
                setTheme(initialIsDark);

                darkModeToggles.forEach((btn) => {
                    btn.addEventListener('click', () => {
                        const willBeDark = !document.documentElement.classList.contains('dark');
                        setTheme(willBeDark);
                    });
                });
            }

            const mobileToggle = document.querySelector('[data-mobile-nav-toggle]');
            const mobilePanel = document.getElementById('mobile-nav');

            if (mobileToggle && mobilePanel) {
                const openIcon = mobileToggle.querySelector('[data-mobile-nav-icon="open"]');
                const closeIcon = mobileToggle.querySelector('[data-mobile-nav-icon="close"]');

                const setMobileMenu = (open) => {
                    if (open) {
                        mobilePanel.classList.remove('hidden');
                        mobileToggle.setAttribute('aria-expanded', 'true');
                        openIcon?.classList.add('hidden');
                        closeIcon?.classList.remove('hidden');
                    } else {
                        mobilePanel.classList.add('hidden');
                        mobileToggle.setAttribute('aria-expanded', 'false');
                        openIcon?.classList.remove('hidden');
                        closeIcon?.classList.add('hidden');
                    }
                };

                mobileToggle.addEventListener('click', () => {
                    const willOpen = mobilePanel.classList.contains('hidden');
                    setMobileMenu(willOpen);
                });

                document.addEventListener('click', (event) => {
                    if (!mobilePanel.contains(event.target) && !mobileToggle.contains(event.target)) {
                        if (!mobilePanel.classList.contains('hidden')) {
                            setMobileMenu(false);
                        }
                    }
                });

                document.addEventListener('keydown', (event) => {
                    if (event.key === 'Escape' && !mobilePanel.classList.contains('hidden')) {
                        setMobileMenu(false);
                    }
                });
            }
        });
    </script>
</body>
</html>
<?php /**PATH E:\Semester 4\ENG\ALP\Booking-Ruangan\resources\views/layouts/app.blade.php ENDPATH**/ ?>