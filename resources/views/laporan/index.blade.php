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
            <h5>Daftar Laporan Jumantik</h5>
            <div class="ibox-tools">
                <form class="form-inline">
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" /> Suspect DBD
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dinas">Dinas</label>
                        <select name="dinas" id="dinas" class="form-control">
                            <option value="">Pilih Dinas</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="penyakit">Penyakit</label>
                        <select name="penyakit" id="penyakit" class="form-control">
                            <option value="">Pilih Penyakit</option>
                        </select>
                    </div>

                </form>
            </div>
        </div>
        <div class="ibox-content no-padding">

            <table id="table-laporan-jumantik" class="table table-condensed table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Pelapor</th>
                    <th>Penyakit</th>
                    <th>Lokasi</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>Joni</td>
                    <td>Demam Berdarah</td>
                    <td>
                        {{--lokasi langsung open gmaps--}}
                        <a href="{{ route('maps') }}" class="text-danger">Jl. Antapani</a>
                    </td>
                    <td>
                        <a href="{{ route('survey/laporan', 1) }}" class="btn btn-success btn-sm"><i
                                    class="glyphicon glyphicon-alert"></i> Survey</a>
                        <a class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
