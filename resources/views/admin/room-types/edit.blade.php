@extends('admin.layouts.app')

@section('title', 'Edit Jenis Ruangan')
@section('header', 'Edit Jenis Ruangan')

@section('content')
<div class="max-w-2xl mx-auto">
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
    $adminCheckboxClass = $adminCheckboxClass ?? $adminFormDefaults['checkbox'];
    $adminPrimaryButtonClass = $adminPrimaryButtonClass ?? $adminFormDefaults['primary_button'];
    $adminSecondaryButtonClass = $adminSecondaryButtonClass ?? $adminFormDefaults['secondary_button'];
    $adminFormSectionDivider = $adminFormSectionDivider ?? $adminFormDefaults['divider'];
  @endphp
  <div class="{{ $adminFormCardClass }}">
    <form action="{{ route('admin.room-types.update', $roomType) }}" method="POST" class="space-y-8">
      @csrf
      @method('PUT')
      <div class="space-y-6">
        <div class="space-y-3">
          <h3 class="{{ $adminFormHeaderClass }}">Perbarui jenis ruangan</h3>
          <p class="{{ $adminFormSubtextClass }}">Sesuaikan informasi teks agar sesuai dengan nomenklatur terbaru di sekolah.</p>
        </div>
        <div class="space-y-2">
          <label for="name" class="{{ $adminLabelClass }}">Nama Jenis (unik, untuk sistem) <span class="text-rose-400">*</span></label>
          <input type="text" id="name" name="name" value="{{ old('name', $roomType->name) }}" required
              class="@class([
                $adminInputClass,
                'border-rose-500/80 bg-rose-900/30 text-rose-100 placeholder-rose-200 focus:border-rose-400 focus:ring-rose-400/40' => $errors->has('name'),
              ])"
                 placeholder="Contoh: laboratorium">
          @error('name')
            <p class="text-xs text-rose-400">{{ $message }}</p>
          @enderror
        </div>
        <div class="space-y-2">
          <label for="label" class="{{ $adminLabelClass }}">Label Tampilan <span class="text-rose-400">*</span></label>
          <input type="text" id="label" name="label" value="{{ old('label', $roomType->label) }}" required
              class="@class([
                $adminInputClass,
                'border-rose-500/80 bg-rose-900/30 text-rose-100 placeholder-rose-200 focus:border-rose-400 focus:ring-rose-400/40' => $errors->has('label'),
              ])"
                 placeholder="Contoh: Laboratorium">
          @error('label')
            <p class="text-xs text-rose-400">{{ $message }}</p>
          @enderror
        </div>
        <div class="space-y-2">
          <label for="description" class="{{ $adminLabelClass }}">Deskripsi</label>
          <textarea id="description" name="description" rows="3"
              class="@class([
                $adminTextareaClass,
                'border-rose-500/80 bg-rose-900/30 text-rose-100 placeholder-rose-200 focus:border-rose-400 focus:ring-rose-400/40' => $errors->has('description'),
              ])"
                    placeholder="Contoh: Ruangan untuk praktikum dan eksperimen">{{ old('description', $roomType->description) }}</textarea>
          @error('description')
            <p class="text-xs text-rose-400">{{ $message }}</p>
          @enderror
        </div>
        <label class="flex flex-col gap-2 rounded-2xl border border-slate-700/70 bg-slate-800/50 p-5 text-sm text-slate-200 shadow-inner shadow-black/30">
          <span class="flex items-center justify-between text-xs font-semibold uppercase tracking-[0.18em] text-slate-400">Status Jenis</span>
          <span class="flex items-center gap-3 text-base font-semibold text-white">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $roomType->is_active) ? 'checked' : '' }} class="{{ $adminCheckboxClass }}">
            Aktif (bisa dipilih)
          </span>
          <span class="{{ $adminHelperTextClass }}">Nonaktifkan jika tidak ingin ditampilkan sementara waktu.</span>
        </label>
        <div class="flex flex-col gap-3 pt-6 sm:flex-row sm:items-center {{ $adminFormSectionDivider }}">
          <button type="submit" class="{{ $adminPrimaryButtonClass }}">
            Perbarui Jenis
          </button>
          <a href="{{ route('admin.room-types.index') }}" class="{{ $adminSecondaryButtonClass }}">
            Batal
          </a>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
