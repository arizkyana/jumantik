<?php

namespace App\Http\Controllers\Master;

use App\RumahSakit;
use App\Http\Controllers\Controller;
use App\Kecamatan;
use App\Kelurahan;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RumahSakitController extends Controller
{
    private $js = 'master/rumah_sakit.js';

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

        $rumah_sakit = DB::table('rumah_sakit')
            ->select('rumah_sakit.*', 'users.name as pic_name')
            ->leftJoin('users', 'rumah_sakit.pic', '=', 'users.id')
            ->get();



        return view('master/rumah_sakit/index')->with([
            'js' => $this->js,
            'rumah_sakit' => $rumah_sakit,
            'title' => 'Rumah Sakit'
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

        return view('master/rumah_sakit/create')
            ->with([
                'kecamatan' => $kecamatan,
                'js' => $this->js,
                'roles' => $roles,
                'title' => 'Daftar Rumah Sakit'
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
            'nama' => 'required|max:100|unique:rumah_sakit,nama',
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

            return redirect('master/rumah_sakit/create')
                ->withErrors($validator)
                ->withInput();
        }

        $rumah_sakit = new RumahSakit();
        $rumah_sakit->nama = $request->input('nama');
        $rumah_sakit->alamat= $request->input('alamat');
        $rumah_sakit->kelurahan = $request->input('kelurahan');
        $rumah_sakit->kecamatan = $request->input('kecamatan');

        $rumah_sakit->is_visible = true;

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

        $rumah_sakit->pic = $user->id;
        $rumah_sakit->created_by = Auth::user()->id;
        $rumah_sakit->save();


        return redirect('master/rumah_sakit/create')->with('success', 'Berhasil Tambah rumah_sakit ' . $rumah_sakit->nama);


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

        $rumah_sakit = RumahSakit::find($id);

        $pic = User::find($rumah_sakit->pic);

        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::where('kecamatan_id', $rumah_sakit->kecamatan)->get();
        $roles = Role::all();

        return view('master/rumah_sakit/edit')->with([
            'js' => $this->js,
            'rumah_sakit' => $rumah_sakit,
            'kecamatan' => $kecamatan,
            'roles' => $roles,
            'pic' => $pic,
            'kelurahan' => $kelurahan,
            'title' => 'Edit Rumah Sakit'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RumahSakit $_rumah_sakit)
    {

        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:100|unique:rumah_sakit,nama',
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
            return redirect('master/rumah_sakit/' . $request->input('id') . '/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $rumah_sakit = $_rumah_sakit->find($request->input('id'));
        $rumah_sakit->nama = $request->input('nama');
        $rumah_sakit->alamat= $request->input('alamat');
        $rumah_sakit->kelurahan = $request->input('kelurahan');
        $rumah_sakit->kecamatan = $request->input('kecamatan');

        $rumah_sakit->is_visible = true;

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

        $rumah_sakit->pic = $user->id;
        $rumah_sakit->created_by = Auth::user()->id;
        $rumah_sakit->save();


        return redirect('master/rumah_sakit/' . $request->input('id') . '/edit')->with('success', 'Berhasil Update rumah_sakit ' . $_rumah_sakit->nama_rumah_sakit);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = RumahSakit::find($id);

        $role->is_visible = false;

        $role->save();

        return redirect('master/rumah_sakit')->with('success', 'Berhasil Hapus Rumah Sakit ' . $id);
    }
}
