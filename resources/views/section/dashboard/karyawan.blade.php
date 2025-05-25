 <div class="row g-4">
     <!-- Card: Karyawan 1 -->
     <div class="col-md-4">
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
     <div class="col-md-4">
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

     <div class="col-md-4">
         <div class="card shadow-sm border-0 h-100" style="min-height: 160px;">
             <div class="card-body p-4 d-flex justify-content-between align-items-center">
                 <div>
                     <div class="fw-semibold text-muted fs-5">Total Pengajuan Cuti</div>
                     <div class="fs-2 fw-bold">{{ App\Models\Cuti::where('users_id', auth()->user()->id)->count() }}
                     </div>
                 </div>
                 <i class="lni lni-envelope display-6 text-warning"></i>
             </div>
         </div>
     </div>
 </div>
