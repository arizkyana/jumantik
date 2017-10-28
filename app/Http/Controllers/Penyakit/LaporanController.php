<?php

namespace App\Http\Controllers\Penyakit;

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
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('penyakit/laporan/index')->with([
            'js' => 'penyakit/laporan.js',
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
            'js' => 'penyakit/laporan.js'
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
        return view('penyakit/laporan/show')->with([
            'js' => 'penyakit/laporan.js',
            'title' => 'Detail Laporan ' . $id
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
            'menu' => $menu
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

        $menu = Menu::find($id);
        $menu->delete();

        return redirect('menu')->with('success', 'Berhasil Hapus Menu ' . $id);
    }

    // ajax


}

