<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $data = User::all();

        return view('section.pengguna.index', [
            'data' => $data
        ]);
    }

    public function create(){

    }

    public function show(){

    }

    public function store(){

    }
    public function edit(){

    }
    public function update(){

    }
    public function destroy(){

    }
}
