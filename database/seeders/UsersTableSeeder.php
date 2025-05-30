<?php

namespace Database\Seeders;

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
        $roles = [
            'karyawan',
            'manajer_unit',
            'manajer_sdm',
            'direktur_operational',
            'super_admin',
        ];

        foreach ($roles as $index => $role) {
            User::create([
                'name' => ucfirst(str_replace('_', ' ', $role)),
                'email' => $role . '@gmail.com',
                'gender' => 'Pria',
                'password' => Hash::make('password'),
                'alamat' => 'Alamat dummy untuk ' . $role,
                'no_telepon' => '08123456789' . $index,
                'role' => $role,
            ]);
        }

        User::create([
            'name' => 'Test',
            'email' => 'test@gmail.com',
            'gender' => 'Pria',
            'password' => Hash::make('password'),
            'alamat' => 'Alamat Dummy Doang.',
            'no_telepon' => '086938473848',
            'role' => 'karyawan',
        ]);
    }
}
