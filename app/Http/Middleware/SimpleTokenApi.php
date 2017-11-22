<?php

namespace App\Http\Middleware;

use App\ApiClient;
use App\Events\UserNavigated;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class SimpleTokenApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if ($request->ajax()) return $next($request);

        $secret = $request->header('Authorization');
        $apiClient = ApiClient::where('secret', $secret)->first();

        if (!empty($apiClient)) {
            // get user
            $user = User::find($apiClient->user_id);

            $request->auth_user = $user;

            event(new UserNavigated($user));

            return $next($request);
        };

        return response('unauthenticated', 403);

    }
}
