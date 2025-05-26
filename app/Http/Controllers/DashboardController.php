<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $cutiPerBulan = Cuti::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        // Daftar nama bulan
        $namaBulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        // Inisialisasi array dengan nama bulan sebagai key
        $data = [];
        foreach ($namaBulan as $num => $bulan) {
            $data[$bulan] = isset($cutiPerBulan[$num]) ? $cutiPerBulan[$num] : 0;
        }

        // $data sekarang berisi key nama bulan dan value total cuti
        return view('section.dashboard.index', ['cutiPerBulan' => $data]);
    }
}
