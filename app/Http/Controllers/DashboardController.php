<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $this->authorize('dashboard');
        return view('dashboard')->with([
            'js' => 'dashboard.js',
            'title' => 'Dashboard'
        ]);
    }
}
