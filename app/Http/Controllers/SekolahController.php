<?php

namespace App\Http\Controllers;

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
        }

        return view('sekolah/add');
    }
}
