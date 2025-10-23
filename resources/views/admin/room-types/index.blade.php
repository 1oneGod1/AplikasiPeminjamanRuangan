@extends('admin.layouts.app')

@section('title', 'Kelola Jenis Ruangan')
@section('header', 'Kelola Jenis Ruangan')

@section('content')
<div class="space-y-4 md:space-y-6">
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
      <h3 class="text-xl md:text-2xl font-bold text-white">Kelola Jenis Ruangan</h3>
      <p class="mt-1 text-sm text-slate-400">Tambah, edit, atau hapus jenis ruangan yang tersedia</p>
    </div>
    <a href="{{ route('admin.room-types.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-500 text-white rounded-xl font-semibold hover:bg-blue-600 transition-colors shadow-lg shadow-blue-500/30">
      <i class="fas fa-plus"></i>
      <span>Tambah Jenis</span>
    </a>
  </div>

  <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm overflow-hidden">
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead class="bg-white/5 border-b border-white/10">
          <tr>
            <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Nama</th>
            <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Label</th>
            <th class="px-4 lg:px-6 py-3 text-left font-semibold text-slate-300">Deskripsi</th>
            <th class="px-4 lg:px-6 py-3 text-center font-semibold text-slate-300">Status</th>
            <th class="px-4 lg:px-6 py-3 text-center font-semibold text-slate-300">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
          @forelse($roomTypes as $type)
            <tr class="hover:bg-white/5 transition-colors">
              <td class="px-4 lg:px-6 py-4 text-slate-100 font-semibold">{{ $type->name }}</td>
              <td class="px-4 lg:px-6 py-4 text-blue-400 font-bold">{{ $type->label }}</td>
              <td class="px-4 lg:px-6 py-4 text-slate-300">{{ $type->description }}</td>
              <td class="px-4 lg:px-6 py-4 text-center">
                @if($type->is_active)
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
              <td class="px-4 lg:px-6 py-4 text-center">
                <a href="{{ route('admin.room-types.edit', $type) }}" class="text-yellow-400 hover:text-yellow-300 font-medium transition-colors">Edit</a>
                <span class="text-slate-700">·</span>
                <form action="{{ route('admin.room-types.destroy', $type) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus jenis ruangan ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-400 hover:text-red-300 font-medium transition-colors">Hapus</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="px-6 py-12 text-center">
                <i class="fas fa-inbox text-6xl text-slate-700 mb-4"></i>
                <p class="text-slate-500 font-medium">Belum ada jenis ruangan</p>
                <a href="{{ route('admin.room-types.create') }}" class="inline-flex items-center gap-2 mt-4 px-4 py-2 bg-blue-500 text-white rounded-xl hover:bg-blue-600 transition-colors">
                  <i class="fas fa-plus"></i>
                  Tambah sekarang
                </a>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
