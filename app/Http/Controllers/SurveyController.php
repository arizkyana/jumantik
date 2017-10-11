<?php

namespace App\Http\Controllers;

use App\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
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
        return view('survey/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('survey/create');
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
            return redirect('menu/create')
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

        return redirect('menu/create')->with('success', 'Berhasil Tambah Menu');


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


        return view('menu/edit')->with([
            'parents' => $parents,
            'menu' => $menu
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
            return redirect('menu/' . $request->input('id') . '/edit')
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


        return redirect('menu/' . $request->input('id') . '/edit')->with('success', 'Berhasil Update Menu ' . $request->input('name'));
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

        return redirect('menu')->with('success', 'Berhasil Hapus Menu ' . $id);
    }

    /**
     * Survey berdasarkan laporan
     *
     * @param \App\Laporan $id
     * @return \Illuminate\Http\Response
     */
    public function laporan(){
        return view('survey/laporan');
    }
}
