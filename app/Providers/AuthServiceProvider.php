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
use Illuminate\Support\Facades\Log;
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
            return $this->authorize_menu($user, 'dashboard');
        });

        // penyakit
        Gate::define('penyakit-laporan', function($user){
            return $this->authorize_menu($user, 'penyakit-laporan');
        });
        Gate::define('penyakit-laporan-show', function($user){
            return $this->authorize_menu($user, 'penyakit-laporan-show');
        });


        Passport::routes();

    }

    private function authorize_menu($user, $resource)
    {

        if ($user->isSuperAdmin()) return true;

        $authorize_menu = DB::table('menu')
            ->leftJoin('role_menu', 'role_menu.menu_id', '=', 'menu.id')
            ->where('role_menu.role_id', $user->role_id)
            ->where('menu.authorize_url', $resource)
            ->get();
        return count($authorize_menu) == 1;
    }

}
