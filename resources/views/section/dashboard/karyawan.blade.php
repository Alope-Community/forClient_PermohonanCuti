<div class="row g-4">

    <h3>Notifikasi</h3>
    @forelse(auth()->user()->unreadNotifications as $notification)
        <div class="alert alert-info mb-2">
            <div>
                <p>Notifikasi Baru</p>
                <strong>Status: {{ $notification->data['status'] }}</strong><br>
                <p>Keterangan: {{ $notification->data['keterangan'] }}</p>
                <small>{{ $notification->created_at->diffForHumans() }}</small>
            </div>
            <a href="{{ route('pengajuan.balasan', $notification->data['leave_response_id']) }}"
                class="btn btn-primary mt-2">Lihat Balasan</a>
        </div>
    @empty
        <p>Tidak ada notifikasi.</p>
    @endforelse

    <!-- Card: Karyawan 1 -->
    <div class="col-12 col-md-4">
        <div class="card shadow-sm border-0 h-100" style="min-height: 160px;">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                <div>
                    <div class="fw-semibold text-muted fs-5">Jatah Cuti Tahun Ini</div>
                    <div class="fs-2 fw-bold">
                        @if (App\Models\JatahCuti::where('users_id', auth()->user()->id)->exists())
                            {{ App\Models\JatahCuti::where('users_id', auth()->user()->id)->value('total_jatah') }}
                        @else
                            0
                        @endif
                    </div>
                </div>
                <i class="lni lni-users display-6 text-primary"></i>
            </div>
        </div>
    </div>

    <!-- Card: Karyawan 2 -->
    <div class="col-12 col-md-4">
        <div class="card shadow-sm border-0 h-100" style="min-height: 160px;">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                <div>
                    <div class="fw-semibold text-muted fs-5">Sisa Jatah Cuti Anda</div>
                    <div class="fs-2 fw-bold">
                        @if (App\Models\JatahCuti::where('users_id', auth()->user()->id)->exists())
                            {{ App\Models\JatahCuti::where('users_id', auth()->user()->id)->value('sisa_jatah') }}
                        @else
                            0
                        @endif
                    </div>
                </div>
                <i class="lni lni-users display-6 text-success"></i>
            </div>
        </div>
    </div>

    <!-- Card: Total Pengajuan -->
    <div class="col-12 col-md-4">
        <div class="card shadow-sm border-0 h-100" style="min-height: 160px;">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                <div>
                    <div class="fw-semibold text-muted fs-5">Total Pengajuan Cuti</div>
                    <div class="fs-2 fw-bold">
                        {{ App\Models\Cuti::where('users_id', auth()->user()->id)->count() }}
                    </div>
                </div>
                <i class="lni lni-envelope display-6 text-warning"></i>
            </div>
        </div>
    </div>
</div>
