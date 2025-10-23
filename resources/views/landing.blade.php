<!DOCTYPE html><!DOCTYPE html>

<html lang="id"><html lang="id">

<head><head>

    <meta charset="UTF-8">    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistem Peminjaman Ruangan Sekolah</title>    <title>Sistem Peminjaman Ruangan Sekolah</title>

    <script src="https://cdn.tailwindcss.com"></script>    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>    <style>

        body { font-family: 'Inter', sans-serif; }        body { font-family: 'Inter', sans-serif; }

        .bg-gradient-dark {        .bg-grid {

            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);            background-image: radial-gradient(circle at 1px 1px, rgba(0, 0, 0, 0.08) 1px, transparent 0);

        }            background-size: 32px 32px;

        .text-gradient {        }

            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);    </style>

            -webkit-background-clip: text;</head>

            -webkit-text-fill-color: transparent;<body class="bg-neutral-100 text-neutral-900">

            background-clip: text;    <div class="min-h-screen flex flex-col">

        }        <header class="relative bg-white/80 backdrop-blur">

    </style>            <div class="relative z-10">

</head>                <nav class="mx-auto flex max-w-6xl items-center justify-between gap-6 px-6 py-7">

<body class="bg-gradient-dark text-white">                    <div class="flex items-center gap-3">

    <div class="min-h-screen flex flex-col">                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-neutral-900 text-white text-lg font-semibold shadow-lg">

        <header class="relative backdrop-blur-sm bg-black/20">                            SR

            <div class="relative z-10">                        </div>

                <nav class="mx-auto flex max-w-6xl items-center justify-between gap-6 px-6 py-6">                        <div>

                    <div class="flex items-center gap-3">                            <p class="text-sm uppercase tracking-wide text-neutral-600 font-semibold">Sekolah Palembang Harapan</p>

                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 text-white text-lg font-bold shadow-lg">                            <h1 class="text-lg font-semibold text-neutral-900">Sistem Peminjaman Ruangan</h1>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">                        </div>

                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />                    </div>

                            </svg>                    <div class="flex items-center gap-3 text-sm">

                        </div>                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-xl border border-neutral-300 px-4 py-2 font-semibold text-neutral-800 transition hover:border-neutral-900 hover:text-neutral-900">Masuk</a>

                        <div>                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-xl bg-neutral-900 px-4 py-2 font-semibold text-white transition hover:bg-black">Daftar</a>

                            <h1 class="text-xl font-bold text-white">PinjamRuang<span class="text-gradient">SPH</span></h1>                    </div>

                        </div>                </nav>

                    </div>                <section class="relative mx-auto max-w-6xl px-6 pb-20 pt-10">

                    <div class="flex items-center gap-3 text-sm">                    <div class="grid gap-12 lg:grid-cols-[1.1fr_0.9fr]">

                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 px-5 py-2.5 font-semibold text-white transition hover:bg-white/20">Login</a>                        <div class="flex flex-col gap-8">

                    </div>                            <div class="inline-flex items-center gap-2 self-start rounded-full bg-neutral-900/5 px-4 py-2 text-sm font-medium text-neutral-700">

                </nav>                                <span class="h-2 w-2 rounded-full bg-neutral-900"></span>

                <section class="relative mx-auto max-w-6xl px-6 pb-20 pt-10">                                Pengajuan ruangan jadi transparan & cepat

                    <div class="text-center space-y-8">                            </div>

                        <div class="space-y-6">                            <div class="space-y-6">

                            <h2 class="text-5xl md:text-6xl font-extrabold leading-tight text-white">                                <h2 class="text-4xl font-bold leading-tight text-neutral-900 sm:text-5xl">

                                Peminjaman Ruangan Lebih Mudah                                    Atur peminjaman ruangan sekolah tanpa perlu spreadsheet.

                            </h2>                                </h2>

                            <h3 class="text-4xl md:text-5xl font-bold text-gradient">                                <p class="text-lg leading-relaxed text-neutral-600">

                                di Sekolah Palembang Harapan                                    Sistem terpusat untuk mengecek ketersediaan ruangan, mengajukan peminjaman, dan memantau status persetujuan secara real-time bagi peminjam, admin, dan kepala sekolah.

                            </h3>                                </p>

                            <p class="mx-auto max-w-3xl text-lg md:text-xl leading-relaxed text-gray-300">                            </div>

                                Ucapkan selamat tinggal pada proses manual. Cek ketersediaan ruangan secara real-time, ajukan peminjaman dengan cepat, dan hindari konflik jadwal.                            <div class="flex flex-wrap items-center gap-4 text-sm">

                            </p>                                <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-neutral-900 px-5 py-3 font-semibold text-white transition hover:bg-black">

                        </div>                                    Mulai Mengajukan

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">

                        <div class="flex flex-wrap justify-center items-center gap-4 text-sm">                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />

                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-500 to-purple-600 px-8 py-4 text-base font-bold text-white shadow-lg transition hover:shadow-xl hover:scale-105">                                    </svg>

                                Lihat Ketersediaan & Ajukan                                </a>

                            </a>                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 rounded-xl border border-neutral-300 px-5 py-3 font-semibold text-neutral-700 transition hover:border-neutral-900 hover:text-neutral-900">

                            <span class="inline-flex items-center gap-2 text-gray-300 bg-white/5 backdrop-blur-sm px-4 py-2 rounded-lg border border-white/10">                                    Daftar Akun Baru

                                Pelajari Lebih Lanjut                                </a>

                            </span>                                <span class="inline-flex items-center gap-2 text-neutral-500">

                        </div>                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-5 w-5 text-neutral-900">

                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />

                        <dl class="grid gap-5 sm:grid-cols-3 mt-12">                                    </svg>

                            <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm p-6 shadow-lg">                                    Persetujuan cepat & transparan

                                <dt class="text-xs uppercase tracking-wide text-gray-400">Ruangan Aktif</dt>                                </span>

                                <dd class="mt-2 text-4xl font-bold text-white">{{ number_format($stats['rooms']) }}</dd>                            </div>

                            </div>                            <dl class="grid gap-5 sm:grid-cols-3">

                            <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm p-6 shadow-lg">                                <div class="rounded-2xl border border-neutral-200 bg-white p-5 shadow-sm">

                                <dt class="text-xs uppercase tracking-wide text-gray-400">Total Pengajuan</dt>                                    <dt class="text-xs uppercase tracking-wide text-neutral-500">Ruangan Aktif</dt>

                                <dd class="mt-2 text-4xl font-bold text-white">{{ number_format($stats['bookings']) }}</dd>                                    <dd class="mt-2 text-3xl font-semibold text-neutral-900">{{ number_format($stats['rooms']) }}</dd>

                            </div>                                </div>

                            <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm p-6 shadow-lg">                                <div class="rounded-2xl border border-neutral-200 bg-white p-5 shadow-sm">

                                <dt class="text-xs uppercase tracking-wide text-gray-400">Jenis Ruangan</dt>                                    <dt class="text-xs uppercase tracking-wide text-neutral-500">Total Pengajuan</dt>

                                <dd class="mt-2 text-4xl font-bold text-white">{{ number_format($stats['room_types']) }}</dd>                                    <dd class="mt-2 text-3xl font-semibold text-neutral-900">{{ number_format($stats['bookings']) }}</dd>

                            </div>                                </div>

                        </dl>                                <div class="rounded-2xl border border-neutral-200 bg-white p-5 shadow-sm">

                    </div>                                    <dt class="text-xs uppercase tracking-wide text-neutral-500">Jenis Ruangan</dt>

                </section>                                    <dd class="mt-2 text-3xl font-semibold text-neutral-900">{{ number_format($stats['room_types']) }}</dd>

            </div>                                </div>

        </header>                            </dl>

                        </div>

        <main class="flex-1">                        <div class="relative hidden overflow-hidden rounded-[32px] border border-neutral-200 bg-white p-8 shadow-2xl lg:block">

            <section class="mx-auto max-w-6xl px-6 py-16">                            <div class="relative space-y-6 text-neutral-600">

                <div class="space-y-6 text-center">                                <div class="rounded-2xl border border-neutral-200 bg-white p-5 shadow-sm">

                    <span class="inline-flex items-center justify-center rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 px-5 py-2 text-xs font-bold uppercase tracking-wide text-white shadow-lg">Fitur Utama</span>                                    <p class="text-xs uppercase tracking-wide text-neutral-500">Langkah 1</p>

                    <h2 class="text-4xl font-bold text-white">Semua proses peminjaman terpantau dari satu tempat.</h2>                                    <h3 class="mt-1 text-lg font-semibold text-neutral-900">Cari ruangan yang tersedia</h3>

                    <p class="mx-auto max-w-2xl text-lg text-gray-300">Setiap peran mendapat tampilan khusus: peminjam, admin, kepala sekolah, hingga petugas kebersihan. Tidak ada lagi jadwal bertabrakan.</p>                                    <p class="mt-2 text-sm">Gunakan filter jenis ruangan, kapasitas, dan jadwal untuk menemukan slot kosong.</p>

                </div>                                </div>

                                <div class="rounded-2xl border border-neutral-200 bg-white p-5 shadow-sm">

                <div class="mt-12 grid gap-6 md:grid-cols-3">                                    <p class="text-xs uppercase tracking-wide text-neutral-500">Langkah 2</p>

                    <article class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm p-7 shadow-lg transition hover:bg-white/10 hover:scale-105">                                    <h3 class="mt-1 text-lg font-semibold text-neutral-900">Ajukan peminjaman dalam hitungan menit</h3>

                        <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 text-white shadow-lg">                                    <p class="mt-2 text-sm">Form digital membantu peminjam mengajukan kebutuhan lengkap beserta catatan.</p>

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-7 w-7">                                </div>

                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />                                <div class="rounded-2xl border border-neutral-200 bg-white p-5 shadow-sm">

                            </svg>                                    <p class="text-xs uppercase tracking-wide text-neutral-500">Langkah 3</p>

                        </div>                                    <h3 class="mt-1 text-lg font-semibold text-neutral-900">Dapatkan notifikasi status</h3>

                        <h3 class="text-xl font-bold text-white">Kalender & Monitoring Real-time</h3>                                    <p class="mt-2 text-sm">Admin dan kepala sekolah memberi keputusan, peminjam menerima email notifikasi otomatis.</p>

                        <p class="mt-3 text-sm leading-relaxed text-gray-300">Pantau setiap jadwal penggunaan ruangan beserta status persetujuan tanpa perlu mencocokkan manual.</p>                                </div>

                    </article>                            </div>

                    <article class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm p-7 shadow-lg transition hover:bg-white/10 hover:scale-105">                        </div>

                        <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 text-white shadow-lg">                    </div>

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-7 w-7">                </section>

                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />            </div>

                            </svg>        </header>

                        </div>

                        <h3 class="text-xl font-bold text-white">Approval Multi Peran & Notifikasi Email</h3>        <main class="flex-1">

                        <p class="mt-3 text-sm leading-relaxed text-gray-300">Admin dan kepala sekolah menyetujui permintaan, pemohon menerima notifikasi otomatis via email.</p>            <section class="mx-auto max-w-6xl px-6 py-16">

                    </article>                <div class="space-y-6 text-center">

                    <article class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm p-7 shadow-lg transition hover:bg-white/10 hover:scale-105">                    <span class="inline-flex items-center justify-center rounded-full bg-neutral-900 px-4 py-1 text-xs font-semibold uppercase tracking-wide text-white">Fitur Utama</span>

                        <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 text-white shadow-lg">                    <h2 class="text-3xl font-semibold text-neutral-900">Semua proses peminjaman terpantau dari satu tempat.</h2>

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-7 w-7">                    <p class="mx-auto max-w-2xl text-base text-neutral-600">Setiap peran mendapat tampilan khusus: peminjam, admin, kepala sekolah, hingga petugas kebersihan. Tidak ada lagi jadwal bertabrakan.</p>

                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />                </div>

                            </svg>

                        </div>                <div class="mt-12 grid gap-6 md:grid-cols-3">

                        <h3 class="text-xl font-bold text-white">Rekap Laporan Lengkap</h3>                    <article class="rounded-2xl border border-neutral-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">

                        <p class="mt-3 text-sm leading-relaxed text-gray-300">Export laporan pemakaian ruangan ke PDF atau Excel untuk rapat evaluasi bulanan.</p>                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-neutral-900/5 text-neutral-900">

                    </article>                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-6 w-6">

                </div>                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h18M3 9h18M3 15h18M3 19.5h18" />

            </section>                            </svg>

                        </div>

            <section class="py-16 bg-black/20">                        <h3 class="text-lg font-semibold text-neutral-900">Kalender & monitoring real-time</h3>

                <div class="mx-auto max-w-6xl px-6">                        <p class="mt-2 text-sm leading-relaxed text-neutral-600">Pantau setiap jadwal penggunaan ruangan beserta status persetujuan tanpa perlu mencocokkan manual.</p>

                    <div class="flex flex-col gap-10 lg:flex-row lg:items-start">                    </article>

                        <div class="flex-1 space-y-4">                    <article class="rounded-2xl border border-neutral-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">

                            <span class="inline-flex items-center justify-center rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 px-5 py-2 text-xs font-bold uppercase tracking-wide text-white shadow-lg">Ruangan Favorit</span>                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-neutral-900/5 text-neutral-900">

                            <h2 class="text-4xl font-bold text-white">Contoh ruangan aktif yang siap dijadwalkan.</h2>                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-6 w-6">

                            <p class="text-lg text-gray-300">Daftar di bawah diambil langsung dari database. Masuk untuk melihat ketersediaan berdasarkan tanggal dan jam yang Anda butuhkan.</p>                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75l2.25 2.25L15 9.75" />

                        </div>                            </svg>

                        <div class="flex-1">                        </div>

                            <div class="grid gap-4 sm:grid-cols-2">                        <h3 class="text-lg font-semibold text-neutral-900">Approval multi peran & notifikasi email</h3>

                                @forelse ($rooms as $room)                        <p class="mt-2 text-sm leading-relaxed text-neutral-600">Admin dan kepala sekolah menyetujui permintaan, pemohon menerima notifikasi otomatis via EmailJS.</p>

                                    <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm p-6 shadow-lg hover:bg-white/10 transition">                    </article>

                                        <p class="text-xs uppercase tracking-wide text-gray-400">{{ $room->type ?? 'Ruangan' }}</p>                    <article class="rounded-2xl border border-neutral-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">

                                        <h3 class="mt-2 text-xl font-bold text-white">{{ $room->name }}</h3>                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-neutral-900/5 text-neutral-900">

                                        <dl class="mt-4 space-y-2 text-sm text-gray-300">                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-6 w-6">

                                            @if(!empty($room->location))                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.375 6.75l7.5-3 7.5 3m-15 0l7.5 3m-7.5-3v10.5l7.5 3m0-10.5l7.5-3m-7.5 3v10.5m7.5-13.5v10.5l-7.5 3" />

                                                <div class="flex items-center gap-2">                            </svg>

                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4 text-indigo-400">                        </div>

                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />                        <h3 class="text-lg font-semibold text-neutral-900">Rekap laporan lengkap</h3>

                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.5-7.5 11.25-7.5 11.25S4.5 18 4.5 10.5a7.5 7.5 0 1115 0z" />                        <p class="mt-2 text-sm leading-relaxed text-neutral-600">Export laporan pemakaian ruangan ke PDF atau Excel untuk rapat evaluasi bulanan.</p>

                                                    </svg>                    </article>

                                                    <span>{{ $room->location }}</span>                </div>

                                                </div>            </section>

                                            @endif

                                            <div class="flex items-center gap-2">            <section class="bg-grid bg-white py-16">

                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4 text-indigo-400">                <div class="mx-auto max-w-6xl px-6">

                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />                    <div class="flex flex-col gap-10 lg:flex-row lg:items-start">

                                                </svg>                        <div class="flex-1 space-y-4">

                                                <span>Kapasitas {{ $room->capacity ?? '—' }} orang</span>                            <span class="inline-flex items-center justify-center rounded-full bg-neutral-900 px-4 py-1 text-xs font-semibold uppercase tracking-wide text-white">Ruangan Favorit</span>

                                            </div>                            <h2 class="text-3xl font-semibold text-neutral-900">Contoh ruangan aktif yang siap dijadwalkan.</h2>

                                        </dl>                            <p class="text-base text-neutral-600">Daftar di bawah diambil langsung dari database. Masuk untuk melihat ketersediaan berdasarkan tanggal dan jam yang Anda butuhkan.</p>

                                    </div>                        </div>

                                @empty                        <div class="flex-1">

                                    <div class="col-span-2 rounded-2xl border border-dashed border-white/20 bg-white/5 backdrop-blur-sm p-8 text-center text-sm text-gray-400">                            <div class="grid gap-4 sm:grid-cols-2">

                                        Belum ada data ruangan aktif. Admin dapat menambahkan dari panel Admin &gt; Ruangan.                                @forelse ($rooms as $room)

                                    </div>                                    <div class="rounded-2xl border border-neutral-200 bg-white p-5 shadow-sm">

                                @endforelse                                        <p class="text-xs uppercase tracking-wide text-neutral-500">{{ $room->type ?? 'Ruangan' }}</p>

                            </div>                                        <h3 class="mt-1 text-lg font-semibold text-neutral-900">{{ $room->name }}</h3>

                        </div>                                        <dl class="mt-4 space-y-1 text-sm text-neutral-600">

                    </div>                                            @if(!empty($room->location))

                </div>                                                <div class="flex items-center gap-2">

            </section>                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-4 w-4 text-neutral-900">

                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />

            <section class="mx-auto max-w-6xl px-6 py-16">                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.5-7.5 11.25-7.5 11.25S4.5 18 4.5 10.5a7.5 7.5 0 1115 0z" />

                <div class="rounded-[32px] bg-gradient-to-r from-indigo-600 to-purple-700 px-10 py-16 text-center text-white shadow-2xl">                                                    </svg>

                    <h2 class="text-4xl font-bold">Siap memulai peminjaman ruangan yang lebih rapi?</h2>                                                    <span>{{ $room->location }}</span>

                    <p class="mx-auto mt-4 max-w-2xl text-lg text-white/90">Masuk untuk melihat kalender ketersediaan, ajukan jadwal, dan terima pembaruan status melalui email otomatis.</p>                                                </div>

                    <div class="mt-8 flex flex-wrap justify-center gap-4">                                            @endif

                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-xl bg-white px-8 py-4 text-base font-bold text-indigo-600 shadow-lg transition hover:bg-gray-100 hover:scale-105">                                            <div class="flex items-center gap-2">

                            Masuk ke Sistem                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-4 w-4 text-neutral-900">

                        </a>                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h7.5m-7.5 4.5h7.5m-7.5 4.5h7.5M5.25 6v12a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0016.5 3.75h-9A2.25 2.25 0 005.25 6z" />

                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-xl border-2 border-white/60 px-8 py-4 text-base font-bold text-white transition hover:border-white hover:bg-white/10">                                                </svg>

                            Buat Akun Baru                                                <span>Kapasitas {{ $room->capacity ?? '—' }} orang</span>

                        </a>                                            </div>

                    </div>                                        </dl>

                </div>                                    </div>

            </section>                                @empty

        </main>                                    <div class="col-span-2 rounded-2xl border border-dashed border-neutral-300 bg-white p-6 text-center text-sm text-neutral-500">

                                        Belum ada data ruangan aktif. Admin dapat menambahkan dari panel Admin &gt; Ruangan.

        <footer class="border-t border-white/10 bg-black/30 py-8">                                    </div>

            <div class="mx-auto flex max-w-6xl flex-col items-center gap-3 px-6 text-sm text-gray-400 md:flex-row md:justify-between">                                @endforelse

                <div class="flex items-center gap-2">                            </div>

                    <span>&copy; {{ now()->year }} Sekolah Palembang Harapan. Sistem Peminjaman Ruangan.</span>                        </div>

                </div>                    </div>

                <div class="flex flex-wrap justify-center gap-4">                </div>

                    <a href="mailto:it-support@sph.sch.id" class="hover:text-white transition">Kontak IT Support</a>            </section>

                    <a href="{{ route('login') }}" class="hover:text-white transition">Masuk Admin</a>

                </div>            <section class="mx-auto max-w-6xl px-6 py-16">

            </div>                <div class="rounded-[32px] bg-neutral-900 px-10 py-12 text-center text-white">

        </footer>                    <h2 class="text-3xl font-semibold">Siap memulai peminjaman ruangan yang lebih rapi?</h2>

    </div>                    <p class="mx-auto mt-3 max-w-2xl text-base text-neutral-300">Masuk untuk melihat kalender ketersediaan, ajukan jadwal, dan terima pembaruan status melalui email otomatis.</p>

</body>                    <div class="mt-6 flex flex-wrap justify-center gap-4">

</html>                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-xl bg-white px-6 py-3 text-base font-semibold text-neutral-900 transition hover:bg-neutral-200">

                            Masuk ke Sistem
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-xl border border-white/40 px-6 py-3 text-base font-semibold text-white transition hover:border-white hover:bg-white/10">
                            Buat Akun Baru
                        </a>
                    </div>
                </div>
            </section>
        </main>

        <footer class="border-t border-neutral-200 bg-white py-8">
            <div class="mx-auto flex max-w-6xl flex-col items-center gap-3 px-6 text-sm text-neutral-500 md:flex-row md:justify-between">
                <div class="flex items-center gap-2">
                    <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-neutral-900 text-white text-sm font-semibold">SR</div>
                    <span>&copy; {{ now()->year }} Sekolah Palembang Harapan. Semua hak dilindungi.</span>
                </div>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="mailto:it-support@sph.sch.id" class="hover:text-neutral-900">Kontak IT Support</a>
                    <a href="{{ route('login') }}" class="hover:text-neutral-900">Masuk Admin</a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
