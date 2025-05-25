<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\JatahCuti;
use Illuminate\Http\Request;

class PengajuanCutiController extends Controller
{
    public function index(){
            return view('section.pengajuanCuti.index');
    }

    public function store(Request $request){
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

            Cuti::create([
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'alasan' => $request->alasan,
                'users_id' => $request->user_id
            ]);

            return redirect()->route('pengajuan.riwayat')->with('sucsess', 'Data Pengajuan Berhasil di Kirim');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function verifikasi(){
        return view('section.verification.index');
    }
}
