<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Detail Peminjaman</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; color: #1f2937; font-size: 12px; }
        h1, h2, h3 { margin: 0; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .meta { margin-top: 8px; }
        .meta span { display: inline-block; margin-right: 16px; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        th, td { border: 1px solid #d1d5db; padding: 8px; text-align: left; }
        th { background: #111827; color: white; font-weight: 600; }
        tbody tr:nth-child(even) { background: #f9fafb; }
        .total { margin-top: 12px; font-weight: 600; }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <h1>Laporan Detail Peminjaman Ruangan</h1>
            <div class="meta">
                <span>Periode: {{ $date_from }} &ndash; {{ $date_to }}</span>
                <span>Dibuat: {{ $generated_at }}</span>
            </div>
        </div>
        <div>
            <strong>Disusun oleh:</strong>
            <div>{{ $generated_by }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Ruangan</th>
                <th>Peminjam</th>
                <th>Status</th>
                <th>Mulai</th>
                <th>Selesai</th>
                <th>Keperluan</th>
                <th>Peserta</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bookings as $booking)
                <tr>
                    <td>{{ optional($booking->booking_date)->format('d M Y') }}</td>
                    <td>{{ $booking->room->name ?? '-' }}</td>
                    <td>{{ $booking->user->name ?? '-' }}</td>
                    <td>{{ ucfirst($booking->status) }}</td>
                    <td>{{ $booking->start_time ? \Carbon\Carbon::parse($booking->start_time)->format('H:i') : '-' }}</td>
                    <td>{{ $booking->end_time ? \Carbon\Carbon::parse($booking->end_time)->format('H:i') : '-' }}</td>
                    <td>{{ $booking->purpose ?? '-' }}</td>
                    <td>{{ $booking->participants ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align:center; padding:12px;">Tidak ada data peminjaman pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="total">Total peminjaman: {{ $total }}</div>
</body>
</html>
