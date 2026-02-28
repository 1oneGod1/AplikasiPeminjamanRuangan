

<?php $__env->startSection('title', 'Kalender Peminjaman'); ?>

<?php $__env->startSection('content'); ?>
<?php
    use App\Models\Booking;

    $statusOptions = [
        'all' => 'Semua Status',
        Booking::STATUS_APPROVED => 'Approved',
        Booking::STATUS_PENDING => 'Pending',
    ];

    $dayHeaders = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];

    $prevParams = array_merge($baseQuery, [
        'month' => $navigation['previous']['month'],
        'year' => $navigation['previous']['year'],
    ]);

    $nextParams = array_merge($baseQuery, [
        'month' => $navigation['next']['month'],
        'year' => $navigation['next']['year'],
    ]);

    $todayParams = array_merge($baseQuery, [
        'month' => $navigation['today']['month'],
        'year' => $navigation['today']['year'],
    ]);

    $statusColors = [
        Booking::STATUS_APPROVED => 'bg-emerald-500/10 border border-emerald-500/30 text-emerald-700 dark:text-emerald-300',
        Booking::STATUS_PENDING => 'bg-amber-400/10 border border-amber-400/30 text-amber-700 dark:text-amber-300',
    ];
?>

<div class="bg-slate-100 dark:bg-slate-950 min-h-screen pb-16">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-10">
		<div class="flex flex-wrap items-start justify-between gap-6">
			<div class="space-y-2">
				<div class="inline-flex items-center gap-2 rounded-full bg-slate-900 text-white text-xs font-semibold px-3 py-1">
					<span>Kalender Peminjaman</span>
				</div>
				<h1 class="text-3xl sm:text-4xl font-semibold text-slate-900 dark:text-white"><?php echo e($navigation['current']['label']); ?></h1>
				<p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 max-w-2xl">Pantau jadwal penggunaan ruangan yang sudah disetujui maupun masih menunggu persetujuan. Pengajuan yang ditolak tidak ditampilkan di sini.</p>
			</div>
			<div class="flex flex-col items-end gap-3 w-full sm:w-auto">
				<a href="<?php echo e(route('dashboard')); ?>" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 dark:border-slate-800 px-4 py-2 text-sm font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" class="w-4 h-4">
						<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
					</svg>
					<span>Kembali ke Dashboard</span>
				</a>
				<div class="flex items-center gap-2">
					<a href="<?php echo e(route('bookings.calendar', $prevParams)); ?>" class="inline-flex items-center justify-center rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 px-3 py-2 text-sm font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition" title="Bulan sebelumnya">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-4 h-4">
							<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
						</svg>
					</a>
					<a href="<?php echo e(route('bookings.calendar', $todayParams)); ?>" class="inline-flex items-center justify-center rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 px-4 py-2 text-sm font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition" title="Kembali ke bulan ini">Hari ini</a>
					<a href="<?php echo e(route('bookings.calendar', $nextParams)); ?>" class="inline-flex items-center justify-center rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 px-3 py-2 text-sm font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition" title="Bulan selanjutnya">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-4 h-4">
							<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
						</svg>
					</a>
				</div>
				<div class="flex items-center gap-2 text-xs font-semibold text-white">
					<span class="inline-flex items-center gap-1 rounded-full bg-emerald-500 px-3 py-1">Approved</span>
					<span class="inline-flex items-center gap-1 rounded-full bg-amber-400 text-slate-900 px-3 py-1">Pending</span>
				</div>
			</div>
		</div>

		<div class="rounded-3xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-6 shadow-sm space-y-6">
			<div class="flex flex-wrap items-center justify-between gap-4">
				<form method="GET" class="flex flex-wrap items-end gap-4">
					<input type="hidden" name="month" value="<?php echo e($navigation['current']['month']); ?>">
					<input type="hidden" name="year" value="<?php echo e($navigation['current']['year']); ?>">

					<label class="flex flex-col text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
						<span>Status</span>
						<select name="status" class="mt-2 min-w-40 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-950/60 px-3 py-2 text-sm text-slate-900 dark:text-slate-100 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/50">
							<?php $__currentLoopData = $statusOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($value); ?>" <?php echo e($filters['status'] === $value ? 'selected' : ''); ?>><?php echo e($label); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</label>

					<label class="flex flex-col text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
						<span>Ruangan</span>
						<select name="room_id" class="mt-2 min-w-[200px] rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-950/60 px-3 py-2 text-sm text-slate-900 dark:text-slate-100 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/50">
							<option value="">Semua Ruangan</option>
							<?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($room->id); ?>" <?php echo e((string) $filters['room_id'] === (string) $room->id ? 'selected' : ''); ?>><?php echo e($room->name); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</label>

					<button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-yellow-400 px-4 py-2 text-sm font-semibold text-slate-900 shadow hover:bg-yellow-300 transition">
						<span>Terapkan</span>
					</button>
				</form>

				<a href="<?php echo e(route('bookings.calendar', ['month' => $navigation['current']['month'], 'year' => $navigation['current']['year']])); ?>" class="text-sm font-semibold text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-white transition">Reset filter</a>
			</div>

			<div class="flex flex-wrap items-center gap-3 text-sm text-slate-500 dark:text-slate-400">
				<span>Total jadwal bulan ini: <strong class="text-slate-700 dark:text-slate-200"><?php echo e($summary['total']); ?></strong></span>
				<span class="inline-flex items-center gap-1">
					<span class="inline-block h-2 w-2 rounded-full bg-emerald-500"></span>
					Disetujui: <strong class="text-slate-700 dark:text-slate-200"><?php echo e($summary['approved']); ?></strong>
				</span>
				<span class="inline-flex items-center gap-1">
					<span class="inline-block h-2 w-2 rounded-full bg-amber-400"></span>
					Menunggu: <strong class="text-slate-700 dark:text-slate-200"><?php echo e($summary['pending']); ?></strong>
				</span>
			</div>

			<!-- Desktop Calendar View -->
			<div class="hidden md:block overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-800">
				<table class="w-full text-sm">
					<thead class="bg-slate-900 text-white">
						<tr>
							<?php $__currentLoopData = $dayHeaders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<th class="px-4 py-3 text-center font-semibold uppercase tracking-wide"><?php echo e($day); ?></th>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tr>
					</thead>
					<tbody class="bg-white dark:bg-slate-950">
						<?php $__currentLoopData = $weeks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $week): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<?php $__currentLoopData = $week; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<td class="align-top border border-slate-200 dark:border-slate-800 p-3">
										<div class="<?php echo \Illuminate\Support\Arr::toCssClasses([
											'flex items-center justify-between text-xs font-semibold',
											'text-slate-900 dark:text-slate-100' => $day['isCurrentMonth'],
											'text-slate-400 dark:text-slate-600' => !$day['isCurrentMonth'],
										]); ?>">
											<span><?php echo e($day['date']->format('j')); ?></span>
											<?php if($day['isToday']): ?>
												<span class="rounded-full bg-yellow-400 px-2 py-0.5 text-[10px] font-bold text-slate-900">Hari ini</span>
											<?php endif; ?>
										</div>

										<?php if(!empty($day['bookings'])): ?>
											<div class="mt-3 space-y-2">
												<?php $__currentLoopData = $day['bookings']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<div class="rounded-xl px-3 py-2 text-xs leading-relaxed shadow-sm" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
														$statusColors[$booking['status']] ?? 'bg-slate-200/40 border border-slate-300 text-slate-700 dark:bg-slate-800/40 dark:border-slate-700 dark:text-slate-200',
													]); ?>">
														<p class="font-semibold">[<?php echo e($booking['room']); ?>]</p>
														<?php if(!empty($booking['purpose'])): ?>
															<button type="button" data-purpose-modal-trigger data-purpose="<?php echo e(e($booking['purpose'])); ?>" data-purpose-title="Tujuan · <?php echo e($booking['room']); ?>" class="mt-2 inline-flex items-center gap-1 rounded-lg border border-slate-200 px-2.5 py-1 text-[11px] font-semibold text-slate-600 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-yellow-400 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800">
																<span>Lihat tujuan</span>
																<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-3 w-3">
																	<path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
																</svg>
															</button>
														<?php else: ?>
															<p class="mt-2 text-[11px] text-slate-500 dark:text-slate-300">Tujuan tidak diisi.</p>
														<?php endif; ?>
														<p class="mt-1 flex items-center gap-1 text-[11px]">
															<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-3 h-3">
																<path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l3 3" />
															</svg>
															<span><?php echo e($booking['time_range']); ?></span>
														</p>
														<p class="text-[11px] text-slate-500 dark:text-slate-300">Pengaju: <?php echo e($booking['user']); ?></p>
													</div>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</div>
										<?php else: ?>
											<p class="mt-4 text-[11px] text-slate-400 dark:text-slate-600">Tidak ada jadwal</p>
										<?php endif; ?>
									</td>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
			</div>

			<!-- Mobile Calendar View -->
			<div class="md:hidden space-y-3">
				<?php
					$allBookings = [];
					foreach($weeks as $week) {
						foreach($week as $day) {
							if($day['isCurrentMonth'] && !empty($day['bookings'])) {
								foreach($day['bookings'] as $booking) {
									$booking['date'] = $day['date'];
									$allBookings[] = $booking;
								}
							}
						}
					}
				?>

				<?php $__empty_1 = true; $__currentLoopData = $allBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
					<div class="rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 p-4 space-y-3 shadow-sm">
						<!-- Header -->
						<div class="flex items-start justify-between">
							<div class="space-y-1">
								<div class="text-sm font-semibold text-slate-900 dark:text-white">
									<?php echo e($booking['date']->format('d M Y')); ?>

								</div>
								<div class="text-xs font-medium text-slate-500 dark:text-slate-400">
									<?php echo e($booking['date']->format('l')); ?>

								</div>
							</div>
							<span class="<?php echo \Illuminate\Support\Arr::toCssClasses([
								'inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold',
								'bg-emerald-500/20 text-emerald-700 dark:text-emerald-300 border border-emerald-500/30' => $booking['status'] === Booking::STATUS_APPROVED,
								'bg-amber-400/20 text-amber-700 dark:text-amber-300 border border-amber-400/30' => $booking['status'] === Booking::STATUS_PENDING,
							]); ?>">
								<i class="<?php echo \Illuminate\Support\Arr::toCssClasses([
									'fas text-xs',
									'fa-check-circle' => $booking['status'] === Booking::STATUS_APPROVED,
									'fa-clock' => $booking['status'] === Booking::STATUS_PENDING,
								]); ?>"></i>
								<span><?php echo e($booking['status'] === Booking::STATUS_APPROVED ? 'Disetujui' : 'Menunggu'); ?></span>
							</span>
						</div>

						<!-- Room & Time -->
						<div class="space-y-2 bg-slate-50 dark:bg-slate-950 rounded-xl p-3">
							<div class="flex items-center gap-2">
								<i class="fas fa-door-open text-slate-600 dark:text-slate-400 w-4"></i>
								<span class="font-semibold text-slate-900 dark:text-white text-sm"><?php echo e($booking['room']); ?></span>
							</div>
							<div class="flex items-center gap-2">
								<i class="fas fa-clock text-slate-600 dark:text-slate-400 w-4"></i>
								<span class="text-sm text-slate-700 dark:text-slate-300"><?php echo e($booking['time_range']); ?></span>
							</div>
							<div class="text-xs text-slate-600 dark:text-slate-400">
								Pengaju: <strong><?php echo e($booking['user']); ?></strong>
							</div>
						</div>

						<!-- Purpose -->
						<?php if(!empty($booking['purpose'])): ?>
							<button type="button" data-purpose-modal-trigger data-purpose="<?php echo e(e($booking['purpose'])); ?>" data-purpose-title="Tujuan · <?php echo e($booking['room']); ?>" class="w-full flex items-center justify-center gap-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-3 py-2 text-sm font-semibold text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
								<i class="fas fa-eye text-xs"></i>
								<span>Lihat Tujuan Peminjaman</span>
							</button>
						<?php endif; ?>
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
					<div class="rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 p-8 text-center">
						<i class="fas fa-calendar-check text-4xl text-slate-400 dark:text-slate-600 mb-3"></i>
						<p class="text-sm font-medium text-slate-600 dark:text-slate-300">Tidak ada jadwal bulan ini</p>
					</div>
				<?php endif; ?>
			</div>

			<p class="text-xs text-slate-500 dark:text-slate-400">Jam operasional: 07:00–21:00 • Tampilan saat ini: Bulanan. Tampilan mingguan akan segera hadir.</p>
		</div>
	</div>
</div>

<?php echo $__env->make('components.purpose-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Semester 4\ENG\ALP\Booking-Ruangan\resources\views/bookings/calendar.blade.php ENDPATH**/ ?>