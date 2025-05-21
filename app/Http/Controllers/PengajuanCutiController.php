<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengajuanCutiController extends Controller
{
    public function index(){
        try {
            $user = auth()->user();
            if (!$user) {
                return redirect()->back()->with('error', 'User Not Defined');
            }

            return view('section.pengajuanCuti.index', [
                'user' => $user
            ]);
        } catch (\Exception $e) {
           return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
