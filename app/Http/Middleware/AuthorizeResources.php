<?php

namespace App\Http\Middleware;

use App\ApiClient;
use App\Events\UserNavigated;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AuthorizeResources
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $resource)
    {

        $user = Auth::user();

        Log::info($user->email . ' navigate to ' . $resource);

        if ($user->isSuperAdmin()) {
            event(new UserNavigated($user));
            return $next($request);
        }

        $authorize_menu = DB::table('menu')
            ->leftJoin('role_menu', 'role_menu.menu_id', '=', 'menu.id')
            ->where('role_menu.role_id', $user->role_id)
            ->where('menu.authorize_url', $resource)
            ->first();



        if (empty($authorize_menu)){
            return response()
                ->view('errors/403', [], 403);
        } else {

            event(new UserNavigated($user));

            return $next($request);
        }


    }
}
