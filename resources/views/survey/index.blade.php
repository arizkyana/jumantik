@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('success') }}
            </div>
        @endif


        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Daftar Survey</h3>
            </div>
            <div class="panel-body no-padding">

                <table id="table-menu" class="table table-condensed table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Laporan</th>
                        <th>Petugas (PJ)</th>
                        <th>Lokasi</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Joni</td>
                            <td>Bp. Marjono</td>
                            <td>
                                {{--lokasi langsung open gmaps--}}
                                <a href="{{ route('maps') }}" class="text-danger">Jl. Antapani</a>
                            </td>
                            <td>
                                <a  class="btn btn-success btn-sm" ><i class="glyphicon glyphicon-alert"></i> Survey Selesai</a>
                                <a class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



@endsection
