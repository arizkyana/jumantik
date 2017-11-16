<?php

namespace App\Http\Controllers\Master;

use App\Dinkes;
use App\Http\Controllers\Controller;
use App\Kecamatan;
use App\Kelurahan;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DinkesController extends Controller
{
    private $js = 'master/dinkes.js';

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

        $dinkes = DB::table('dinkes')
            ->select('dinkes.*', 'users.name as pic_name')
            ->leftJoin('users', 'dinkes.pic', '=', 'users.id')
            ->get();



        return view('master/dinkes/index')->with([
            'js' => $this->js,
            'dinkes' => $dinkes,
            'title' => 'Dinkes'
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

        return view('master/dinkes/create')
            ->with([
                'kecamatan' => $kecamatan,
                'js' => $this->js,
                'roles' => $roles,
                'title' => 'Daftar Dinkes'
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
            'nama' => 'required|max:100|unique:dinkes,nama',
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

            return redirect('master/dinkes/create')
                ->withErrors($validator)
                ->withInput();
        }

        $dinkes = new Dinkes();
        $dinkes->nama = $request->input('nama');
        $dinkes->alamat= $request->input('alamat');
        $dinkes->kelurahan = $request->input('kelurahan');
        $dinkes->kecamatan = $request->input('kecamatan');

        $dinkes->is_visible = true;

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

        $dinkes->pic = $user->id;
        $dinkes->created_by = Auth::user()->id;
        $dinkes->save();


        return redirect('master/dinkes/create')->with('success', 'Berhasil Tambah Dinkes ' . $dinkes->nama);


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

        $dinkes = Dinkes::find($id);

        $pic = User::find($dinkes->pic);

        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::where('kecamatan_id', $dinkes->kecamatan)->get();
        $roles = Role::all();

        return view('master/dinkes/edit')->with([
            'js' => $this->js,
            'dinkes' => $dinkes,
            'kecamatan' => $kecamatan,
            'roles' => $roles,
            'pic' => $pic,
            'kelurahan' => $kelurahan,
            'title' => 'Edit Dinkes'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dinkes $_dinkes)
    {

        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:100|unique:dinkes,nama',
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
            return redirect('master/dinkes/' . $request->input('id') . '/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $dinkes = $_dinkes->find($request->input('id'));
        $dinkes->nama = $request->input('nama');
        $dinkes->alamat= $request->input('alamat');
        $dinkes->kelurahan = $request->input('kelurahan');
        $dinkes->kecamatan = $request->input('kecamatan');

        $dinkes->is_visible = true;

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

        $dinkes->pic = $user->id;
        $dinkes->created_by = Auth::user()->id;
        $dinkes->save();


        return redirect('master/dinkes/' . $request->input('id') . '/edit')->with('success', 'Berhasil Update Dinkes ' . $_dinkes->nama_dinkes);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Dinkes::find($id);

        $role->is_visible = false;

        $role->save();

        return redirect('master/dinkes')->with('success', 'Berhasil Hapus Dinkes ' . $id);
    }
}
