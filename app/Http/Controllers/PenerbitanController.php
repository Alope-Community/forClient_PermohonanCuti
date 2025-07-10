<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PenerbitanController extends Controller
{
    public function index()
    {
        $data = Cuti::where('status', 'setujui')
            ->doesntHave('laporanCuti')
            ->with('user', 'riwayatCuti')
            ->get();

        return view('section.penerbitan.index', [
            'data' => $data
        ]);
    }

    public function store($cuti)
    {
        try {
            $data = Cuti::where('id', $cuti)->with('user', 'riwayatCuti')->first();

            $user = auth()->user() ?? null;

            $this->simpanKeLaporan($data, $user, $data->status);

            return redirect()->route('penerbitan.index')->with('success', 'Surat Berhasil Di buat');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function simpanKeLaporan(Cuti $cuti, User $user, $status)
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
            'diterbitkan_oleh' => auth()->user()->name,
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
