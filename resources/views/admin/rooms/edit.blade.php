@extends('admin.layouts.app')

@section('title', 'Edit Ruangan')
@section('header', 'Edit Ruangan')

@section('content')
<div class="max-w-4xl mx-auto">
  @php
    $adminFormDefaults = config('admin_form');
    $adminFormCardClass = $adminFormCardClass ?? $adminFormDefaults['card'];
    $adminFormHeaderClass = $adminFormHeaderClass ?? $adminFormDefaults['header'];
    $adminFormSubtextClass = $adminFormSubtextClass ?? $adminFormDefaults['subtext'];
    $adminLabelClass = $adminLabelClass ?? $adminFormDefaults['label'];
    $adminHelperTextClass = $adminHelperTextClass ?? $adminFormDefaults['helper'];
    $adminInputClass = $adminInputClass ?? $adminFormDefaults['input'];
    $adminTextareaClass = $adminTextareaClass ?? $adminFormDefaults['textarea'];
    $adminSelectClass = $adminSelectClass ?? $adminFormDefaults['select'];
    $adminPrimaryButtonClass = $adminPrimaryButtonClass ?? $adminFormDefaults['primary_button'];
    $adminSecondaryButtonClass = $adminSecondaryButtonClass ?? $adminFormDefaults['secondary_button'];
    $adminFormSectionDivider = $adminFormSectionDivider ?? $adminFormDefaults['divider'];
  @endphp

  <div class="{{ $adminFormCardClass }}">
    <form action="{{ route('admin.rooms.update', $room) }}" method="POST" class="space-y-12">
      @csrf
      @method('PUT')

      <div class="space-y-10">
        <div class="space-y-2.5">
          <p class="text-[10px] font-semibold uppercase tracking-[0.36em] text-slate-500">Detail Ruangan</p>
          <h3 class="{{ $adminFormHeaderClass }}">Perbarui informasi ruangan secara akurat</h3>
          <p class="{{ $adminFormSubtextClass }}">Pastikan data kapasitas, fasilitas, dan status ruangan selalu terbaru agar peminjaman berjalan lancar.</p>
        </div>

        <div class="space-y-7">
          <div class="space-y-2.5">
            <label for="name" class="{{ $adminLabelClass }}">Nama Ruangan <span class="text-rose-400">*</span></label>
            <input
              id="name"
              type="text"
              name="name"
              value="{{ old('name', $room->name) }}"
              required
              class="@class([
                $adminInputClass,
                'border-rose-500/80 focus:border-rose-400 focus:ring-rose-400/40 focus:shadow-rose-500/20' => $errors->has('name'),
              ])"
            >
            @error('name')
              <p class="text-xs text-rose-400">{{ $message }}</p>
            @enderror
          </div>

          <div class="grid gap-6 sm:grid-cols-2">
            <div class="space-y-2.5">
              <div class="flex items-center justify-between">
                <label for="type" class="{{ $adminLabelClass }}">Jenis Ruangan <span class="text-rose-400">*</span></label>
                <a href="{{ route('admin.room-types.index') }}" class="text-[10px] font-bold tracking-[0.04em] text-yellow-400 hover:text-yellow-300 transition-colors">Kelola Jenis Ruangan</a>
              </div>
              <div class="relative">
                <select
                  id="type"
                  name="type"
                  required
                  class="@class([
                    $adminSelectClass,
                    'border-rose-500/80 focus:border-rose-400 focus:ring-rose-400/40 focus:shadow-rose-500/20' => $errors->has('type'),
                  ])"
                >
                  <option value="" class="bg-slate-900 text-slate-400">Pilih Jenis</option>
                  @foreach($roomTypes as $type)
                    <option value="{{ $type->name }}" class="bg-slate-900 text-white" @selected(old('type', $room->type) === $type->name)>{{ $type->label }}</option>
                  @endforeach
                </select>
                <span class="pointer-events-none absolute right-4 top-1/2 flex h-6 w-6 -translate-y-1/2 items-center justify-center rounded-full bg-slate-800/70 text-slate-300 shadow-inner shadow-black/30">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-3.5 w-3.5">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.21 8.29a.75.75 0 0 1 .02-1.08z" clip-rule="evenodd" />
                  </svg>
                </span>
              </div>
              @error('type')
                <p class="text-xs text-rose-400">{{ $message }}</p>
              @enderror
            </div>

            <div class="space-y-2.5">
              <label for="capacity" class="{{ $adminLabelClass }}">Kapasitas <span class="text-rose-400">*</span></label>
              <input
                id="capacity"
                type="number"
                name="capacity"
                value="{{ old('capacity', $room->capacity) }}"
                min="1"
                required
                placeholder="Jumlah orang"
                class="@class([
                  $adminInputClass,
                  'border-rose-500/80 focus:border-rose-400 focus:ring-rose-400/40 focus:shadow-rose-500/20' => $errors->has('capacity'),
                ])"
              >
              @error('capacity')
                <p class="text-xs text-rose-400">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="space-y-2.5">
            <label for="location" class="{{ $adminLabelClass }}">Lokasi</label>
            <input
              id="location"
              type="text"
              name="location"
              value="{{ old('location', $room->location) }}"
              placeholder="Contoh: Lantai 2, Gedung A"
              class="@class([
                $adminInputClass,
                'border-rose-500/80 focus:border-rose-400 focus:ring-rose-400/40 focus:shadow-rose-500/20' => $errors->has('location'),
              ])"
              required
            >
            @error('location')
              <p class="text-xs text-rose-400">{{ $message }}</p>
            @enderror
          </div>

          <div class="space-y-2.5">
            <label for="facilities" class="{{ $adminLabelClass }}">Fasilitas</label>
            <textarea
              id="facilities"
              name="facilities"
              rows="4"
              placeholder="Contoh: Proyektor, AC, Whiteboard, 30 Komputer"
              class="@class([
                $adminTextareaClass,
                'border-rose-500/80 focus:border-rose-400 focus:ring-rose-400/40 focus:shadow-rose-500/20' => $errors->has('facilities'),
              ])"
            >{{ old('facilities', $room->facilities) }}</textarea>
            @error('facilities')
              <p class="text-xs text-rose-400">{{ $message }}</p>
            @enderror
          </div>

          <section class="rounded-[22px] border border-slate-700/50 bg-slate-900/40 p-7 text-sm text-slate-200 shadow-inner shadow-black/30">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
              <div class="space-y-1.5">
                <span class="text-[10px] font-semibold uppercase tracking-[0.28em] text-slate-400">Status Aktif</span>
                <p class="text-[15px] font-semibold leading-tight text-white">Ruangan aktif (bisa dipinjam)</p>
                <p class="text-[11px] leading-relaxed text-slate-500">Ruangan dapat dilihat dan dipilih untuk dipinjam.</p>
              </div>
              <div class="shrink-0">
                <input type="hidden" name="is_active" value="0">
                <label class="relative inline-flex h-[34px] w-[66px] cursor-pointer items-center">
                  <input type="checkbox" name="is_active" value="1" class="peer sr-only" @checked(old('is_active', $room->is_active ?? true))>
                  <span class="absolute inset-0 rounded-full bg-slate-600/60 shadow-inner shadow-black/30 transition-all duration-200 peer-checked:bg-yellow-400"></span>
                  <span class="absolute left-[3px] top-[3px] h-7 w-7 rounded-full bg-white shadow-md transition-all duration-200 peer-checked:translate-x-8 peer-checked:bg-slate-950"></span>
                </label>
              </div>
            </div>
          </section>
        </div>

        <footer class="flex flex-col gap-3 pt-6 sm:flex-row sm:items-center sm:justify-end {{ $adminFormSectionDivider }}">
          <a href="{{ route('admin.rooms.index') }}" class="{{ $adminSecondaryButtonClass }}">Batal</a>
          <button type="submit" class="{{ $adminPrimaryButtonClass }}">Perbarui Ruangan</button>
        </footer>
      </div>
    </form>
  </div>
</div>
@endsection
