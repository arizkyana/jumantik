<?php

namespace App;

use App\Utils\FCM;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Laporan extends Model
{
    protected $table = 'laporan';


    // after store
    public function onStore($notify)
    {
        /*
         * Setelah simpan laporan via api, kirim notifikasi ke puskesmas
         */

        Log::info($notify['laporan']);

        $notifikasi = new NotificationSetup();
        $notifikasi->title = 'Laporan Jentik Terbaru!';
        $notifikasi->body = $notify['body']['keterangan'] . ' ' . $notify['body']['alamat'] . ' ' . $notify['body']['kecamatan'] . ' ' . $notify['body']['kelurahan'];
        $notifikasi->type = 2;
        $notifikasi->created_by = $notify['pelapor'];
        $notifikasi->is_visible = true;

        $notifikasi->save();


        //sender
        $sender = DB::table('users')
            ->select('role.name')
            ->leftJoin('role', 'users.role_id', '=', 'role.id')
            ->where('users.id', '=', $notify['pelapor'])
            ->first();

        //receiver
        $users = DB::table('users')
            ->select('users.fcm_token', 'users.id')
            ->leftJoin('role', 'users.role_id', '=', 'role.id');

        if ($sender->name == 'rs') {
            $users = $users->where('role.name', '=', 'jumantik')
                ->orWhere('role.name', '=', 'puskesmas')
                ->get();
        } else if ($sender->name == 'warga' || $sender->name == 'ketua_warga'){
            $users = $users->where('role.name', '=', 'puskesmas')
                ->get();
        } else {
            $users = $users->get();
        }



        $receivers = [];
        foreach ($users as $user) {

            $notifikasi_history = new NotificationHistory();

            $notifikasi_history->id_notification_setup = $notifikasi->id;
            $notifikasi_history->status = 1;
            $notifikasi_history->receiver = $user->id;
            $notifikasi_history->id_laporan = $notify['laporan'];
            $notifikasi_history->is_visible = true;
            $notifikasi_history->save();

            array_push($receivers, $user->fcm_token);

        }

        $fcm = new FCM();

        $sent = $fcm->send_messages($receivers, $notifikasi->title, $notifikasi->body);

        Log::info($sent);
    }

    public function onUpdate($notify)
    {
        /*
         * Setelah simpan laporan via api, kirim notifikasi ke puskesmas
         */

        $notifikasi = new NotificationSetup();
        $notifikasi->title = 'Update Laporan Jentik!';
        $notifikasi->body = $notify['body']['keterangan'] . ' ' . $notify['body']['alamat'] . ' ' . $notify['body']['kecamatan'] . ' ' . $notify['body']['kelurahan'];
        $notifikasi->type = 2;
        $notifikasi->created_by = $notify['pelapor'];
        $notifikasi->is_visible = true;

        $notifikasi->save();

        $users = DB::table('users')
            ->select('users.fcm_token', 'users.id')
            ->leftJoin('role', 'users.role_id', '=', 'role.id')
            ->where('role.name', '=', 'jumantik')
            ->orWhere('role.name', '=', 'puskesmas')
            ->orWhere('role.name', '=', 'rs')
            ->get();

        $receivers = [];
        foreach ($users as $user) {

            $notifikasi_history = new NotificationHistory();

            $notifikasi_history->id_notification_setup = $notifikasi->id;
            $notifikasi_history->status = 1;
            $notifikasi_history->receiver = $user->id;
            $notifikasi_history->id_laporan = $notify['laporan'];
            $notifikasi_history->is_visible = true;
            $notifikasi_history->save();

            array_push($receivers, $user->fcm_token);

        }

        $fcm = new FCM();

        $sent = $fcm->send_messages($receivers, $notifikasi->title, $notifikasi->body);

        Log::info($sent);
    }

    public function onStoreDetail($notify)
    {
        /*
         * Setelah simpan laporan via api, kirim notifikasi ke puskesmas
         */

        $notifikasi = new NotificationSetup();
        $notifikasi->title = 'Update Laporan Jentik!';

        $tindakan = Tindakan::find($notify['body']['tindakan']);
        $status = Status::alias($notify['body']['status']);

        $notifikasi->body = $notify['body']['keterangan'] . ' Tindakan : ' . $tindakan->nama_tindakan . ' Status : ' . $status;
        $notifikasi->type = 1;
        $notifikasi->created_by = $notify['pelapor'];
        $notifikasi->is_visible = true;

        $notifikasi->save();

        $users = DB::table('users')
            ->select('users.fcm_token', 'users.id')
            ->leftJoin('role', 'users.role_id', '=', 'role.id')
            ->get();

        $receivers = [];
        foreach ($users as $user) {

            $notifikasi_history = new NotificationHistory();

            $notifikasi_history->id_notification_setup = $notifikasi->id;
            $notifikasi_history->status = 1;
            $notifikasi_history->receiver = $user->id;
            $notifikasi_history->id_laporan = $notify['laporan'];
            $notifikasi_history->is_visible = true;
            $notifikasi_history->save();

            array_push($receivers, $user->fcm_token);

        }

        $fcm = new FCM();

        $sent = $fcm->send_messages($receivers, $notifikasi->title, $notifikasi->body);

        Log::info($sent);


    }

    public function onApproved($notify)
    {
        /*
         * Setelah simpan laporan via api, kirim notifikasi ke puskesmas
         */

        $notifikasi = new NotificationSetup();
        $notifikasi->title = 'Status Terakhir Laporan Jentik!';

        $tindakan = Tindakan::find($notify['body']['tindakan']);
        $status = Status::alias($notify['body']['status']);

        $notifikasi->body = ' Tindakan : ' . $tindakan->nama_tindakan . ' Status : ' . $status;
        $notifikasi->type = 1;
        $notifikasi->created_by = $notify['approved_by'];
        $notifikasi->is_visible = true;

        $notifikasi->save();

        $users = DB::table('users')
            ->select('users.fcm_token', 'users.id')
            ->leftJoin('role', 'users.role_id', '=', 'role.id')
            ->where('users.id', '<>', $notify['approved_by'])
            ->get();

        $receivers = [];
        foreach ($users as $user) {

            $notifikasi_history = new NotificationHistory();

            $notifikasi_history->id_notification_setup = $notifikasi->id;
            $notifikasi_history->status = 1;
            $notifikasi_history->receiver = $user->id;
            $notifikasi_history->is_visible = true;
            $notifikasi_history->save();

            array_push($receivers, $user->fcm_token);

        }

        $fcm = new FCM();

        $sent = $fcm->send_messages($receivers, $notifikasi->title, $notifikasi->body);

        Log::info($sent);


    }
}
