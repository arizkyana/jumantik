<?php

namespace App\Http\Controllers\Api\Master;

use App\AreaKecamatan;
use App\Faskes;
use App\Http\Controllers\Controller;
use App\Kecamatan;
use Illuminate\Http\Request;

class FaskesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Faskes::all();
    }




}
