

<?php $__env->startSection('title', 'Ajukan Peminjaman'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-slate-100 dark:bg-slate-950 min-h-screen pb-16">
	<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">
		<a href="<?php echo e(route('dashboard')); ?>" class="inline-flex items-center text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white transition">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-5 h-5 mr-2">
				<path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
			</svg>
			Kembali ke Dashboard
		</a>

		<div class="space-y-3">
			<h1 class="text-3xl font-semibold text-slate-900 dark:text-white">Ajukan Peminjaman Ruangan</h1>
			<p class="text-slate-600 dark:text-slate-300 text-sm sm:text-base">Lengkapi formulir berikut untuk mengajukan peminjaman ruangan. Pastikan informasi yang kamu isi sesuai dengan kebutuhan kegiatan.</p>
		</div>

		<?php if($errors->has('booking')): ?>
			<div class="rounded-xl border border-red-300 bg-red-50 text-red-700 dark:border-red-500 dark:bg-red-500/10 dark:text-red-200 px-4 py-3 text-sm">
				<?php echo e($errors->first('booking')); ?>

			</div>
		<?php endif; ?>

		<?php if($errors->any() && !$errors->has('booking')): ?>
			<div class="rounded-xl border border-red-300 bg-red-50 text-red-700 dark:border-red-500 dark:bg-red-500/10 dark:text-red-200 px-4 py-3 text-sm">
				Terdapat beberapa kesalahan pada formulir. Silakan periksa kembali isianmu.
			</div>
		<?php endif; ?>

		<div class="grid gap-6 md:grid-cols-5">
			<div class="md:col-span-2 space-y-4">
				<div class="rounded-3xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-6 shadow-sm">
					<h2 class="text-lg font-semibold text-slate-900 dark:text-white">Info Ruangan</h2>
					<div class="mt-4 space-y-4 text-sm text-slate-600 dark:text-slate-300">
						<div>
							<p class="text-xs uppercase tracking-wide text-slate-400">Nama</p>
							<p class="font-medium text-slate-900 dark:text-white"><?php echo e($room->name); ?></p>
						</div>
						<div>
							<p class="text-xs uppercase tracking-wide text-slate-400">Lokasi</p>
							<p><?php echo e($room->location ?? 'Lokasi belum diatur'); ?></p>
						</div>
						<div class="flex items-center justify-between">
							<div>
								<p class="text-xs uppercase tracking-wide text-slate-400">Tipe</p>
								<p><?php echo e(ucfirst(str_replace('_', ' ', $room->type ?? 'umum'))); ?></p>
							</div>
							<div class="text-right">
								<p class="text-xs uppercase tracking-wide text-slate-400">Kapasitas</p>
								<p><?php echo e($room->capacity); ?> orang</p>
							</div>
						</div>
						<div>
							<p class="text-xs uppercase tracking-wide text-slate-400">Fasilitas</p>
							<?php if($room->facilities): ?>
								<ul class="mt-2 space-y-1">
									<?php $__currentLoopData = preg_split('/[,;]+/', $room->facilities); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php if(trim($facility) !== ''): ?>
											<li class="inline-flex items-center rounded-full bg-slate-100 dark:bg-slate-800 px-3 py-1 text-xs mr-2 mb-2"><?php echo e(trim($facility)); ?></li>
										<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</ul>
							<?php else: ?>
								<p>Fasilitas belum diatur.</p>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>

			<div class="md:col-span-3">
				<form action="<?php echo e(route('bookings.store')); ?>" method="POST" class="rounded-3xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-6 shadow-sm space-y-5">
					<?php echo csrf_field(); ?>
					<input type="hidden" name="room_id" value="<?php echo e($room->id); ?>">

					<div class="grid sm:grid-cols-2 gap-4">
						<div>
							<label class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-300">Tanggal</label>
							<input type="date" name="booking_date" value="<?php echo e(old('booking_date', $prefill['date'])); ?>" class="mt-2 w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-950/60 px-3 py-2 text-sm text-slate-900 dark:text-slate-100 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/50" required>
							<?php $__errorArgs = ['booking_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
								<p class="mt-2 text-xs text-red-500"><?php echo e($message); ?></p>
							<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
						</div>
						<div class="grid grid-cols-2 gap-4">
							<div>
								<label class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-300">Mulai</label>
								<input type="time" name="start_time" value="<?php echo e(old('start_time', $prefill['start_time'])); ?>" class="mt-2 w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-950/60 px-3 py-2 text-sm text-slate-900 dark:text-slate-100 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/50" required>
								<?php $__errorArgs = ['start_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
									<p class="mt-2 text-xs text-red-500"><?php echo e($message); ?></p>
								<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
							</div>
							<div>
								<label class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-300">Selesai</label>
								<input type="time" name="end_time" value="<?php echo e(old('end_time', $prefill['end_time'])); ?>" class="mt-2 w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-950/60 px-3 py-2 text-sm text-slate-900 dark:text-slate-100 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/50" required>
								<?php $__errorArgs = ['end_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
									<p class="mt-2 text-xs text-red-500"><?php echo e($message); ?></p>
								<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
							</div>
						</div>
					</div>

					<div>
						<label class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-300">Jumlah Peserta</label>
						<input type="number" min="1" name="participants" value="<?php echo e(old('participants')); ?>" placeholder="Contoh: 25" class="mt-2 w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-950/60 px-3 py-2 text-sm text-slate-900 dark:text-slate-100 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/50" required>
						<?php $__errorArgs = ['participants'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
							<p class="mt-2 text-xs text-red-500"><?php echo e($message); ?></p>
						<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
					</div>

					<div>
						<label class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-300">Tujuan Peminjaman</label>
						<textarea name="purpose" rows="4" placeholder="Jelaskan kegiatan yang akan dilaksanakan" class="mt-2 w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-950/60 px-3 py-2 text-sm text-slate-900 dark:text-slate-100 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/50" required><?php echo e(old('purpose')); ?></textarea>
						<?php $__errorArgs = ['purpose'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
							<p class="mt-2 text-xs text-red-500"><?php echo e($message); ?></p>
						<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
					</div>

					<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
						<p class="text-xs text-slate-500 dark:text-slate-400">Pengajuan akan ditinjau oleh admin. Kamu akan menerima notifikasi setelah disetujui atau ditolak.</p>
						<button type="submit" class="inline-flex items-center justify-center rounded-xl bg-yellow-400 px-5 py-3 text-sm font-semibold text-slate-900 shadow hover:bg-yellow-300 transition">
							Ajukan Sekarang
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Semester 4\ENG\ALP\Booking-Ruangan\resources\views/bookings/create.blade.php ENDPATH**/ ?>