<?php

namespace Tests\Feature;

use App\Exports\DetailBookingsExport;
use App\Exports\SummaryReportExport;
use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class ReportExportTest extends TestCase
{
    use RefreshDatabase;

    public function test_headmaster_can_export_detail_report_to_excel(): void
    {
        Excel::fake();
        Carbon::setTestNow('2025-01-15 08:00:00');

        $headmaster = User::factory()->kepalaSekolah()->create();
        $room = Room::factory()->create(['is_active' => true]);
        $peminjam = User::factory()->peminjam()->create();

        Booking::factory()->create([
            'user_id' => $peminjam->id,
            'room_id' => $room->id,
            'booking_date' => '2025-01-10',
            'start_time' => '09:00:00',
            'end_time' => '11:00:00',
            'status' => Booking::STATUS_APPROVED,
        ]);

        $from = '2025-01-01';
        $to = '2025-01-31';
        $expectedFilename = "laporan-detail-peminjaman-{$from}-to-{$to}.xlsx";

        $response = $this->actingAs($headmaster)->post(route('reports.export.excel'), [
            'date_from' => $from,
            'date_to' => $to,
            'type' => 'detail',
        ]);

        $response->assertOk();

        Excel::assertDownloaded($expectedFilename, function ($export) {
            $this->assertInstanceOf(DetailBookingsExport::class, $export);
            $this->assertCount(1, $export->collection());

            return true;
        });

        Carbon::setTestNow();
    }

    public function test_headmaster_can_export_summary_report_to_excel(): void
    {
        Excel::fake();
        Carbon::setTestNow('2025-03-05 09:00:00');

        $headmaster = User::factory()->kepalaSekolah()->create();
        $room = Room::factory()->create(['is_active' => true]);
        $peminjam = User::factory()->peminjam()->create();

        Booking::factory()->create([
            'user_id' => $peminjam->id,
            'room_id' => $room->id,
            'booking_date' => '2025-03-01',
            'start_time' => '08:00:00',
            'end_time' => '10:00:00',
            'status' => Booking::STATUS_APPROVED,
        ]);

        Booking::factory()->create([
            'user_id' => $peminjam->id,
            'room_id' => $room->id,
            'booking_date' => '2025-03-02',
            'start_time' => '10:00:00',
            'end_time' => '11:00:00',
            'status' => Booking::STATUS_REJECTED,
        ]);

        Booking::factory()->create([
            'user_id' => $peminjam->id,
            'room_id' => $room->id,
            'booking_date' => '2025-03-03',
            'start_time' => '13:00:00',
            'end_time' => '14:00:00',
            'status' => Booking::STATUS_CANCELLED,
        ]);

        $from = '2025-03-01';
        $to = '2025-03-31';
        $expectedFilename = "laporan-ringkasan-{$from}-to-{$to}.xlsx";

        $response = $this->actingAs($headmaster)->post(route('reports.export.excel'), [
            'date_from' => $from,
            'date_to' => $to,
            'type' => 'summary',
        ]);

        $response->assertOk();

        Excel::assertDownloaded($expectedFilename, function ($export) {
            $this->assertInstanceOf(SummaryReportExport::class, $export);
            $this->assertCount(4, $export->collection());

            return true;
        });

        Carbon::setTestNow();
    }
}
