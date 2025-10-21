<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Utilisasi Ruangan</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; color: #1f2937; font-size: 12px; }
        h1 { margin-bottom: 4px; }
        .meta { margin-bottom: 16px; }
        .meta span { display: inline-block; margin-right: 16px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #d1d5db; padding: 8px; text-align: left; }
        th { background: #111827; color: white; font-weight: 600; }
        tbody tr:nth-child(even) { background: #f9fafb; }
    </style>
</head>
<body>
    <h1>Laporan Utilisasi Ruangan</h1>
    <div class="meta">
        <span>Periode: {{ $date_from }} &ndash; {{ $date_to }}</span>
        <span>Dibuat: {{ $generated_at }}</span>
        <span>Disusun oleh: {{ $generated_by }}</span>
    </div>

    <table>
        <thead>
            <tr>
                <th>Ruangan</th>
                <th>Tipe</th>
                <th>Total Booking</th>
                <th>Total Jam Terpakai</th>
                <th>Utilisasi (%)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($utilization as $item)
                @php
                    $room = $item['room'] ?? null;
                    $type = $room->type ?? ($item['room_type'] ?? null);
                    $typeLabel = \App\Http\Controllers\ReportController::ROOM_TYPE_LABELS[$type] ?? ucfirst(str_replace('_', ' ', (string) ($type ?? 'Lainnya')));
                @endphp
                <tr>
                    <td>{{ $room->name ?? ($item['room_name'] ?? '-') }}</td>
                    <td>{{ $typeLabel }}</td>
                    <td>{{ $item['total_bookings'] ?? 0 }}</td>
                    <td>{{ number_format($item['total_hours'] ?? 0, 2) }}</td>
                    <td>{{ number_format($item['utilization_percentage'] ?? 0, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center; padding:12px;">Tidak ada data utilisasi pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
