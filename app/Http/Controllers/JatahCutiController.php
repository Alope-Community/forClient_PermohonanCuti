<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JatahCutiController extends Controller
{
       public function index()
    {
        try {
            $user = auth()->user();
            if (!$user) {
                return redirect()->back()->with('error', 'User Not Defined');
            }

            return view('section.jatahCuti.index', [
                'user' => $user
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
