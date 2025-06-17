@extends('layouts.main')

@section('content')
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Form Verifikasi Cuti</h5>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card-body">
                <div class="row">
                    <!-- Informasi Cuti -->
                    <div class="col-12 col-md-6 mb-3">
                        <label class="form-label fw-bold">Nama Pegawai</label>
                        <p class="form-control-plaintext">{{ $riwayatCuti->cuti->user->name }}</p>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <label class="form-label fw-bold">Divisi Pegawai</label>
                        <p class="form-control-plaintext">{{ $riwayatCuti->cuti->user->divisi }}</p>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <label class="form-label fw-bold">Tanggal Pengajuan</label>
                        <p class="form-control-plaintext">{{ $riwayatCuti->cuti->created_at }}</p>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <label class="form-label fw-bold">Tanggal Mulai Cuti</label>
                        <p class="form-control-plaintext">{{ $riwayatCuti->cuti->tanggal_mulai }}</p>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <label class="form-label fw-bold">Tanggal Selesai Cuti</label>
                        <p class="form-control-plaintext">{{ $riwayatCuti->cuti->tanggal_selesai }}</p>
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label fw-bold">Alasan Cuti</label>
                        <p class="form-control-plaintext">{{ $riwayatCuti->cuti->alasan }}</p>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <label class="form-label fw-bold">Tanggal Update Verifikasi</label>
                        <p class="form-control-plaintext">{{ $riwayatCuti->tanggal_update }}</p>
                    </div>

                    <hr>

                    <div class="col-12 col-md-6 mb-3">
                        <label class="form-label fw-bold">Verifikasi Sebelumnya oleh</label>
                        <p class="form-control-plaintext">{{ ucwords(str_replace('_', ' ', $riwayatCuti->status)) }}</p>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <label class="form-label fw-bold">Keterangan Sebelumnya:</label>
                        <p class="form-control-plaintext">{{ $riwayatCuti->keterangan }}</p>
                    </div>

                </div>

                <!-- Form Verifikasi -->
                <form action="{{ route('cuti.verifikasi.update', $riwayatCuti->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="status" class="form-label fw-bold">Status Verifikasi</label>
                            <select class="form-select" name="status" id="status" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="setujui">Disetujui</option>
                                <option value="ditolak">Ditolak</option>
                            </select>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="keterangan" class="form-label fw-bold">Keterangan</label>
                            <textarea class="form-control" name="keterangan" id="keterangan" rows="3" required></textarea>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn" style="background-color: #00BFFF">Simpan Verifikasi</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
