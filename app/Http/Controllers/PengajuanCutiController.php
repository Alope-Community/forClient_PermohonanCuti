<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
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
                'tanggal_selesai' => 'required|date',
                'alasan' => 'required|string',
                'user_id' => 'required|exists:users,id'
            ]);

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
