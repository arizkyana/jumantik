<?php

namespace App\Http\Controllers\Master;

use App\Petugas;
use App\Http\Controllers\Controller;
use App\Kecamatan;
use App\Kelurahan;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PetugasController extends Controller
{
    private $js = 'master/petugas.js';

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

        $petugas = DB::table('petugas')
            ->select('petugas.*', 'users.name as pic_name')
            ->leftJoin('users', 'petugas.pic', '=', 'users.id')
            ->get();



        return view('master/petugas/index')->with([
            'js' => $this->js,
            'petugas' => $petugas,
            'title' => 'Petugas Jumantik'
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

        return view('master/petugas/create')
            ->with([
                'kecamatan' => $kecamatan,
                'js' => $this->js,
                'roles' => $roles,
                'title' => 'Daftar Petugas Jumantik'
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
            'nama' => 'required|max:100|unique:petugas,nama',
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

            return redirect('master/petugas/create')
                ->withErrors($validator)
                ->withInput();
        }

        $petugas = new Petugas();
        $petugas->nama = $request->input('nama');
        $petugas->alamat= $request->input('alamat');
        $petugas->kelurahan = $request->input('kelurahan');
        $petugas->kecamatan = $request->input('kecamatan');

        $petugas->is_visible = true;

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

        $petugas->pic = $user->id;
        $petugas->created_by = Auth::user()->id;
        $petugas->save();


        return redirect('master/petugas/create')->with('success', 'Berhasil Tambah Petugas ' . $petugas->nama);


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

        $petugas = Petugas::find($id);

        $pic = User::find($petugas->pic);

        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::where('kecamatan_id', $petugas->kecamatan)->get();
        $roles = Role::all();

        return view('master/petugas/edit')->with([
            'js' => $this->js,
            'petugas' => $petugas,
            'kecamatan' => $kecamatan,
            'roles' => $roles,
            'pic' => $pic,
            'kelurahan' => $kelurahan,
            'title' => 'Edit Petugas Jumantik'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Petugas $_petugas)
    {

        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:100|unique:petugas,nama',
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
            return redirect('master/petugas/' . $request->input('id') . '/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $petugas = $_petugas->find($request->input('id'));
        $petugas->nama = $request->input('nama');
        $petugas->alamat= $request->input('alamat');
        $petugas->kelurahan = $request->input('kelurahan');
        $petugas->kecamatan = $request->input('kecamatan');

        $petugas->is_visible = true;

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

        $petugas->pic = $user->id;
        $petugas->created_by = Auth::user()->id;
        $petugas->save();


        return redirect('master/petugas/' . $request->input('id') . '/edit')->with('success', 'Berhasil Update petugas ' . $_petugas->nama_petugas);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Petugas::find($id);

        $role->is_visible = false;

        $role->save();

        return redirect('master/petugas')->with('success', 'Berhasil Hapus Petugas ' . $id);
    }
}
