<?php

namespace App\Http\Controllers\Api\Penyakit;

use App\DetailLaporan;
use App\Events\JumantikReported;
use App\Http\Controllers\Controller;
use App\Kecamatan;
use App\Kelurahan;
use App\NotificationHistory;
use App\NotificationSetup;
use App\Penyakit;
use App\Puskesmas\Laporan;
use App\Utils\Datatables;
use App\Utils\FCM;
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

    public function histories(Request $request){
        $user = $request->auth_user;

        $limit = $request->input('limit');
        $offset = $request->input('offset');

        $histories = DB::table('notification_history')
            ->select('laporan.*')
            ->leftJoin('notification_setup', 'notification_history.id_notification_setup', '=', 'notification_setup.id')
            ->leftJoin('laporan', 'notification_history.id_laporan', '=', 'laporan.id')
            ->where('laporan.update_by', '=', $user->id)
            ->limit($limit)
            ->offset($offset)
            ->get();

        return ResponseMod::success($histories);
    }

    public function to_self(Request $request){
        $user = $request->auth_user;

        $limit = $request->input('limit');
        $offset = $request->input('offset');

        $laporan = DB::table('notification_history')
            ->select('laporan.*', 'notification_history.receiver')
            ->leftJoin('notification_setup', 'notification_history.id_notification_setup', '=', 'notification_setup.id')
            ->leftJoin('laporan', 'notification_history.id_laporan', '=', 'laporan.id')
            ->where('receiver', '=', $user->id)
            ->limit($limit)
            ->offset($offset)
            ->get();

        return ResponseMod::success($laporan);
    }

    // encapsulated api
    public function jumantik(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100|unique:laporan,title',
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
            'foto' => 'required'
        ]);

        if ($validator->fails()) {
            return ResponseMod::failed($validator->messages()->all());
        }

        $pelapor = isset($request->auth_user) ? $request->auth_user->id : $request->input('pelapor');

        $laporan = new \App\Laporan();

        $laporan->pelapor = $pelapor;
        $laporan->title = $request->input('title');
        $laporan->sub_title = $request->input('sub_title');
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


        $files = $request->file('foto');
        $fotos = [];
        foreach ($files as $file) {
            $foto = $file->store('uploads');
            array_push($fotos, $foto);
        }

        $laporan->foto = implode(',', $fotos);

        $laporan->save();

        event(new JumantikReported($laporan));

        return ResponseMod::success($laporan);
    }

    public function dinkes(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100|unique:laporan,title',
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
            'foto' => 'required'
        ]);

        if ($validator->fails()) {
            return ResponseMod::failed($validator->messages()->all());
        }

        $pelapor = isset($request->auth_user) ? $request->auth_user->id : $request->input('pelapor');

        $laporan = new \App\Laporan();

        $laporan->pelapor = $pelapor;
        $laporan->title = $request->input('title');
        $laporan->sub_title = $request->input('sub_title');
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

        $files = $request->file('foto');
        $fotos = [];
        foreach ($files as $file) {
            $foto = $file->store('uploads');
            array_push($fotos, $foto);
        }

        $laporan->foto = implode(',', $fotos);

        $laporan->save();

        if ($laporan->intensitas_jentik == '> 10 %' || $laporan->intensitas_jentik == 1) {

            // kirim notif ke dinkes
            $dinkes = DB::table('users')
                ->select('users.id')
                ->leftJoin('role', 'users.role_id', '=', 'role.id')
                ->where('role.name', 'like', '%warga%')
                ->first();

            Log::info($laporan->keterangan);

            $notifikasi = new NotificationSetup();
            $notifikasi->title = $laporan->title;
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

        return ResponseMod::success($laporan);
    }

    public function fogging(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tindakan' => 'required',
            'status' => 'required',
            'keterangan' => 'required',
            'id_laporan' => 'required'
        ]);

        if ($validator->fails()) {
            return ResponseMod::failed($validator->messages()->all());
        }

        $detail = new DetailLaporan();

        $detail->id_laporan = $request->input('id_laporan');
        $detail->pelapor = $request->auth_user->id;

        $detail->keterangan = $request->input('keterangan');
        $detail->tindakan = $request->input('tindakan');
        $detail->status = $request->input('status');
        $detail->is_visible = true;

        // if has file

        $files = $request->file('foto');
        $fotos = [];
        foreach ($files as $file) {
            $foto = $file->store('uploads');
            array_push($fotos, $foto);
        }

        $detail->foto = implode(',', $fotos);

        $detail->save();

        $laporan = \App\Laporan::find($request->input('id_laporan'));
        $laporan->tindakan = $detail->tindakan;
        $laporan->status = $detail->status;
        $laporan->update_by = $request->auth_user->id;

        $laporan->save();

        // kirim notif ke dinkes
        $dinkes = DB::table('users')
            ->select('users.id', 'users.fcm_token')
            ->leftJoin('role', 'users.role_id', '=', 'role.id')
            ->where('role.name', 'like', '%dinkes%')
            ->get();

        Log::info($laporan->keterangan);

        $notifikasi = new NotificationSetup();
        $notifikasi->title = 'Sudah Melakukan Fogging';
        $notifikasi->body = 'Tim Petugas Dinkes sudah melakukan fogging untuk alamat ' . $laporan->alamat . ' pada laporan ' . $laporan->judul;
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

        return ResponseMod::success($laporan);
    }

    public function rumah_sakit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100|unique:laporan,title',
            'jumlah_suspect' => 'required',
            'penyakit' => 'required',

            'keterangan' => 'required',
            'tindakan' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'lat' => 'required',
            'lon' => 'required',
            'alamat' => 'required',
            'is_pekdrs' => 'required',
            'foto' => 'required'
        ]);

        if ($validator->fails()) {
            return ResponseMod::failed($validator->messages()->all());
        }


        $arr_kecamatan = $request->input('kecamatan');
        $arr_kelurahan = $request->input('kelurahan');
        $arr_alamat = $request->input('kecamatan');
        $arr_lat = $request->input('lat');
        $arr_lon = $request->input('lon');

        if (!is_array($arr_kecamatan) || !is_array($arr_kelurahan) || !is_array($arr_alamat) || !is_array($arr_lat) || !is_array($arr_lon)) {
            return ResponseMod::failed('wilayah harus array');
        }

        $arr_laporan = [];
        foreach ($arr_alamat as $key => $alamat) {
            $kecamatan = $arr_kecamatan[$key];
            $kelurahan = $arr_kelurahan[$key];
            $lat = $arr_lat[$key];
            $lon = $arr_lon[$key];

            $pelapor = isset($request->auth_user) ? $request->auth_user->id : $request->input('pelapor');

            $laporan = new \App\Laporan();

            $laporan->pelapor = $pelapor;
            $laporan->title = $request->input('title');
            $laporan->sub_title = $request->input('sub_title');
            $laporan->jumlah_suspect = $request->input('jumlah_suspect');
            $laporan->penyakit = $request->input('penyakit'); // demam berdarah
            $laporan->intensitas_jentik = 0;
            $laporan->keterangan = $request->input('keterangan');
            $laporan->tindakan = $request->input('tindakan'); // Evakuasi
            $laporan->kecamatan = $kecamatan;
            $laporan->kelurahan = $kelurahan;
            $laporan->lat = $lat;
            $laporan->lon = $lon;
            $laporan->alamat = $alamat;
            $laporan->status = 1; // Open
            $laporan->is_pekdrs = $request->input('is_pekdrs');
            $laporan->update_by = $pelapor;

            $files = $request->file('foto');
            $fotos = [];
            foreach ($files as $file) {
                $foto = $file->store('uploads');
                array_push($fotos, $foto);
            }

            $laporan->foto = implode(',', $fotos);

            $laporan->save();

            // kirim notif ke puskesmas
            $dinkes = DB::table('users')
                ->select('users.id', 'users.fcm_token')
                ->leftJoin('role', 'users.role_id', '=', 'role.id')
                ->where('role.name', 'like', '%puskesmas%')
                ->get();


            Log::info($laporan->keterangan);

            $notifikasi = new NotificationSetup();
            $notifikasi->title = $laporan->title;
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

            array_push($arr_laporan, $laporan);
        }

        return ResponseMod::success($arr_laporan);
    }

    public function survey(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'intensitas_jentik' => 'required',
            'keterangan' => 'required',
            'tindakan' => 'required',
            'status' => 'required',
            'is_pekdrs' => 'required',
            'id_laporan' => 'required',
            'foto' => 'required'
        ]);

        if ($validator->fails()) {
            return ResponseMod::failed($validator->messages()->all());
        }

        $laporan = \App\Laporan::find($request->input('id_laporan'));

        $laporan->intensitas_jentik = $request->input('intensitas_jentik');
        $laporan->tindakan = $request->input('tindakan');
        $laporan->status = $request->input('status');
        $laporan->is_pekdrs = $request->input('is_pekdrs');

        $laporan->save();

        $detail = new DetailLaporan();
        $detail->id_laporan = $laporan->id;
        $detail->pelapor = $request->auth_user->id;
        $detail->tindakan = $laporan->tindakan;
        $detail->status = $laporan->status;
        $detail->keterangan = $laporan->keterangan;
        $detail->is_visible = true;

        $files = $request->file('foto');
        $fotos = [];
        foreach ($files as $file) {
            $foto = $file->store('uploads');
            array_push($fotos, $foto);
        }

        $detail->foto = implode(',', $fotos);

        $detail->save();

        if ($laporan->intensitas_jentik == '> 10 %' || $laporan->intensitas_jentik == 1) {

            // kirim notif ke dinkes
            $dinkes = DB::table('users')
                ->select('users.id', 'users.fcm_token')
                ->leftJoin('role', 'users.role_id', '=', 'role.id')
                ->where('role.name', 'like', '%dinkes%')
                ->get();

            Log::info($laporan->keterangan);

            $notifikasi = new NotificationSetup();
            $notifikasi->title = 'Suspect Penyakit Nyamuk Menular dari Rumah Sakit';
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

        return ResponseMod::success($laporan);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100|unique:laporan,title',
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
        $laporan->title = $request->input('title');
        $laporan->sub_title = $request->input('sub_title');
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
            'title' => 'max:100',
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
        $laporan->title = $request->input('title');
        $laporan->sub_title = $request->input('sub_title');
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


        if ($request->query('tanggal_mulai') && $request->query('tanggal_akhir') && $request->query('tipe_pelapor') && $request->query('penyakit') && $request->query('kecamatan')) {
            $tanggal_mulai = date('Y-m-d', strtotime($request->query('tanggal_mulai')));
            $tanggal_akhir = date('Y-m-d', strtotime($request->query('tanggal_akhir')));
            $data->whereBetween('laporan.created_at', [$tanggal_mulai, $tanggal_akhir]);
            if ($request->query('tipe_pelapor') !== 'all' && $request->query('penyakit') !== 'all') {
                $data->where('role.id', '=', $request->query('tipe_pelapor'));
                $data->where('penyakit.id', '=', $request->query('penyakit'));
            }
            $data->where('kecamatan.nama_kecamatan', 'LIKE', '%'.$this->parseKecamatan($request->query('kecamatan')).'%');

        }

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
            $tanggal_mulai = date('Y-m-d 00:00:00', strtotime($request->query('tanggal_mulai')));
            $tanggal_akhir = date('Y-m-d 23:59:59', strtotime($request->query('tanggal_akhir')));
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


        if ($request->query('tipe_pelapor') && $request->query('penyakit') && $request->query('kecamatan')) {
            if ($request->query('tipe_pelapor') !== 'all' && $request->query('penyakit') !== 'all') {
                $data->where('role.id', '=', $request->query('tipe_pelapor'));
                $data->where('penyakit.id', '=', $request->query('penyakit'));
            }
            $data->where('kecamatan.nama_kecamatan', 'LIKE', '%'.$this->parseKecamatan($request->query('kecamatan')).'%');
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

        if ($request->query('kecamatan')){
            $data->where('kecamatan.nama_kecamatan', 'LIKE', '%'.$this->parseKecamatan($request->query('kecamatan')).'%');
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

    // util
    private function parseKecamatan($kecamatan){
        return trim(str_replace('-', ' ', $kecamatan));
    }
}
