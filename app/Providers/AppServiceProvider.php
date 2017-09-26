<?php

namespace App\Providers;

use App\Menu;
use App\RoleMenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(150);


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    protected function menus($role_id){

        $menus = Menu::all();
        $selected_menus = RoleMenu::where('role_id', $role_id)->get();

        $new_menus = [];
        $test = [];
        foreach ($menus as $menu){
            $isShow = false;
            foreach ($selected_menus as $selected_menu){
                if ($menu->id == $selected_menu->menu_id) $isShow = true;
            }

            $menu->isShow = $isShow;
            array_push($new_menus, $menu);
        }

        return $this->build_tree($new_menus);
    }
    private function build_tree($elements, $parentId = 0){
        $branch = array();

        foreach ($elements as $element) {

            if ($element['parent'] == $parentId) {
                $children = $this->build_tree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }
}
