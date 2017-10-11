<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Role;
use App\RoleMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Validator;

class RoleController extends MyController
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

        $roles = Role::all();


        return view('role/index')->with([
            'roles' => $roles,
            'js' => 'role.js'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $menus = Menu::all();
        return view('role/create')->with('menus', $menus);
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
        ]);

        if ($validator->fails()) {
            return redirect('role/create')
                ->withErrors($validator)
                ->withInput();
        }



        $role = new Role();
        $role->name = $request->input('name');

        $role->save();


        $menus = $request->input('menus');

        foreach($menus as $menu) {
            $role_menu = new RoleMenu();
            $role_menu->role_id = $role->id;
            $role_menu->menu_id = $menu;
            $role_menu->save();
        }

        return redirect('role/create')->with('success', 'Berhasil Tambah Role');


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

        $role = Role::find($id);
        $menus = Menu::all();
        $selected_menus = RoleMenu::where('role_id', $id)->get();

        foreach ($menus as $menu){
            $selected = false;
            foreach ($selected_menus as $selected_menu){
                if ($menu->id == $selected_menu->menu_id) $selected = true;
            }
            $menu->selected = $selected;
        }

        return view('role/edit')->with([
            'role' => $role,
            'menus' => $menus,
            'selected_menus' => $selected_menus
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return redirect('role/' . $request->input('id') . '/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $_role = $role->find($request->input('id'));

        $_role->name = $request->input('name');

        $_role->save();

        $menus = $request->input('menus');

        RoleMenu::where('role_id', $request->input('id'))->delete();

        foreach($menus as $menu) {
            $role_menu = new RoleMenu();
            $role_menu->role_id = $role->id;
            $role_menu->menu_id = $menu;
            $role_menu->save();
        }

        return redirect('role/' . $request->input('id') . '/edit')->with('success', 'Berhasil Update Role ' . $request->input('name'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();

        return redirect('role')->with('success', 'Berhasil Hapus Role ' . $id);
    }
}
