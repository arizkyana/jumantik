<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\MyController;
use App\Menu;
use App\Penyakit;
use App\Role;
use App\RoleMenu;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Validator;

class PenyakitController extends MyController
{

    private $js = 'setting/penyakit.js';

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

        $penyakit = Penyakit::where('is_visible', TRUE)->get();
        return view('setting/penyakit/index')->with([
            'js' => $this->js,
            'penyakit' => $penyakit,
            'title' => 'Profile Penyakit'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('setting/penyakit/create')->with([
            'title' => 'Daftar Profile Penyakit'
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

        $penyakit = new Penyakit();
        $penyakit->nama_penyakit = $request->input('nama');
        $penyakit->keterangan_penyakit = $request->input('keterangan');
        $penyakit->is_visible = TRUE;
        $penyakit->save();

        return redirect('setting/penyakit/create')->with('success', 'Berhasil Tambah Penyakit ' . $penyakit->nama_penyakit);


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

        $penyakit = Penyakit::find($id);
        return view('setting/penyakit/edit')->with([
            'js' => $this->js,
            'penyakit' => $penyakit,
            'title' => 'Edit Profile Penyakit'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penyakit $penyakit)
    {

        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return redirect('setting/penyakit/' . $request->input('id') . '/edit')
                ->withErrors($validator)
                ->withInput()
                ->with($request->input());
        }

        $_penyakit = $penyakit->find($request->input('id'));

        $_penyakit->nama_penyakit = $request->input('nama');
        $_penyakit->keterangan_penyakit = $request->input('keterangan');

        $_penyakit->save();


        return redirect('setting/penyakit/' . $request->input('id') . '/edit')->with('success', 'Berhasil Update Penyakit ' . $_penyakit->nama_penyakit);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Penyakit::find($id);
        $role->delete();

        return redirect('setting/penyakit')->with('success', 'Berhasil Hapus Penyakit ' . $id);
    }



}
