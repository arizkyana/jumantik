<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MyController;
use App\Menu;
use App\Penyakit;
use App\Role;
use App\RoleMenu;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Validator;

class PenyakitController extends Controller
{

   public function index(Request $request){
       return Penyakit::where('is_visible', true)->get();
   }



}
