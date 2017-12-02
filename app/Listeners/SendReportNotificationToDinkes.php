<?php

namespace App\Listeners;

use App\Events\JumantikReported;
use App\NotificationHistory;
use App\NotificationSetup;
use App\Utils\FCM;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SendReportNotificationToDinkes
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  JumantikReported  $event
     * @return void
     */
    public function handle(JumantikReported $event)
    {
        Log::info('listen_event_jumantik_reported ' . $event->laporan->keterangan);

        $laporan = $event->laporan;

        // kirim notif ke dinkes
        $dinkes = DB::table('users')
            ->select('users.id', 'users.fcm_token')
            ->leftJoin('role', 'users.role_id', '=', 'role.id')
            ->where('role.name', 'like', '%dinkes%')
            ->get();

        Log::info($laporan->keterangan);

        $notifikasi = new NotificationSetup();
        $notifikasi->title = $laporan->intensitas_jentik == 1 ? 'Bahaya Jentik pada laporan  ' . $laporan->title : $laporan->title;
        $notifikasi->body = $laporan->keterangan . ' ' . $laporan->alamat . ' ' . $laporan->kecamatan . ' ' . $laporan->kelurahan;
        $notifikasi->type = 2;
        $notifikasi->created_by = $laporan->pelapor;
        $notifikasi->is_visible = true;

        $notifikasi->save();

        $receivers = [];
        foreach ($dinkes as $user) {

            $notifikasi_history = new NotificationHistory();

            $notifikasi_history->id_notification_setup = $notifikasi->id;
            $notifikasi_history->status = 1;
            $notifikasi_history->receiver = $user->id;
            $notifikasi_history->id_laporan = $laporan->id;
            $notifikasi_history->is_visible = true;
            $notifikasi_history->save();

            array_push($receivers, $user->fcm_token);

        }

        $fcm = new FCM();

        $sent = $fcm->send_messages($receivers, $notifikasi->title, $notifikasi->body);

        Log::info($sent);

    }
}
