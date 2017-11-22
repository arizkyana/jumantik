<?php

namespace App\Http\Controllers\Api;

use App\AreaKecamatan;
use App\Dinkes;
use App\Http\Controllers\Controller;
use App\Jadwal;
use App\Kecamatan;
use App\Puskesmas;
use App\Role;
use App\RumahSakit;
use App\User;
use App\Utils\Datatables;
use App\Utils\ResponseMod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    /**
     * Load laporan with datatables configuration
     *
     * @param Request
     * @return \Illuminate\Http\Response
     */
    public function ajax_log(Request $request)
    {

        $start = $request->input('start');
        $length = $request->input('length');
        $draw = $request->input('draw');

        $count = DB::table('activity')->count();
        $data = DB::table('activity')
//            ->where($where)
            ->leftJoin('users', 'users.id', '=', 'activity.id_user')
            ->leftJoin('role', 'role.id', '=', 'users.role_id')
            ->offset($start)
            ->limit($length)
            ->select('activity.*', 'users.email as email', 'role.name as role');


        if ($request->query('tanggal_mulai') && $request->query('tanggal_akhir') ) {
            $tanggal_mulai = date('Y-m-d', strtotime($request->query('tanggal_mulai')));
            $tanggal_akhir = date('Y-m-d', strtotime($request->query('tanggal_akhir')));
            $data->whereBetween('activity.created_at', [$tanggal_mulai, $tanggal_akhir]);
        }

        $data = Datatables::like($request, $data);
        $data = Datatables::order($request, $data);

        $data = $data->get();

        return [
            'draw' => $draw,
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'data' => $data,

        ];
    }


}
