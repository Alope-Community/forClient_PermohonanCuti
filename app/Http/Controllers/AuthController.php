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
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $credentials = $request->only(['email', 'password']);

            if (Auth::attempt($credentials)) {
                $user = User::where('email', $request->email)->first();

                switch ($user->role) {
                    case 'karyawan':
                        return redirect()->route('dashboard');
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
                        return redirect()->route('dashboard');
                    default:
                        return redirect()->back()->withErrors(['error' => 'Email Atau Password Salah']);
                }
            } else {
                return redirect()->back()->withErrors(['error' => 'Email Atau Password Salah']);
            }
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
}
