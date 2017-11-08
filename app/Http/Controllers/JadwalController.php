<?php

namespace App\Http\Controllers;

use App\Dinkes;
use App\Jadwal;
use App\Kecamatan;
use App\Kelurahan;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class JadwalController extends Controller
{
    private $js = 'jadwal.js';

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

        $jadwal = Jadwal::where('is_visible', true)->get();

        return view('jadwal/index')->with([
            'js' => $this->js,
            'jadwal' => $jadwal
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pic = DB::table('users')
            ->select('users.*')
            ->leftJoin('role', 'users.role_id', '=', 'role.id')
            ->where('role.name', 'like', '%jumantik%')
            ->get();

        $supervisor = DB::table('users')
            ->select('users.*')
            ->leftJoin('role', 'users.role_id', '=', 'role.id')
            ->where('role.name', 'like', '%puskesmas%')
            ->get();

        return view('jadwal/create')
            ->with([
                'js' => $this->js,
                'pic' => $pic,
                'supervisor' => $supervisor
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
            'mulai' => 'required',
            'akhir' => 'required',
            'pic' => 'required',
            'supervisor' => 'required',
            'title' => 'required|unique:jadwal,title',
            'keterangan' => 'required|email|unique:users,email',

        ]);


        if ($validator->fails()) {

            return redirect('jadwal/create')
                ->withErrors($validator)
                ->withInput();
        }

        $jadwal = new Jadwal();
        $jadwal->mulai = $request->input('mulai');
        $jadwal->akhir= $request->input('akhir');
        $jadwal->pic = $request->input('pic');
        $jadwal->supervisor = $request->input('supervisor');
        $jadwal->title = $request->input('title');
        $jadwal->keterangan = $request->input('keterangan');

        $jadwal->is_visible = true;
        $jadwal->status = 1;

        $jadwal->created_by = Auth::user()->id;


        return redirect('jadwal/create')->with('success', 'Berhasil Tambah Jadwal ' . $jadwal->title);


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
    public function edit(Jadwal $jadwal)
    {

        return view('jadwal/edit')->with([
            'js' => $this->js,
            'jadwal' => $jadwal,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jadwal $jadwal)
    {

        $validator = Validator::make($request->all(), [
            'mulai' => 'required',
            'akhir' => 'required',
            'pic' => 'required',
            'supervisor' => 'required',
            'title' => 'required|unique:jadwal,title',
            'keterangan' => 'required|email|unique:users,email',

        ]);

        if ($validator->fails()) {
            return redirect('jadwal/' . $request->input('id') . '/edit')
                ->withErrors($validator)
                ->withInput();
        }


        $jadwal->mulai = $request->input('mulai');
        $jadwal->akhir= $request->input('akhir');
        $jadwal->pic = $request->input('pic');
        $jadwal->supervisor = $request->input('supervisor');
        $jadwal->title = $request->input('title');
        $jadwal->keterangan = $request->input('keterangan');

        $jadwal->is_visible = true;
        $jadwal->status = 1;

        $jadwal->created_by = Auth::user()->id;


        return redirect('master/dinkes/' . $request->input('id') . '/edit')->with('success', 'Berhasil Update Jadwal ' . $jadwal->title);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jadwal = Jadwal::find($id);

        $jadwal->is_visible = false;

        $jadwal->save();

        return redirect('master/dinkes')->with('success', 'Berhasil Hapus Jadwal ' . $jadwal->title);
    }
}
