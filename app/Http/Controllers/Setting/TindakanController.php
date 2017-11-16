<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\MyController;
use App\Menu;
use App\Penyakit;
use App\Role;
use App\RoleMenu;
use App\Tindakan;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Validator;

class TindakanController extends MyController
{

    private $js = 'setting/tindakan.js';

    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tindakan = Tindakan::all();
        return view('setting/tindakan/index')->with([
            'js' => $this->js,
            'tindakan' => $tindakan,
            'title' => 'Tindakan'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('setting/tindakan/create')
            ->with([
                'title' => 'Daftar Tindakan'
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
            'nama' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return redirect('setting/penyakit/create')
                ->withErrors($validator)
                ->withInput()
                ->with($request->input());
        }

        $penyakit = new Tindakan();
        $penyakit->nama_tindakan = $request->input('nama');
        $penyakit->keterangan_tindakan = $request->input('keterangan');
        $penyakit->is_visible = TRUE;
        $penyakit->save();

        return redirect('setting/tindakan/create')->with('success', 'Berhasil Tambah Tindakan ' . $penyakit->nama_tindakan);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $tindakan = Tindakan::find($id);

        return view('setting/tindakan/edit')->with([
            'js' => $this->js,
            'tindakan' => $tindakan,
            'title' => 'Edit Tindakan'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tindakan $tindakan)
    {

        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return redirect('setting/tindakan/' . $request->input('id') . '/edit')
                ->withErrors($validator)
                ->withInput()
                ->with($request->input());
        }

        $_penyakit = $tindakan->find($request->input('id'));


        $_penyakit->nama_tindakan = $request->input('nama');
        $_penyakit->keterangan_tindakan = $request->input('keterangan');

        $_penyakit->save();


        return redirect('setting/tindakan/' . $request->input('id') . '/edit')->with('success', 'Berhasil Update Tindakan ' . $_penyakit->nama_tindakan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Tindakan::find($id);
        $role->delete();

        return redirect('setting/tindakan')->with('success', 'Berhasil Hapus Tindakan ' . $id);
    }



}
