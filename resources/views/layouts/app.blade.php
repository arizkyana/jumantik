<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="padding-top:45px">
<div id="app">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @guest
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            @endguest
                </ul>
            </div>
        </div>
    </nav>

    @guest
        @yield('content')

        @else
            <div id="wrapper">
                <!-- Sidebar -->
                <div id="sidebar-wrapper">
                    <ul class="sidebar-nav">
                        <li class="sidebar-brand"></li>

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


                            function set_active($menus, $curr_uri){
                                foreach ($menus as $index => $menu) {
                                    $is_active = false;
                                    $has_children = isset($menu['children']) and is_array($menu['children']);

                                    if ($has_children) {
                                        $menus[$index]['children'] = set_active($menus[$index]['children'], $curr_uri);
                                        foreach ($menus[$index]['children'] as $menu_item) {

                                            if ($menu_item['active']) {
                                                $is_active = $is_active || true;
                                            }

                                        }
                                    } else {
                                        $is_active = strpos($curr_uri, url('/').'/'.$menu['uri']) === 0;

                                    }
                                    $menus[$index]['active'] = $is_active;

                                }
                                return $menus;
                            }

                            function print_menu($menu, $url){

                                $has_children = is_array($menu['children']) and isset($menu['children']);
                                if ($has_children) {
                                    echo '<li data-toggle="collapse" data-target="#'.$menu['name'].'" aria-expanded="false" aria-controls="menu"><a>'.$menu['name'].'</a></li>';

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

                    </ul>
                </div>
                <!-- /#sidebar-wrapper -->

                <!-- Page Content -->
                <div id="page-content-wrapper">
                    <div class="container-fluid">

                        @yield('content')

                    </div>
                </div>
                <!-- /#page-content-wrapper -->
            </div>
            @endguest

</div>

<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>
<script src="{{ mix('js/users.js') }}"></script>

</body>
</html>
