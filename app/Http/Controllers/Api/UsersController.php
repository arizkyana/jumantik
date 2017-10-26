<?php

namespace App\Http\Controllers\Api;

use App\ApiClient;
use App\Http\Controllers\Controller;
use App\Menu;
use App\Role;
use App\RoleMenu;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Validator;

use GuzzleHttp;
class UsersController extends Controller
{

    public function __construct(){}

    public function login(Request $request){
        $user = User::where('nik' , $request->input('nik'))->first();

        if (Auth::attempt(['email' => $user->email, 'password' => $request->input('password')])) {
            // issuing token
            // grant type : password

            $http = new GuzzleHttp\Client;

            $response = $http->post(url('oauth/token'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => '2',
                    'client_secret' => '',
                    'username' => 'taylor@laravel.com',
                    'password' => 'my-password',
                    'scope' => '',
                ],
            ]);

        }

        return ['message' => 'user not authenticated'];
    }

    public function logout(){
        Auth::logout();
        return ['message' => 'you logged out'];
    }

}
