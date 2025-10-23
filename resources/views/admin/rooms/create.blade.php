@extends('admin.layouts.app')

@section('title', isset($room) ? 'Edit Ruangan' : 'Tambah Ruangan')
@section('header', isset($room) ? 'Edit Ruangan' : 'Tambah Ruangan Baru')

@section('content')
<div class="max-w-3xl">
  <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm p-6">
    <form action="{{ isset($room) ? route('admin.rooms.update', $room) : route('admin.rooms.store') }}" method="POST">
      @csrf
      @if(isset($room))
        @method('PUT')
      @endif

  <div class="space-y-6">
        <!-- Nama Ruangan -->
        <div>
          <label for="name" class="block text-sm font-semibold text-slate-100 mb-2">Nama Ruangan <span class="text-red-400">*</span></label>
     <input type="text" id="name" name="name" value="{{ old('name', $room->name ?? '') }}" required
       class="@class([
      'w-full px-4 py-2 border bg-white/10 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500',
      'border-red-500' => $errors->has('name'),
      'border-white/20' => !$errors->has('name'),
       ])"
                 placeholder="Contoh: Lab Komputer 1">
          @error('name')
            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
          @enderror
        </div>

        <!-- Jenis Ruangan -->
        <div>
          <div class="flex items-center justify-between mb-2">
            <label for="type" class="block text-sm font-semibold text-slate-100">Jenis Ruangan <span class="text-red-400">*</span></label>
            <a href="{{ route('admin.room-types.index') }}" class="text-xs text-blue-400 hover:underline">Kelola Jenis Ruangan</a>
          </div>
      <select id="type" name="type" required class="@class([
        'w-full px-4 py-2 border bg-slate-800 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500',
        'border-red-500' => $errors->has('type'),
        'border-white/20' => !$errors->has('type'),
      ])">
            <option value="" class="bg-slate-800 text-slate-400">Pilih Jenis</option>
            @foreach($roomTypes as $type)
              <option value="{{ $type->name }}" class="bg-slate-800 text-white" {{ old('type', $room->type ?? '') == $type->name ? 'selected' : '' }}>{{ $type->label }}</option>
            @endforeach
          </select>
          @error('type')
            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
          @enderror
        </div>

        <!-- Kapasitas -->
        <div>
          <label for="capacity" class="block text-sm font-semibold text-slate-100 mb-2">Kapasitas <span class="text-red-400">*</span></label>
     <input type="number" id="capacity" name="capacity" value="{{ old('capacity', $room->capacity ?? '') }}" required min="1"
       class="@class([
      'w-full px-4 py-2 border bg-white/10 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500',
      'border-red-500' => $errors->has('capacity'),
      'border-white/20' => !$errors->has('capacity'),
       ])"
                 placeholder="Jumlah orang">
          @error('capacity')
            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
          @enderror
        </div>

        <!-- Lokasi -->
        <div>
          <label for="location" class="block text-sm font-semibold text-slate-100 mb-2">Lokasi</label>
     <input type="text" id="location" name="location" value="{{ old('location', $room->location ?? '') }}"
       class="@class([
      'w-full px-4 py-2 border bg-white/10 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500',
      'border-red-500' => $errors->has('location'),
      'border-white/20' => !$errors->has('location'),
       ])"
                 placeholder="Contoh: Lantai 2, Gedung A">
          @error('location')
            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
          @enderror
        </div>

        <!-- Fasilitas -->
        <div>
          <label for="facilities" class="block text-sm font-semibold text-slate-100 mb-2">Fasilitas</label>
      <textarea id="facilities" name="facilities" rows="3"
          class="@class([
            'w-full px-4 py-2 border bg-white/10 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500',
            'border-red-500' => $errors->has('facilities'),
            'border-white/20' => !$errors->has('facilities'),
          ])"
                    placeholder="Contoh: Proyektor, AC, Whiteboard, 30 Komputer">{{ old('facilities', $room->facilities ?? '') }}</textarea>
          @error('facilities')
            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
          @enderror
        </div>

        <!-- Status Aktif -->
        <div>
          <label class="flex items-center gap-3">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $room->is_active ?? true) ? 'checked' : '' }}
                   class="w-4 h-4 text-blue-500 border-white/20 rounded focus:ring-blue-500">
            <span class="text-sm font-semibold text-slate-100">Ruangan Aktif (bisa dipinjam)</span>
          </label>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center gap-3 pt-4 border-t border-white/10">
          <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-xl font-semibold hover:bg-blue-600 transition-colors shadow-lg shadow-blue-500/30">
            {{ isset($room) ? 'Perbarui' : 'Simpan' }}
          </button>
          <a href="{{ route('admin.rooms.index') }}" class="px-6 py-2 border border-white/20 text-slate-100 rounded-xl hover:bg-white/10 transition-colors">
            Batal
          </a>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
