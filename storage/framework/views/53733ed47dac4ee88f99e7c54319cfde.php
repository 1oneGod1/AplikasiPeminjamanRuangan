<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Edit User</h1>
        <p class="text-gray-600 mt-1">Ubah data user: <?php echo e($user->name); ?></p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="<?php echo e(route('admin.users.update', $user->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    value="<?php echo e(old('name', $user->name)); ?>"
                    class="class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent',
                        'border-red-500' => $errors->has('name'),
                        'border-gray-300' => !$errors->has('name')
                    ]); ?>""
                    required
                >
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Email <span class="text-red-500">*</span>
                </label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    value="<?php echo e(old('email', $user->email)); ?>"
                    class="class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent',
                        'border-red-500' => $errors->has('email'),
                        'border-gray-300' => !$errors->has('email')
                    ]); ?>""
                    required
                >
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Password Baru
                </label>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    class="class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent',
                        'border-red-500' => $errors->has('password'),
                        'border-gray-300' => !$errors->has('password')
                    ]); ?>""
                    minlength="8"
                >
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <p class="mt-1 text-xs text-gray-500">Kosongkan jika tidak ingin mengubah password. Minimal 8 karakter.</p>
            </div>

            <!-- Password Confirmation -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                    Konfirmasi Password Baru
                </label>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    id="password_confirmation" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    minlength="8"
                >
            </div>

            <!-- Phone -->
            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                    No. Telepon
                </label>
                <input 
                    type="text" 
                    name="phone" 
                    id="phone" 
                    value="<?php echo e(old('phone', $user->phone)); ?>"
                    class="class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent',
                        'border-red-500' => $errors->has('phone'),
                        'border-gray-300' => !$errors->has('phone')
                    ]); ?>""
                >
                <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Role -->
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                    Role <span class="text-red-500">*</span>
                </label>
                <select 
                    name="role" 
                    id="role" 
                    class="class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent',
                        'border-red-500' => $errors->has('role'),
                        'border-gray-300' => !$errors->has('role')
                    ]); ?>""
                    required
                >
                    <option value="">Pilih Role</option>
                    <option value="kepala_sekolah" <?php echo e(old('role', $user->role) == 'kepala_sekolah' ? 'selected' : ''); ?>>Kepala Sekolah</option>
                    <option value="cleaning_service" <?php echo e(old('role', $user->role) == 'cleaning_service' ? 'selected' : ''); ?>>Cleaning Service</option>
                    <option value="peminjam" <?php echo e(old('role', $user->role) == 'peminjam' ? 'selected' : ''); ?>>Peminjam</option>
                </select>
                <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Status -->
            <div class="mb-6">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                    Status <span class="text-red-500">*</span>
                </label>
                <select 
                    name="status" 
                    id="status" 
                    class="class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent',
                        'border-red-500' => $errors->has('status'),
                        'border-gray-300' => !$errors->has('status')
                    ]); ?>""
                    required
                >
                    <option value="active" <?php echo e(old('status', $user->status) == 'active' ? 'selected' : ''); ?>>Aktif</option>
                    <option value="inactive" <?php echo e(old('status', $user->status) == 'inactive' ? 'selected' : ''); ?>>Tidak Aktif</option>
                </select>
                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-3">
                <a 
                    href="<?php echo e(url()->previous()); ?>" 
                    class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors"
                >
                    Batal
                </a>
                <button 
                    type="submit" 
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                >
                    Update User
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Semester 4\ENG\ALP\Booking-Ruangan\resources\views/admin/users/edit.blade.php ENDPATH**/ ?>