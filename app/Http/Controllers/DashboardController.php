<?php

namespace App\Http\Controllers;

use App\AreaKecamatan;
use App\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

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

        return view('dashboard')->with([
            'js' => 'dashboard.js',
            'title' => 'Dashboard',
            'gmaps' => true,
            'chart' => true,
            'jadwal' => $jadwal
        ]);
    }

    public function get_all_kecamatan(){
        return Kecamatan::where('is_active', TRUE)->get();
    }

    public function get_area_by_kecamatan(Request $request){
        $nama_kecamatan = $request->input('nama_kecamatan');
        return AreaKecamatan::where('nama_kecamatan', $nama_kecamatan)->get();
    }
}
