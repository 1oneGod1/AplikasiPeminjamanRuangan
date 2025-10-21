<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\Room;
use App\Services\ConflictValidationService;
use Carbon\Carbon;
use Faker\Factory as Faker;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param ConflictValidationService $conflictService
     */
    public function run(ConflictValidationService $conflictService): void
    {
        $faker = Faker::create('id_ID');
        $peminjamUsers = User::where('role', 'peminjam')->get();
        $rooms = Room::all();

        if ($peminjamUsers->isEmpty() || $rooms->isEmpty()) {
            $this->command->warn('Tidak ada user peminjam atau ruangan yang tersedia. Seeder booking dilewati.');
            return;
        }

        $this->command->info('Membuat 50 data booking palsu...');
        $bookingCount = 0;
        $maxAttempts = 100; // Untuk menghindari infinite loop jika sulit menemukan slot kosong
        $attempts = 0;

        while ($bookingCount < 50 && $attempts < $maxAttempts) {
            $attempts++;
            $user = $peminjamUsers->random();
            $room = $rooms->random();
            $date = Carbon::now()->addDays($faker->numberBetween(-14, 28));
            
            // Jam operasional dari 07:00 sampai 17:00
            $startHour = $faker->numberBetween(7, 16);
            $endHour = $faker->numberBetween($startHour + 1, 17);

            $startTime = Carbon::createFromTime($startHour, 0, 0)->format('H:i:s');
            $endTime = Carbon::createFromTime($endHour, 0, 0)->format('H:i:s');

            // Cek konflik sebelum membuat booking
            $hasConflict = $conflictService->validateConflict(
                $room->id,
                $date->format('Y-m-d'),
                $startTime,
                $endTime
            );

            if (!$hasConflict) {
                Booking::create([
                    'user_id' => $user->id,
                    'room_id' => $room->id,
                    'booking_date' => $date->format('Y-m-d'),
                    'start_time' => $startTime,
                    'end_time' => $endTime,
                    'purpose' => $faker->sentence(3),
                    'status' => $faker->randomElement([
                        Booking::STATUS_PENDING,
                        Booking::STATUS_APPROVED,
                        Booking::STATUS_REJECTED,
                        Booking::STATUS_CANCELLED,
                        Booking::STATUS_COMPLETED
                    ]),
                    'participants' => $faker->numberBetween(5, 30),
                ]);
                $bookingCount++;
            }
        }

        $this->command->info("Berhasil membuat {$bookingCount} data booking baru.");
    }
}
