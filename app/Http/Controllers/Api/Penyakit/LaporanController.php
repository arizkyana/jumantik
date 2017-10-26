<?php

namespace App\Http\Controllers\Api\Penyakit;

use App\Http\Controllers\Controller;
use App\Kecamatan;
use App\Kelurahan;
use App\Penyakit;
use App\Puskesmas\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{

    public function __construct()
    {
    }

    public function index(){
        return ['data' => 'All laporan will be here'];
    }

    public function create(Request $request){
        return $request->input();
    }

    public function show($id){
        return $id;
    }
}
