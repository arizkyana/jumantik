<?php

namespace App\Http\Controllers\Notification;

use App\Dinkes;
use App\Http\Controllers\Controller;
use App\Kecamatan;
use App\Kelurahan;
use App\NotificationSetup;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SetupController extends Controller
{
    private $js = 'notification/setup.js';

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

        $notifications = NotificationSetup::where('is_visible', true)->get();


        return view('notification/setup/index')->with([
            'js' => $this->js,
            'notifications' => $notifications
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
        $users = User::all();

        return view('notification/setup/create')
            ->with([
                'users' => $users,
                'js' => $this->js,
                'roles' => $roles
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
            'title' => 'required|max:100|unique:notification_setup,title',
            'body' => 'required',
            'type' => 'required',
        ]);


        if ($validator->fails()) {

            return redirect('notification/setup/create')
                ->withErrors($validator)
                ->withInput();
        }

        $notification_setup = new NotificationSetup();
        $notification_setup->title = $request->input('title');
        $notification_setup->body = $request->input('body');
        $notification_setup->type = $request->input('type');
        $notification_setup->is_visible = true;
        $notification_setup->created_by = Auth::user()->id;

        $notification_setup->save();


        return redirect('notification/setup/create')->with('success', 'Berhasil Tambah Setup Notifikasi ' . $notification_setup->title);


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

        $notification_setup = NotificationSetup::find($id);

        $roles = Role::all();
        $users = User::all();

        return view('notification/setup/edit')->with([
            'js' => $this->js,
            'notification_setup' => $notification_setup,
            'roles' => $roles,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NotificationSetup $_notification_setup)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100|unique:notificationSetup,title',
            'body' => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('notification/setup/' . $request->input('id') . '/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $notification_setup = $_notification_setup->find($request->input('id'));
        $notification_setup->title = $request->input('title');
        $notification_setup->body = $request->input('body');
        $notification_setup->created_by = Auth::user()->id;

        $notification_setup->save();

        return redirect('notification/setup/' . $request->input('id') . '/edit')->with('success', 'Berhasil Update Setup Notifikasi ' . $_notification_setup->title);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = NotificationSetup::find($id);

        $role->is_visible = false;

        $role->save();

        return redirect('notification/setup')->with('success', 'Berhasil Hapus Setup Notifikasi ' . $id);
    }
}
