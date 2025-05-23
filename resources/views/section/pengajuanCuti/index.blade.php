@extends('layouts.main')

@section('content')
<div class="main p-4 ms-3 mt-3">
    <h1 class="mb-4 fw-bold">Halo, Admin</h1>
    <hr class="text-black">
    <div class="d-flex justify-content-center align-items-center mt-5">
        <div class="card shadow-sm rounded p-5" style="width: 100%; max-width: 700px;">
            <h4 class="text-center fw-bold mb-5">FORMULIR<br>PENGAJUAN CUTI</h4>
            <form action="" method="POST">
                @csrf

                <div class="row mb-3 align-items-center">
                    <div class="col-sm-4">
                        <label for="nama" class="col-form-label">Nama</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control bg-secondary-subtle border border-secondary" id="nama" name="nama" placeholder="Masukkan nama">
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <div class="col-sm-4">
                        <label for="tanggal_mulai" class="col-form-label">Tanggal Mulai</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="date" class="form-control bg-secondary-subtle border border-secondary" id="tanggal_mulai" name="tanggal_mulai">
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <div class="col-sm-4">
                        <label for="tanggal_selesai" class="col-form-label">Tanggal Selesai</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="date" class="form-control bg-secondary-subtle border border-secondary" id="tanggal_selesai" name="tanggal_selesai">
                    </div>
                </div>

                <div class="row mb-3 align-items-start">
                    <div class="col-sm-4">
                        <label for="alasan" class="col-form-label">Alasan</label>
                    </div>
                    <div class="col-sm-8">
                        <textarea class="form-control bg-secondary-subtle border border-secondary" id="alasan" name="alasan" rows="3" placeholder="Tulis alasan cuti..."></textarea>
                    </div>
                </div>

                <div class="row mb-4 align-items-start">
                    <div class="col-sm-4">
                        <label for="catatan_penolakan" class="col-form-label">Catatan Penolakan</label>
                    </div>
                    <div class="col-sm-8">
                        <textarea class="form-control bg-secondary-subtle border border-secondary" id="catatan_penolakan" name="catatan_penolakan" rows="2" placeholder="(Jika ada)"></textarea>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-5">Ajukan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
