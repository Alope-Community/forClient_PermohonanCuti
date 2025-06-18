@extends('layouts.main')

@section('content')
    <div class="main p-4 ms-3 mt-3">
        <div class="mb-4 border-bottom pb-2">
            <h4 class="fw-bold text-dark">Detail Balasan</h4>
        </div>
        <div class="row mb-3">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Nama</label>
                <div class="form-control bg-light">{{ $data->user ? $data->user->name : '-' }}</div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Status</label>
                @if ($data->status == 'setujui')
                    <div class="form-control bg-light text-success">Disetujui</div>
                @else
                    <div class="form-control bg-light text-danger">Ditolak</div>
                @endif
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Tanggal Mulai</label>
                <div class="form-control bg-light">{{ $data->tanggal_mulai }}</div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Tanggal Selesai</label>
                <div class="form-control bg-light">{{ $data->tanggal_selesai }}</div>
            </div>
            <div class="col-12 mb-3">
                <label class="form-label fw-semibold">Alasan</label>
                <div class="form-control bg-light">{{ $data->alasan }}</div>
            </div>
            <div class="col-12 mb-3">
                <label class="form-label fw-semibold">Balasan Atasan</label>
               @if (auth()->user()->role == 'manajer_sdm')
                   <div class="form-control bg-light">
                        Permohonan cuti telah disetujui oleh semua atasan. silakan anda untuk terbitkan surat.
                    </div>
               @else
                    @if ($data->status == 'setujui')
                    <div class="form-control bg-light">
                        Permohonan cuti Anda telah disetujui. Silakan pastikan pekerjaan ditinggal sudah dialihkan.
                    </div>
                @else
                    <div class="form-control bg-light">
                        Permohonan cuti Anda ditolak oleh atasan.
                    </div>
                @endif
               @endif
            </div>
            @if (auth()->user()->role == 'manajer_sdm')
                <div class="col-12 mt-3">
                    <a href="{{ route('penerbitan.store', $data->id) }}" class="btn btn-primary">
                        <i class="bi bi-file-earmark-text me-1"></i> Penerbitan Surat
                    </a>
                </div>
            @else
                @if ($file && isset($file['file_path']))
                    {{-- Tombol Download PDF --}}
                    <div class="col-12 mt-3">
                        <a href="{{ asset('storage/' . $file['file_path']) }}" class="btn btn-outline-primary" download>
                            <i class="bi bi-download me-1"></i> Download PDF
                        </a>
                    </div>
                @else
                    {{-- Pesan jika file belum tersedia --}}
                    <div class="col-12 mt-3">
                        <div class="alert alert-warning" role="alert">
                            File belum tersedia. Mohon menunggu penerbitan surat oleh Manajer SDM.
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection
