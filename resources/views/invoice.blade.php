<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $pembayaran->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #007bff;
            margin: 0;
            font-size: 28px;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .invoice-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .info-section {
            flex: 1;
        }
        .info-section h3 {
            color: #007bff;
            margin-bottom: 10px;
            font-size: 16px;
        }
        .info-section p {
            margin: 5px 0;
            font-size: 14px;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .details-table th,
        .details-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        .details-table th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #333;
        }
        .details-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .total-section {
            text-align: right;
            margin-top: 20px;
        }
        .total-amount {
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        .date-info {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>INVOICE PEMBAYARAN</h1>
        <p>Mutam Tour & Travel</p>
        <p>No. Invoice: #{{ $pembayaran->id }}</p>
    </div>

    <div class="invoice-info">
        <div class="info-section">
            <h3>Data Jamaah</h3>
            <p><strong>Nama:</strong> {{ strtoupper($jamaah->nama) }}</p>
            <p><strong>Alamat:</strong> {{ $jamaah->alamat ?? '-' }}</p>
            <p><strong>No. WA:</strong> {{ $jamaah->nomor_wa ?? '-' }}</p>
            <p><strong>CS:</strong> {{ $jamaah->cs ?? '-' }}</p>
        </div>
        
        <div class="info-section">
            <h3>Data Group</h3>
            @if($group)
                <p><strong>Paket:</strong> {{ $paket->nama ?? '-' }}</p>
                <p><strong>Keterangan:</strong> {{ $group->keterangan ?? '-' }}</p>
                <p><strong>Vendor:</strong> {{ $group->vendor ?? '-' }}</p>
                <p><strong>Tour Leader:</strong> {{ $group->tour_leader ?? '-' }}</p>
            @else
                <p>Belum terdaftar dalam group</p>
            @endif
        </div>
    </div>

    @if($group)
    <div class="date-info">
        <h3>Tanggal Keberangkatan</h3>
        @php
            $bulanMap = [
                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 
                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 
                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
            ];
            $tanggal = $group->tanggal;
            $bulan = $bulanMap[(int) $group->bulan] ?? $group->bulan;
            $tahun = $group->tahun;
        @endphp
        <p><strong>Tanggal:</strong> 
            @if($tanggal && $bulan && $tahun)
                {{ $tanggal }} {{ $bulan }} {{ $tahun }}
            @elseif($bulan && $tahun)
                {{ $bulan }} {{ $tahun }}
            @else
                Belum ditentukan
            @endif
        </p>
    </div>
    @endif

    <table class="details-table">
        <thead>
            <tr>
                <th>Jenis Pembayaran</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $pembayaran->jenis }}</td>
                <td>Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</td>
                <td>{{ $pembayaran->keterangan ?? '-' }}</td>
                <td>{{ $pembayaran->created_at->format('d/m/Y H:i') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="total-section">
        <p class="total-amount">Total: Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</p>
    </div>

    <div class="footer">
        <p>Terima kasih atas kepercayaan Anda kepada Mutam Tour & Travel</p>
        <p>Invoice ini dibuat secara otomatis pada {{ now()->format('d F Y H:i') }}</p>
    </div>
</body>
</html>