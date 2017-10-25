<?php

namespace App\Http\Controllers;

use App\ApiClient;
use App\Menu;
use App\Role;
use App\RoleMenu;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Validator;

class UsersController extends Controller
{

    private $js = 'users.js';

    public function __construct()
    {
        parent::__construct();

    }


}
