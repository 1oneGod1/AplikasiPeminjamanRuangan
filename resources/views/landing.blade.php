<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Peminjaman Ruangan Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .bg-grid {
            background-image: radial-gradient(circle at 1px 1px, rgba(0, 0, 0, 0.08) 1px, transparent 0);
            background-size: 32px 32px;
        }
    </style>
</head>
<body class="bg-neutral-100 text-neutral-900">
    <div class="min-h-screen flex flex-col">
        <header class="relative bg-white/80 backdrop-blur">
            <div class="relative z-10">
                <nav class="mx-auto flex max-w-6xl items-center justify-between gap-6 px-6 py-7">
                    <div class="flex items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-neutral-900 text-white text-lg font-semibold shadow-lg">
                            SR
                        </div>
                        <div>
                            <p class="text-sm uppercase tracking-wide text-neutral-600 font-semibold">Sekolah Palembang Harapan</p>
                            <h1 class="text-lg font-semibold text-neutral-900">Sistem Peminjaman Ruangan</h1>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 text-sm">
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-xl border border-neutral-300 px-4 py-2 font-semibold text-neutral-800 transition hover:border-neutral-900 hover:text-neutral-900">Masuk</a>
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-xl bg-neutral-900 px-4 py-2 font-semibold text-white transition hover:bg-black">Daftar</a>
                    </div>
                </nav>
                <section class="relative mx-auto max-w-6xl px-6 pb-20 pt-10">
                    <div class="grid gap-12 lg:grid-cols-[1.1fr_0.9fr]">
                        <div class="flex flex-col gap-8">
                            <div class="inline-flex items-center gap-2 self-start rounded-full bg-neutral-900/5 px-4 py-2 text-sm font-medium text-neutral-700">
                                <span class="h-2 w-2 rounded-full bg-neutral-900"></span>
                                Pengajuan ruangan jadi transparan & cepat
                            </div>
                            <div class="space-y-6">
                                <h2 class="text-4xl font-bold leading-tight text-neutral-900 sm:text-5xl">
                                    Atur peminjaman ruangan sekolah tanpa perlu spreadsheet.
                                </h2>
                                <p class="text-lg leading-relaxed text-neutral-600">
                                    Sistem terpusat untuk mengecek ketersediaan ruangan, mengajukan peminjaman, dan memantau status persetujuan secara real-time bagi peminjam, admin, dan kepala sekolah.
                                </p>
                            </div>
                            <div class="flex flex-wrap items-center gap-4 text-sm">
                                <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-neutral-900 px-5 py-3 font-semibold text-white transition hover:bg-black">
                                    Mulai Mengajukan
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                                    </svg>
                                </a>
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 rounded-xl border border-neutral-300 px-5 py-3 font-semibold text-neutral-700 transition hover:border-neutral-900 hover:text-neutral-900">
                                    Daftar Akun Baru
                                </a>
                                <span class="inline-flex items-center gap-2 text-neutral-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-5 w-5 text-neutral-900">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                    Persetujuan cepat & transparan
                                </span>
                            </div>
                            <dl class="grid gap-5 sm:grid-cols-3">
                                <div class="rounded-2xl border border-neutral-200 bg-white p-5 shadow-sm">
                                    <dt class="text-xs uppercase tracking-wide text-neutral-500">Ruangan Aktif</dt>
                                    <dd class="mt-2 text-3xl font-semibold text-neutral-900">{{ number_format($stats['rooms']) }}</dd>
                                </div>
                                <div class="rounded-2xl border border-neutral-200 bg-white p-5 shadow-sm">
                                    <dt class="text-xs uppercase tracking-wide text-neutral-500">Total Pengajuan</dt>
                                    <dd class="mt-2 text-3xl font-semibold text-neutral-900">{{ number_format($stats['bookings']) }}</dd>
                                </div>
                                <div class="rounded-2xl border border-neutral-200 bg-white p-5 shadow-sm">
                                    <dt class="text-xs uppercase tracking-wide text-neutral-500">Jenis Ruangan</dt>
                                    <dd class="mt-2 text-3xl font-semibold text-neutral-900">{{ number_format($stats['room_types']) }}</dd>
                                </div>
                            </dl>
                        </div>
                        <div class="relative hidden overflow-hidden rounded-[32px] border border-neutral-200 bg-white p-8 shadow-2xl lg:block">
                            <div class="relative space-y-6 text-neutral-600">
                                <div class="rounded-2xl border border-neutral-200 bg-white p-5 shadow-sm">
                                    <p class="text-xs uppercase tracking-wide text-neutral-500">Langkah 1</p>
                                    <h3 class="mt-1 text-lg font-semibold text-neutral-900">Cari ruangan yang tersedia</h3>
                                    <p class="mt-2 text-sm">Gunakan filter jenis ruangan, kapasitas, dan jadwal untuk menemukan slot kosong.</p>
                                </div>
                                <div class="rounded-2xl border border-neutral-200 bg-white p-5 shadow-sm">
                                    <p class="text-xs uppercase tracking-wide text-neutral-500">Langkah 2</p>
                                    <h3 class="mt-1 text-lg font-semibold text-neutral-900">Ajukan peminjaman dalam hitungan menit</h3>
                                    <p class="mt-2 text-sm">Form digital membantu peminjam mengajukan kebutuhan lengkap beserta catatan.</p>
                                </div>
                                <div class="rounded-2xl border border-neutral-200 bg-white p-5 shadow-sm">
                                    <p class="text-xs uppercase tracking-wide text-neutral-500">Langkah 3</p>
                                    <h3 class="mt-1 text-lg font-semibold text-neutral-900">Dapatkan notifikasi status</h3>
                                    <p class="mt-2 text-sm">Admin dan kepala sekolah memberi keputusan, peminjam menerima email notifikasi otomatis.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </header>

        <main class="flex-1">
            <section class="mx-auto max-w-6xl px-6 py-16">
                <div class="space-y-6 text-center">
                    <span class="inline-flex items-center justify-center rounded-full bg-neutral-900 px-4 py-1 text-xs font-semibold uppercase tracking-wide text-white">Fitur Utama</span>
                    <h2 class="text-3xl font-semibold text-neutral-900">Semua proses peminjaman terpantau dari satu tempat.</h2>
                    <p class="mx-auto max-w-2xl text-base text-neutral-600">Setiap peran mendapat tampilan khusus: peminjam, admin, kepala sekolah, hingga petugas kebersihan. Tidak ada lagi jadwal bertabrakan.</p>
                </div>

                <div class="mt-12 grid gap-6 md:grid-cols-3">
                    <article class="rounded-2xl border border-neutral-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-neutral-900/5 text-neutral-900">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h18M3 9h18M3 15h18M3 19.5h18" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-neutral-900">Kalender & monitoring real-time</h3>
                        <p class="mt-2 text-sm leading-relaxed text-neutral-600">Pantau setiap jadwal penggunaan ruangan beserta status persetujuan tanpa perlu mencocokkan manual.</p>
                    </article>
                    <article class="rounded-2xl border border-neutral-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-neutral-900/5 text-neutral-900">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75l2.25 2.25L15 9.75" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-neutral-900">Approval multi peran & notifikasi email</h3>
                        <p class="mt-2 text-sm leading-relaxed text-neutral-600">Admin dan kepala sekolah menyetujui permintaan, pemohon menerima notifikasi otomatis via EmailJS.</p>
                    </article>
                    <article class="rounded-2xl border border-neutral-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-neutral-900/5 text-neutral-900">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.375 6.75l7.5-3 7.5 3m-15 0l7.5 3m-7.5-3v10.5l7.5 3m0-10.5l7.5-3m-7.5 3v10.5m7.5-13.5v10.5l-7.5 3" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-neutral-900">Rekap laporan lengkap</h3>
                        <p class="mt-2 text-sm leading-relaxed text-neutral-600">Export laporan pemakaian ruangan ke PDF atau Excel untuk rapat evaluasi bulanan.</p>
                    </article>
                </div>
            </section>

            <section class="bg-grid bg-white py-16">
                <div class="mx-auto max-w-6xl px-6">
                    <div class="flex flex-col gap-10 lg:flex-row lg:items-start">
                        <div class="flex-1 space-y-4">
                            <span class="inline-flex items-center justify-center rounded-full bg-neutral-900 px-4 py-1 text-xs font-semibold uppercase tracking-wide text-white">Ruangan Favorit</span>
                            <h2 class="text-3xl font-semibold text-neutral-900">Contoh ruangan aktif yang siap dijadwalkan.</h2>
                            <p class="text-base text-neutral-600">Daftar di bawah diambil langsung dari database. Masuk untuk melihat ketersediaan berdasarkan tanggal dan jam yang Anda butuhkan.</p>
                        </div>
                        <div class="flex-1">
                            <div class="grid gap-4 sm:grid-cols-2">
                                @forelse ($rooms as $room)
                                    <div class="rounded-2xl border border-neutral-200 bg-white p-5 shadow-sm">
                                        <p class="text-xs uppercase tracking-wide text-neutral-500">{{ $room->type ?? 'Ruangan' }}</p>
                                        <h3 class="mt-1 text-lg font-semibold text-neutral-900">{{ $room->name }}</h3>
                                        <dl class="mt-4 space-y-1 text-sm text-neutral-600">
                                            @if(!empty($room->location))
                                                <div class="flex items-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-4 w-4 text-neutral-900">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.5-7.5 11.25-7.5 11.25S4.5 18 4.5 10.5a7.5 7.5 0 1115 0z" />
                                                    </svg>
                                                    <span>{{ $room->location }}</span>
                                                </div>
                                            @endif
                                            <div class="flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-4 w-4 text-neutral-900">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h7.5m-7.5 4.5h7.5m-7.5 4.5h7.5M5.25 6v12a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0016.5 3.75h-9A2.25 2.25 0 005.25 6z" />
                                                </svg>
                                                <span>Kapasitas {{ $room->capacity ?? '—' }} orang</span>
                                            </div>
                                        </dl>
                                    </div>
                                @empty
                                    <div class="col-span-2 rounded-2xl border border-dashed border-neutral-300 bg-white p-6 text-center text-sm text-neutral-500">
                                        Belum ada data ruangan aktif. Admin dapat menambahkan dari panel Admin &gt; Ruangan.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mx-auto max-w-6xl px-6 py-16">
                <div class="rounded-[32px] bg-neutral-900 px-10 py-12 text-center text-white">
                    <h2 class="text-3xl font-semibold">Siap memulai peminjaman ruangan yang lebih rapi?</h2>
                    <p class="mx-auto mt-3 max-w-2xl text-base text-neutral-300">Masuk untuk melihat kalender ketersediaan, ajukan jadwal, dan terima pembaruan status melalui email otomatis.</p>
                    <div class="mt-6 flex flex-wrap justify-center gap-4">
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-xl bg-white px-6 py-3 text-base font-semibold text-neutral-900 transition hover:bg-neutral-200">
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
