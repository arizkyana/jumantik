<?php

namespace App\Http\Controllers\Penyakit;

use App\DetailLaporan;
use App\Http\Controllers\Controller;
use App\Kecamatan;
use App\Kelurahan;
use App\NotificationHistory;
use App\NotificationSetup;
use App\Penyakit;
use App\Puskesmas\Laporan;
use App\Role;
use App\Status;
use App\Tindakan;
use App\User;
use App\Utils\Datatables;
use App\Utils\FCM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LaporanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $kecamatan = Kecamatan::all();
        $init_kecamatan = $request->query('kecamatan');


        return view('penyakit/laporan/index')->with([
            'js' => 'penyakit/laporan.js',
            'title' => 'Laporan',
            'kecamatan' => $kecamatan,
            'init_kecamatan' => $init_kecamatan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kecamatan = Kecamatan::where('is_active', TRUE)->get();
        $kelurahan = Kelurahan::where('is_active', TRUE)->get();
        $penyakit = Penyakit::where('is_active', TRUE)->get();

        return view('penyakit/laporan/create')->with([
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
            'penyakit' => $penyakit,
            'js' => 'penyakit/laporan.js',
            'title' => 'Buat Laporan'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'penyakit' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('penyakit/laporan/create')
                ->withErrors($validator);
        }

        $laporan = new Laporan();

        $laporan->pelapor = Auth::user()->id;


        return redirect('penyakit/laporan/create')->with('success', 'Berhasil Buat Laporan');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Laporan $laporan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $laporan = Laporan::find($id);
        $penyakit = Penyakit::find($laporan->penyakit);
        $tindakan = Tindakan::find($laporan->tindakan);
        $status = Status::alias($laporan->status);
        $kecamatan = Kecamatan::where('kecamatan_id', $laporan->kecamatan)->first();
        $kelurahan = Kelurahan::where('kelurahan_id', $laporan->kelurahan)->first();
        $pelapor = User::find($laporan->pelapor);
        $tipe_pelapor = Role::find($pelapor->role_id);
        $detail_laporan = DetailLaporan::where('id_laporan', $id)->get();

        $detail_laporan = DB::table('detail_laporan')
            ->select('detail_laporan.status', 'detail_laporan.foto', 'tindakan.nama_tindakan as tindakan', 'detail_laporan.created_at', 'detail_laporan.keterangan', 'detail_laporan.id')
            ->leftJoin('tindakan', 'detail_laporan.tindakan', '=', 'tindakan.id')
            ->where('detail_laporan.id_laporan', '=', $id)
            ->orderByDesc('detail_laporan.created_at')
            ->get();

        $detail_status  = [
            'deleted' => [
                'id' => 0,
                'name' => 'Deleted'
            ],
            'open' => [
                'id' => 1,
                'name' => 'Open'
            ],
            'finish' => [
                'id' => 2,
                'name' => 'Finish'
            ],
            'on_going' => [
                'id' => 3,
                'name' => 'On Going'
            ],
            'surveyed' => [
                'id' => 4,
                'name' => 'Surveyed'
            ]
        ];

        $detail_tindakan = Tindakan::all();


        return view('penyakit/laporan/show')->with([
            'js' => 'penyakit/detail.js',
            'title' => 'Detail Laporan ' . $id,
            'laporan' => [
                'isi' => $laporan,
                'penyakit' => $penyakit,
                'tindakan' => $tindakan,
                'status' => $status,
                'kecamatan' => $kecamatan,
                'kelurahan' => $kelurahan,
                'pelapor' => [
                    'pelapor' => $pelapor,
                    'tipe_pelapor' => $tipe_pelapor
                ]
            ],
            'detail_laporan' => $detail_laporan,
            'detail_status' => $detail_status,
            'detail_tindakan' => $detail_tindakan

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $menu = Menu::find($id);
        $parents = Menu::where('parent', 0)->get();


        return view('menu/edit')->with([
            'parents' => $parents,
            'menu' => $menu,
            'title' => 'Edit Laporan'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'url' => 'required',
            'icon' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('menu/' . $request->input('id') . '/edit')
                ->withErrors($validator)
                ->withInput();
        }


        $_menu = $menu->find($request->input('id'));

        $_menu->name = $request->input('name');
        $_menu->url = $request->input('url');
        $_menu->icon = $request->input('icon');
        $_menu->parent = $request->input('parent');
        $_menu->show = $request->input('show') ? TRUE : FALSE;
        $_menu->authorize_url = str_replace("/", "-", $request->input('url'));

        $_menu->save();


        return redirect('menu/' . $request->input('id') . '/edit')->with('success', 'Berhasil Update Menu ' . $request->input('name'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $laporan = Laporan::find($id);
//        $menu->delete();

        $laporan->status = 0;
        $laporan->save();
        return redirect('penyakit/laporan')->with('success', 'Berhasil Hapus Laporan ' . $id);
    }

    public function selesai($id){

        $laporan = Laporan::find($id);



        $detail = new DetailLaporan();
        $detail->pelapor = Auth::user()->id;
        $detail->tindakan = 3;
        $detail->status = 2;
        $detail->keterangan = 'Laporan sudah selesai di tangani';
        $detail->id_laporan = $id;
        $detail->is_visible = true;
        $detail->save();

        $laporan->tindakan = $detail->tindakan;
        $laporan->status = $detail->status;
        $laporan->save();

        $notifikasi = new NotificationSetup();
        $notifikasi->title = 'Laporan ' . $laporan->keterangan . ' sudah selesai di tangani';
        $notifikasi->body = $laporan->keterangan ;
        $notifikasi->type = 2;
        $notifikasi->created_by = Auth::user()->id;
        $notifikasi->is_visible = true;

        $notifikasi->save();

        $users = DB::table('users')
            ->select('users.fcm_token', 'users.id')
            ->leftJoin('role', 'users.role_id', '=', 'role.id')
            ->where('role.name', 'like', '%jumantik%')
            ->orWhere('role.name', 'like', '%dinkes%')
            ->orWhere('role.name', 'like', '%warga%')
            ->get();

        $receivers = [];
        foreach ($users as $user) {

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

        return redirect('penyakit/laporan')->with('success', 'Berhasil Selesaikan Laporan ' . $id);
    }

    public function detail(){
        return 'ook';
    }

}

