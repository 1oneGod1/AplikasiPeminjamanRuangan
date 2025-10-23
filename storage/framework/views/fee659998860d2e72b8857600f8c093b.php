

<?php $__env->startSection('title', 'Riwayat Peminjaman'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-slate-100 dark:bg-slate-950 min-h-screen pb-20">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-10">
		<div class="flex flex-wrap items-start justify-between gap-6">
			<div class="space-y-2">
				<p class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Navigasi</p>
				<h1 class="text-3xl sm:text-4xl font-semibold text-slate-900 dark:text-white">Riwayat Peminjaman</h1>
				<p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 max-w-2xl">Lihat seluruh riwayat pengajuan peminjamanmu, lengkap dengan status, jadwal, dan catatan dari admin.</p>
			</div>
			<a href="<?php echo e(route('dashboard')); ?>" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 dark:border-slate-800 px-4 py-2 text-sm font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" class="w-4 h-4">
					<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
				</svg>
				<span>Kembali ke Dashboard</span>
			</a>
		</div>

		<section class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
			<?php
				$statCards = [
					['label' => 'Total', 'value' => $statistics['total'] ?? 0],
					['label' => 'Menunggu', 'value' => $statistics['pending'] ?? 0],
					['label' => 'Disetujui', 'value' => $statistics['approved'] ?? 0],
					['label' => 'Ditolak', 'value' => $statistics['rejected'] ?? 0],
					['label' => 'Dibatalkan', 'value' => $statistics['cancelled'] ?? 0],
					['label' => 'Selesai', 'value' => $statistics['completed'] ?? 0],
				];
			?>

			<?php $__currentLoopData = $statCards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-5 shadow-sm">
					<p class="text-xs uppercase tracking-wide text-slate-500 dark:text-slate-400"><?php echo e($card['label']); ?></p>
					<p class="mt-3 text-3xl font-semibold text-slate-900 dark:text-white"><?php echo e($card['value']); ?></p>
				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</section>

		<section class="space-y-6">
			<form method="GET" class="rounded-3xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-6 shadow-sm space-y-5">
				<div class="grid gap-4 md:grid-cols-4">
					<label class="block">
						<span class="block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Status</span>
						<select name="status" class="mt-2 w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-950/60 px-3 py-2 text-sm text-slate-900 dark:text-slate-100 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/50">
							<?php $__currentLoopData = $statusOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($value); ?>" <?php echo e($filters['status'] === $value ? 'selected' : ''); ?>><?php echo e($label); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</label>
					<label class="block">
						<span class="block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Tanggal Mulai</span>
						<input type="date" name="date_from" value="<?php echo e($filters['date_from']); ?>" class="mt-2 w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-950/60 px-3 py-2 text-sm text-slate-900 dark:text-slate-100 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/50">
					</label>
					<label class="block">
						<span class="block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Tanggal Akhir</span>
						<input type="date" name="date_to" value="<?php echo e($filters['date_to']); ?>" class="mt-2 w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-950/60 px-3 py-2 text-sm text-slate-900 dark:text-slate-100 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/50">
					</label>
					<div class="flex items-end">
						<button type="submit" class="inline-flex items-center justify-center gap-2 w-full rounded-xl bg-yellow-400 px-4 py-2 text-sm font-semibold text-slate-900 shadow hover:bg-yellow-300 transition">
							<span>Terapkan Filter</span>
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
								<path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h18m-10.5 6h10.5m-7.5 6h7.5" />
							</svg>
						</button>
					</div>
				</div>

				<?php if(array_filter($filters)): ?>
					<div class="flex items-center justify-between gap-3 text-xs text-slate-500 dark:text-slate-400">
						<p>Menampilkan riwayat berdasarkan filter yang dipilih.</p>
						<a href="<?php echo e(route('bookings.history')); ?>" class="inline-flex items-center gap-1 font-semibold text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
								<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m-15 0h15v15" />
							</svg>
							<span>Reset</span>
						</a>
					</div>
				<?php endif; ?>

				<?php $__errorArgs = ['date_to'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
					<p class="text-xs text-red-500"><?php echo e($message); ?></p>
				<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
			</form>

			<div class="rounded-3xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 overflow-hidden">
				<table class="min-w-full divide-y divide-slate-200 dark:divide-slate-800 text-sm">
					<thead class="bg-slate-50 dark:bg-slate-800 text-slate-500 dark:text-slate-300">
						<tr>
							<th class="px-6 py-3 text-left font-medium">ID</th>
							<th class="px-6 py-3 text-left font-medium">Ruangan</th>
							<th class="px-6 py-3 text-left font-medium">Jadwal</th>
							<th class="px-6 py-3 text-left font-medium">Peserta</th>
							<th class="px-6 py-3 text-left font-medium">Status</th>
							<th class="px-6 py-3 text-left font-medium">Catatan</th>
						</tr>
					</thead>
					<tbody class="divide-y divide-slate-200 dark:divide-slate-800">
						<?php
							$statusColors = [
								'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-300/10 dark:text-yellow-300',
								'approved' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-400/10 dark:text-emerald-300',
								'rejected' => 'bg-red-100 text-red-700 dark:bg-red-400/10 dark:text-red-300',
								'cancelled' => 'bg-slate-100 text-slate-600 dark:bg-slate-500/10 dark:text-slate-300',
								'completed' => 'bg-blue-100 text-blue-700 dark:bg-blue-400/10 dark:text-blue-300',
							];
						?>

						<?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
							<tr class="hover:bg-slate-50 dark:hover:bg-slate-800/70 transition">
								<td class="px-6 py-4 font-semibold text-slate-700 dark:text-slate-200">#<?php echo e($booking->id); ?></td>
								<td class="px-6 py-4 text-slate-600 dark:text-slate-300 space-y-2">
									<p class="font-medium text-slate-800 dark:text-slate-100"><?php echo e($booking->room->name ?? 'Ruangan tidak tersedia'); ?></p>
									<?php if($booking->purpose): ?>
										<button type="button" data-purpose-modal-trigger data-purpose="<?php echo e(e($booking->purpose)); ?>" data-purpose-title="Tujuan · Pengajuan #<?php echo e($booking->id); ?>" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-600 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-yellow-400 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800">
											<span>Lihat tujuan</span>
											<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-3.5 w-3.5">
												<path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
											</svg>
										</button>
									<?php else: ?>
										<p class="text-xs text-slate-500 dark:text-slate-400">Tujuan tidak diisi.</p>
									<?php endif; ?>
								</td>
								<td class="px-6 py-4 text-slate-600 dark:text-slate-300">
									<p class="font-medium"><?php echo e(\Illuminate\Support\Carbon::parse($booking->booking_date)->translatedFormat('d M Y')); ?></p>
									<p class="text-xs text-slate-500 dark:text-slate-400 mt-1"><?php echo e(substr($booking->start_time, 0, 5)); ?> - <?php echo e(substr($booking->end_time, 0, 5)); ?></p>
								</td>
								<td class="px-6 py-4 text-slate-600 dark:text-slate-300"><?php echo e($booking->participants); ?> orang</td>
								<td class="px-6 py-4">
									<?php
										$badgeClass = $statusColors[$booking->status] ?? 'bg-slate-100 text-slate-600 dark:bg-slate-500/10 dark:text-slate-300';
									?>
									<span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold <?php echo e($badgeClass); ?>">
										<?php echo e(ucfirst($booking->status)); ?>

									</span>
								</td>
								<td class="px-6 py-4 text-xs text-slate-500 dark:text-slate-400 space-y-1">
									<?php if($booking->status === 'rejected' && $booking->rejection_reason): ?>
										<p>Alasan penolakan: <span class="font-medium text-red-600 dark:text-red-300"><?php echo e($booking->rejection_reason); ?></span></p>
									<?php endif; ?>
									<?php if($booking->status === 'approved' && $booking->approved_at): ?>
										<p>Disetujui pada <?php echo e(\Illuminate\Support\Carbon::parse($booking->approved_at)->translatedFormat('d M Y \p\u\k\u\l H:i')); ?></p>
									<?php endif; ?>
									<?php if($booking->status === 'cancelled'): ?>
										<p>Pengajuan dibatalkan olehmu.</p>
									<?php endif; ?>
									<?php if($booking->status === 'pending'): ?>
										<p>Menunggu persetujuan admin.</p>
									<?php endif; ?>
									<?php if($booking->status === 'completed'): ?>
										<p>Kegiatan telah selesai dilaksanakan.</p>
									<?php endif; ?>
									<p>Diajukan pada <?php echo e(\Illuminate\Support\Carbon::parse($booking->created_at)->translatedFormat('d M Y \p\u\k\u\l H:i')); ?></p>
								</td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
							<tr>
								<td colspan="6" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">Belum ada riwayat peminjaman yang cocok dengan filter saat ini.</td>
							</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>

			<?php if($bookings->hasPages()): ?>
				<div class="flex items-center justify-between gap-3 text-sm text-slate-600 dark:text-slate-300">
					<p>Menampilkan <?php echo e($bookings->firstItem()); ?>-<?php echo e($bookings->lastItem()); ?> dari <?php echo e($bookings->total()); ?> data.</p>
					<?php echo e($bookings->onEachSide(1)->links()); ?>

				</div>
			<?php endif; ?>
		</section>
	</div>
</div>

<?php echo $__env->make('components.purpose-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Semester 4\ENG\ALP\Booking-Ruangan\resources\views/bookings/history.blade.php ENDPATH**/ ?>