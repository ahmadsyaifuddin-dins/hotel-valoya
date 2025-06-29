<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi Hotel</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        .header h1 {
            color: #2c3e50;
            margin-bottom: 5px;
        }
        .info {
            margin-bottom: 20px;
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 12px;
        }
        th {
            background-color: #3498db;
            color: white;
            padding: 10px;
            text-align: left;
        }
        td {
            padding: 8px 10px;
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .total-row {
            font-weight: bold;
            background-color: #e3f2fd !important;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 11px;
            color: #7f8c8d;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Transaksi Hotel</h1>
        @isset($start_date)
            <p>Periode: {{ date('d F Y', strtotime($start_date)) }} - {{ date('d F Y', strtotime($end_date)) }}</p>
        @else
            <p>Periode: Semua Data</p>
        @endisset
    </div>

    <div class="info">
        <p>Dicetak pada: {{ $waktuCetak }} WITA | Total Transaksi: {{ $booking_lists->count() }}</p>    </div>
    <table>
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Kode Booking</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Tipe Kamar</th>
                <th>Nama Pelanggan</th>
                <th class="text-right">Total (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($booking_lists as $booking)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $booking->kode_booking ?? '-' }}</td>
                <td>{{ $booking->tgl_checkin ? date('d M Y', strtotime($booking->tgl_checkin)) : '-' }}</td>
                <td>{{ $booking->tgl_checkout ? date('d M Y', strtotime($booking->tgl_checkout)) : '-' }}</td>
                <td>{{ $booking->tipeKamars->nama ?? 'N/A' }}</td>
                <td>{{ $booking->nama_pemesan ?? '-' }}</td>
                <td class="text-right">{{ number_format($booking->total ?? 0, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="6" class="text-right"><strong>Total Pendapatan:</strong></td>
                <td class="text-right"><strong>Rp{{ number_format($booking_lists->sum('total'), 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak oleh: {{ auth()->user()->name ?? 'System' }} | {{ config('app.name') }}</p>
    </div>
</body>
</html>