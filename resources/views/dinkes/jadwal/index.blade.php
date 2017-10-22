@extends('layouts.app')

@section('content')

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ session('success') }}
        </div>
    @endif

    {{--<div class="padding-bottom-md text-right">--}}
    {{--<a href="{{ route('laporan/create') }}" class="btn btn-primary">--}}
    {{--<i class="glyphicon glyphicon-plus-sign"></i> Buat Laporan--}}
    {{--</a>--}}
    {{--</div>--}}



    <div class="ibox">
        <div class="ibox-title">
            <h5>Jadwal Monitoring</h5>
            <div class="ibox-tools">
                <a href="{{ route('dinkes/jadwal/create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Buat Jadwal
                </a>
            </div>
        </div>
        <div class="ibox-content no-padding">

            <div id="calendar-jadwal-monitoring"></div>

        </div>
    </div>

@endsection
