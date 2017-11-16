<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MyController;
use App\Menu;
use Illuminate\Http\Request;
use Validator;

class MenuController extends Controller
{

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
//        $this->authorize('menu.index', Menu::class);
        $menus = Menu::all();

        return view('setting/menu/index')->with([
            'menus' => $menus,
            'js' => 'menu.js',
            'title' => 'Menu'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = Menu::all();
        return view('setting/menu/create')->with([
            'parents' => $parents,
            'title' => 'Buat Menu'
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
            'name' => 'required|max:100',
            'url' => 'required',
            'icon' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('setting/menu/create')
                ->withErrors($validator)
                ->withInput();
        }

        $menu = new Menu();
        $menu->name = $request->input('name');
        $menu->url = $request->input('url');
        $menu->icon = $request->input('icon');
        $menu->parent = $request->input('parent');
        $menu->show = $request->input('show') ? TRUE : FALSE;
        $menu->authorize_url = str_replace("/", "-", $request->input('url'));

        $menu->save();

        return redirect('setting/menu/create')->with('success', 'Berhasil Tambah Menu');


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

        $menu = Menu::find($id);
        $parents = Menu::where('parent', 0)->get();


        return view('setting/menu/edit')->with([
            'parents' => $parents,
            'menu' => $menu,
            'title' => 'Edit Menu'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'url' => 'required',
            'icon' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('setting/menu/' . $request->input('id') . '/edit')
                ->withErrors($validator)
                ->withInput();
        }



        $_menu = $menu->find($request->input('id'));

        $_menu->name = $request->input('name');
        $_menu->url = $request->input('url');
        $_menu->icon = $request->input('icon');
        $_menu->parent = $request->input('parent');
        $_menu->show = $request->input('show') ? TRUE : FALSE;
        $_menu->authorize_url = str_replace("/", "-", $request->input('url'));

        $_menu->save();


        return redirect('setting/menu/' . $request->input('id') . '/edit')->with('success', 'Berhasil Update Menu ' . $request->input('name'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $menu = Menu::find($id);
        $menu->delete();

        return redirect('setting/menu')->with('success', 'Berhasil Hapus Menu ' . $id);
    }
}
