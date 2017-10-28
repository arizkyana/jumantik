<?php

namespace App\Http\Controllers\Api;

use App\AreaKecamatan;
use App\Kecamatan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $this->authorize('dashboard');
        return view('dashboard')->with([
            'js' => 'dashboard.js',
            'title' => 'Dashboard',
            'gmaps' => true
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
