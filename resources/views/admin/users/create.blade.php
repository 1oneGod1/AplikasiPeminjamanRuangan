@extends('admin.layouts.app')

@section('content')

<div class="max-w-3xl">
    <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm p-6">
        <form action="{{ route('admin.users.store', $role ?? '') }}" method="POST">
            @csrf
            <div class="space-y-6">
                <!-- Nama Lengkap -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-slate-100 mb-2">Nama Lengkap <span class="text-red-400">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                 class="@class([
                                     'w-full px-4 py-2 border bg-white/10 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500',
                                     'border-red-500' => $errors->has('name'),
                                     'border-white/20' => !$errors->has('name'),
                                 ])"
                                 placeholder="Nama Lengkap">
                    @error('name')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-100 mb-2">Email <span class="text-red-400">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                 class="@class([
                                     'w-full px-4 py-2 border bg-white/10 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500',
                                     'border-red-500' => $errors->has('email'),
                                     'border-white/20' => !$errors->has('email'),
                                 ])"
                                 placeholder="Email">
                    @error('email')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-100 mb-2">Password <span class="text-red-400">*</span></label>
                    <input type="password" id="password" name="password" required minlength="8"
                                 class="@class([
                                     'w-full px-4 py-2 border bg-white/10 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500',
                                     'border-red-500' => $errors->has('password'),
                                     'border-white/20' => !$errors->has('password'),
                                 ])"
                                 placeholder="Password">
                    @error('password')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-slate-400">Minimal 8 karakter</p>
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-slate-100 mb-2">Konfirmasi Password <span class="text-red-400">*</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required minlength="8"
                                 class="w-full px-4 py-2 border border-white/20 bg-white/10 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                 placeholder="Konfirmasi Password">
                </div>

                <!-- No. Telepon -->
                <div>
                    <label for="phone" class="block text-sm font-semibold text-slate-100 mb-2">No. Telepon</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                 class="@class([
                                     'w-full px-4 py-2 border bg-white/10 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500',
                                     'border-red-500' => $errors->has('phone'),
                                     'border-white/20' => !$errors->has('phone'),
                                 ])"
                                 placeholder="No. Telepon">
                    @error('phone')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role -->
                <div>
                    <label for="role" class="block text-sm font-semibold text-slate-100 mb-2">Role <span class="text-red-400">*</span></label>
                                <select id="role" name="role" required class="@class([
                                    'w-full px-4 py-2 border bg-slate-800 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500',
                                    'border-red-500' => $errors->has('role'),
                                    'border-white/20' => !$errors->has('role'),
                                ])">
                                    <option value="" class="bg-slate-800 text-slate-400">Pilih Role</option>
                                    <option value="kepala_sekolah" class="bg-slate-800 text-white" {{ (old('role', $role ?? '') == 'kepala_sekolah') ? 'selected' : '' }}>Kepala Sekolah</option>
                                    <option value="cleaning_service" class="bg-slate-800 text-white" {{ (old('role', $role ?? '') == 'cleaning_service') ? 'selected' : '' }}>Cleaning Service</option>
                                    <option value="peminjam" class="bg-slate-800 text-white" {{ (old('role', $role ?? '') == 'peminjam') ? 'selected' : '' }}>Peminjam</option>
                                </select>
                    @error('role')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-semibold text-slate-100 mb-2">Status <span class="text-red-400">*</span></label>
                                <select id="status" name="status" required class="@class([
                                    'w-full px-4 py-2 border bg-slate-800 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500',
                                    'border-red-500' => $errors->has('status'),
                                    'border-white/20' => !$errors->has('status'),
                                ])">
                                    <option value="active" class="bg-slate-800 text-white" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="inactive" class="bg-slate-800 text-white" {{ old('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center gap-3 pt-4 border-t border-white/10">
                    <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-xl font-semibold hover:bg-blue-600 transition-colors shadow-lg shadow-blue-500/30">
                        Simpan User
                    </button>
                    <a href="{{ url()->previous() }}" class="px-6 py-2 border border-white/20 text-slate-100 rounded-xl hover:bg-white/10 transition-colors">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
