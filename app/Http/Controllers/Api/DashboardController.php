<?php

namespace App\Http\Controllers\Api;

use App\AreaKecamatan;
use App\Http\Controllers\Controller;
use App\Kecamatan;
use App\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function jumantik(Request $request)
    {

        $bulan = $request->query('bulan');

        $laporan_mapped = [];


        if (isset($bulan) and !empty($bulan)) {
            $month = date('m', strtotime($bulan));
            $year = date('Y', strtotime($bulan));

            $laporan = DB::table('laporan')
                ->select(DB::raw('count(laporan.id) as jumlah, date(laporan.created_at) as created_at'))
                ->where(DB::raw("MONTH(laporan.created_at)"), '=' , $month )
                ->where(DB::raw("YEAR(laporan.created_at)"), '=' , $year )
                ->groupBy(DB::raw('date(laporan.created_at)'))
                ->get();

        } else {
            $laporan = DB::table('laporan')
                ->select(DB::raw('count(laporan.id) as jumlah, date(laporan.created_at) as created_at'))
                ->groupBy(DB::raw('date(laporan.created_at)'))
                ->get();
        }


        return $laporan;

    }

    public function penyakit_nyamuk_menular(Request $request)
    {

        $bulan = $request->query('bulan');

        if (isset($bulan) and !empty($bulan)) {
            $month = date('m', strtotime($bulan));
            $year = date('Y', strtotime($bulan));

            $laporan = DB::table('laporan')
                ->select(DB::raw('count(laporan.id) as jumlah, penyakit.nama_penyakit'))
                ->leftJoin('penyakit', 'laporan.penyakit', '=', 'penyakit.id')
//                ->where("MONTH(laporan.created_at) = '?' AND YEAR(laporan.created_at) = '?' ")
                ->where(DB::raw("MONTH(laporan.created_at)"), '=' , $month )
                ->where(DB::raw("YEAR(laporan.created_at)"), '=' , $year )
                ->groupBy('penyakit.nama_penyakit')
                ->get();


        } else {
            $laporan = DB::table('laporan')
                ->select(DB::raw('count(laporan.id) as jumlah, penyakit.nama_penyakit'))
                ->leftJoin('penyakit', 'laporan.penyakit', '=', 'penyakit.id')
                ->groupBy(DB::raw('penyakit.nama_penyakit'))
                ->get();
        }


        $laporan_mapped = [];
        $total = 0;
        foreach ($laporan as $item) {
            $total += $item->jumlah;
        }

        foreach ($laporan as $item) {
            array_push($laporan_mapped, [
                'name' => $item->nama_penyakit,
                'y' => ($item->jumlah / $total) * 100
            ]);
        }


        return $laporan_mapped;
    }


}
