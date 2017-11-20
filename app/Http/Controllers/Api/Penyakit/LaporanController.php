<?php

namespace App\Http\Controllers\Api\Penyakit;

use App\DetailLaporan;
use App\Http\Controllers\Controller;
use App\Kecamatan;
use App\Kelurahan;
use App\NotificationSetup;
use App\Penyakit;
use App\Puskesmas\Laporan;
use App\Utils\Datatables;
use App\Utils\ResponseMod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Validator;

class LaporanController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        return Laporan::all();
    }


    // encapsulated api
    public function warga(Request $request){
        $validator = Validator::make($request->all(), [
            'jumlah_suspect' => 'required',
            'penyakit' => 'required',
            'intensitas_jentik' => 'required',
            'keterangan' => 'required',
            'tindakan' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'lat' => 'required',
            'lon' => 'required',
            'alamat' => 'required',
            'is_pekdrs' => 'required',
        ]);

        if ($validator->fails()) {
            return ResponseMod::failed($validator->messages()->all());
        }

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

        // kirim notif ke dinkes
        $dinkes = DB::table('users')
            ->select('users.id')
            ->leftJoin('role', 'users.role_id', '=', 'role.id')
            ->where('role.name', 'like', '%dinkes%')
            ->first();

        Log::info($laporan->keterangan);

        $notifikasi = new NotificationSetup();
        $notifikasi->title = 'Laporan Jentik Terbaru!';
        $notifikasi->body = $laporan->keterangan . ' ' . $laporan->alamat . ' ' . $laporan->kecamatan . ' ' . $laporan->kelurahan;
        $notifikasi->type = 2;
        $notifikasi->created_by = $laporan->pelapor;
        $notifikasi->is_visible = true;

        $notifikasi->save();

        $receivers = [];
        foreach ($dinkes as $user) {

            $notifikasi_history = new NotificationHistory();

            $notifikasi_history->id_notification_setup = $notifikasi->id;
            $notifikasi_history->status = 1;
            $notifikasi_history->receiver = $user->id;
            $notifikasi_history->id_laporan = $laporan->id;
            $notifikasi_history->is_visible = true;
            $notifikasi_history->save();

            array_push($receivers, $user->fcm_token);

        }

        $fcm = new FCM();

        $sent = $fcm->send_messages($receivers, $notifikasi->title, $notifikasi->body);

        Log::info($sent);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'jumlah_suspect' => 'required',
            'penyakit' => 'required',
            'intensitas_jentik' => 'required',
            'keterangan' => 'required',
            'tindakan' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'lat' => 'required',
            'lon' => 'required',
            'alamat' => 'required',
            'is_pekdrs' => 'required',
        ]);

        if ($validator->fails()) {
            return ResponseMod::failed($validator->messages()->all());
        }

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

        $laporan->onStore([
            'pelapor' => $pelapor,
            'laporan' => $laporan->id,
            'body' => [
                'keterangan' => $request->input('keterangan'),
                'alamat' => $request->input('alamat'),
                'lat' => $request->input('lat'),
                'lon' => $request->input('lon'),
                'kecamatan' => $request->input('kecamatan'),
                'kelurahan' => $request->input('kelurahan')
            ]
        ]);


        return ResponseMod::success($laporan);
    }

    public function edit(Request $request, \App\Laporan $laporan)
    {



        $validator = Validator::make($request->all(), [
            'jumlah_suspect' => 'required',
            'penyakit' => 'required',
            'intensitas_jentik' => 'required',
            'keterangan' => 'required',
            'tindakan' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'lat' => 'required',
            'lon' => 'required',
            'alamat' => 'required',
            'is_pekdrs' => 'required',
        ]);

        if ($validator->fails()) {
            return ResponseMod::failed($validator->messages()->all());
        }

        $pelapor = isset($request->auth_user) ? $request->auth_user->id : $request->input('pelapor');



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
        $laporan->status = $request->input('status'); // Open
        $laporan->is_pekdrs = $request->input('is_pekdrs');
        $laporan->update_by = $pelapor;

        $laporan->save();

        $laporan->onUpdate([
            'pelapor' => $pelapor,
            'laporan' => $laporan->id,
            'body' => [
                'keterangan' => $request->input('keterangan'),
                'alamat' => $request->input('alamat'),
                'lat' => $request->input('lat'),
                'lon' => $request->input('lon'),
                'kecamatan' => $request->input('kecamatan'),
                'kelurahan' => $request->input('kelurahan')
            ]
        ]);


        return ResponseMod::success($laporan);
    }

    public function show($id)
    {
        $laporan = \App\Laporan::find($id);
        $detail_laporan = DetailLaporan::where('id_laporan', $id)->get();

        if (empty($detail_laporan)) $detail_laporan = [];

        return ResponseMod::success([
            'laporan' => $laporan,
            'detail_laporan' => $detail_laporan
        ]);
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
