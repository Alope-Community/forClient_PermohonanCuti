<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\RiwayatCuti;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verifikasi(Request $request, $cuti_id)
    {
        $request->validate([
            'status' => 'required|in:manajer-unit,manajer-sdm,direktur-operasional,ditolak',
            'keterangan' => 'required|string',
        ]);

        $cuti = Cuti::findOrFail($cuti_id);

        $existing = RiwayatCuti::where('cuti_id', $cuti_id)
            ->where('status', $request->status)
            ->exists();

        if ($existing) {
            return redirect()->back()->withErrors([
                'status' => 'Status verifikasi ini sudah ada sebelumnya.'
            ]);
        }

        // Simpan riwayat verifikasi
        RiwayatCuti::create([
            'cuti_id' => $cuti_id,
            'tanggal_update' => now(),
            'status' => $request->status,
            'keterangan' => $request->keterangan
        ]);

        // Update status cuti jika ditolak atau semua tahap selesai
        $riwayats = RiwayatCuti::where('cuti_id', $cuti_id)->pluck('status');

        if ($riwayats->contains('ditolak')) {
            $cuti->status = 'tolak';
            $cuti->catatan_penolakan = $request->keterangan;
        } elseif (
            $riwayats->contains('manajer-unit') &&
            $riwayats->contains('manajer-sdm') &&
            $riwayats->contains('direktur-operasional')
        ) {
            $cuti->status = 'setujui';
        } else {
            $cuti->status = 'proses';
        }

        $cuti->save();

        return redirect()->route('cuti.index')->with('success', 'Verifikasi cuti berhasil.');
    }
}
