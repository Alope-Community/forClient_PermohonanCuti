<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Illuminate\Http\Request;

class PenerbitanController extends Controller
{
    public function index(){
        $data = Cuti::where('status', 'setujui')
            ->with('user', 'laporanCuti')
            ->get();

        dd($data);
        return view('section.penerbitan.index', [
            'data' => $data
        ]);
    }
}
