<?php $__env->startSection('content'); ?>

<div class="max-w-3xl">
    <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm p-6">
        <form action="<?php echo e(route('admin.users.store', $role ?? '')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="space-y-6">
                <!-- Nama Lengkap -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-slate-100 mb-2">Nama Lengkap <span class="text-red-400">*</span></label>
                    <input type="text" id="name" name="name" value="<?php echo e(old('name')); ?>" required
                                 class="w-full px-4 py-2 border border-white/20 bg-white/10 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                 placeholder="Nama Lengkap">
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-400"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-100 mb-2">Email <span class="text-red-400">*</span></label>
                    <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" required
                                 class="w-full px-4 py-2 border border-white/20 bg-white/10 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                 placeholder="Email">
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-400"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-100 mb-2">Password <span class="text-red-400">*</span></label>
                    <input type="password" id="password" name="password" required minlength="8"
                                 class="w-full px-4 py-2 border border-white/20 bg-white/10 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                 placeholder="Password">
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-400"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                    <input type="text" id="phone" name="phone" value="<?php echo e(old('phone')); ?>"
                                 class="w-full px-4 py-2 border border-white/20 bg-white/10 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                 placeholder="No. Telepon">
                    <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-400"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Role -->
                <div>
                    <label for="role" class="block text-sm font-semibold text-slate-100 mb-2">Role <span class="text-red-400">*</span></label>
                                <select id="role" name="role" required class="w-full px-4 py-2 border border-white/20 bg-slate-800 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="" class="bg-slate-800 text-slate-400">Pilih Role</option>
                                    <option value="kepala_sekolah" class="bg-slate-800 text-white" <?php echo e((old('role', $role ?? '') == 'kepala_sekolah') ? 'selected' : ''); ?>>Kepala Sekolah</option>
                                    <option value="cleaning_service" class="bg-slate-800 text-white" <?php echo e((old('role', $role ?? '') == 'cleaning_service') ? 'selected' : ''); ?>>Cleaning Service</option>
                                    <option value="peminjam" class="bg-slate-800 text-white" <?php echo e((old('role', $role ?? '') == 'peminjam') ? 'selected' : ''); ?>>Peminjam</option>
                                </select>
                    <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-400"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-semibold text-slate-100 mb-2">Status <span class="text-red-400">*</span></label>
                                <select id="status" name="status" required class="w-full px-4 py-2 border border-white/20 bg-slate-800 text-white placeholder-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="active" class="bg-slate-800 text-white" <?php echo e(old('status') == 'active' ? 'selected' : ''); ?>>Aktif</option>
                                    <option value="inactive" class="bg-slate-800 text-white" <?php echo e(old('status') == 'inactive' ? 'selected' : ''); ?>>Tidak Aktif</option>
                                </select>
                    <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-400"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center gap-3 pt-4 border-t border-white/10">
                    <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-xl font-semibold hover:bg-blue-600 transition-colors shadow-lg shadow-blue-500/30">
                        Simpan User
                    </button>
                    <a href="<?php echo e(url()->previous()); ?>" class="px-6 py-2 border border-white/20 text-slate-100 rounded-xl hover:bg-white/10 transition-colors">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Semester 4\ENG\ALP\Booking-Ruangan\resources\views/admin/users/create.blade.php ENDPATH**/ ?>