@extends('admin.layouts.app')

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
        $adminCheckboxClass = $adminCheckboxClass ?? $adminFormDefaults['checkbox'];
        $adminPrimaryButtonClass = $adminPrimaryButtonClass ?? $adminFormDefaults['primary_button'];
        $adminSecondaryButtonClass = $adminSecondaryButtonClass ?? $adminFormDefaults['secondary_button'];
        $adminFormSectionDivider = $adminFormSectionDivider ?? $adminFormDefaults['divider'];
    @endphp

    <div class="mb-8">
        <h1 class="text-3xl font-semibold text-white">Edit User</h1>
        <p class="text-sm text-slate-400 mt-2">Ubah data pengguna <span class="font-semibold text-slate-200">{{ $user->name }}</span> untuk menjaga data tetap mutakhir.</p>
    </div>

    <div class="{{ $adminFormCardClass }}">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-7">
            @csrf
            @method('PUT')

            <div class="space-y-2.5">
                <label for="name" class="{{ $adminLabelClass }}">Nama Lengkap <span class="text-rose-400">*</span></label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name', $user->name) }}"
                    class="@class([
                        $adminInputClass,
                        'border-rose-500/80 focus:border-rose-400 focus:ring-rose-400/40 focus:shadow-rose-500/20' => $errors->has('name')
                    ])"
                    required
                >
                @error('name')
                    <p class="text-xs text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2.5">
                <label for="email" class="{{ $adminLabelClass }}">Email <span class="text-rose-400">*</span></label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email', $user->email) }}"
                    class="@class([
                        $adminInputClass,
                        'border-rose-500/80 focus:border-rose-400 focus:ring-rose-400/40 focus:shadow-rose-500/20' => $errors->has('email')
                    ])"
                    required
                >
                @error('email')
                    <p class="text-xs text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2.5">
                <label for="password" class="{{ $adminLabelClass }}">Password Baru</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="@class([
                        $adminInputClass,
                        'border-rose-500/80 focus:border-rose-400 focus:ring-rose-400/40 focus:shadow-rose-500/20' => $errors->has('password')
                    ])"
                    minlength="8"
                >
                @error('password')
                    <p class="text-xs text-rose-400">{{ $message }}</p>
                @enderror
                <p class="{{ $adminHelperTextClass }}">Kosongkan jika tidak ingin mengubah password. Minimal 8 karakter.</p>
            </div>

            <div class="space-y-2.5">
                <label for="password_confirmation" class="{{ $adminLabelClass }}">Konfirmasi Password Baru</label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    class="{{ $adminInputClass }}"
                    minlength="8"
                >
            </div>

            <div class="space-y-2.5">
                <label for="phone" class="{{ $adminLabelClass }}">No. Telepon</label>
                <input
                    type="text"
                    name="phone"
                    id="phone"
                    value="{{ old('phone', $user->phone) }}"
                    class="@class([
                        $adminInputClass,
                        'border-rose-500/80 focus:border-rose-400 focus:ring-rose-400/40 focus:shadow-rose-500/20' => $errors->has('phone')
                    ])"
                >
                @error('phone')
                    <p class="text-xs text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2.5">
                <label for="role" class="{{ $adminLabelClass }}">Role <span class="text-rose-400">*</span></label>
                <div class="relative w-full">
                    <select
                        name="role"
                        id="role"
                        class="@class([
                            $adminSelectClass,
                            'border-rose-500/80 focus:border-rose-400 focus:ring-rose-400/40 focus:shadow-rose-500/20' => $errors->has('role')
                        ])"
                        required
                    >
                        <option value="" class="bg-slate-900 text-slate-400">Pilih Role</option>
                        <option value="kepala_sekolah" class="bg-slate-900 text-white" {{ old('role', $user->role) == 'kepala_sekolah' ? 'selected' : '' }}>Kepala Sekolah</option>
                        <option value="cleaning_service" class="bg-slate-900 text-white" {{ old('role', $user->role) == 'cleaning_service' ? 'selected' : '' }}>Cleaning Service</option>
                        <option value="peminjam" class="bg-slate-900 text-white" {{ old('role', $user->role) == 'peminjam' ? 'selected' : '' }}>Peminjam</option>
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

            <div class="space-y-2.5">
                <label for="status" class="{{ $adminLabelClass }}">Status <span class="text-rose-400">*</span></label>
                <div class="relative w-full">
                    <select
                        name="status"
                        id="status"
                        class="@class([
                            $adminSelectClass,
                            'border-rose-500/80 focus:border-rose-400 focus:ring-rose-400/40 focus:shadow-rose-500/20' => $errors->has('status')
                        ])"
                        required
                    >
                        <option value="active" class="bg-slate-900 text-white" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" class="bg-slate-900 text-white" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
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

            <div class="flex flex-col gap-3 pt-6 sm:flex-row sm:justify-end sm:items-center {{ $adminFormSectionDivider }}">
                <a
                    href="{{ url()->previous() }}"
                    class="{{ $adminSecondaryButtonClass }}"
                >
                    Batal
                </a>
                <button
                    type="submit"
                    class="{{ $adminPrimaryButtonClass }}"
                >
                    Update User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
