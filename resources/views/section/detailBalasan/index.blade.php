@extends('layouts.main')

@section('content')
    <div class="main p-4 ms-3 mt-3">
        <h1 class="mb-4 fw-bold">Halo, Admin</h1>
        <hr class="text-black">
        <div class="mb-4 border-bottom pb-2">
            <h4 class="fw-bold text-dark">Detail Balasan</h4>
        </div>
        <div class="row mb-3">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Nama</label>
                <div class="form-control bg-light">Rizki</div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Status</label>
                <div class="form-control bg-light text-success">Disetujui</div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Tanggal Mulai</label>
                <div class="form-control bg-light">2025-06-01</div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Tanggal Selesai</label>
                <div class="form-control bg-light">2025-06-10</div>
            </div>
            <div class="col-12 mb-3">
                <label class="form-label fw-semibold">Alasan</label>
                <div class="form-control bg-light">Liburan keluarga</div>
            </div>
            <div class="col-12 mb-3">
                <label class="form-label fw-semibold">Balasan Admin</label>
                <div class="form-control bg-light">
                    Permohonan cuti Anda telah disetujui. Silakan pastikan pekerjaan ditinggal sudah dialihkan.
                </div>
            </div>

            {{-- Tombol Download PDF --}}
            <div class="col-12 mt-3">
                <a href="/files/balasan_izin_cuti.pdf" class="btn btn-outline-primary" download>
                    <i class="bi bi-download me-1"></i> Download PDF
                </a>
            </div>
        </div>
    </div>
@endsection
