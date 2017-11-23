<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? config('app.name', 'Laravel') . " | " . $title : config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>

</head>

{{--<body class="mini-navbar">--}}
<body class="">

@guest
    @yield('content')
    @else
        {{--admin--}}

        <div id="wrapper">

            <nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav metismenu" id="side-menu">
                        <li class="nav-header">
                            <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" style="height: 48px; width: 48px;"
                                 src="{{ asset('images/logo-bekasi.jpg') }}"/>
                             </span>
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong
                                            class="font-bold">{{ \Illuminate\Support\Facades\Auth::user()->name }}</strong>
                             </span> <span class="text-muted text-xs block">{{ \Illuminate\Support\Facades\Auth::user()->role->name}}
                                    <b
                                            class="caret"></b></span> </span> </a>
                                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                    <li><a href="{{ route('users/profile') }}">Profile</a></li>
                                    <li class="divider"></li>
                                    <li>

                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form-nav').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form-nav" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            <div class="logo-element">
                                JM
                            </div>
                        </li>

                        @include('layouts/sidebar')

                    </ul>

                </div>
            </nav>

            <div id="page-wrapper" class="gray-bg">
                <div class="row border-bottom">
                    <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
                        <div class="navbar-header">
                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i
                                        class="fa fa-bars"></i>
                            </a>
                            <form role="search" class="navbar-form-custom hide" action="search_results.html">
                                <div class="form-group">
                                    <input type="text" placeholder="Search for something..." class="form-control"
                                           name="top-search" id="top-search">
                                </div>
                            </form>
                        </div>
                        <ul class="nav navbar-top-links navbar-right">
                            <li>

                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i> Log out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>

                    </nav>
                </div>
                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-sm-12">
                        <h2>{{ isset($title) ? $title : config('app.name', 'Laravel') }}</h2>


                        <ol class="breadcrumb">
                            <li>
                                <a href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="active">
                                <strong>{{ isset($title) ? $title : config('app.name', 'Laravel') }}</strong>
                            </li>
                        </ol>
                    </div>

                </div>

                <div class="wrapper wrapper-content animated fadeInRight">

                    @yield('content')

                </div>
                <div class="footer">

                    <div>
                        <strong>Copyright</strong> {{ config('app.name', 'Laravel') }} &copy; 2017
                    </div>
                </div>

            </div>
        </div>
        {{--/admin--}}
        @endguest


        <script src="{{ asset('js/themes/jquery-3.1.1.min.js') }}"></script>
        <script src="{{ asset('js/themes/bootstrap.js') }}"></script>
        <script src="{{ asset('js/themes/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
        <script src="{{ asset('js/themes/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

        <!-- Flot -->
        <script src="{{ asset('js/themes/plugins/flot/jquery.flot.js') }}"></script>
        <script src="{{ asset('js/themes/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
        <script src="{{ asset('js/themes/plugins/flot/jquery.flot.spline.js') }}"></script>
        <script src="{{ asset('js/themes/plugins/flot/jquery.flot.resize.js') }}"></script>
        <script src="{{ asset('js/themes/plugins/flot/jquery.flot.pie.js') }}"></script>

        <!-- Peity -->
        <script src="{{ asset('js/themes/plugins/peity/jquery.peity.min.js') }}"></script>


        <!-- Custom and plugin javascript -->
        <script src="{{ asset('js/themes/inspinia.js') }}"></script>
        <script src="{{ asset('js/themes/plugins/pace/pace.min.js') }}"></script>

        <!-- jQuery UI -->
        <script src="{{ asset('js/themes/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

        <!-- GITTER -->
        <script src="{{ asset('js/themes/plugins/gritter/jquery.gritter.min.js') }}"></script>

        <!-- Sparkline -->
        <script src="{{ asset('js/themes/plugins/sparkline/jquery.sparkline.min.js') }}"></script>


        <!-- Toastr -->
        <script src="{{ asset('js/themes/plugins/toastr/toastr.min.js') }}"></script>

        {{--Datatable--}}
        <script src="{{ asset('js/themes/plugins/dataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('js/themes/plugins/datapicker/bootstrap-datepicker.js') }}"></script>

        {{--select 2--}}
        <script src="{{ asset('js/themes/plugins/select2/select2.full.min.js')  }}"></script>
        <!-- Scripts -->

        {{--sweetalert--}}
        <script src="{{ asset('js/themes/plugins/sweetalert/sweetalert.min.js') }}"></script>
        {{--/sweetalert--}}

        {{--Switchery--}}
        <script src="{{ asset('js/themes/plugins/switchery/switchery.js') }}"></script>

        {{--Clockpicker--}}
        <script src="{{ asset('js/themes/plugins/clockpicker/clockpicker.js') }}"></script>

        {{--<script src="{{ mix('js/app.js') }}"></script>--}}



        <script src="{{ mix('js/socket.js') }}"></script>
        <script src="{{ mix('js/app.js') }}"></script>

        {{--plugins themes js--}}
        @if (isset($plugins_js))
            @foreach ($plugins_js as $js)
                <script src="{{ asset('js/themes/plugins/' . $js) }}"></script>
            @endforeach
        @endif

        {{--gmaps required--}}
        @if (isset($gmaps) and $gmaps)
            <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
            </script>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACK1BU_M2kIo8xohz0dx5RjNOqDwwUKSE" async
                    defer></script>
        @endif

        <script type="text/javascript">
            var base_url = {!! json_encode(url('/')) !!};

            var logError = (e) => {
                console.log(e);
            };
        </script>

        @if (isset($js))
            <script src="{{ mix('js/' . $js) }}" async defer></script>
        @endif


</body>
</html>
