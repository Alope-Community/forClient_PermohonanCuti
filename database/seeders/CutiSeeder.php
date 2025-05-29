<?php

namespace Database\Seeders;

use App\Models\Cuti;
use App\Models\JatahCuti;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CutiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengajuanCuti = Cuti::create([
            'users_id' => 1,
            'tanggal_mulai' => '2025-05-29',
            'tanggal_selesai' => '2025-06-01',
            'alasan' => 'pen kawin',
            'status' => 'setujui',
        ]);

        Cuti::create([
            'users_id' => 1,
            'tanggal_mulai' => '2025-05-20',
            'tanggal_selesai' => '2025-05-25',
            'alasan' => 'pen kawin',
            'status' => 'tolak',
        ]);

        Cuti::create([
            'users_id' => 1,
            'tanggal_mulai' => '2025-06-10',
            'tanggal_selesai' => '2025-06-15',
            'alasan' => 'pen kawin',
            'status' => 'proses',
        ]);

        // Hitung jumlah hari cuti (inklusif)
        $tanggalMulai = \Carbon\Carbon::createFromFormat('Y-m-d', $pengajuanCuti->tanggal_mulai);
        $tanggalSelesai = \Carbon\Carbon::createFromFormat('Y-m-d', $pengajuanCuti->tanggal_selesai);
        $jumlahHariCuti = $tanggalMulai->diffInDays($tanggalSelesai) + 1;

        // Update sisa cuti user
        $dataJatahCuti = JatahCuti::where('users_id', 1)->first();
        if ($dataJatahCuti) {
            $dataJatahCuti->update([
            'sisa_jatah' => max(0, $dataJatahCuti->sisa_jatah - $jumlahHariCuti)
            ]);
        }
    }
}
