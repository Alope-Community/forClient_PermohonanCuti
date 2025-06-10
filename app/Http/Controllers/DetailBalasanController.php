<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\LaporanCuti;
use Illuminate\Http\Request;

class DetailBalasanController extends Controller
{
    public function index(Cuti $cuti)
    {
        $notification = auth()->user()
            ->unreadNotifications
            ->where('data.leave_response_id', $cuti->id)
            ->first();

        if ($notification) {
            $notification->markAsRead();
        }

        $file = LaporanCuti::where('cuti_id', $cuti->id)->first();


        return view('section.detailBalasan.index', [
            'data' => $cuti,
            'file' => $file
        ]);
    }
}
