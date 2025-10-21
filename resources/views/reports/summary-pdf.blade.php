<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Ringkasan Peminjaman</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; color: #1f2937; font-size: 12px; }
        h1 { margin-bottom: 6px; }
        .meta { margin-bottom: 16px; }
        .meta span { display: inline-block; margin-right: 16px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #d1d5db; padding: 8px; text-align: left; }
        th { background: #111827; color: white; font-weight: 600; }
        tbody tr:nth-child(even) { background: #f9fafb; }
    </style>
</head>
<body>
    <h1>Laporan Ringkasan Peminjaman</h1>
    <div class="meta">
        <span>Periode: {{ $date_from }} &ndash; {{ $date_to }}</span>
        <span>Dibuat: {{ $generated_at }}</span>
        <span>Disusun oleh: {{ $generated_by }}</span>
    </div>

    <table>
        <thead>
            <tr>
                <th>Metrik</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total Pengajuan</td>
                <td>{{ $summary['total_bookings'] ?? 0 }}</td>
            </tr>
            <tr>
                <td>Disetujui</td>
                <td>{{ $summary['approved'] ?? 0 }}</td>
            </tr>
            <tr>
                <td>Ditolak</td>
                <td>{{ $summary['rejected'] ?? 0 }}</td>
            </tr>
            <tr>
                <td>Dibatalkan</td>
                <td>{{ $summary['cancelled'] ?? 0 }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
