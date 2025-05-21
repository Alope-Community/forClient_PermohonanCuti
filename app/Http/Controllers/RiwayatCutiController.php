<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiwayatCutiController extends Controller
{
   public function index(){
        try {
            $user = auth()->user();
            if (!$user) {
                return redirect()->back()->with('error', 'User Not Defined');
            }

            return view('section.riwayatCuti.index', [
                'user' => $user
            ]);
        } catch (\Exception $e) {
           return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
