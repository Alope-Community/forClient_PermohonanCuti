<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = User::all();

        return view('section.pengguna.index', [
            'data' => $data,
        ]);
    }



    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'gender' => 'required|in:Pria,Wanita',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
                'confirmation' => 'required|same:password',
                'alamat' => 'required|string',
                'no_telepon' => 'required|string|max:20',
                'role' => 'required|in:karyawan,asisten_manajer_unit,manajer_unit,asisten_manajer_sdm,manajer_sdm,direktur_operational,super_admin',
                'divisi' => 'nullable'
            ]);

            $user = User::create([
                'name' => $validated['name'],
                'gender' => $validated['gender'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'alamat' => $validated['alamat'],
                'no_telepon' => $validated['no_telepon'],
                'role' => $validated['role'],
                'divisi' => $validated['divisi']
            ]);

            return redirect()->back()->with('success', 'User created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('errors', $e->getMessage());
        }
    }

    public function destroy(User $id)
    {
        $id->delete();
        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}
