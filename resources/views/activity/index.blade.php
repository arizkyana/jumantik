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

    {{--filter--}}
    <div class="ibox">
        <div class="ibox-content no-overflow">
            <form class="form-inline" id="form-filter">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" class="form-control" placeholder="Tanggal Mulai" name="tanggal_mulai"
                               id="tanggal_mulai"/>
                        <span class="input-group-addon"> - </span>
                        <input type="text" class="form-control" placeholder="Tanggal Akhir" name="tanggal_akhir"
                               id="tanggal_akhir"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{--/filter--}}

    <div class="ibox">
        <div class="ibox-title">
            <h5>Log Activity</h5>
            <div class="ibox-tools">
                <button type="button" class="btn btn-primary" id="refresh">
                    <i class="fa fa-refresh"></i>
                </button>
            </div>
        </div>
        <div class="ibox-content ">

            <table id="table-jadwal" class="table table-condensed table-striped table-hover full-width">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>IP</th>
                    <th>User</th>
                    <th>Role</th>
                    <th>Message</th>

                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@endsection
