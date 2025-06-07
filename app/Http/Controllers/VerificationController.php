<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\RiwayatCuti;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        dd($request->status);

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

        if ($request->status == 'direktur-operasional') {
            dd("hallo");
            $this->simpanKeLaporan($cuti);
             return redirect()->route('cuti.index')->with('success', 'Verifikasi cuti berhasil, Laporan Telah Di Generate.');
        } else {
             return redirect()->route('cuti.index')->with('success', 'Verifikasi cuti berhasil.');
        }


    }

    /**
     * Simpan data cuti ke laporan.
     *
     * @param  \App\Models\Cuti  $cuti
     * @return void
     */
    protected function simpanKeLaporan(Cuti $cuti)
    {
        // Generate kode: 3 digit urutan/CUTI/tanggal (ddmmyyyy)
        $lastId = DB::table('laporan_cutis')->max('id') ?? 0;
        $nextNumber = str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);
        $kode = $nextNumber . '/CUTI/' . now()->format('dmY');

        // Generate PDF file and save to storage
        $pdf = Pdf::loadView('section.document.template', compact('cuti'));
        $fileName = 'surat_cuti_' . $cuti->id . '_' . time() . '.pdf';
        $filePath = 'laporan_cuti/' . $fileName;
        Storage::put('public/' . $filePath, $pdf->output());

        // Simpan ke tabel laporan_cutis
        DB::table('laporan_cutis')->insert([
            'kode' => $kode,
            'cuti_id' => $cuti->id,
            'nama_karyawan' => $cuti->user_id,
            'diterbitkan_oleh' => auth()->user()->id,
            'tanggal_mulai' => $cuti->tanggal_mulai,
            'tanggal_selesai' => $cuti->tanggal_selesai,
            'jumlah_hari' => $cuti->jumlah_hari,
            'alasan' => $cuti->alasan,
            'file_path' => $filePath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
