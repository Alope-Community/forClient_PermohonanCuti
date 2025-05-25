<?php

namespace App\Http\Controllers;

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
}
