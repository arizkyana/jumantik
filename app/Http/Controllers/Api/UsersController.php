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

    public function __construct(){}

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

    public function logout()
    {
        Auth::logout();
        return ['message' => 'you logged out'];
    }

}
