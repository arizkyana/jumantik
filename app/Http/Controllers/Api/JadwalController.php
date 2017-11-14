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
use App\Utils\ResponseMod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResponseMod::success(Jadwal::where('is_visible', true)->get());
    }

    public function wilayah(User $user){

        $role = Role::find($user->role_id);

        if ($role->name == 'puskesmas') {
            $wilayah = DB::table('puskesmas')
                ->select('users.name as pic', 'users.email', 'users.phone', 'users.nik','puskesmas.alamat', 'puskesmas.nama', 'kecamatan.kecamatan_id', 'kelurahan.kelurahan_id', 'kecamatan.nama_kecamatan', 'kelurahan.nama_kelurahan')
                ->leftJoin('kecamatan', 'puskesmas.kecamatan', '=', 'kecamatan.kecamatan_id')
                ->leftJoin('kelurahan', 'puskesmas.kelurahan', '=', 'kelurahan.kelurahan_id')
                ->leftJoin('users', 'puskesmas.pic', '=', 'users.id')
                ->first();
        } else if ($role->name == 'rs') {
            $wilayah = DB::table('rumah_sakit')
                ->select('users.name as pic', 'users.email', 'users.phone', 'users.nik','rumah_sakit.alamat', 'rumah_sakit.nama', 'kecamatan.kecamatan_id', 'kelurahan.kelurahan_id', 'kecamatan.nama_kecamatan', 'kelurahan.nama_kelurahan')
                ->leftJoin('kecamatan', 'rumah_sakit.kecamatan', '=', 'kecamatan.kecamatan_id')
                ->leftJoin('kelurahan', 'rumah_sakit.kelurahan', '=', 'kelurahan.kelurahan_id')
                ->leftJoin('users', 'rumah_sakit.pic', '=', 'users.id')
                ->first();
        } else if ($role->name == 'dinkes') {
            $wilayah = DB::table('dinkes')
                ->select('users.name as pic', 'users.email', 'users.phone', 'users.nik','dinkes.alamat', 'dinkes.nama', 'kecamatan.kecamatan_id', 'kelurahan.kelurahan_id', 'kecamatan.nama_kecamatan', 'kelurahan.nama_kelurahan')
                ->leftJoin('kecamatan', 'dinkes.kecamatan', '=', 'kecamatan.kecamatan_id')
                ->leftJoin('kelurahan', 'dinkes.kelurahan', '=', 'kelurahan.kelurahan_id')
                ->leftJoin('users', 'dinkes.pic', '=', 'users.id')
                ->first();
        }

        if (empty($wilayah)) return ResponseMod::failed($wilayah);

        return ResponseMod::success($wilayah);
    }


}
