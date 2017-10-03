<?php

namespace App\Providers;

use App\Menu;
use App\Policies\SekolahPolicy;
use App\RoleMenu;
use App\Sekolah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('dashboard', function ($user) {

            return $user->isSuperAdmin() || $this->authorize_menu($user->role_id, 'dashboard');
        });

        Gate::define('role', function ($user) {
            return $user->isSuperAdmin() || $this->authorize_menu($user->role_id, 'role');
        });
        Gate::define('role-create', function ($user) {
            return $user->isSuperAdmin() || $this->authorize_menu($user->role_id, 'role-create');
        });
        Gate::define('role-edit', function ($user) {
            return $user->isSuperAdmin() || $this->authorize_menu($user->role_id, 'role-edit');
        });


    }

    private function authorize_menu($role_id, $resource)
    {
        $authorize_menu = DB::table('menu')
            ->leftJoin('role_menu', 'role_menu.menu_id', '=', 'menu.id')
            ->where('role_menu.role_id', $role_id)
            ->where('menu.authorize_url', $resource)
            ->get();
        return count($authorize_menu) == 1;
    }
}
