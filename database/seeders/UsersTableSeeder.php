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
                'nip' => '1990010112340011',
                'gender' => 'Pria',
                'email' => 'surya.danu@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'karyawan',
            ],
            [
                'name' => 'Mukhlapila',
                'nip' => '1990020212340012',
                'gender' => 'Pria',
                'email' => 'mukhlapila@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'karyawan',
            ],
            [
                'name' => 'Febryan Alfani',
                'nip' => '1990030312340013',
                'gender' => 'Pria',
                'email' => 'febryan.alfani@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'karyawan',
            ],
            [
                'name' => 'Afrianti',
                'nip' => '1990040412340014',
                'gender' => 'Pria',
                'email' => 'afrianti@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'karyawan',
            ],
            [
                'name' => 'Mirzal',
                'nip' => '1990050512340015',
                'gender' => 'Pria',
                'email' => 'mirzal@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'karyawan',
            ],
            [
                'name' => 'Herlina Sari',
                'nip' => '1990060612340016',
                'gender' => 'Pria',
                'email' => 'herlina@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'karyawan',
            ],
            [
                'name' => 'M Eric Saktana',
                'nip' => '1990070712340017',
                'gender' => 'Pria',
                'email' => 'eric.saktana@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'karyawan',
            ],
            [
                'name' => 'Siti Aisyah',
                'nip' => '1990080812340018',
                'gender' => 'Pria',
                'email' => 'siti.aisyah@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'karyawan',
            ],
            [
                'name' => 'Bambang Edi Harianto',
                'nip' => '1990090912340019',
                'gender' => 'Pria',
                'email' => 'bambang.edi.harianto@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'karyawan',
            ],
            [
                'name' => 'Khoirul Kamal',
                'nip' => '1990101012340020',
                'gender' => 'Pria',
                'email' => 'khoirul.kamal@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'karyawan',
            ],
            [
                'name' => 'Adelia Rahmawati',
                'nip' => '1990111112340021',
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
                'nip' => '1980010112340001',
                'gender' => 'Pria',
                'email' => 'm.aidil.fikri@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'manajer_sdm',
            ],
            [
                'name' => 'Aan Ardianto',
                'nip' => '1981020212340002',
                'gender' => 'Pria',
                'email' => 'aan.ardianto@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'manajer_sdm',
            ],
            [
                'name' => 'Muhammad Ilham',
                'nip' => '1982030312340003',
                'gender' => 'Pria',
                'email' => 'muhammad.ilham@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'manajer_sdm',
            ],
            [
                'name' => 'M. Kokoh Pagestu',
                'nip' => '1983040412340004',
                'gender' => 'Pria',
                'email' => 'mkokohpagestu@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'manajer_unit',
            ],
            [
                'name' => 'Rinto Chandra',
                'nip' => '1984050512340005',
                'gender' => 'Pria',
                'email' => 'rinto.chandra@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'manajer_unit',
            ],
            [
                'name' => 'Bambang Hermanto',
                'nip' => '1985060612340006',
                'gender' => 'Pria',
                'email' => 'bambang.hermanto@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'manajer_unit',
            ],
            [
                'name' => 'Dudi Iskandar',
                'nip' => '1986070712340007',
                'gender' => 'Pria',
                'email' => 'dudi.iskandar@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'direktur_operational',
            ],
            [
                'name' => 'Efrilina',
                'nip' => '1987080812340008',
                'gender' => 'Pria',
                'email' => 'efrilina@gmail.com',
                'password' => bcrypt('password'),
                'alamat' => '-',
                'no_telepon' => '-',
                'role' => 'direktur_operational',
            ],
            [
                'name' => 'Dian Ariska Putri',
                'nip' => '1988090912340009',
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
