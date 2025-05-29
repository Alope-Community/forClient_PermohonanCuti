<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JatahCuti;

class JatahCutiSeeder extends Seeder
{
    public function run(): void
    {
        JatahCuti::create([
            'users_id' => 1,
            'tahun' => now()->format('Y-01-01'),
            'total_jatah' => '20',
            'sisa_jatah' => '20'
        ]);
    }
}
