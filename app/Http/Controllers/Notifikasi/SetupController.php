<?php

namespace App\Http\Controllers\Notifikasi;

use App\Dinkes;
use App\Http\Controllers\Controller;
use App\Kecamatan;
use App\Kelurahan;
use App\NotificationHistory;
use App\NotificationSetup;
use App\Role;
use App\User;
use App\Utils\FCM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

        $notifications = NotificationSetup::where('is_visible', true)
            ->orderByDesc('created_at')
            ->get();

        return view('notifikasi/setup/index')->with([
            'js' => $this->js,
            'notifications' => $notifications,
            'title' => 'Setup Notifikasi'
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
        $users = User::orderByDesc('created_at')->get();

        return view('notifikasi/setup/create')
            ->with([
                'users' => $users,
                'js' => $this->js,
                'roles' => $roles,
                'title' => 'Buat Notifikasi'
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

            return redirect('notifikasi/setup/create')
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


        return redirect('notifikasi/setup/create')->with('success', 'Berhasil Tambah Setup Notifikasi ' . $notification_setup->title);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NotificationSetup $setup
     * @return \Illuminate\Http\Response
     */
    public function show(NotificationSetup $setup)
    {
        $roles = Role::all();
        $users = User::orderByDesc('created_at')->get();

        return view('notifikasi/setup/show')
            ->with([
                'js' => $this->js,
                'setup' => $setup,
                'roles' => $roles,
                'users' => $users,
                'title' => 'Detail Notifikasi'
            ]);
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

        return view('notifikasi/setup/edit')->with([
            'js' => $this->js,
            'setup' => $notification_setup,
            'roles' => $roles,
            'users' => $users,
            'title' => 'Edit Notifikasi'
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
            'title' => 'required|max:100|unique:notification_setup,title',
            'body' => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('notifikasi/setup/' . $request->input('id') . '/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $notification_setup = $_notification_setup->find($request->input('id'));
        $notification_setup->title = $request->input('title');
        $notification_setup->body = $request->input('body');
        $notification_setup->type = $request->input('type');
        $notification_setup->created_by = Auth::user()->id;

        $notification_setup->save();

        return redirect('notifikasi/setup/' . $request->input('id') . '/edit')->with('success', 'Berhasil Update Setup Notifikasi ' . $_notification_setup->title);
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

        return redirect('notifikasi/setup')->with('success', 'Berhasil Hapus Setup Notifikasi ' . $id);
    }

    /**
     * Send Notification
     */

    public function send(Request $request, NotificationSetup $setup)
    {

        $histories = [];

        $registration_ids = [];

        if ($setup->type == 2) {
            $receivers = $request->input('users');

            foreach ($receivers as $receiver) {

                $user = User::find($receiver);


                $history = new NotificationHistory();
                $history->id_notification_setup = $setup->id;
                $history->receiver = $receiver;
                $history->status = 1;
                $history->is_visible = true;
                $history->save();

                array_push($histories, $history);
                array_push($registration_ids, $user->fcm_token);
            }

        } else {


            // Broadcast
            $users = User::all();

            foreach ($users as $user) {
                $history = new NotificationHistory();
                $history->id_notification_setup = $setup->id;
                $history->receiver = $user->id;
                $history->status = 1;
                $history->is_visible = true;
                $history->save();

                array_push($histories, $history);
            }
        }


        // send notification
        $fcm = new FCM();

        $sent = $fcm->send_messages($receivers, $setup->title, $setup->body);

        Log::info($sent);

        return redirect('notifikasi/'.$setup->id.'/show')->with('success', 'Berhasil Kirim Notifikasi!');


    }
}
