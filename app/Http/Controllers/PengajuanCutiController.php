<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\JatahCuti;
use App\Models\RiwayatCuti;
use App\Models\User;
use App\Notifications\LeaveRequestNotification;
use App\Notifications\LeaveResponseNotification;
use Illuminate\Http\Request;

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
}
