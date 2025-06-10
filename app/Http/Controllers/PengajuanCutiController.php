<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\JatahCuti;
use App\Models\RiwayatCuti;
use App\Models\User;
use App\Notifications\LeaveRequestNotification;
use App\Notifications\LeaveResponseNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PengajuanCutiController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;

        $query = RiwayatCuti::with('cuti.user');

        if ($role == 'manajer_unit') {
            $query->where('status', 'menunggu');
        } elseif ($role == 'manajer_sdm') {
            $query->where('status', 'manajer_unit');
        } elseif ($role == 'direktur_operational') {
            $query->where('status', 'manajer_sdm');
        } elseif ($role == 'karyawan') {
            return view('section.pengajuanCuti.index');
        }

        // TODO status ditolak dilempar ke riwayat

        $riwayatCuti = $query->get();

        return view('section.verification.index', compact('riwayatCuti'));
    }


    public function formEdit($id)
    {
        $riwayatCuti = RiwayatCuti::with('cuti.user')->findOrFail($id);

        $role = auth()->user()->role;
        $status = $riwayatCuti->status;

        // Logika akses bertahap
        $aksesValid = false;

        if ($role === 'manajer_unit' && $status === 'menunggu') {
            $aksesValid = true;
        } elseif ($role === 'manajer_sdm' && $status === 'manajer_unit') {
            $aksesValid = true;
        } elseif ($role === 'direktur_operational' && $status === 'manajer_sdm') {
            $aksesValid = true;
        } elseif ($role === 'super_admin') {
            $aksesValid = true; // super_admin bisa akses semua
        }

        if (!$aksesValid) {
            abort(403, 'Anda tidak memiliki akses untuk memverifikasi cuti ini.');
        }

        return view('section.verification.form', compact('riwayatCuti'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:setujui,ditolak',
            'keterangan' => 'required|string|max:255',
        ]);

        try {
            $riwayatCuti = RiwayatCuti::findOrFail($id);
            $user = auth()->user();
            $role = $user->role;
            $currentStatus = $riwayatCuti->status;


            if ($riwayatCuti->status === 'ditolak') {
                $cuti = Cuti::findOrFail($riwayatCuti->cuti_id);
                $this->simpanKeLaporan($cuti, $user, $request->status);
            }

            if (!$this->hasAccess($role, $currentStatus)) {
                return redirect()->back()->withErrors(['error' => 'Anda tidak memiliki akses untuk memverifikasi cuti ini.']);
            }

            $riwayatCuti->status = $request->status === 'setujui' ? $role : 'ditolak';
            $riwayatCuti->tanggal_update = now();
            $riwayatCuti->keterangan = $request->keterangan;

            $this->markNotificationAsRead($user, $riwayatCuti->id);

            if ($role === 'direktur_operational' || $riwayatCuti->status === 'ditolak') {
                $this->notifyEmployee($riwayatCuti, $request->status);
            }

            if ($role !== 'direktur_operational' && $request->status === 'setujui') {
                $this->notifyNextApprover($riwayatCuti, $role);
            }

            // Pengurangan jatah cuti
            if ($role === 'direktur_operational' && $request->status === 'setujui') {
                $start = \Carbon\Carbon::parse($riwayatCuti->cuti->tanggal_mulai);
                $end = \Carbon\Carbon::parse($riwayatCuti->cuti->tanggal_selesai);
                $jumlah_hari = $start->diffInDays($end) + 1;


                $jatahCuti = JatahCuti::where('users_id', $riwayatCuti->cuti->users_id)->first();
                $jatahCuti->sisa_jatah -= $jumlah_hari;
                $jatahCuti->save();
            }

            $riwayatCuti->save();
            return redirect()->route('cuti.verifikasi')->with('success', 'Verifikasi cuti berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $th->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
                'alasan' => 'required|string',
                'user_id' => 'required|exists:users,id'
            ]);
            // Hitung jumlah hari cuti yang diajukan
            $start = \Carbon\Carbon::parse($request->tanggal_mulai);
            $end = \Carbon\Carbon::parse($request->tanggal_selesai);
            $jumlah_hari = $start->diffInDays($end) + 1;

            // Pastikan cuti dalam tahun yang sama
            if ($start->year !== $end->year) {
                return redirect()->back()->withInput()->with('error', 'Tanggal cuti harus dalam tahun yang sama.');
            }

            // Ambil sisa cuti user untuk tahun berjalan
            $user = \App\Models\User::find($request->user_id);
            $tahun = $start->year . '-01-01';
            $sisa_cuti = JatahCuti::where('users_id', $user->id)
                ->where('tahun', $tahun)
                ->value('sisa_jatah');

            if (is_null($sisa_cuti)) {
                return redirect()->back()->withInput()->with('error', 'Jatah cuti untuk tahun ini tidak ditemukan.');
            }


            if ($jumlah_hari > $sisa_cuti) {
                return redirect()->back()->withInput()->with('error', 'Rentang waktu cuti melebihi sisa cuti Anda.');
            }

            $cuti = Cuti::create([
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'alasan' => $request->alasan,
                'users_id' => $request->user_id
            ]);

            // TODO: add ke riwayat cuti
            $riwayat = $cuti->riwayatCuti()->create([
                'tanggal_update' => now(),
                'status' => 'menunggu',
                'keterangan' => 'Menunggu Approval dari Manajer Unit'
            ]);

            // manajer unit terlebih dahulu
            $paraAtasan = User::where('role', 'manajer_unit')->get();

            $totalHariCuti = \Carbon\Carbon::parse($cuti->tanggal_mulai)->diffInDays(\Carbon\Carbon::parse($cuti->tanggal_selesai)) + 1;

            foreach ($paraAtasan as $atasan) {
                $atasan->notify(new LeaveRequestNotification(
                    $riwayat->id,
                    $cuti->user->name,
                    $totalHariCuti,
                    $cuti->alasan
                ));
            }

            return redirect()->route('pengajuan.riwayat')->with('success', 'Data Pengajuan Berhasil di Kirim');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    //? HELPERS
    private function hasAccess($role, $status)
    {
        return match ($role) {
            'manajer_unit' => $status === 'menunggu',
            'manajer_sdm' => $status === 'manajer_unit',
            'direktur_operational' => $status === 'manajer_sdm',
            'super_admin' => true,
            default => false,
        };
    }

    private function markNotificationAsRead($user, $leaveId)
    {
        $notification = $user->unreadNotifications
            ->where('data.leave_request_id', $leaveId)
            ->first();

        if ($notification) {
            $notification->markAsRead();
        }
    }

    private function notifyEmployee($riwayatCuti, $statusRequest)
    {
        $karyawan = $riwayatCuti->cuti->user;
        $cuti = $riwayatCuti->cuti;

        $cuti->status = $statusRequest === 'ditolak' ? 'tolak' : $statusRequest;
        $cuti->save();

        $karyawan->notify(new LeaveResponseNotification(
            $cuti->id,
            $cuti->status,
            $riwayatCuti->keterangan
        ));
    }

    private function notifyNextApprover($riwayatCuti, $currentRole)
    {
        $nextRole = match ($currentRole) {
            'manajer_unit' => 'manajer_sdm',
            'manajer_sdm' => 'direktur_operational',
            default => null,
        };

        if (!$nextRole) return;

        $atasans = User::where('role', $nextRole)->get();
        $cuti = $riwayatCuti->cuti;
        $totalHariCuti = \Carbon\Carbon::parse($cuti->tanggal_mulai)
            ->diffInDays(\Carbon\Carbon::parse($cuti->tanggal_selesai)) + 1;

        foreach ($atasans as $atasan) {
            $atasan->notify(new LeaveRequestNotification(
                $riwayatCuti->id,
                $cuti->user->name,
                $totalHariCuti,
                $cuti->alasan
            ));
        }
    }

    /**
     * Simpan data cuti ke laporan.
     *
     * @param  \App\Models\Cuti  $cuti
     * @return void
     */
    protected function simpanKeLaporan(Cuti $cuti, User $user, $status)
    {
        // Generate kode: 3 digit urutan/CUTI/tanggal (ddmmyyyy)
        $lastId = DB::table('laporan_cutis')->max('id') ?? 0;
        $nextNumber = str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);
        $kode = $nextNumber . '/CUTI/' . now()->format('dmY');

        // Hitung jumlah hari cuti
        $jumlah_hari = \Carbon\Carbon::parse($cuti->tanggal_mulai)
            ->diffInDays(\Carbon\Carbon::parse($cuti->tanggal_selesai)) + 1;

        // Simpan ke tabel laporan_cutis terlebih dahulu
        $laporanId = DB::table('laporan_cutis')->insertGetId([
            'kode' => $kode,
            'cuti_id' => $cuti->id,
            'nama_karyawan' => $cuti->users_id,
            'diterbitkan_oleh' => auth()->user()->id,
            'tanggal_mulai' => $cuti->tanggal_mulai,
            'tanggal_selesai' => $cuti->tanggal_selesai,
            'jumlah_hari' => $jumlah_hari,
            'alasan' => $cuti->alasan,
            'file_path' => '-', // sementara null, nanti diupdate setelah pdf dibuat
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Ambil data laporan yang baru saja disimpan
        $laporan = DB::table('laporan_cutis')->where('id', $laporanId)->first();

        // Generate PDF file and save to storage, gunakan data laporan
        $pdf = Pdf::loadView('section.document.template', compact(['laporan', 'cuti', 'user', 'status']));
        $fileName = 'surat_cuti_' . $cuti->id . '_' . time() . '.pdf';
        $filePath = 'laporan_cuti/' . $fileName;
        Storage::disk('public')->put($filePath, $pdf->output());

        // Update file_path di laporan_cutis
        DB::table('laporan_cutis')->where('id', $laporanId)->update([
            'file_path' => $filePath,
            'updated_at' => now(),
        ]);
    }
}
