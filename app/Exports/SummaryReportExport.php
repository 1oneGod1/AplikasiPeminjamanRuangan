<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class SummaryReportExport implements FromCollection, WithHeadings, ShouldAutoSize, WithTitle
{
    /** @var array<string, int|float> */
    private array $summary;

    private string $title;

    public function __construct(array $summary, string $title = 'Ringkasan')
    {
        $this->summary = $summary;
        $this->title = $title;
    }

    public function collection(): Collection
    {
        return collect($this->summary)->map(function ($value, $key) {
            return [
                $this->label($key),
                $value,
            ];
        });
    }

    public function headings(): array
    {
        return ['Metrik', 'Nilai'];
    }

    public function title(): string
    {
        return $this->title;
    }

    private function label(string $key): string
    {
        return match ($key) {
            'total_bookings' => 'Total Pengajuan',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            'cancelled' => 'Dibatalkan',
            default => ucfirst(str_replace('_', ' ', $key)),
        };
    }
}
