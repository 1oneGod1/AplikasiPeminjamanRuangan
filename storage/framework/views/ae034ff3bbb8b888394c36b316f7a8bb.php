<?php $__env->startSection('content'); ?>

<div class="max-w-4xl">
    <?php
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
    ?>
    <div class="<?php echo e($adminFormCardClass); ?>">
        <form action="<?php echo e(route('admin.users.store', $role ?? '')); ?>" method="POST" class="space-y-10">
            <?php echo csrf_field(); ?>
            <div class="space-y-7">
                <div class="space-y-2.5">
                    <h3 class="<?php echo e($adminFormHeaderClass); ?>">Tambah pengguna baru</h3>
                    <p class="<?php echo e($adminFormSubtextClass); ?>">Lengkapi detail akun agar setiap peran memperoleh akses sesuai kebutuhan operasional.</p>
                </div>
                <!-- Nama Lengkap -->
                <div class="space-y-2.5">
                    <label for="name" class="<?php echo e($adminLabelClass); ?>">Nama Lengkap <span class="text-rose-400">*</span></label>
                    <input type="text" id="name" name="name" value="<?php echo e(old('name')); ?>" required
                           class="class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                               $adminInputClass,
                               'border-rose-500/80 focus:border-rose-400 focus:ring-rose-400/40 focus:shadow-rose-500/20' => $errors->has('name'),
                           ]); ?>""
                           placeholder="Nama Lengkap">
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-xs text-rose-400"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Email -->
                <div class="space-y-2.5">
                    <label for="email" class="<?php echo e($adminLabelClass); ?>">Email <span class="text-rose-400">*</span></label>
                    <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" required
                           class="class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                               $adminInputClass,
                               'border-rose-500/80 focus:border-rose-400 focus:ring-rose-400/40 focus:shadow-rose-500/20' => $errors->has('email'),
                           ]); ?>""
                           placeholder="Email">
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-xs text-rose-400"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Password -->
                <div class="space-y-2.5">
                    <label for="password" class="<?php echo e($adminLabelClass); ?>">Password <span class="text-rose-400">*</span></label>
                    <input type="password" id="password" name="password" required minlength="8"
                           class="class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                               $adminInputClass,
                               'border-rose-500/80 focus:border-rose-400 focus:ring-rose-400/40 focus:shadow-rose-500/20' => $errors->has('password'),
                           ]); ?>""
                           placeholder="Password">
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-xs text-rose-400"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <p class="<?php echo e($adminHelperTextClass); ?>">Minimal 8 karakter.</p>
                </div>

                <!-- Konfirmasi Password -->
                <div class="space-y-2.5">
                    <label for="password_confirmation" class="<?php echo e($adminLabelClass); ?>">Konfirmasi Password <span class="text-rose-400">*</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required minlength="8"
                           class="<?php echo e($adminInputClass); ?>"
                           placeholder="Konfirmasi Password">
                </div>

                <!-- No. Telepon -->
                <div class="space-y-2.5">
                    <label for="phone" class="<?php echo e($adminLabelClass); ?>">No. Telepon</label>
                    <input type="text" id="phone" name="phone" value="<?php echo e(old('phone')); ?>"
                           class="class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                               $adminInputClass,
                               'border-rose-500/80 focus:border-rose-400 focus:ring-rose-400/40 focus:shadow-rose-500/20' => $errors->has('phone'),
                           ]); ?>""
                           placeholder="No. Telepon">
                    <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-xs text-rose-400"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Role -->
                <div class="space-y-2.5">
                    <label for="role" class="<?php echo e($adminLabelClass); ?>">Role <span class="text-rose-400">*</span></label>
                    <div class="relative w-full">
                        <select id="role" name="role" required class="class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                            $adminSelectClass,
                            'border-rose-500/80 focus:border-rose-400 focus:ring-rose-400/40 focus:shadow-rose-500/20' => $errors->has('role'),
                        ]); ?>"">
                            <option value="" class="bg-slate-900 text-slate-400">Pilih Role</option>
                            <option value="kepala_sekolah" class="bg-slate-900 text-white" <?php echo e((old('role', $role ?? '') == 'kepala_sekolah') ? 'selected' : ''); ?>>Kepala Sekolah</option>
                            <option value="cleaning_service" class="bg-slate-900 text-white" <?php echo e((old('role', $role ?? '') == 'cleaning_service') ? 'selected' : ''); ?>>Cleaning Service</option>
                            <option value="peminjam" class="bg-slate-900 text-white" <?php echo e((old('role', $role ?? '') == 'peminjam') ? 'selected' : ''); ?>>Peminjam</option>
                        </select>
                        <span class="pointer-events-none absolute right-4 top-1/2 flex h-6 w-6 -translate-y-1/2 items-center justify-center rounded-full bg-slate-800/70 text-slate-300 shadow-inner shadow-black/30">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-3.5 w-3.5">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.21 8.29a.75.75 0 0 1 .02-1.08z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </div>
                    <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-xs text-rose-400"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Status -->
                <div class="space-y-2.5">
                    <label for="status" class="<?php echo e($adminLabelClass); ?>">Status <span class="text-rose-400">*</span></label>
                    <div class="relative w-full">
                        <select id="status" name="status" required class="class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                            $adminSelectClass,
                            'border-rose-500/80 focus:border-rose-400 focus:ring-rose-400/40 focus:shadow-rose-500/20' => $errors->has('status'),
                        ]); ?>"">
                            <option value="active" class="bg-slate-900 text-white" <?php echo e(old('status') == 'active' ? 'selected' : ''); ?>>Aktif</option>
                            <option value="inactive" class="bg-slate-900 text-white" <?php echo e(old('status') == 'inactive' ? 'selected' : ''); ?>>Tidak Aktif</option>
                        </select>
                        <span class="pointer-events-none absolute right-4 top-1/2 flex h-6 w-6 -translate-y-1/2 items-center justify-center rounded-full bg-slate-800/70 text-slate-300 shadow-inner shadow-black/30">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-3.5 w-3.5">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.21 8.29a.75.75 0 0 1 .02-1.08z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </div>
                    <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-xs text-rose-400"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col gap-3 pt-6 sm:flex-row sm:items-center <?php echo e($adminFormSectionDivider); ?>">
                    <button type="submit" class="<?php echo e($adminPrimaryButtonClass); ?>">
                        Simpan User
                    </button>
                    <a href="<?php echo e(url()->previous()); ?>" class="<?php echo e($adminSecondaryButtonClass); ?>">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Semester 4\ENG\ALP\Booking-Ruangan\resources\views/admin/users/create.blade.php ENDPATH**/ ?>