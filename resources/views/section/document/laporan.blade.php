<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Cuti Bulanan</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #333;
        }

        h2, h4 {
            margin: 0;
            padding: 0;
        }

        .title {
            text-align: center;
            margin-bottom: 10px;
        }

        .periode {
            text-align: center;
            margin-bottom: 20px;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #aaa;
            padding: 6px 8px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #e8f0fe;
        }

        .summary {
            margin-top: 30px;
        }

        .summary table {
            width: 50%;
            border: none;
        }

        .summary td {
            padding: 4px 8px;
        }

        .summary td.label {
            font-weight: bold;
        }

        .title-table{
            margin-top: 30px;
        }
    </style>
</head>
<body>

    <div class="title">
        <h2>Laporan Pengajuan Cuti Karyawan</h2>
    </div>
    <div class="periode">
        Periode: {{ DateTime::createFromFormat('!m', $bulan_awal)->format('F') }} - {{ DateTime::createFromFormat('!m', $bulan_akhir)->format('F') }} {{ $tahun }}
    </div>

    @php
        $total = $cuti->count();
        $disetujui = $cuti->where('status', 'setujui')->count();
        $ditolak = $cuti->where('status', 'tolak')->count();
        $diproses = $cuti->where('status', 'proses')->count();
    @endphp

    <div class="summary">
        <h4>Rekapitulasi Status Cuti</h4>
        <table>
            <tr>
                <td class="label">Total Pengajuan</td>
                <td>: {{ $total }}</td>
            </tr>
            <tr>
                <td class="label">Disetujui</td>
                <td>: {{ $disetujui }}</td>
            </tr>
            <tr>
                <td class="label">Ditolak</td>
                <td>: {{ $ditolak }}</td>
            </tr>
            <tr>
                <td class="label">Diproses</td>
                <td>: {{ $diproses }}</td>
            </tr>
        </table>
    </div>

    <h4 class="title-table">Rekapitulasi Status Cuti</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Tanggal Cuti</th>
                <th>Alasan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cuti as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}</td>
                    <td>{{ $item->alasan }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
