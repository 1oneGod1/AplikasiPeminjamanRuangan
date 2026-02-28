@extends('admin.layouts.app')

@section('content')

<div class="max-w-4xl">
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
        <form action="{{ route('admin.users.store', $role ?? '') }}" method="POST" class="space-y-10">
            @csrf
            <div class="space-y-7">
                <div class="space-y-2.5">
                    <h3 class="{{ $adminFormHeaderClass }}">Tambah pengguna baru</h3>
                    <p class="{{ $adminFormSubtextClass }}">Lengkapi detail akun agar setiap peran memperoleh akses sesuai kebutuhan operasional.</p>
                </div>
                <!-- Nama Lengkap -->
                <div class="space-y-2.5">
                    <label for="name" class="{{ $adminLabelClass }}">Nama Lengkap <span class="text-rose-400">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                           class="@class([
                               $adminInputClass,
                               'border-rose-500/80 focus:border-rose-400 focus:ring-rose-400/40 focus:shadow-rose-500/20' => $errors->has('name'),
                           ])"
                           placeholder="Nama Lengkap">
                    @error('name')
                        <p class="text-xs text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="space-y-2.5">
                    <label for="email" class="{{ $adminLabelClass }}">Email <span class="text-rose-400">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                           class="@class([
                               $adminInputClass,
                               'border-rose-500/80 focus:border-rose-400 focus:ring-rose-400/40 focus:shadow-rose-500/20' => $errors->has('email'),
                           ])"
                           placeholder="Email">
                    @error('email')
                        <p class="text-xs text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="space-y-2.5">
                    <label for="password" class="{{ $adminLabelClass }}">Password <span class="text-rose-400">*</span></label>
                    <input type="password" id="password" name="password" required minlength="8"
                           class="@class([
                               $adminInputClass,
                               'border-rose-500/80 focus:border-rose-400 focus:ring-rose-400/40 focus:shadow-rose-500/20' => $errors->has('password'),
                           ])"
                           placeholder="Password">
                    @error('password')
                        <p class="text-xs text-rose-400">{{ $message }}</p>
                    @enderror
                    <p class="{{ $adminHelperTextClass }}">Minimal 8 karakter.</p>
                </div>

                <!-- Konfirmasi Password -->
                <div class="space-y-2.5">
                    <label for="password_confirmation" class="{{ $adminLabelClass }}">Konfirmasi Password <span class="text-rose-400">*</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required minlength="8"
                           class="{{ $adminInputClass }}"
                           placeholder="Konfirmasi Password">
                </div>

                <!-- No. Telepon -->
                <div class="space-y-2.5">
                    <label for="phone" class="{{ $adminLabelClass }}">No. Telepon</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                           class="@class([
                               $adminInputClass,
                               'border-rose-500/80 focus:border-rose-400 focus:ring-rose-400/40 focus:shadow-rose-500/20' => $errors->has('phone'),
                           ])"
                           placeholder="No. Telepon">
                    @error('phone')
                        <p class="text-xs text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role -->
                <div class="space-y-2.5">
                    <label for="role" class="{{ $adminLabelClass }}">Role <span class="text-rose-400">*</span></label>
                    <div class="relative w-full">
                        <select id="role" name="role" required class="@class([
                            $adminSelectClass,
                            'border-rose-500/80 focus:border-rose-400 focus:ring-rose-400/40 focus:shadow-rose-500/20' => $errors->has('role'),
                        ])">
                            <option value="" class="bg-slate-900 text-slate-400">Pilih Role</option>
                            <option value="kepala_sekolah" class="bg-slate-900 text-white" {{ (old('role', $role ?? '') == 'kepala_sekolah') ? 'selected' : '' }}>Kepala Sekolah</option>
                            <option value="cleaning_service" class="bg-slate-900 text-white" {{ (old('role', $role ?? '') == 'cleaning_service') ? 'selected' : '' }}>Cleaning Service</option>
                            <option value="peminjam" class="bg-slate-900 text-white" {{ (old('role', $role ?? '') == 'peminjam') ? 'selected' : '' }}>Peminjam</option>
                        </select>
                        <span class="pointer-events-none absolute right-4 top-1/2 flex h-6 w-6 -translate-y-1/2 items-center justify-center rounded-full bg-slate-800/70 text-slate-300 shadow-inner shadow-black/30">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-3.5 w-3.5">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.21 8.29a.75.75 0 0 1 .02-1.08z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </div>
                    @error('role')
                        <p class="text-xs text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div class="space-y-2.5">
                    <label for="status" class="{{ $adminLabelClass }}">Status <span class="text-rose-400">*</span></label>
                    <div class="relative w-full">
                        <select id="status" name="status" required class="@class([
                            $adminSelectClass,
                            'border-rose-500/80 focus:border-rose-400 focus:ring-rose-400/40 focus:shadow-rose-500/20' => $errors->has('status'),
                        ])">
                            <option value="active" class="bg-slate-900 text-white" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" class="bg-slate-900 text-white" {{ old('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        <span class="pointer-events-none absolute right-4 top-1/2 flex h-6 w-6 -translate-y-1/2 items-center justify-center rounded-full bg-slate-800/70 text-slate-300 shadow-inner shadow-black/30">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-3.5 w-3.5">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.21 8.29a.75.75 0 0 1 .02-1.08z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </div>
                    @error('status')
                        <p class="text-xs text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col gap-3 pt-6 sm:flex-row sm:items-center {{ $adminFormSectionDivider }}">
                    <button type="submit" class="{{ $adminPrimaryButtonClass }}">
                        Simpan User
                    </button>
                    <a href="{{ url()->previous() }}" class="{{ $adminSecondaryButtonClass }}">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
