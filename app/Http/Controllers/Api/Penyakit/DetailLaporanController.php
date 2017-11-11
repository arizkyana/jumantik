<?php

namespace App\Http\Controllers\Api\Penyakit;

use App\DetailLaporan;
use App\Http\Controllers\Controller;
use App\Kecamatan;
use App\Kelurahan;
use App\Penyakit;
use App\Puskesmas\Laporan;
use App\Utils\Datatables;
use App\Utils\ResponseMod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

class DetailLaporanController extends Controller
{

    public function __construct()
    {
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_laporan' => 'required',
            'keterangan' => 'required',
            'tindakan' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return ResponseMod::success($validator->messages()->all());
        }

        $pelapor = isset($request->auth_user) ? $request->auth_user->id : $request->input('pelapor');

        $detail_laporan = new DetailLaporan();
        $detail_laporan->id_laporan = $request->input('id_laporan');
        $detail_laporan->pelapor = $pelapor; // TODO: Change to $request->auth_user after use middleware 'simple.token'
        $detail_laporan->keterangan = $request->input('keterangan');
        $detail_laporan->tindakan = $request->input('tindakan');
        $detail_laporan->status = $request->input('status');

        $detail_laporan->is_visible = TRUE;

        // if has file
        if ($request->hasFile('foto')){
//            $path = strtolower(trim(str_replace(" ", "_", $request->input('nama'))));
            $foto = $request->file('foto')->store('uploads/');
            $detail_laporan->foto = $foto;
        }

        $detail_laporan->save();

        // update laporan
        $laporan = \App\Laporan::find($request->input('id_laporan'));
        $laporan->status = $detail_laporan->status;
        $laporan->tindakan = $detail_laporan->tindakan;

        $laporan->save();

        return ResponseMod::success([
            'detail_laporan' => $detail_laporan,
            'laporan' => $laporan
        ]);
    }

    public function show($id)
    {
        return ResponseMod::success(\App\Laporan::find($id));
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
            ->leftJoin('penyakit', 'penyakit.id', '=', 'laporan.penyakit')
            ->leftJoin('status', 'status.id', '=', 'laporan.status')
            ->leftJoin('tindakan', 'tindakan.id', '=', 'laporan.tindakan')
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

    public function approval(Request $request, DetailLaporan $detail_laporan){

        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'tindakan' => 'required',
        ]);

        if ($validator->fails()) {
            return ResponseMod::failed($validator->messages()->all());
        }

        $approved_by = $request->auth_user->id;

        $status = $request->input('status');
        $tindakan = $request->input('tindakan');
        $is_pekdrs = $request->input('is_pekdrs') ? true : false;

        $detail_laporan->status = $status;
        $detail_laporan->tindakan = $tindakan;

        $detail_laporan->approved_by = $approved_by;
        $detail_laporan->save();

        $laporan = Laporan::find($detail_laporan->id_laporan);

        $laporan->status = $status;
        $laporan->tindakan = $tindakan;
        $laporan->is_pekdrs = $is_pekdrs;
        $laporan->approved_by = $approved_by;

        $laporan->save();

        return ResponseMod::success([
            'laporan' => $laporan
        ]);

    }
}
