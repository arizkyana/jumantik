<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Role;
use App\RoleMenu;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Validator;

class UsersController extends MyController
{


    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::all();

        foreach ($users as $user) :
            $role = Role::find($user->role_id);
            $user->role = $role;
        endforeach;

        return view('users/index')->with([
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $roles = Role::all();
        return view('users/create')->with('roles', $roles);
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
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password'
        ]);

        if ($validator->fails()) {
            return redirect('users/create')
                ->withErrors($validator)
                ->withInput()
                ->with($request->input());
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role_id = $request->input('role');

        $user->save();

        return redirect('users/create')->with('success', 'Berhasil Tambah User ' . $user->email);


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

//        $this->authorize('update-role');

        $users = User::find($id);

        $roles = Role::all();


        return view('users/edit')->with([
            'users' => $users,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'email' => 'email|unique:users,email',
            'role' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password'
        ]);

        if ($validator->fails()) {
            return redirect('users/' . $request->input('id') . '/edit')
                ->withErrors($validator)
                ->withInput()
                ->with($request->input());
        }

        $_user = $user->find($request->input('id'));

        $_user->name = $request->input('name');
        $_user->email = $request->input('email') ? $request->input('email') : $_user->email;
        $_user->password = $request->input('password');
        $_user->role_id = $request->input('role');

        $_user->save();

        return redirect('users/' . $request->input('id') . '/edit')->with('success', 'Berhasil Update User ' . $_user->email);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = User::find($id);
        $role->delete();

        return redirect('users')->with('success', 'Berhasil Hapus User ' . $id);
    }
}