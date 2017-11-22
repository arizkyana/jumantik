<?php

namespace App\Http\Middleware;

use App\ApiClient;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        if ($user->isSuperAdmin()) return $next($request);

        $authorize_menu = DB::table('menu')
            ->leftJoin('role_menu', 'role_menu.menu_id', '=', 'menu.id')
            ->where('role_menu.role_id', $user->role_id)
            ->where('menu.authorize_url', $resource)
            ->first();

        if (empty($authorize_menu)){
            return response()
                ->view('errors/403', [], 403);
        } else {
            return $next($request);
        }


    }
}
