<?php

namespace App\Http\Controllers;

use App\Menu;
use App\RoleMenu;
use Illuminate\Support\Facades\Auth;

class MyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }

}
