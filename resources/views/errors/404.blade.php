@extends('layouts.navbarless')

@section('content')

    <div class="middle-box text-center animated fadeInDown">
        <h1>404</h1>
        <h3 class="font-bold">Page Not Found</h3>

        <div class="error-desc">
            Sorry, but the page you are looking for has note been found. Try found something else in our app.
            <form class="form-inline m-t" role="form">
                <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
            </form>
        </div>
    </div>


@endsection
