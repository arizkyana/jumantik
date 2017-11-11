<?php

namespace App\Http\Controllers\Api\Master;

use App\AreaKecamatan;
use App\Http\Controllers\Controller;
use App\Kecamatan;
use App\Perkimtan;
use App\Utils\ResponseMod;
use Illuminate\Http\Request;

class PerkimtanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResponseMod::success(Perkimtan::all());
    }




}
