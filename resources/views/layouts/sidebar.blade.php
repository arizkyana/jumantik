@php


    function menus($role_id){
        $menus = App\Menu::all();
        $selected_menus = App\RoleMenu::where('role_id', $role_id)->get();

        $new_menus = [];
        $test = [];
        foreach ($menus as $menu){
            $isShow = false;



            foreach ($selected_menus as $selected_menu){
                if ($menu->id == $selected_menu->menu_id) $isShow = true;
            }

            $menu->isShow = $isShow;
            if ($menu->isShow) {
                array_push($new_menus, $menu);
            }
        }

        return build_tree($new_menus);
    }



    function build_tree($elements, $parentId = 0){
        $branch = array();

        foreach ($elements as $element) {

            if ($element['parent'] == $parentId) {
                $children = build_tree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }

    function print_menu($menu, $url){

        $has_children = is_array($menu['children']) and isset($menu['children']);
        if ($has_children) {
            echo '<li class="sub-menu" data-toggle="collapse" data-target="#'.$menu['name'].'" aria-expanded="false" aria-controls="menu"><a>'.$menu['name'].' <i class="glyphicon glyphicon-menu-down"></i> </a>  </li>';

            if ((strpos(url('/').'/'.$menu['url'], $url) === 0) || (Request::segment(1) == $menu['url'])) {
                echo '<ul id="'.$menu['name'].'" data-current-url="'.$url.'" data-menu-url="'.$menu['url'].'" class="sidebar-nav-sub collapse in">';
            } else {
                echo '<ul id="'.$menu['name'].'" data-current-url="'.$url.'" data-menu-url="'.$menu['url'].'" class="sidebar-nav-sub collapse">';
            }

            foreach ($menu['children'] as $child){

                print_menu($child, url()->current());

            }
            echo '</ul>';
        } else { // doesn't have children
            echo '<li><a href='.route($menu['url']).'>'.$menu['name'].'</a></li>';
        }
    }

    $menus = menus(\Illuminate\Support\Facades\Auth::user()->role_id);

    foreach ($menus as $menu) {
        print_menu($menu, url()->current());
    }

@endphp