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
use Laravel\Passport\Passport;

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

        // dashboard
        Gate::define('dashboard', function ($user) {

            return $user->isSuperAdmin() || $this->authorize_menu($user->role_id, 'dashboard');
        });

        // role
        Gate::define('role', function ($user) {
            return $user->isSuperAdmin() || $this->authorize_menu($user->role_id, 'role');
        });
        Gate::define('role-create', function ($user) {
            return $user->isSuperAdmin() || $this->authorize_menu($user->role_id, 'role-create');
        });
        Gate::define('role-edit', function ($user) {
            return $user->isSuperAdmin() || $this->authorize_menu($user->role_id, 'role-edit');
        });

        // menu
        Gate::define('menu', function ($user) {
            return $user->isSuperAdmin() || $this->authorize_menu($user->role_id, 'menu');
        });
        Gate::define('menu-create', function ($user) {
            return $user->isSuperAdmin() || $this->authorize_menu($user->role_id, 'menu-create');
        });
        Gate::define('menu-edit', function ($user) {
            return $user->isSuperAdmin() || $this->authorize_menu($user->role_id, 'menu-edit');
        });

        // users
        Gate::define('users', function ($user) {
            return $user->isSuperAdmin() || $this->authorize_menu($user->role_id, 'users');
        });
        Gate::define('users-create', function ($user) {
            return $user->isSuperAdmin() || $this->authorize_menu($user->role_id, 'users-create');
        });
        Gate::define('users-edit', function ($user) {
            return $user->isSuperAdmin() || $this->authorize_menu($user->role_id, 'users-edit');
        });

        // apiClient
        Gate::define('apiClient', function ($user) {
            return $user->isSuperAdmin() || $this->authorize_menu($user->role_id, 'apiClient');
        });
        Gate::define('apiClient-create', function ($user) {
            return $user->isSuperAdmin() || $this->authorize_menu($user->role_id, 'apiClient-create');
        });
        Gate::define('apiClient-edit', function ($user) {
            return $user->isSuperAdmin() || $this->authorize_menu($user->role_id, 'apiClient-edit');
        });

        // laporan
        Gate::define('laporan', function ($user) {
            return $user->isSuperAdmin() || $this->authorize_menu($user->role_id, 'laporan');
        });
        Gate::define('laporan-create', function ($user) {
            return $user->isSuperAdmin() || $this->authorize_menu($user->role_id, 'laporan-create');
        });
        Gate::define('laporan-edit', function ($user) {
            return $user->isSuperAdmin() || $this->authorize_menu($user->role_id, 'laporan-edit');
        });


        // survey
        Gate::define('survey', function ($user) {
            return $user->isSuperAdmin() || $this->authorize_menu($user->role_id, 'survey');
        });
        Gate::define('survey-create', function ($user) {
            return $user->isSuperAdmin() || $this->authorize_menu($user->role_id, 'survey-create');
        });
        Gate::define('survey-edit', function ($user) {
            return $user->isSuperAdmin() || $this->authorize_menu($user->role_id, 'survey-edit');
        });
        Gate::define('survey-laporan', function ($user) {
            return $user->isSuperAdmin() || $this->authorize_menu($user->role_id, 'survey-laporan');
        });

        Passport::routes();


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
