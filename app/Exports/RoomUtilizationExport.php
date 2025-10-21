<?php

namespace App\Exports;

use App\Http\Controllers\ReportController;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class RoomUtilizationExport implements FromCollection, WithHeadings, ShouldAutoSize, WithTitle
{
    /** @var array<int, array<string, mixed>> */
    private array $utilizations;

    private string $title;

    public function __construct(array $utilizations, string $title = 'Utilisasi Ruangan')
    {
        $this->utilizations = $utilizations;
        $this->title = $title;
    }

    public function collection(): Collection
    {
        return collect($this->utilizations)->map(function (array $entry) {
            $roomData = $entry['room'] ?? null;

            $roomName = '-';
            $roomType = null;

            if ($roomData) {
                if (is_object($roomData)) {
                    $roomName = $roomData->name ?? '-';
                    $roomType = $roomData->type ?? null;
                } elseif (is_array($roomData)) {
                    $roomName = $roomData['name'] ?? '-';
                    $roomType = $roomData['type'] ?? null;
                }
            } else {
                $roomName = $entry['room_name'] ?? '-';
                $roomType = $entry['room_type'] ?? null;
            }

            $typeLabel = ReportController::ROOM_TYPE_LABELS[$roomType] ?? ucfirst(str_replace('_', ' ', (string) ($roomType ?? 'Lainnya')));

            return [
                $roomName,
                $typeLabel,
                $entry['total_bookings'] ?? 0,
                $entry['total_hours'] ?? 0,
                $entry['utilization_percentage'] ?? ($entry['utilization'] ?? 0),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Ruangan',
            'Tipe',
            'Total Booking',
            'Total Jam Terpakai',
            'Utilisasi (%)',
        ];
    }

    public function title(): string
    {
        return $this->title;
    }
}
