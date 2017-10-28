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
use Illuminate\Support\Facades\Log;
use Validator;

use GuzzleHttp;

class UsersController extends Controller
{

    public function __construct()
    {
    }

    public function login(Request $request)
    {
        $user = User::where('nik', $request->input('nik'))->first();

        Log::info('Call api/auth/login');

        if (Auth::attempt(['email' => $user->email, 'password' => $request->input('password')])) {
            // issuing token
            // grant type : password

            $apiClient = ApiClient::where('user_id', $user->id)->first();

            Log::info('Success Login ' . $apiClient->user_id);

            $user->secret = $apiClient->secret;
            Auth::user()->secret = $apiClient->secret;

            return Auth::user();

        }

        return ['message' => 'user not authenticated'];
    }

    public function register(Request $request)
    {
        $user = new User();

        $user->nik = $request->input('nik');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->username = $request->input('username');
        $user->role_id = 4; // default mobile role

        $user->save();

        // Store Client API
        $_api = new ApiClient();

        $_api->user_id = $user->id;
        $_api->name = 'Mobile ' . $user->username;
        $_api->secret = str_random(40);
        $_api->redirect = 'http://localhost:8000/callback'; // sementara statik dulu
        $_api->personal_access_client = false;
        $_api->password_client = true;
        $_api->revoked = false;

        $_api->save();

        return $user;


    }

    public function logout()
    {
        Auth::logout();
        return ['message' => 'you logged out'];
    }

}
