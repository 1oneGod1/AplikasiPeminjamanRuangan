<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\BookingChangeRequest;
use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class RoomManagerChangeRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_room_manager_can_submit_edit_request(): void
    {
        $manager = User::factory()->peminjam()->create();
        $room = Room::factory()->create();
        $room->managers()->attach($manager->id);

        $booking = Booking::factory()
            ->approved()
            ->for($manager, 'user')
            ->for($room)
            ->create([
                'booking_date' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'start_time' => '10:00:00',
                'end_time' => '12:00:00',
            ]);

        $this->actingAs($manager);

        $payload = [
            'type' => BookingChangeRequest::TYPE_EDIT,
            'reason' => 'Perlu mengubah waktu karena bentrok dengan acara lain.',
        ];

        $response = $this->post(route('room-manager.change-request', $booking), $payload);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('booking_change_requests', [
            'booking_id' => $booking->id,
            'requested_by' => $manager->id,
            'type' => BookingChangeRequest::TYPE_EDIT,
            'reason' => $payload['reason'],
            'status' => BookingChangeRequest::STATUS_PENDING,
        ]);
    }

    public function test_room_manager_cannot_submit_duplicate_pending_request(): void
    {
        $manager = User::factory()->peminjam()->create();
        $room = Room::factory()->create();
        $room->managers()->attach($manager->id);

        $booking = Booking::factory()
            ->approved()
            ->for($manager, 'user')
            ->for($room)
            ->create([
                'booking_date' => Carbon::now()->addDays(3)->format('Y-m-d'),
                'start_time' => '08:00:00',
                'end_time' => '10:00:00',
            ]);

        $this->actingAs($manager);

        $payload = [
            'type' => BookingChangeRequest::TYPE_CANCEL,
            'reason' => 'Kegiatan dibatalkan oleh penanggung jawab.',
        ];

        $this->post(route('room-manager.change-request', $booking), $payload);
        $response = $this->post(route('room-manager.change-request', $booking), $payload);

        $response->assertRedirect();
        $response->assertSessionHas('error');

        $this->assertEquals(1, BookingChangeRequest::where([
            'booking_id' => $booking->id,
            'requested_by' => $manager->id,
            'type' => BookingChangeRequest::TYPE_CANCEL,
            'status' => BookingChangeRequest::STATUS_PENDING,
        ])->count());
    }

    public function test_room_manager_cannot_request_change_for_unmanaged_booking(): void
    {
        $manager = User::factory()->peminjam()->create();
        $anotherManager = User::factory()->peminjam()->create();
        $room = Room::factory()->create();
        $room->managers()->attach($anotherManager->id);

        $booking = Booking::factory()
            ->approved()
            ->for($anotherManager, 'user')
            ->for($room)
            ->create([
                'booking_date' => Carbon::now()->addDays(5)->format('Y-m-d'),
                'start_time' => '13:00:00',
                'end_time' => '15:00:00',
            ]);

        $this->actingAs($manager);

        $response = $this->post(route('room-manager.change-request', $booking), [
            'type' => BookingChangeRequest::TYPE_EDIT,
            'reason' => 'Mencoba akses tanpa hak.',
        ]);

        $response->assertForbidden();
        $this->assertDatabaseCount('booking_change_requests', 0);
    }
}
