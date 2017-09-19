<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')){

            return var_dump($request->file('foto')->store('uploads'));
        }
        return view('siswa/add');
    }

    public function daftar()
    {
        return view('siswa/list');
    }
}
