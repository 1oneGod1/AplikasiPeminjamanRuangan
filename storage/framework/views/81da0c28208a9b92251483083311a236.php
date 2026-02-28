

<?php $__env->startSection('title', 'Dashboard Peminjaman'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-slate-100 dark:bg-slate-950 min-h-screen pb-16">
	<div class="relative bg-slate-900 text-white overflow-hidden">
		<!-- Animated gradient background -->
		<div class="absolute inset-0 opacity-40 pointer-events-none">
			<div class="absolute top-0 -left-48 w-96 h-96 bg-yellow-400/40 rounded-full blur-3xl animate-float"></div>
			<div class="absolute top-32 -right-32 w-80 h-80 bg-blue-400/30 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
			<div class="absolute bottom-0 left-1/3 w-72 h-72 bg-cyan-400/20 rounded-full blur-3xl animate-float" style="animation-delay: 4s;"></div>
		</div>

		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 relative z-10">
			<div class="grid lg:grid-cols-12 gap-8 items-start">
				<div class="lg:col-span-8 space-y-6">
					<div class="animate-fade-in-up">
						<span class="hero-badge animate-slide-in-down">✨ Cari Ketersediaan</span>
						<h1 class="mt-5 text-4xl sm:text-5xl font-bold animate-slide-in-down" style="animation-delay: 0.1s;">Halo, <?php echo e(auth()->user()->name); ?> 👋</h1>
						<p class="text-slate-200 mt-4 text-lg max-w-2xl animate-fade-in-up font-medium" style="animation-delay: 0.2s;">Temukan ruangan yang sempurna dengan fitur pencarian real-time, dapatkan notifikasi instan saat ada perubahan jadwal.</p>
					</div>

					<?php if(session('success')): ?>
						<div class="rounded-2xl border border-emerald-300/60 bg-emerald-500/20 px-4 py-3 text-sm text-emerald-100 shadow">
							<?php echo e(session('success')); ?>

						</div>
					<?php endif; ?>

					<?php if($errors->has('booking')): ?>
						<div class="rounded-2xl border border-red-300/60 bg-red-500/20 px-4 py-3 text-sm text-red-100 shadow">
							<?php echo e($errors->first('booking')); ?>

						</div>
					<?php endif; ?>

					<form action="<?php echo e(route('dashboard')); ?>" method="GET" class="bg-white/10 backdrop-blur rounded-2xl border border-white/10 p-6 shadow-xl space-y-5">
						<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
							<label class="block">
								<span class="block text-xs font-semibold uppercase tracking-wide text-slate-300">Tanggal</span>
								<input type="date" name="date" value="<?php echo e($filters['date']); ?>" class="mt-2 w-full rounded-xl border border-white/20 bg-white/10 px-3 py-2 text-white placeholder-slate-300 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/60" />
							</label>
							<label class="block">
								<span class="block text-xs font-semibold uppercase tracking-wide text-slate-300">Mulai</span>
								<input type="time" name="start_time" value="<?php echo e($filters['start_time']); ?>" class="mt-2 w-full rounded-xl border border-white/20 bg-white/10 px-3 py-2 text-white placeholder-slate-300 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/60" />
							</label>
							<label class="block">
								<span class="block text-xs font-semibold uppercase tracking-wide text-slate-300">Selesai</span>
								<input type="time" name="end_time" value="<?php echo e($filters['end_time']); ?>" class="mt-2 w-full rounded-xl border border-white/20 bg-white/10 px-3 py-2 text-white placeholder-slate-300 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/60" />
							</label>
							<label class="block">
								<span class="block text-xs font-semibold uppercase tracking-wide text-slate-300">Jenis Ruangan</span>
								<select name="type" class="mt-2 w-full rounded-xl border border-white/20 bg-white/10 px-3 py-2 text-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/60">
									<?php $__currentLoopData = $roomTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($value); ?>" <?php echo e($filters['type'] === $value ? 'selected' : ''); ?>><?php echo e($label); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</label>
							<label class="block">
								<span class="block text-xs font-semibold uppercase tracking-wide text-slate-300">Kapasitas Minimum</span>
								<input type="number" name="min_capacity" min="0" value="<?php echo e($filters['min_capacity']); ?>" placeholder="0" class="mt-2 w-full rounded-xl border border-white/20 bg-white/10 px-3 py-2 text-white placeholder-slate-300 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/60" />
							</label>
							<label class="block">
								<span class="block text-xs font-semibold uppercase tracking-wide text-slate-300">Kata Kunci</span>
								<input type="text" name="keyword" value="<?php echo e($filters['keyword']); ?>" placeholder="Nama / Gedung / Tipe" class="mt-2 w-full rounded-xl border border-white/20 bg-white/10 px-3 py-2 text-white placeholder-slate-300 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/60" />
							</label>
						</div>

						<div class="flex flex-wrap items-center justify-between gap-3">
							<label class="flex items-center gap-2 text-sm text-slate-200">
								<input type="checkbox" name="available_only" value="1" <?php echo e($filters['available_only'] ? 'checked' : ''); ?> class="h-4 w-4 rounded border-white/30 bg-white/10 text-yellow-400 focus:ring-yellow-300" />
								Tampilkan yang tersedia saja
							</label>

							<button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-yellow-400 px-5 py-2 text-slate-900 font-semibold shadow hover:bg-yellow-300 transition">
								<span>Cek Ketersediaan</span>
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
									<path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 105.25 5.25a7.5 7.5 0 0011.4 11.4z" />
								</svg>
							</button>
						</div>
					</form>
				</div>

				<div class="lg:col-span-4">
					<div class="rounded-3xl bg-slate-800/80 border border-white/10 backdrop-blur p-6 space-y-5 shadow-xl animate-pulse-glow">
						<h2 class="text-lg font-semibold text-white">Ringkasan Hari Ini</h2>
						<div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
							<div class="hero-stat-card rounded-3xl px-6 py-8 text-white shadow-lg flex flex-col items-center text-center hover:shadow-2xl transition-shadow" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
								<p class="text-xs font-bold uppercase tracking-widest">Tersedia</p>
								<p class="mt-4 text-5xl font-black"><?php echo e($summary['available']); ?></p>
							</div>
							<div class="hero-stat-card rounded-3xl px-6 py-8 text-white shadow-lg flex flex-col items-center text-center hover:shadow-2xl transition-shadow" style="background: linear-gradient(135deg, #f87171 0%, #dc2626 100%);">
								<p class="text-xs font-bold uppercase tracking-widest">Terpesan</p>
								<p class="mt-4 text-5xl font-black"><?php echo e($summary['booked']); ?></p>
							</div>
							<div class="hero-stat-card rounded-3xl px-6 py-8 text-white shadow-lg flex flex-col items-center text-center hover:shadow-2xl transition-shadow" style="background: linear-gradient(135deg, #fb923c 0%, #ea580c 100%);">
								<p class="text-xs font-bold uppercase tracking-widest">Jumlah Ruangan</p>
								<p class="mt-4 text-5xl font-black"><?php echo e($summary['total_rooms']); ?></p>
							</div>
							<div class="hero-stat-card rounded-3xl px-6 py-8 text-white shadow-lg flex flex-col items-center text-center hover:shadow-2xl transition-shadow" style="background: linear-gradient(135deg, #a78bfa 0%, #7c3aed 100%);">
								<p class="text-xs font-bold uppercase tracking-widest">Pengajuan Saya</p>
								<p class="mt-4 text-5xl font-black"><?php echo e($summary['my_requests']); ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10 space-y-12">
		<section class="space-y-4">
			<div class="flex flex-wrap items-end justify-between gap-4">
				<div>
					<h2 class="text-2xl font-semibold text-slate-900 dark:text-slate-100">Hasil Pencarian</h2>
					<p class="text-slate-500 dark:text-slate-400"><?php echo e($roomsFound); ?> ruangan ditemukan</p>
				</div>
			</div>

			<?php if($roomsFound === 0): ?>
				<div class="rounded-2xl border border-dashed border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 p-8 text-center text-slate-500 dark:text-slate-400">
					Belum ada ruangan yang cocok dengan filter yang kamu pilih.
				</div>
			<?php else: ?>
				<div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">
					<?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="rounded-3xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-6 shadow-sm hover:shadow-lg transition">
							<div class="flex items-start justify-between gap-4">
								<div>
									<h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100"><?php echo e($room->name); ?></h3>
									<p class="text-sm text-slate-500 dark:text-slate-400"><?php echo e($room->location ?? 'Lokasi tidak tersedia'); ?></p>
									<p class="text-xs uppercase tracking-wide text-slate-400"><?php echo e(ucfirst(str_replace('_', ' ', $room->type ?? 'Umum'))); ?></p>
								</div>
								<span class="inline-flex items-center gap-1 rounded-full px-3 py-1 text-xs font-semibold <?php echo e($room->availability_badge); ?>">
									<?php echo e($room->availability_label); ?>

								</span>
							</div>

							<div class="flex flex-wrap gap-2 mt-6 text-xs text-slate-600 dark:text-slate-300">
								<span class="inline-flex items-center rounded-full bg-slate-100 dark:bg-slate-800 px-3 py-1">Kapasitas <?php echo e($room->capacity); ?></span>
								<?php $__currentLoopData = $room->facility_list->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<span class="inline-flex items-center rounded-full bg-slate-100 dark:bg-slate-800 px-3 py-1"><?php echo e($facility); ?></span>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php if($room->facility_list->count() === 0): ?>
									<span class="inline-flex items-center rounded-full bg-slate-100 dark:bg-slate-800 px-3 py-1">Fasilitas belum diatur</span>
								<?php endif; ?>
							</div>

							<?php
								$bookingQuery = array_filter([
									'date' => $filters['date'] ?? null,
									'start_time' => $filters['start_time'] ?? null,
									'end_time' => $filters['end_time'] ?? null,
								], fn ($value) => filled($value));
								$bookingUrl = route('bookings.create', array_merge(['room' => $room->id], $bookingQuery));
							?>

							<div class="mt-6 flex items-center gap-3">
								<a href="<?php echo e($bookingUrl); ?>" class="flex-1 inline-flex justify-center rounded-xl bg-yellow-400 px-4 py-2 font-semibold text-slate-900 shadow hover:bg-yellow-300 transition" title="Ajukan peminjaman untuk ruangan ini">
									Ajukan Peminjaman
								</a>
								<button type="button" class="rounded-xl border border-slate-200 dark:border-slate-700 px-4 py-2 text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800" title="Detail ruangan segera hadir">
									Detail
								</button>
							</div>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			<?php endif; ?>
		</section>

		<section class="space-y-4">
			<div class="flex items-center justify-between">
				<div>
					<h2 class="text-2xl font-semibold text-slate-900 dark:text-slate-100">Pengajuan Terbaru Saya</h2>
					<p class="text-slate-500 dark:text-slate-400 text-sm">Pantau status pengajuan peminjaman terakhir kamu.</p>
				</div>
			</div>

			<div class="overflow-hidden rounded-3xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900">
				<table class="min-w-full divide-y divide-slate-200 dark:divide-slate-800 text-sm">
					<thead class="bg-slate-50 dark:bg-slate-800 text-slate-500 dark:text-slate-300">
						<tr>
							<th class="px-6 py-3 text-left font-medium">ID</th>
							<th class="px-6 py-3 text-left font-medium">Ruangan</th>
							<th class="px-6 py-3 text-left font-medium">Tanggal</th>
							<th class="px-6 py-3 text-left font-medium">Waktu</th>
							<th class="px-6 py-3 text-left font-medium">Tujuan</th>
							<th class="px-6 py-3 text-left font-medium">Status</th>
							<th class="px-6 py-3 text-left font-medium">Aksi</th>
						</tr>
					</thead>
					<tbody class="divide-y divide-slate-200 dark:divide-slate-800">
						<?php $__empty_1 = true; $__currentLoopData = $recentBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
							<tr class="hover:bg-slate-50 dark:hover:bg-slate-800">
								<td class="px-6 py-3 font-semibold text-slate-700 dark:text-slate-200">#<?php echo e($booking->id); ?></td>
								<td class="px-6 py-3 text-slate-600 dark:text-slate-300"><?php echo e($booking->room->name ?? '-'); ?></td>
								<td class="px-6 py-3 text-slate-600 dark:text-slate-300"><?php echo e(\Illuminate\Support\Carbon::parse($booking->booking_date)->format('d M Y')); ?></td>
								<td class="px-6 py-3 text-slate-600 dark:text-slate-300"><?php echo e(substr($booking->start_time,0,5)); ?>–<?php echo e(substr($booking->end_time,0,5)); ?></td>
								<td class="px-6 py-3 text-slate-600 dark:text-slate-300">
									<?php if($booking->purpose): ?>
										<button type="button" data-purpose-modal-trigger data-purpose="<?php echo e(e($booking->purpose)); ?>" data-purpose-title="Tujuan · Pengajuan #<?php echo e($booking->id); ?>" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-3 py-1.5 text-xs font-semibold text-slate-600 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-yellow-400 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800">
											<span>Lihat tujuan</span>
											<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-3.5 w-3.5">
												<path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
											</svg>
										</button>
									<?php else: ?>
										<span class="text-xs text-slate-400 dark:text-slate-500">-</span>
									<?php endif; ?>
								</td>
								<td class="px-6 py-3">
									<?php
										$statusColors = [
											'pending' => 'bg-yellow-100 text-yellow-800',
											'approved' => 'bg-green-100 text-green-700',
											'rejected' => 'bg-red-100 text-red-700',
											'cancelled' => 'bg-slate-100 text-slate-600',
										];
										$badgeClass = $statusColors[$booking->status] ?? 'bg-slate-100 text-slate-600';
									?>
									<span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold <?php echo e($badgeClass); ?>">
										<?php echo e(ucfirst($booking->status)); ?>

									</span>
								</td>
								<td class="px-6 py-3 text-slate-600 dark:text-slate-300">
									<div class="flex flex-wrap items-center gap-2">
										<?php if($booking->status === 'pending'): ?>
											<a href="<?php echo e(route('bookings.edit', $booking)); ?>" class="inline-flex items-center rounded-xl border border-slate-200 dark:border-slate-700 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition">Edit</a>
										<?php endif; ?>
										<?php if(in_array($booking->status, ['pending', 'approved'])): ?>
											<form action="<?php echo e(route('bookings.destroy', $booking)); ?>" method="POST" onsubmit="return confirm('Batalkan pengajuan ini?');">
												<?php echo csrf_field(); ?>
												<?php echo method_field('DELETE'); ?>
												<button type="submit" class="inline-flex items-center rounded-xl border border-red-200 dark:border-red-500/40 px-3 py-1.5 text-xs font-semibold text-red-600 dark:text-red-300 hover:bg-red-50 dark:hover:bg-red-500/10 transition">Batalkan</button>
											</form>
										<?php else: ?>
											<span class="text-xs text-slate-400 dark:text-slate-500">-</span>
										<?php endif; ?>
									</div>
								</td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
							<tr>
								<td colspan="7" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">Belum ada pengajuan peminjaman.</td>
							</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</section>
	</div>
</div>

<?php echo $__env->make('components.purpose-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Semester 4\ENG\ALP\Booking-Ruangan\resources\views/dashboard.blade.php ENDPATH**/ ?>