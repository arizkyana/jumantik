<?php

namespace App\Providers;

use App\Menu;
use App\Policies\SekolahPolicy;
use App\RoleMenu;
use App\Sekolah;
use Illuminate\Support\Facades\Auth;
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

        Gate::define('dashboard', function(){
            return true;
        });

        Gate::define('home', function(){
           return true;
        });




    }

    private function authorize_menu($role_id)
    {
        $menus = Menu::all();
        $selected_menus = RoleMenu::where('role_id', $role_id)->get();

        $authorize_menus = [];
        foreach ($menus as $menu) {
            $isAuthorize = false;
            foreach ($selected_menus as $selected_menu) {
                if ($menu->id == $selected_menu->menu_id) $isAuthorize = true;
            }

            $menu->isAuthorize = $isAuthorize;
            if ($menu->isAuthorize) {
                array_push($authorize_menus, $menu);
            }
        }

        return $authorize_menus;
    }
}
