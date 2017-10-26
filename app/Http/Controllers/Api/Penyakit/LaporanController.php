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

    public function store(Request $request){
        $pelapor = $request->auth_user;

        $laporan = new \App\Laporan();

        $laporan->pelapor = $pelapor->id;
        $laporan->jumlah_suspect = $request->input('jumlah_suspect');
        $laporan->penyakit = $request->input('penyakit'); // demam berdarah
//        $laporan->intensitas_jentik = $request->input('intensitas_jentik');
        $laporan->keterangan = $request->input('keterangan');
        $laporan->tindakan = $request->input('tindakan'); // Evakuasi
        $laporan->kecamatan = $request->input('kecamatan');
        $laporan->kelurahan = $request->input('kelurahan');
        $laporan->lat = $request->input('lat');
        $laporan->lon = $request->input('lon');
        $laporan->status = $request->input('status'); // Open
        $laporan->is_pekdrs = TRUE;
        $laporan->update_by = $pelapor->id;

        $laporan->save();

        return $laporan;
    }

    public function show($id){
        return \App\Laporan::find($id);
    }
}
