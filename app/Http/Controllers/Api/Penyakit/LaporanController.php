<?php

namespace App\Http\Controllers\Api\Penyakit;

use App\DetailLaporan;
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
        $pelapor = isset($request->auth_user) ? $request->auth_user->id : $request->input('pelapor');

        $laporan = new \App\Laporan();

        $laporan->pelapor = $pelapor;
        $laporan->jumlah_suspect = $request->input('jumlah_suspect');
        $laporan->penyakit = $request->input('penyakit'); // demam berdarah
        $laporan->intensitas_jentik = $request->input('intensitas_jentik');
        $laporan->keterangan = $request->input('keterangan');
        $laporan->tindakan = $request->input('tindakan'); // Evakuasi
        $laporan->kecamatan = $request->input('kecamatan');
        $laporan->kelurahan = $request->input('kelurahan');
        $laporan->lat = $request->input('lat');
        $laporan->lon = $request->input('lon');
        $laporan->alamat = $request->input('alamat');
        $laporan->status = 1; // Open
        $laporan->is_pekdrs = $request->input('is_pekdrs');
        $laporan->update_by = $pelapor;

        $laporan->save();

        return $laporan;
    }

    public function show($id)
    {
        $laporan = \App\Laporan::find($id);
        $detail_laporan = DetailLaporan::where('id_laporan', $id)->get();

        if (empty($detail_laporan)) $detail_laporan = [];

        return [
            'message' => 'OK',
            'laporan' => $laporan,
            'detail_laporan' => $detail_laporan
        ];
    }

    /**
     * Load laporan with datatables configuration
     *
     * @param Request
     * @return \Illuminate\Http\Response
     */
    public function ajax_laporan(Request $request)
    {

        $start = $request->input('start');
        $length = $request->input('length');
        $draw = $request->input('draw');


        $count = DB::table('laporan')->count();

        $data = DB::table('laporan')
//            ->where($where)
            ->leftJoin('users', 'users.id', '=', 'laporan.pelapor')
            ->leftJoin('role', 'role.id', '=', 'users.role_id')
            ->leftJoin('penyakit', 'penyakit.id', '=', 'laporan.penyakit')
            ->leftJoin('tindakan', 'tindakan.id', '=', 'laporan.tindakan')
            ->leftJoin('kecamatan', 'kecamatan.kecamatan_id', '=', 'laporan.kecamatan')
            ->leftJoin('kelurahan', 'kelurahan.kelurahan_id', '=', 'laporan.kelurahan')
            ->offset($start)
            ->limit($length)
            ->select('laporan.*', 'users.nik', 'role.name as tipe_pelapor', 'users.name as pelapor', 'penyakit.nama_penyakit', 'tindakan.nama_tindakan', 'kecamatan.nama_kecamatan', 'kelurahan.nama_kelurahan')
            ->where('laporan.status', '<>', 0);


        if ($request->query('tanggal_mulai') && $request->query('tanggal_akhir') && $request->query('tipe_pelapor') && $request->query('penyakit')) {
            $tanggal_mulai = date('Y-m-d', strtotime($request->query('tanggal_mulai')));
            $tanggal_akhir = date('Y-m-d', strtotime($request->query('tanggal_akhir')));
            $data->whereBetween('laporan.created_at', [$tanggal_mulai, $tanggal_akhir]);
            if ($request->query('tipe_pelapor') !== 'all' && $request->query('penyakit') !== 'all') {
                $data->where('role.id', '=', $request->query('tipe_pelapor'));
                $data->where('penyakit.id', '=', $request->query('penyakit'));
            }
        }

        if ($request->query('tanggal_mulai') && $request->query('tanggal_akhir') && $request->query('tipe_pelapor')) {
            $tanggal_mulai = date('Y-m-d', strtotime($request->query('tanggal_mulai')));
            $tanggal_akhir = date('Y-m-d', strtotime($request->query('tanggal_akhir')));
            $data->whereBetween('laporan.created_at', [$tanggal_mulai, $tanggal_akhir]);
            if ($request->query('tipe_pelapor') !== 'all') {
                $data->where('role.id', '=', $request->query('tipe_pelapor'));
            }
        }

        if ($request->query('tanggal_mulai') && $request->query('tanggal_akhir')) {
            $tanggal_mulai = date('Y-m-d 00:00:00', strtotime($request->query('tanggal_mulai')));
            $tanggal_akhir = date('Y-m-d 23:59:59', strtotime($request->query('tanggal_akhir')));
            $data->whereBetween('laporan.created_at', [$tanggal_mulai, $tanggal_akhir]);
        }


        if ($request->query('tipe_pelapor') && $request->query('penyakit')) {
            if ($request->query('tipe_pelapor') !== 'all' && $request->query('penyakit') !== 'all') {
                $data->where('role.id', '=', $request->query('tipe_pelapor'));
                $data->where('penyakit.id', '=', $request->query('penyakit'));
            }
        }

        if ($request->query('tipe_pelapor')) {
            if ($request->query('tipe_pelapor') !== 'all') {
                $data->where('role.id', '=', $request->query('tipe_pelapor'));
            }
        }

        if ($request->query('penyakit')) {
            if ($request->query('penyakit') !== 'all') {
                $data->where('penyakit.id', '=', $request->query('penyakit'));
            }
        }

        $data = Datatables::like($request, $data);
        $data = Datatables::order($request, $data);

        $data = $data->get();

        return [
            'draw' => $draw,
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'data' => $data,

        ];
    }

    public function delete($id)
    {
        $laporan = Laporan::find($id);
        $laporan->status = 0;

        $laporan->save();
        return $laporan;
    }
}
