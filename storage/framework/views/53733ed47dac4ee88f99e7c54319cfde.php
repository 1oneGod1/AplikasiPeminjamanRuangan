<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto">
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

    <div class="mb-8">
        <h1 class="text-3xl font-semibold text-white">Edit User</h1>
        <p class="text-sm text-slate-400 mt-2">Ubah data pengguna <span class="font-semibold text-slate-200"><?php echo e($user->name); ?></span> untuk menjaga data tetap mutakhir.</p>
    </div>

    <div class="<?php echo e($adminFormCardClass); ?>">
        <form action="<?php echo e(route('admin.users.update', $user->id)); ?>" method="POST" class="space-y-7">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="space-y-2.5">
                <label for="name" class="<?php echo e($adminLabelClass); ?>">Nama Lengkap <span class="text-rose-400">*</span></label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="<?php echo e(old('name', $user->name)); ?>"
                    class="class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        $adminInputClass,
                        'border-rose-500/80 focus:border-rose-400 focus:ring-rose-400/40 focus:shadow-rose-500/20' => $errors->has('name')
                    ]); ?>""
                    required
                >
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

            <div class="space-y-2.5">
                <label for="email" class="<?php echo e($adminLabelClass); ?>">Email <span class="text-rose-400">*</span></label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="<?php echo e(old('email', $user->email)); ?>"
                    class="class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        $adminInputClass,
                        'border-rose-500/80 focus:border-rose-400 focus:ring-rose-400/40 focus:shadow-rose-500/20' => $errors->has('email')
                    ]); ?>""
                    required
                >
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

            <div class="space-y-2.5">
                <label for="password" class="<?php echo e($adminLabelClass); ?>">Password Baru</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        $adminInputClass,
                        'border-rose-500/80 focus:border-rose-400 focus:ring-rose-400/40 focus:shadow-rose-500/20' => $errors->has('password')
                    ]); ?>""
                    minlength="8"
                >
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
                <p class="<?php echo e($adminHelperTextClass); ?>">Kosongkan jika tidak ingin mengubah password. Minimal 8 karakter.</p>
            </div>

            <div class="space-y-2.5">
                <label for="password_confirmation" class="<?php echo e($adminLabelClass); ?>">Konfirmasi Password Baru</label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    class="<?php echo e($adminInputClass); ?>"
                    minlength="8"
                >
            </div>

            <div class="space-y-2.5">
                <label for="phone" class="<?php echo e($adminLabelClass); ?>">No. Telepon</label>
                <input
                    type="text"
                    name="phone"
                    id="phone"
                    value="<?php echo e(old('phone', $user->phone)); ?>"
                    class="class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        $adminInputClass,
                        'border-rose-500/80 focus:border-rose-400 focus:ring-rose-400/40 focus:shadow-rose-500/20' => $errors->has('phone')
                    ]); ?>""
                >
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

            <div class="space-y-2.5">
                <label for="role" class="<?php echo e($adminLabelClass); ?>">Role <span class="text-rose-400">*</span></label>
                <div class="relative w-full">
                    <select
                        name="role"
                        id="role"
                        class="class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                            $adminSelectClass,
                            'border-rose-500/80 focus:border-rose-400 focus:ring-rose-400/40 focus:shadow-rose-500/20' => $errors->has('role')
                        ]); ?>""
                        required
                    >
                        <option value="" class="bg-slate-900 text-slate-400">Pilih Role</option>
                        <option value="kepala_sekolah" class="bg-slate-900 text-white" <?php echo e(old('role', $user->role) == 'kepala_sekolah' ? 'selected' : ''); ?>>Kepala Sekolah</option>
                        <option value="cleaning_service" class="bg-slate-900 text-white" <?php echo e(old('role', $user->role) == 'cleaning_service' ? 'selected' : ''); ?>>Cleaning Service</option>
                        <option value="peminjam" class="bg-slate-900 text-white" <?php echo e(old('role', $user->role) == 'peminjam' ? 'selected' : ''); ?>>Peminjam</option>
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

            <div class="space-y-2.5">
                <label for="status" class="<?php echo e($adminLabelClass); ?>">Status <span class="text-rose-400">*</span></label>
                <div class="relative w-full">
                    <select
                        name="status"
                        id="status"
                        class="class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                            $adminSelectClass,
                            'border-rose-500/80 focus:border-rose-400 focus:ring-rose-400/40 focus:shadow-rose-500/20' => $errors->has('status')
                        ]); ?>""
                        required
                    >
                        <option value="active" class="bg-slate-900 text-white" <?php echo e(old('status', $user->status) == 'active' ? 'selected' : ''); ?>>Aktif</option>
                        <option value="inactive" class="bg-slate-900 text-white" <?php echo e(old('status', $user->status) == 'inactive' ? 'selected' : ''); ?>>Tidak Aktif</option>
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

            <div class="flex flex-col gap-3 pt-6 sm:flex-row sm:justify-end sm:items-center <?php echo e($adminFormSectionDivider); ?>">
                <a
                    href="<?php echo e(url()->previous()); ?>"
                    class="<?php echo e($adminSecondaryButtonClass); ?>"
                >
                    Batal
                </a>
                <button
                    type="submit"
                    class="<?php echo e($adminPrimaryButtonClass); ?>"
                >
                    Update User
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Semester 4\ENG\ALP\Booking-Ruangan\resources\views/admin/users/edit.blade.php ENDPATH**/ ?>