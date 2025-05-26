<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        try {
            $user = auth()->user();
            if (!$user) {
                return redirect()->back()->with('error', 'User Not Defined');
            }

            return view('section.profile.index', [
                'user' => $user
            ]);
        } catch (\Exception $e) {
           return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, User $user){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:Pria,Wanita',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:255',
        ]);

        try {
            $user->update($validated);
            return redirect()->route('user.profile')->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function changePassword(Request $request, User $user)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Check if current password matches
        if (!Hash::check($validated['current_password'], $user->password)) {
            return redirect()->back()->with('error', 'Password lama salah.');
        }

        try {
            $user->password = Hash::make($validated['new_password']);
            $user->save();

            return redirect()->route('user.profile')->with('success', 'Password berhasil diubah.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
