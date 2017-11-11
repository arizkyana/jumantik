<?php

namespace App\Http\Controllers\Api;

use App\AreaKecamatan;
use App\Http\Controllers\Controller;
use App\Kecamatan;
use App\Utils\ResponseMod;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResponseMod::success(Kecamatan::where('is_active', TRUE)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function show(Kecamatan $kecamatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kecamatan $kecamatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kecamatan $kecamatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kecamatan $kecamatan)
    {
        //
    }


    public function area_kecamatan(){
        $path_coordinates = [];
        $kecamatan = Kecamatan::where('is_active', TRUE)->get();

        foreach($kecamatan as $item) {
            $area_kecamatan = AreaKecamatan::where('nama_kecamatan', $item->nama_kecamatan)->get();
            array_push($path_coordinates, array(
                'kecamatan' => $item->nama_kecamatan,
                'area' => $area_kecamatan
            ));
        }

        return ResponseMod::success($path_coordinates);
    }


}
