<!DOCTYPE html>
<html lang="id" class="h-full bg-white">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lupa Kata Sandi - Sistem Peminjaman Ruangan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
  <style> body{ font-family: 'Inter', sans-serif; } </style>
</head>
<body class="h-full">
  <main class="relative min-h-screen flex items-center justify-center overflow-hidden bg-black text-white">
    <!-- Background image -->
    <img src="https://proditp.unismuh.ac.id/wp-content/uploads/2023/01/Lab-Komputer-SMP-Negeri-12-Binjai-Gambar-Ilustrasi-768x439.jpg" alt="Lab Komputer Sekolah Palembang Harapan" class="absolute inset-0 h-full w-full object-cover object-center opacity-40" />
    <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/60 to-black/90"></div>

    <!-- Card -->
    <div class="relative z-10 w-full max-w-md rounded-2xl border border-white/10 bg-white/10 backdrop-blur-lg p-8 shadow-2xl">
      <div class="text-center mb-8">
        <div class="mx-auto mb-3 h-16 w-16 rounded-full border border-white/20 bg-white/10 backdrop-blur-sm p-2">
          <img src="https://static.wixstatic.com/media/07639e_83549958900b44ad9fea05d99e380dd5~mv2.png/v1/fill/w_559,h_512,al_c/07639e_83549958900b44ad9fea05d99e380dd5~mv2.png" alt="Logo Sekolah Palembang Harapan" class="h-full w-full object-contain" loading="lazy">
        </div>
        <h1 class="text-2xl font-bold tracking-tight">Lupa Kata Sandi</h1>
        <p class="mt-2 text-sm text-gray-300">Ajukan perubahan kata sandi Anda.<br>Admin akan meninjau dan menyetujui permintaan Anda.</p>
      </div>

      @if (session('status'))
        <div class="mb-4 rounded-md bg-green-500/20 border border-green-500/30 p-3 text-sm text-green-200">
          {{ session('status') }}
        </div>
      @endif

      <!-- Form -->
      <form action="{{ route('password.email') }}" method="POST" class="space-y-5" novalidate>
        @csrf

        <!-- Email -->
        <div>
          <label for="email" class="block text-sm font-medium text-gray-200">Email</label>
          <input id="email" name="email" type="email" inputmode="email" autocomplete="email" required
            value="{{ old('email') }}"
            placeholder="nama@sekolah.sch.id"
            class="mt-1 w-full rounded-xl border bg-black/30 px-3 py-2 text-white placeholder-gray-400 outline-none focus:ring-2 focus:ring-white/70 {{ $errors->has('email') ? 'border-red-400' : 'border-white/20' }}">
          @error('email')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
        </div>

        <!-- Password Baru -->
        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm font-medium text-gray-200">Password Baru</label>
            <button type="button" id="togglePassword" class="text-xs text-gray-400 hover:text-white underline underline-offset-4">Tampilkan</button>
          </div>
          <input id="password" name="password" type="password" autocomplete="new-password" required placeholder="Minimal 8 karakter"
                 class="mt-1 w-full rounded-xl border bg-black/30 px-3 py-2 text-white placeholder-gray-400 outline-none focus:ring-2 focus:ring-white/70 {{ $errors->has('password') ? 'border-red-400' : 'border-white/20' }}">
          @error('password')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
        </div>

        <!-- Konfirmasi Password -->
        <div>
          <label for="password_confirmation" class="block text-sm font-medium text-gray-200">Konfirmasi Password</label>
          <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required placeholder="Ketik ulang password baru"
                 class="mt-1 w-full rounded-xl border bg-black/30 px-3 py-2 text-white placeholder-gray-400 outline-none focus:ring-2 focus:ring-white/70 border-white/20">
        </div>

        <!-- Submit -->
        <button type="submit"
          class="w-full rounded-xl border border-white/30 bg-white/10 px-4 py-2 font-medium text-white transition hover:bg-white/20 focus:ring-4 focus:ring-white/40">
          🔑 Ajukan Perubahan Password
        </button>

        <p class="text-center text-sm text-gray-400 mt-4">
          Sudah ingat? <a href="{{ route('login') }}" class="underline hover:text-white">Kembali ke Login</a>
        </p>
      </form>

      <p class="mt-8 text-center text-xs text-gray-500">© {{ date('Y') }} Sekolah Palembang Harapan — Lab Komputer Theme</p>
    </div>
  </main>

  <script>
    // Toggle password visibility
    (function(){
      const toggle = document.getElementById('togglePassword');
      const pwd = document.getElementById('password');
      if(toggle && pwd){ 
        toggle.addEventListener('click', function(){ 
          const isHidden = pwd.type === 'password'; 
          pwd.type = isHidden ? 'text' : 'password'; 
          toggle.textContent = isHidden ? 'Sembunyikan' : 'Tampilkan'; 
        }); 
      }
    })();
  </script>
</body>
</html>
