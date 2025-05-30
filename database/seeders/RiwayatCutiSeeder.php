<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RiwayatCuti;
use Carbon\Carbon;

class RiwayatCutiSeeder extends Seeder
{
    public function run()
    {
        RiwayatCuti::create([
            'cuti_id' => 1, 
            'tanggal_update' => Carbon::now()->subDays(5), 
            'status' => 'manajer_sdm',
            'keterangan' => 'Cuti disetujui oleh Manajer SDM',
        ]);

        RiwayatCuti::create([
            'cuti_id' => 2,
            'tanggal_update' => Carbon::now()->subDays(2),
            'status' => 'manajer_unit',
            'keterangan' => 'Menunggu verifikasi Manajer Unit',
        ]);

        RiwayatCuti::create([
            'cuti_id' => 3,
            'tanggal_update' => Carbon::now()->subDay(),
            'status' => 'ditolak',
            'keterangan' => 'Cuti ditolak karena alasan tertentu',
        ]);
    }
}
