<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\BookingChangeRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookingChangeRequest>
 */
class BookingChangeRequestFactory extends Factory
{
    protected $model = BookingChangeRequest::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'booking_id' => Booking::factory(),
            'requested_by' => User::factory()->peminjam(),
            'type' => fake()->randomElement([
                BookingChangeRequest::TYPE_EDIT,
                BookingChangeRequest::TYPE_CANCEL,
            ]),
            'reason' => fake()->sentence(12),
            'status' => BookingChangeRequest::STATUS_PENDING,
            'admin_note' => null,
            'handled_by' => null,
            'handled_at' => null,
        ];
    }

    /**
     * Indicate that the request has been handled.
     */
    public function handled(string $status = BookingChangeRequest::STATUS_APPROVED): static
    {
        return $this->state(fn () => [
            'status' => $status,
            'handled_by' => User::factory()->admin(),
            'handled_at' => now(),
        ]);
    }
}
