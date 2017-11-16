<?php

namespace App\Http\Controllers\Master;

use App\Puskesmas;
use App\Http\Controllers\Controller;
use App\Kecamatan;
use App\Kelurahan;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PuskesmasController extends Controller
{
    private $js = 'master/puskesmas.js';

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

        $puskesmas = DB::table('puskesmas')
            ->select('puskesmas.*', 'users.name as pic_name')
            ->leftJoin('users', 'puskesmas.pic', '=', 'users.id')
            ->get();



        return view('master/puskesmas/index')->with([
            'js' => $this->js,
            'puskesmas' => $puskesmas,
            'title' => 'Puskesmas'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kecamatan = Kecamatan::all();
        $roles = Role::all();

        return view('master/puskesmas/create')
            ->with([
                'kecamatan' => $kecamatan,
                'js' => $this->js,
                'roles' => $roles,
                'title' => 'Daftar Petugas'
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
            'nama' => 'required|max:100|unique:puskesmas,nama',
            'alamat' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'pic_nama' => 'required',
            'pic_nik' => 'required|unique:users,nik',
            'email' => 'required|email|unique:users,email',
            'pic_phone' => 'required',
            'role' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password'
        ]);


        if ($validator->fails()) {

            return redirect('master/puskesmas/create')
                ->withErrors($validator)
                ->withInput();
        }

        $puskesmas = new Puskesmas();
        $puskesmas->nama = $request->input('nama');
        $puskesmas->alamat= $request->input('alamat');
        $puskesmas->kelurahan = $request->input('kelurahan');
        $puskesmas->kecamatan = $request->input('kecamatan');

        $puskesmas->is_visible = true;

        // create new user by pic
        $user = new User();
        $user->name = $request->input('pic_nama');
        $user->nik = $request->input('pic_nik');
        $user->email = $request->input('email');
        $user->phone = $request->input('pic_phone');
        $user->role_id = $request->input('role');
        $user->password = bcrypt($request->input('password'));
        $user->is_active = true;
        $user->save();

        $puskesmas->pic = $user->id;
        $puskesmas->created_by = Auth::user()->id;
        $puskesmas->save();


        return redirect('master/puskesmas/create')->with('success', 'Berhasil Tambah puskesmas ' . $puskesmas->nama);


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

        $puskesmas = Puskesmas::find($id);

        $pic = User::find($puskesmas->pic);

        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::where('kecamatan_id', $puskesmas->kecamatan)->get();
        $roles = Role::all();

        return view('master/puskesmas/edit')->with([
            'js' => $this->js,
            'puskesmas' => $puskesmas,
            'kecamatan' => $kecamatan,
            'roles' => $roles,
            'pic' => $pic,
            'kelurahan' => $kelurahan,
            'title' => 'Edit Petugas'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Puskesmas $_puskesmas)
    {

        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:100|unique:puskesmas,nama',
            'alamat' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'pic_nama' => 'required',
            'pic_nik' => 'required|unique:users,nik',
            'email' => 'required|email|unique:users,email',
            'pic_phone' => 'required',
            'role' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password'
        ]);

        if ($validator->fails()) {
            return redirect('master/puskesmas/' . $request->input('id') . '/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $puskesmas = $_puskesmas->find($request->input('id'));
        $puskesmas->nama = $request->input('nama');
        $puskesmas->alamat= $request->input('alamat');
        $puskesmas->kelurahan = $request->input('kelurahan');
        $puskesmas->kecamatan = $request->input('kecamatan');

        $puskesmas->is_visible = true;

        // create new user by pic
        $user = User::find($request->input('pic_id'));
        $user->name = $request->input('pic_nama');
        $user->nik = $request->input('pic_nik');
        $user->email = $request->input('email');
        $user->phone = $request->input('pic_phone');
        $user->role_id = $request->input('role');
        $user->password = bcrypt($request->input('password'));
        $user->is_active = true;
        $user->save();

        $puskesmas->pic = $user->id;
        $puskesmas->created_by = Auth::user()->id;
        $puskesmas->save();


        return redirect('master/puskesmas/' . $request->input('id') . '/edit')->with('success', 'Berhasil Update puskesmas ' . $_puskesmas->nama_puskesmas);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Puskesmas::find($id);

        $role->is_visible = false;

        $role->save();

        return redirect('master/puskesmas')->with('success', 'Berhasil Hapus Puskesmas ' . $id);
    }
}
