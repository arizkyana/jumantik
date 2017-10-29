<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\MyController;
use App\Menu;
use App\Penyakit;
use App\Role;
use App\RoleMenu;
use App\Status;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Validator;

class StatusController extends MyController
{

    private $js = 'setting/status.js';

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

        $status = Status::all();

        return view('setting/status/index')->with([
            'js' => $this->js,
            'status' => $status
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('setting/status/create');
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
            return redirect('setting/status/create')
                ->withErrors($validator)
                ->withInput()
                ->with($request->input());
        }

        $penyakit = new Status();
        $penyakit->nama_status = $request->input('nama');
        $penyakit->keterangan_status = $request->input('keterangan');
        $penyakit->is_visible = TRUE;
        $penyakit->save();

        return redirect('setting/status/create')->with('success', 'Berhasil Tambah Status ' . $penyakit->nama_status);


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

        $status = Status::find($id);
        return view('setting/status/edit')->with([
            'js' => $this->js,
            'status' => $status
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Status $penyakit)
    {

        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return redirect('setting/status/' . $request->input('id') . '/edit')
                ->withErrors($validator)
                ->withInput()
                ->with($request->input());
        }

        $_penyakit = $penyakit->find($request->input('id'));

        $_penyakit->nama_status = $request->input('nama');
        $_penyakit->keterangan_status = $request->input('keterangan');

        $_penyakit->save();


        return redirect('setting/status/' . $request->input('id') . '/edit')->with('success', 'Berhasil Update Status ' . $_penyakit->nama_status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Status::find($id);
        $role->delete();

        return redirect('setting/status')->with('success', 'Berhasil Hapus Status ' . $id);
    }



}
