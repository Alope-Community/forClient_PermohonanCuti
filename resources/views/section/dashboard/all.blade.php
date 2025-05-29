<div class="row g-4">
    <!-- Card: Total Karyawan -->
    <div class="col-12 col-md-4">
        <div class="card shadow-sm border-0 h-100" style="min-height: 160px;">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                <div>
                   @if (auth()->user()->role == 'super_admin')
                       <div class="fw-semibold text-muted fs-5">Total Pengguna</div>
                       <div class="fs-2 fw-bold">
                           {{ \App\Models\User::count() }}
                       </div>

                   @else
                         <div class="fw-semibold text-muted fs-5">Total Karyawan</div>
                          <div class="fs-2 fw-bold">
                            {{ \App\Models\User::where('role', 'karyawan')->count() }}
                          </div>
                   @endif
                </div>
                <i class="lni lni-users display-6 text-primary"></i>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="card shadow-sm border-0 h-100" style="min-height: 160px;">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                <div>
                    <div class="fw-semibold text-muted fs-5">Pengajuan Cuti Disetujui Tahun Ini</div>
                    <div class="fs-2 fw-bold">
                        {{ \App\Models\Cuti::whereYear('created_at', now()->year)->where('status', 'setujui')->count() }}
                    </div>
                </div>
                <i class="lni lni-checkmark-circle display-6 text-success"></i>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="card shadow-sm border-0 h-100" style="min-height: 160px;">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                <div>
                    <div class="fw-semibold text-muted fs-5">Pengajuan Cuti Ditolak Tahun Ini</div>
                    <div class="fs-2 fw-bold">
                        {{ \App\Models\Cuti::whereYear('created_at', now()->year)->where('status', 'ditolak')->count() }}
                    </div>
                </div>
                <i class="lni lni-close display-6 text-danger"></i>
            </div>
        </div>
    </div>
</div>
