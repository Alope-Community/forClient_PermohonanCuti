@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Form Verifikasi Cuti</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Informasi Cuti -->
                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label fw-bold">Nama Pegawai</label>
                    <p class="form-control-plaintext">Firdan Fauzan</p>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label fw-bold">Tanggal Pengajuan</label>
                    <p class="form-control-plaintext">2025-05-27</p>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label fw-bold">Tanggal Cuti</label>
                    <p class="form-control-plaintext">2025-06-01 s.d 2025-06-05</p>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label fw-bold">Alasan Cuti</label>
                    <p class="form-control-plaintext">Cuti tahunan keluarga</p>
                </div>
            </div>

            <!-- Form Verifikasi -->
            <form action="/verifikasi-cuti/123" method="POST">
                <!-- @csrf -->
                <div class="row">
                    <div class="col-12 col-md-6 mb-3">
                        <label for="status" class="form-label fw-bold">Status Verifikasi</label>
                        <select class="form-select" name="status" id="status" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="disetujui">Disetujui</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                    </div>

                    <div class="col-12 mb-3">
                        <label for="catatan" class="form-label fw-bold">Catatan (Opsional)</label>
                        <textarea class="form-control" name="catatan" id="catatan" rows="3"></textarea>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-success">Simpan Verifikasi</button>
                    <a href="/daftar-cuti" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection