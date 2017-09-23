<?php

namespace App\Http\Controllers;

use App\Menu;
use App\RoleMenu;
use App\Sekolah;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;


class SekolahController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add(Request $request){


        if ($request->isMethod('post')){
            $validator = Validator::make($request->all(), [
                'nama' => 'required|max:100',
                'alamat' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect('sekolah/add')
                    ->withErrors($validator)
                    ->withInput();
            }

            // save new 'Sekolah'
            $sekolah = new Sekolah;
            $sekolah->nama = $request->input('nama');
            $sekolah->alamat = $request->input('alamat');

            if ($request->hasFile('foto')) {
                $path = strtolower(trim(str_replace(" ", "_", $request->input('nama'))));
                $foto = $request->file('foto')->store('uploads/' . $path );
                $sekolah->foto = $foto;
            }

            $sekolah->save();
            return redirect('sekolah/add')
                ->with('success', 'Sukses Tambah Sekolah Baru');
        }

        return view('sekolah/add');
    }
}
