<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\JatahCuti;
use App\Models\RiwayatCuti;
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

            $role = auth()->user()->role;
            $status = $riwayatCuti->status;

            // Validasi akses berdasarkan status saat ini
            $aksesValid = match ($role) {
                'manajer_unit' => $status === 'menunggu',
                'manajer_sdm' => $status === 'manajer_unit',
                'direktur_operational' => $status === 'manajer_sdm',
                'super_admin' => true,
                default => false,
            };

            if (!$aksesValid) {
                return redirect()->back()->withErrors(['error' => 'Anda tidak memiliki akses untuk memverifikasi cuti ini.']);
            }

            // Update status berdasarkan persetujuan
            $riwayatCuti->status = $request->status === 'setujui' ? $role : 'ditolak';
            $riwayatCuti->tanggal_update = now();
            $riwayatCuti->keterangan = $request->keterangan;

            if ($role === 'direktur_operational' || $riwayatCuti->status === 'ditolak') {
                $riwayatCuti->cuti->status = $request->status === 'ditolak' ? 'tolak' : $request->status;
                $riwayatCuti->cuti->save();
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
            $cuti->riwayatCuti()->create([
                'tanggal_update' => now(),
                'status' => 'menunggu',
                'keterangan' => 'Menunggu Approval dari Manajer Unit'
            ]);

            return redirect()->route('pengajuan.riwayat')->with('sucsess', 'Data Pengajuan Berhasil di Kirim');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
