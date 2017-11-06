<?php

namespace App\Http\Controllers\Api\Notifikasi;

use App\Dinkes;
use App\Http\Controllers\Controller;
use App\Kecamatan;
use App\Kelurahan;
use App\NotificationHistory;
use App\NotificationSetup;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SetupController extends Controller
{
    public function index(Request $request){
        $user = $request->auth_user;

        $notifikasi = DB::table('notification_history')
            ->select('notification_history.status', 'notification_history.created_at', 'notification_setup.title', 'notification_setup.body')
            ->leftJoin('notification_setup', 'notification_history.id_notification_setup', '=', 'notification_setup.id')
            ->where('receiver', '=', $user->id)
            ->get();

        return [
            'receiver' => $user,
            'notifications' => $notifikasi
        ];
    }
}
