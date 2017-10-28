<?php

namespace App\Http\Controllers\Api\Penyakit;

use App\Http\Controllers\Controller;
use App\Kecamatan;
use App\Kelurahan;
use App\Penyakit;
use App\Puskesmas\Laporan;
use App\Utils\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        return Laporan::all();
    }

    public function store(Request $request)
    {
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

    public function show($id)
    {
        return \App\Laporan::find($id);
    }

    /**
     * Load laporan with datatables configuration
     *
     * @param Request
     * @return \Illuminate\Http\Response
     */
    public function ajax_laporan(Request $request)
    {
//        $this->middleware('auth');

        $start = $request->input('start');
        $length = $request->input('length');
        $draw = $request->input('draw');

        $where = "";
        $where .= Datatables::like_or_order($request);

        $count = DB::table('laporan')->count();

        $data = DB::table('laporan')
//            ->where($where)
            ->leftJoin('users', 'users.id', '=', 'laporan.pelapor')
            ->leftJoin('role', 'role.id', '=', 'users.role_id')
            ->leftJoin('penyakit', 'penyakit.id_penyakit', '=', 'laporan.penyakit')
            ->leftJoin('status', 'status.id_status', '=', 'laporan.status')
            ->leftJoin('tindakan', 'tindakan.id_tindakan', '=', 'laporan.tindakan')
            ->leftJoin('kecamatan', 'kecamatan.kecamatan_id', '=', 'laporan.kecamatan')
            ->leftJoin('kelurahan', 'kelurahan.kelurahan_id', '=', 'laporan.kelurahan')
            ->offset($start)
            ->limit($length)
            ->select('laporan.*', 'users.nik', 'role.name as tipe_pelapor', 'users.name as pelapor', 'penyakit.nama_penyakit', 'tindakan.nama_tindakan', 'status.nama_status', 'kecamatan.nama_kecamatan', 'kelurahan.nama_kelurahan')
            ->get();

        return [
            'draw' => $draw,
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'data' => $data,
        ];
    }
}
