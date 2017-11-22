<?php

namespace App\Http\Controllers\Api;

use App\ApiClient;
use App\Events\UserNavigated;
use App\Http\Controllers\Controller;
use App\Menu;
use App\Role;
use App\RoleMenu;
use App\User;
use App\Utils\ResponseMod;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        $validator = Validator::make($request->all(), [
            'password' => 'required|min:5, max:16',
            'nik' => 'required',
            'fcm_token' => 'required'
        ]);

        if ($validator->fails()) {
            return ResponseMod::failed($validator->messages()->all());
        }

        $user = User::where('nik', $request->input('nik'))->first();

        if (empty($user)) return ['message' => 'user not found'];

        Log::info('Call api/auth/login');

        if (Auth::attempt(['email' => $user->email, 'password' => $request->input('password')])) {
            // issuing token
            // grant type : password

            $apiClient = ApiClient::where('user_id', $user->id)->first();
            $role = Role::find($user->role_id);

            Log::info('Success Login ' . $apiClient->user_id);

            $user->fcm_token = $request->input('fcm_token');
            $user->save();

            $user->secret = $apiClient->secret;
            Auth::user()->fcm_token = $user->fcm_token;
            Auth::user()->secret = $apiClient->secret;
            Auth::user()->role = $role;

            event(new UserNavigated($user));

            return ResponseMod::success(Auth::user());

        }

        return ['message' => 'user not authenticated'];
    }

    public function registration(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password',
            'nik' => 'required',
            'fcm_token' => 'required'
        ]);

        if ($validator->fails()) {
            return ResponseMod::failed($validator->messages()->all());
        }

        $user = new User();

        $user->nik = $request->input('nik');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->name = $request->input('name');
        $user->role_id = $request->input('role'); // default mobile role
        $user->fcm_token = $request->input('fcm_token');

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

        $user->secret = $_api->secret;
        $user->role = Role::find($user->role_id);

        event(new UserNavigated($user));

        return ResponseMod::success($user);


    }

    public function logout()
    {
        event(new UserNavigated(Auth::user()));
        Auth::logout();

        return ResponseMod::success('you logged out');
    }

    public function roles()
    {

        $role = DB::table('role')
            ->whereNotIn('id', [1, 2, 3])
            ->get();

        return ResponseMod::success($role);
    }

    public function forgot(Request $request)
    {
        $email = $request->input('email');

        $validator = Validator::make($request->all(), [
            'email' => 'email|required',
        ]);

        if ($validator->fails()) {
            return ResponseMod::failed($validator->messages()->all());
        }

        $user = User::where('email', $email)->first();

        $new_password = str_random(5);

        $updated_user = User::find($user->id);
        $updated_user->password = bcrypt($new_password);

        $updated_user->save();

        event(new UserNavigated($updated_user));

        return ResponseMod::success([
            'user' => $user,
            'new_password' => $new_password
        ]);

    }

    public function reset_password(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'old_password' => 'required|min:5',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:new_password',
            'email' => 'required'
        ]);

        if ($validator->fails()) {
            return ResponseMod::failed($validator->messages()->all());
        }

        $user = User::where('email', $request->email)->first();

        $updated_user = User::find($user->id);


        $new_password = $request->input('new_password');
        $updated_user->password = bcrypt($new_password);

        $updated_user->save();

        event(new UserNavigated($updated_user));

        return ResponseMod::success([
            'message' => 'Success Update New Password',
            'user' => $user
        ]);

    }
}
