<?php

namespace App\Http\Controllers\Penyakit;

use App\DetailLaporan;
use App\Http\Controllers\Controller;
use App\Kecamatan;
use App\Kelurahan;
use App\Penyakit;
use App\Puskesmas\Laporan;
use App\Role;
use App\Status;
use App\Tindakan;
use App\User;
use App\Utils\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DetailLaporanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request){

        $laporan = Laporan::find($request->input('id_laporan'));

        $validator = Validator::make($request->all(), [
            'id_laporan' => 'required',
            'detail_tindakan' => 'required',
            'detail_status' => 'required',
            'detail_keterangan' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('penyakit/laporan/' . $laporan->id . '/show')
                ->withErrors($validator);
        }

        $detail = new DetailLaporan();

        $detail->id_laporan = $laporan->id;
        $detail->pelapor = Auth::user()->id;

        $detail->keterangan = $request->input('detail_keterangan');
        $detail->tindakan = $request->input('detail_tindakan');
        $detail->status = $request->input('detail_status');
        $detail->is_visible = true;

        // if has file
        if ($request->hasFile('detail_foto')){
//            $path = strtolower(trim(str_replace(" ", "_", $request->input('nama'))));
            $foto = $request->file('detail_foto')->store('uploads/');
            $detail->foto = $foto;
        }

        $detail->save();

        // update laporan
        $laporan->status = $detail->status;
        $laporan->tindakan = $detail->tindakan;

        $laporan->save();

        return redirect('penyakit/laporan/' . $laporan->id . '/show')->with(['success', 'Berhasil Menambahkan Detail Laporan']);




    }

}

