<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Surat Balasan Izin</title>
  <style>
    body {
      font-family: "Times New Roman", serif;
      margin: 50px;
      line-height: 1.6;
    }
    .kop {
      text-align: center;
      font-weight: bold;
      text-transform: uppercase;
    }
    .tanggal {
      text-align: right;
      margin-top: 20px;
    }
    .info {
      margin-top: 20px;
    }
    .info table td {
      padding: 2px 5px;
    }
    .isi {
      margin-top: 30px;
    }
    .tanda-tangan {
      margin-top: 60px;
      text-align: right;
    }
    .ttd {
      margin-top: 80px;
    }
  </style>
</head>
<body>

  <div class="kop">KOP SURAT</div>

<div class="tanggal">Palembang, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
  <div class="info">
    <table>
      <tr>
        <td>Nomor</td>
        <td>: {{ $laporan->kode }}</td>
      </tr>
      <tr>
        <td>Hal</td>
        <td>: Balasan Surat Cuti</td>
      </tr>
      <tr>
        <td>Lampiran</td>
        <td>: -</td>
      </tr>
    </table>
  </div>

  <div class="isi">
    <p>Dengan Hormat,</p>
    <p>Menindak lanjuti surat permohonan izin saudara/saudari perihal permohonan cuti, saya yang bertanda tangan dibawah ini:</p>
    <table>
      <tr>
        <td>Nama</td>
        <td>: {{ $user->name }}</td>
      </tr>
      <tr>
        <td>Jabatan</td>
        <td>: {{ $user->role }}</td>
      </tr>
    </table>

    <p>Menerangkan bahwa:</p>
    <table>
      <tr>
        <td>Nama</td>
        <td>: {{ $cuti->user->name }}</td>
      </tr>
      <tr>
        <td>Posisi</td>
        <td>: {{ $cuti->user->role }}</td>
      </tr>
    </table>

    <p>Dan {{ $status == 'setujui' ? 'Disetujui' : 'Di Tolak' }}, izin untuk tidak masuk bekerja pada tanggal {{$cuti->tanggal_mulai}} sampai dengan {{ $cuti->tanggal_selesai }}.</p>

    <p>Demikian surat balasan ini disampaikan untuk dipergunakan sebagaimana mestinya.</p>
  </div>

  <div class="tanda-tangan">
    <p>Mengetahui</p>
    <div class="ttd">
      <p>{{ $user->name }}</p>
    </div>
  </div>

</body>
</html>
