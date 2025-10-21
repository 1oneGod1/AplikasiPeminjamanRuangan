<?php

namespace App\Exports;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class DetailBookingsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithTitle
{
    /** @var \Illuminate\Support\Collection<int, \App\Models\Booking> */
    private Collection $bookings;

    private string $title;

    public function __construct(Collection $bookings, string $title = 'Detail Peminjaman')
    {
        $this->bookings = $bookings;
        $this->title = $title;
    }

    public function collection(): Collection
    {
        return $this->bookings;
    }

    /**
     * @param \App\Models\Booking $booking
     * @return array<string>
     */
    public function map($booking): array
    {
        $start = $booking->start_time ? Carbon::parse($booking->start_time)->format('H:i') : '-';
        $end = $booking->end_time ? Carbon::parse($booking->end_time)->format('H:i') : '-';
        $bookingDate = $booking->booking_date instanceof Carbon
            ? $booking->booking_date
            : ($booking->booking_date ? Carbon::parse($booking->booking_date) : null);

        return [
            $bookingDate ? $bookingDate->format('d M Y') : '-',
            $booking->room->name ?? '-',
            $booking->room->type ?? '-',
            $booking->user->name ?? '-',
            ucfirst($booking->status ?? '-'),
            $start,
            $end,
            $booking->purpose ?? '-',
            $booking->participants ?? '-',
        ];
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Ruangan',
            'Tipe',
            'Peminjam',
            'Status',
            'Mulai',
            'Selesai',
            'Keperluan',
            'Jumlah Peserta',
        ];
    }

    public function title(): string
    {
        return $this->title;
    }
}
