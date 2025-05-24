<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Illuminate\Http\Request;

class RiwayatCutiController extends Controller
{
    public function index()
    {
        try {
            $data = Cuti::where('users_id', auth()->user()->id)
                ->with('user')
                ->get();

            // dd($data);
            return view('section.riwayatCuti.index', [
                'data' => $data
            ]);
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
