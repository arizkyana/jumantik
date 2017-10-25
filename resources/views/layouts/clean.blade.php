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
</head>

{{--<body class="mini-navbar">--}}
<body class="top-navigation">

<div id="wrapper">

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom white-bg">
            <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse"
                            class="navbar-toggle collapsed" type="button">
                        <i class="fa fa-reorder"></i>
                    </button>
                    <a href="#" class="navbar-brand">Jumantik</a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    @guest
                        <li>
                            <a href="{{ route('login') }}" class="active">
                                Login
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('dashboard') }}">
                                Dashboard
                            </a>
                        </li>
                        <li>

                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                        @endguest

                </ul>

            </nav>
        </div>


        <div class="wrapper wrapper-content">

            @yield('content')

        </div>
        <div class="footer">

            <div>
                <strong>Copyright</strong> {{ config('app.name', 'Laravel') }} &copy; 2017
            </div>
        </div>

    </div>
</div>


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
<script src="{{ asset('js/themes/demo/peity-demo.js') }}"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('js/themes/inspinia.js') }}"></script>
<script src="{{ asset('js/themes/plugins/pace/pace.min.js') }}"></script>

<!-- jQuery UI -->
<script src="{{ asset('js/themes/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

<!-- GITTER -->
<script src="{{ asset('js/themes/plugins/gritter/jquery.gritter.min.js') }}"></script>

<!-- Sparkline -->
<script src="{{ asset('js/themes/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Sparkline demo data  -->
<script src="{{ asset('js/themes/demo/sparkline-demo.js') }}"></script>

<!-- ChartJS-->
<script src="{{ asset('js/themes/plugins/chartJs/Chart.min.js') }}"></script>

<!-- Toastr -->
<script src="{{ asset('js/themes/plugins/toastr/toastr.min.js') }}"></script>

{{--Datatable--}}
<script src="{{ asset('js/themes/plugins/dataTables/datatables.min.js') }}"></script>

{{--select 2--}}
<script src="{{ asset('js/themes/plugins/select2/select2.full.min.js')  }}"></script>
<!-- Scripts -->
{{--<script src="{{ mix('js/app.js') }}"></script>--}}

@if (isset($js))
    <script src="{{ mix('js/' . $js) }}"></script>
@endif

{{--plugins themes js--}}
@if (isset($plugins_js))
    @foreach ($plugins_js as $js)
        <script src="{{ asset('js/themes/plugins/' . $js) }}"></script>
    @endforeach
@endif

{{--gmaps required--}}
@if (isset($gmaps) && $gmaps)
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACK1BU_M2kIo8xohz0dx5RjNOqDwwUKSE" async
            defer></script>
@endif
</body>
</html>
