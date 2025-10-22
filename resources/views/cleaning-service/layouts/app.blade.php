<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Petugas Kebersihan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-green-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <i class="fas fa-broom text-white text-2xl mr-3"></i>
                    <span class="text-white text-xl font-bold">Dashboard Petugas Kebersihan</span>
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="text-white text-sm">
                        <i class="fas fa-user-circle mr-2"></i>
                        <span>{{ Auth::user()->name }}</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg transition duration-200">
                            <i class="fas fa-sign-out-alt mr-2"></i>Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar & Main Content -->
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg">
            <nav class="mt-5 px-2">
                <a href="{{ route('cleaning-service.dashboard') }}" 
                   class="group flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-600 {{ request()->routeIs('cleaning-service.dashboard') ? 'bg-green-50 text-green-600' : '' }}">
                    <i class="fas fa-home mr-3 text-lg"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                
                <a href="{{ route('cleaning-service.schedule') }}" 
                   class="group flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-600 mt-2 {{ request()->routeIs('cleaning-service.schedule') ? 'bg-green-50 text-green-600' : '' }}">
                    <i class="fas fa-calendar-alt mr-3 text-lg"></i>
                    <span class="font-medium">Jadwal Peminjaman</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <div class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    @if (session('success'))
                        <div class="mb-4 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg relative" role="alert">
                            <i class="fas fa-check-circle mr-2"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-4 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg relative" role="alert">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html>
