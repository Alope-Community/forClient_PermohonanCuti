<?php

namespace Database\Seeders;

use App\Models\JatahCuti;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Surya Danu Saputra',
                'gender' => 'Pria',
                'email' => 'surya.danu@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'karyawan',
            ],
            [
                'name' => 'Mukhlapila',
                'gender' => 'Pria',
                'email' => 'mukhlapila@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'karyawan',
            ],
            [
                'name' => 'Febryan Alfani',
                'gender' => 'Pria',
                'email' => 'febryan.alfani@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'karyawan',
            ],
            [
                'name' => 'Afrianti',
                'gender' => 'Pria',
                'email' => 'afrianti@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'karyawan',
            ],
            [
                'name' => 'Mirzal',
                'gender' => 'Pria',
                'email' => 'mirzal@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'karyawan',
            ],
            [
                'name' => 'Herlina Sari',
                'gender' => 'Pria',
                'email' => 'herlina@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'karyawan',
            ],
            [
                'name' => 'M Eric Saktana',
                'gender' => 'Pria',
                'email' => 'eric.saktana@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'karyawan',
            ],
            [
                'name' => 'Siti Aisyah',
                'gender' => 'Pria',
                'email' => 'siti.aisyah@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'karyawan',
            ],
            [
                'name' => 'Bambang Edi Harianto',
                'gender' => 'Pria',
                'email' => 'bambang.edi.harianto@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'karyawan',
            ],
            [
                'name' => 'Khoirul Kamal',
                'gender' => 'Pria',
                'email' => 'khoirul.kamal@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'karyawan',
            ],
            [
                'name' => 'Adelia Rahmawati',
                'gender' => 'Pria',
                'email' => 'adelia.rahmawati@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'karyawan',
            ],
        ];

        foreach ($users as $index => $user) {
            $user = User::create($user);
            $user->update([
                'divisi' => 'pelayanan'
            ]);

            JatahCuti::create([
                'users_id' => $user->id,
                'tahun' => now()->format('Y-01-01'),
                'total_jatah' => '20',
                'sisa_jatah' => '20'
            ]);
        }

        $atasan = [
            [
                'name' => 'M. Aidil Fikri, A.Md',
                'gender' => 'Pria',
                'email' => 'm.aidil.fikri@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'manajer_sdm',
            ],
            [
                'name' => 'Aan Ardianto',
                'gender' => 'Pria',
                'email' => 'aan.ardianto@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'manajer_sdm',
            ],
            [
                'name' => 'Muhammad Ilham',
                'gender' => 'Pria',
                'email' => 'muhammad.ilham@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'manajer_sdm',
            ],
            [
                'name' => 'M. Kokoh Pagestu',
                'gender' => 'Pria',
                'email' => 'mkokohpagestu@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'manajer_unit',
            ],
            [
                'name' => 'Rinto Chandra',
                'gender' => 'Pria',
                'email' => 'rinto.chandra@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'manajer_unit',
            ],
            [
                'name' => 'Bambang Hermanto',
                'gender' => 'Pria',
                'email' => 'bambang.hermanto@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'manajer_unit',
            ],
            [
                'name' => 'Dudi Iskandar',
                'gender' => 'Pria',
                'email' => 'dudi.iskandar@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'direktur_operational',
            ],
            [
                'name' => 'Efrilina',
                'gender' => 'Pria',
                'email' => 'efrilina@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'direktur_operational',
            ],
            [
                'name' => 'Dian Ariska Putri',
                'gender' => 'Pria',
                'email' => 'dian.ariska.putri@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'direktur_operational',
            ],

        ];

        foreach ($atasan as $index => $user) {
            $user  = User::create($user);
        }
    }
}
