<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

              return redirect()->route('dashboard');
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

    public function reset(){
        return view('auth.reset-password');
    }

    public function resetPost(Request $request)
    {
        // Validasi input email
        $request->validate([
            'email' => 'required|email'
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Set password baru
            $user->password = Hash::make('tirtamusi123');
            $user->save();

            // Kirim pesan sukses ke session
            return back()->with('status', 'Password berhasil di-reset ke: tirtamusi123');
        } else {
            // Jika email tidak ditemukan
            return back()->withErrors(['email' => 'Email tidak ditemukan dalam sistem.']);
        }
    }
}
