@extends('admin.layouts.app')

@section('title', 'Tambah Jenis Ruangan')
@section('header', 'Tambah Jenis Ruangan')

@section('content')
<div class="max-w-xl mx-auto">
  <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm p-6">
    <form action="{{ route('admin.room-types.store') }}" method="POST">
      @csrf
      <div class="space-y-6">
        <div>
          <label for="name" class="block text-sm font-semibold text-slate-100 mb-2">Nama Jenis (unik, untuk sistem) <span class="text-red-400">*</span></label>
     <input type="text" id="name" name="name" value="{{ old('name') }}" required
       class="@class([
      'w-full px-4 py-2 border bg-white/10 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500',
      'border-red-500' => $errors->has('name'),
      'border-white/20' => !$errors->has('name'),
       ])"
                 placeholder="Contoh: laboratorium">
          @error('name')
            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
          @enderror
        </div>
        <div>
          <label for="label" class="block text-sm font-semibold text-slate-100 mb-2">Label Tampilan <span class="text-red-400">*</span></label>
     <input type="text" id="label" name="label" value="{{ old('label') }}" required
       class="@class([
      'w-full px-4 py-2 border bg-white/10 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500',
      'border-red-500' => $errors->has('label'),
      'border-white/20' => !$errors->has('label'),
       ])"
                 placeholder="Contoh: Laboratorium">
          @error('label')
            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
          @enderror
        </div>
        <div>
          <label for="description" class="block text-sm font-semibold text-slate-100 mb-2">Deskripsi</label>
      <textarea id="description" name="description" rows="2"
          class="@class([
            'w-full px-4 py-2 border bg-white/10 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500',
            'border-red-500' => $errors->has('description'),
            'border-white/20' => !$errors->has('description'),
          ])"
                    placeholder="Contoh: Ruangan untuk praktikum dan eksperimen">{{ old('description') }}</textarea>
          @error('description')
            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
          @enderror
        </div>
        <div>
          <label class="flex items-center gap-3">
            <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 text-blue-500 border-white/20 rounded focus:ring-blue-500">
            <span class="text-sm font-semibold text-slate-100">Aktif (bisa dipilih)</span>
          </label>
        </div>
        <div class="flex items-center gap-3 pt-4 border-t border-white/10">
          <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-xl font-semibold hover:bg-blue-600 transition-colors shadow-lg shadow-blue-500/30">
            Simpan Jenis
          </button>
          <a href="{{ route('admin.room-types.index') }}" class="px-6 py-2 border border-white/20 text-slate-100 rounded-xl hover:bg-white/10 transition-colors">
            Batal
          </a>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
