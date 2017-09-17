<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add(){
        return view('siswa/add');
    }

    public function list(){
        return view('siswa/list');
    }
}
