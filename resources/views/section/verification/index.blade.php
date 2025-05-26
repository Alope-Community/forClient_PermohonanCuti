@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h2 class="h4 fw-bold mb-4">Verifikasi Cuti</h2>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Nama</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Alasan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Firdan Fauzan</td>
                    <td>2025-06-01</td>
                    <td>2025-06-05</td>
                    <td>Liburan keluarga</td>
                    <td>
                        <select name="status" class="form-select form-select-sm">
                            <option value="disetujui">Setujui</option>
                            <option value="ditolak">Tolak</option>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Tombol Kirim Desktop, kanan bawah --}}
    <div class="d-none d-sm-flex justify-content-end mt-3">
        <button 
            onclick="alert('Status cuti dikirim!')" 
            type="button" 
            class="btn btn-primary btn-sm">
            Kirim
        </button>
    </div>

    {{-- Tombol Kirim Mobile, di bawah tabel, kiri bawah --}}
    <div class="d-block d-sm-none mt-3 text-start">
        <button 
            onclick="alert('Status cuti dikirim!')" 
            type="button" 
            class="btn btn-primary btn-sm">
            Kirim
        </button>
    </div>
</div>
@endsection
