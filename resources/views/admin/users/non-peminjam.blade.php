@extends('admin.layouts.app')

@section('title', 'User Non-Peminjam')
@section('header', 'Manajemen User Non-Peminjam')

@section('content')
<div class="space-y-4 md:space-y-6">
  <!-- Header -->
  <div class="flex flex-col gap-3">
    <div>
      <h3 class="text-xl md:text-2xl font-bold text-white">Manajemen User Non-Peminjam</h3>
      <p class="mt-1 text-sm text-slate-400">Kelola user admin, kepala sekolah, cleaning service</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="w-full md:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-500 text-white rounded-xl font-semibold hover:bg-blue-600 transition-colors shadow-lg shadow-blue-500/30">
      <i class="fas fa-plus"></i>
      <span>Tambah User</span>
    </a>
  </div>

  <!-- Desktop Table View -->
  <div class="hidden md:block rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm overflow-hidden">
  <div class="bg-linear-to-r from-slate-800 to-slate-900 px-4 md:px-6 py-4">
      <div class="flex items-center gap-3">
        <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-green-500/10">
          <i class="fas fa-user-shield text-green-400"></i>
        </div>
        <h2 class="text-lg font-bold text-white">User Non-Peminjam</h2>
      </div>
    </div>
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead class="bg-white/5 border-b border-white/10">
          <tr>
            <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">#</th>
            <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Nama</th>
            <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Email</th>
            <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">No. Telepon</th>
            <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Role</th>
            <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Status</th>
            <th class="px-4 lg:px-6 py-3 text-center font-semibold text-slate-300">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
        @foreach($users as $u)
          <tr class="hover:bg-white/5 transition-colors">
            <td class="px-4 lg:px-6 py-4 text-slate-400">{{ $loop->iteration }}</td>
            <td class="px-4 lg:px-6 py-4">
              <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-green-500 flex items-center justify-center text-white font-bold text-sm">
                  {{ strtoupper(substr($u->name, 0, 1)) }}
                </div>
                <span class="font-medium text-white">{{ $u->name }}</span>
              </div>
            </td>
            <td class="px-4 lg:px-6 py-4 text-slate-300">{{ $u->email }}</td>
            <td class="px-4 lg:px-6 py-4 text-slate-400">{{ $u->phone ?? '-' }}</td>
            <td class="px-4 lg:px-6 py-4 text-slate-400">{{ ucfirst(str_replace('_', ' ', $u->role)) }}</td>
            <td class="px-4 lg:px-6 py-4">
              @if($u->is_active)
                <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-green-500/10 border border-green-500/30 text-green-400">
                  <i class="fas fa-check-circle"></i>
                  Aktif
                </span>
              @else
                <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-red-500/10 border border-red-500/30 text-red-400">
                  <i class="fas fa-times-circle"></i>
                  Nonaktif
                </span>
              @endif
            </td>
            <td class="px-4 lg:px-6 py-4">
              <div class="flex items-center justify-center gap-2">
                <a href="{{ route('admin.users.edit', $u) }}" class="text-yellow-400 hover:text-yellow-300 font-medium transition-colors">Edit</a>
                <span class="text-slate-700">·</span>
                <form action="{{ route('admin.users.destroy', $u) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus user ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-400 hover:text-red-300 font-medium transition-colors">Hapus</button>
                </form>
              </div>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <!-- Mobile Card View -->
  <div class="md:hidden space-y-3">
    @forelse($users as $u)
      <div class="rounded-xl border border-white/10 bg-white/5 backdrop-blur-sm p-4 space-y-3">
        <!-- Header -->
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-3 flex-1 min-w-0">
            <div class="w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold shrink-0">
              {{ strtoupper(substr($u->name, 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
              <h3 class="font-bold text-white truncate">{{ $u->name }}</h3>
              <p class="text-xs text-slate-400">{{ ucfirst(str_replace('_', ' ', $u->role)) }}</p>
            </div>
          </div>
        </div>

        <!-- Status Badge -->
        <div class="flex items-center gap-2">
          @if($u->is_active)
            <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-semibold rounded-full bg-green-500/10 border border-green-500/30 text-green-400">
              <i class="fas fa-check-circle text-xs"></i>
              Aktif
            </span>
          @else
            <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-semibold rounded-full bg-red-500/10 border border-red-500/30 text-red-400">
              <i class="fas fa-times-circle text-xs"></i>
              Nonaktif
            </span>
          @endif
        </div>

        <!-- Details -->
        <div class="space-y-2">
          <div class="flex items-center gap-2 text-sm text-slate-300">
            <i class="fas fa-envelope text-blue-400 w-4"></i>
            <span class="truncate">{{ $u->email }}</span>
          </div>
          <div class="flex items-center gap-2 text-sm text-slate-400">
            <i class="fas fa-phone text-green-400 w-4"></i>
            <span>{{ $u->phone ?? '-' }}</span>
          </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center gap-2 pt-2 border-t border-white/10">
          <a href="{{ route('admin.users.edit', $u) }}" class="flex-1 inline-flex items-center justify-center gap-2 px-3 py-2 rounded-lg bg-yellow-500 text-white text-sm font-semibold hover:bg-yellow-600 transition-colors">
            <i class="fas fa-edit"></i>
            <span>Edit</span>
          </a>
          <form action="{{ route('admin.users.destroy', $u) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin hapus user ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 rounded-lg bg-red-500 text-white text-sm font-semibold hover:bg-red-600 transition-colors">
              <i class="fas fa-trash"></i>
              <span>Hapus</span>
            </button>
          </form>
        </div>
      </div>
    @empty
      <div class="rounded-xl border border-white/10 bg-white/5 p-8 text-center">
        <i class="fas fa-inbox text-5xl text-slate-700 mb-4"></i>
        <p class="text-slate-500 font-medium">Belum ada data user non-peminjam</p>
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 mt-4 px-4 py-2 bg-blue-500 text-white rounded-xl hover:bg-blue-600 transition-colors">
          <i class="fas fa-plus"></i>
          Tambah sekarang
        </a>
      </div>
    @endforelse
  </div>
</div>
@endsection
