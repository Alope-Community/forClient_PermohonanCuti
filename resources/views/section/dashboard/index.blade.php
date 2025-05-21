@extends('layouts.main')

@section('content')
<div class="main p-4 ms-3 mt-3">
    <h1 class="mb-4 fw-bold">Hallo, Admin</h1>
    <hr class="text-black">

    <div class="row g-4">
        <!-- Card: Karyawan 1 -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100" style="min-height: 160px;">
                <div class="card-body p-4 d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fw-semibold text-muted fs-5">Karyawan</div>
                        <div class="fs-2 fw-bold">150</div>
                    </div>
                    <i class="lni lni-users display-6 text-primary"></i>
                </div>
            </div>
        </div>

        <!-- Card: Karyawan 2 -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100" style="min-height: 160px;">
                <div class="card-body p-4 d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fw-semibold text-muted fs-5">Karyawan</div>
                        <div class="fs-2 fw-bold">150</div>
                    </div>
                    <i class="lni lni-users display-6 text-success"></i>
                </div>
            </div>
        </div>

        <!-- Card: Surat Balasan -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100" style="min-height: 160px;">
                <div class="card-body p-4 d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fw-semibold text-muted fs-5">Surat Balasan</div>
                        <div class="fs-2 fw-bold">150</div>
                    </div>
                    <i class="lni lni-envelope display-6 text-warning"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection