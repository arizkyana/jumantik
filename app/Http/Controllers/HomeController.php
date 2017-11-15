<?php

namespace App\Http\Controllers;

use App\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $jadwal = DB::table('jadwal')
            ->select(
                'jadwal.id',
                'jadwal.mulai',
                'jadwal.akhir',
                'jadwal.jam_mulai',
                'jadwal.jam_akhir',
                'jadwal.status',
                'jadwal.title',
                'jadwal.keterangan',

                'jadwal.alamat',
                'kelurahan.nama_kelurahan',
                'kecamatan.nama_kecamatan',

                'pic.name as pic',
                'supervisor.name as supervisor'
            )
            ->join('users as pic', 'jadwal.pic', '=', 'pic.id')
            ->join('users as supervisor', 'jadwal.supervisor', '=', 'supervisor.id')
            ->leftJoin('kecamatan', 'jadwal.kecamatan', '=', 'kecamatan.kecamatan_id')
            ->leftJoin('kelurahan', 'jadwal.kelurahan', '=', 'kelurahan.kelurahan_id')
            ->orderByDesc('jadwal.created_at')
            ->where('jadwal.is_visible', true)
            ->get();


        return view('home')->with([
            'js' => 'dashboard.js',
            'title' => 'Dashboard',
            'gmaps' => true,
            'chart' => true,
            'jadwal' => $jadwal
        ]);
    }
}
