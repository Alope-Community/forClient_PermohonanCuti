<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
{
    $request->validate([
        'bulan_awal' => 'required|integer|min:1|max:12',
        'bulan_akhir' => 'required|integer|min:1|max:12|gte:bulan_awal',
    ]);

    $tahun = now()->year;
    $bulanAwal = (int) $request->bulan_awal;
    $bulanAkhir = (int) $request->bulan_akhir;

    // Ambil data cuti berdasarkan range bulan
    $cuti = Cuti::with('user')
        ->whereYear('tanggal_mulai', $tahun)
        ->whereMonth('tanggal_mulai', '>=', $bulanAwal)
        ->whereMonth('tanggal_mulai', '<=', $bulanAkhir)
        ->orderBy('tanggal_mulai')
        ->get();

    // Kirim ke PDF view (buat blade: laporan-pdf.blade.php)
    $pdf = Pdf::loadView('section.document.laporan', [
        'cuti' => $cuti,
        'bulan_awal' => $bulanAwal,
        'bulan_akhir' => $bulanAkhir,
        'tahun' => $tahun,
    ]);

    return $pdf->download("laporan-cuti-{$bulanAwal}-{$bulanAkhir}-{$tahun}.pdf");
}
}
