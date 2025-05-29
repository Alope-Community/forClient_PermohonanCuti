<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Illuminate\Http\Request;

class DetailBalasanController extends Controller
{
    public function index(Cuti $cuti)
    {
        return view('section.detailBalasan.index', [
            'data' => $cuti
        ]);
    }
}
