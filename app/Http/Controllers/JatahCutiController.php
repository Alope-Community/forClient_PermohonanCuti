<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\JatahCuti;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JatahCutiController extends Controller
{
    public function index()
    {
        $dataKaryawan = User::where('role', 'karyawan')
            ->whereDoesntHave('jatahCuti', function ($q) {
                $q->whereYear('tahun', date('Y'));
            })->get();

        // Ambil semua jatah cuti yang sudah ada dan include relasi user-nya
        $dataJatahCuti = JatahCuti::with('users')->get();

        return view('section.jatahCuti.index', [
            'karyawan' => $dataKaryawan,
            'jatahCuti' => $dataJatahCuti
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'users_id' => 'required|exists:users,id',
                'tahun' => 'required|date',
                'total_jatah' => 'required|numeric',
            ]);

            $existing = JatahCuti::where('users_id', $request->user_id)
                ->whereYear('tahun', Carbon::parse($request->tahun)->year)
                ->first();

            if ($existing) {
                return back()->with('error', 'User ini sudah memiliki jatah cuti untuk tahun tersebut.');
            }

            JatahCuti::create([
                'users_id' => $request->users_id,
                'tahun' => $request->tahun,
                'total_jatah' => $request->total_jatah,
                'sisa_jatah' => $request->total_jatah
            ]);

            return redirect()->back()->with('success', 'Data Jatah Cuti Berhasil Di Tambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(JatahCuti $jatahCuti)
    {
        $dataKaryawan = User::where('role', 'karyawan')->get();
        return view('section.jatahCuti.edit', [
            'data' => $jatahCuti,
            'karyawan' => $dataKaryawan
        ]);
    }

    public function update(Request $request, JatahCuti $jatahCuti)
    {
        try {
            $request->validate([
                'users_id' => 'required|exists:users,id',
                'tahun' => 'required|date',
                'total_jatah' => 'required|numeric',
            ]);

            // Cek apakah ada data jatah cuti lain dengan user dan tahun yang sama
            $existing = JatahCuti::where('users_id', $request->users_id)
                ->whereYear('tahun', \Carbon\Carbon::parse($request->tahun)->year)
                ->where('id', '!=', $jatahCuti->id)
                ->first();

            if ($existing) {
                return back()->with('error', 'User ini sudah memiliki jatah cuti untuk tahun tersebut.');
            }

            // Ambil data cuti dengan status 'setujui' untuk user dan tahun terkait
            $cuti = Cuti::where('users_id', $request->users_id)
                ->whereYear('tanggal_mulai', \Carbon\Carbon::parse($request->tahun)->year)
                ->where('status', 'setujui')
                ->get();

            // Hitung total hari cuti yang sudah diambil
            $totalHariCuti = $cuti->sum(function ($item) {
                $mulai = \Carbon\Carbon::parse($item->tanggal_mulai);
                $selesai = \Carbon\Carbon::parse($item->tanggal_selesai);
                return $mulai->diffInDays($selesai) + 1;
            });

            if ($totalHariCuti) {
                $jatahCuti->update([
                    'users_id' => $request->users_id,
                    'tahun' => $request->tahun,
                    'total_jatah' => $request->total_jatah,
                    'sisa_jatah' => max(0, $request->total_jatah - $totalHariCuti)
                ]);
            } else {
                $jatahCuti->update([
                    'users_id' => $request->users_id,
                    'tahun' => $request->tahun,
                    'total_jatah' => $request->total_jatah,
                    'sisa_jatah' => $request->total_jatah,
                ]);
            }
            return redirect()->route('jatah-cuti')->with('success', 'Data Jatah Cuti berhasil diupdate.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(JatahCuti $jatahCuti)
    {
        try {
            $jatahCuti->delete();
            return redirect()->back()->with('success', 'Jatah cuti berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus jatah cuti: ' . $e->getMessage());
        }
    }
}
