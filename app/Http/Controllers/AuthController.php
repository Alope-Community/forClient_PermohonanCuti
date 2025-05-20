<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:users,email',
                'password' => 'required',
            ], [
                'email.required' => 'Email Wajib Di Isi',
                'email.exists' => 'User Tidak Ditemukan',
                'password.required' => 'Password Wajib Di Isi',
            ]);

            $credentials = $request->only(['email', 'password']);

            if (Auth::attempt($credentials)) {
                $user = User::where('email', $request->email)->first();

                switch ($user->role) {
                    case 'karyawan':
                        dd('Login sebagai Karyawan');
                    case 'asisten_manajer_unit':
                        dd('Login sebagai Asisten Manajer Unit');
                    case 'manajer_unit':
                        dd('Login sebagai Manajer Unit');
                    case 'asisten_manajer_sdm':
                        dd('Login sebagai Asisten Manajer SDM');
                    case 'manajer_sdm':
                        dd('Login sebagai Manajer SDM');
                    case 'direktur_operational':
                        dd('Login sebagai Direktur Operasional');
                    case 'super_admin':
                        dd('Login sebagai Super Admin');
                    default:
                        return redirect()->back()->with('error', 'Email Atau Password Salah');
                }
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
