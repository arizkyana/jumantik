@php


    function menus($role_id){
        $menus = App\Menu::all();
        $selected_menus = App\RoleMenu::where('role_id', $role_id)->get();

        $new_menus = [];
        $test = [];
        foreach ($menus as $menu){
            $isShow = false;

            if ($menu->show == 1) {
                 foreach ($selected_menus as $selected_menu){
                    if ($menu->id == $selected_menu->menu_id) $isShow = true;
                 }

                    $menu->isShow = $isShow;
                    if ($menu->isShow) {
                        array_push($new_menus, $menu);
                    }
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

    function print_menu($menu, $url, $is_child = FALSE){

        $has_children = is_array($menu['children']) and isset($menu['children']);
        if ($has_children) {
            if ((strpos(url('/').'/'.$menu['url'], $url) === 0) || (Request::segment(1) == $menu['url'])) {
                echo '<li class="active">';
            } else {
                echo '<li>';
            }
            echo '<a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">'.$menu['name'].'</span> <span class="fa arrow"></span></a>';

            if ((strpos(url('/').'/'.$menu['url'], $url) === 0) || (Request::segment(1) == $menu['url'])) {
                echo '<ul id="'.$menu['name'].'" data-current-url="'.$url.'" data-menu-url="'.$menu['url'].'" class="nav nav-second-level collapse in">';
            } else {
                echo '<ul id="'.$menu['name'].'" data-current-url="'.$url.'" data-menu-url="'.$menu['url'].'" class="nav nav-second-level collapse">';
            }

            foreach ($menu['children'] as $child){

                print_menu($child, url()->current(), TRUE);

            }
            echo '</ul>';
            echo '</li>';
        } else { // doesn't have children

            if ($is_child) {
                echo '<li><a href='.url($menu['url']).'>'.$menu['name'].'</a></li>';
            } else {
                echo "<li><a data-child='".$is_child."' href='".url($menu['url'])."'><i class='fa fa-th-large'></i><span class='nav-label'>".$menu['name']."</span></a></li>";
            }
        }
    }

    $menus = menus(\Illuminate\Support\Facades\Auth::user()->role_id);

    foreach ($menus as $menu) {
        print_menu($menu, url()->current());
    }

@endphp