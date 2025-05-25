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
}
