@extends('layouts.navbarless')

@section('content')

    <div class="middle-box text-center animated fadeInDown">
        <h1>403</h1>
        <h3 class="font-bold">Unauthorized Access</h3>

        <div class="error-desc">
            You are not authorized to access this page. Please back to previous page or another page.
            <form class="form-inline m-t" role="form">

                <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
            </form>
        </div>
    </div>


@endsection
