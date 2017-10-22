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
                        <label for="tingkatan">Tingkatan</label>
                        <select name="tingkatan" id="tingkatan" class="form-control">
                            <option value="">Pilih Tingkatan</option>
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
                    <th>Tingkatan</th>
                    <th>Penyakit</th>
                    <th>Lokasi</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>Joni</td>
                    <td>Kader (Dinkes)</td>
                    <td>Suspect DBD</td>
                    <td>
                        {{--lokasi langsung open gmaps--}}
                        <a href="{{ route('maps') }}" class="text-danger">Jl. Antapani</a>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('survey/laporan', 1) }}" class="btn btn-success btn-sm"><i
                                    class="glyphicon glyphicon-alert"></i> Tindakan</a>
                        <a class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Jono</td>
                    <td>Sekolah</td>
                    <td>Malaria</td>
                    <td>
                        {{--lokasi langsung open gmaps--}}
                        <a href="{{ route('maps') }}" class="text-danger">Jl. Antapani</a>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('survey/laporan', 1) }}" class="btn btn-success btn-sm"><i
                                    class="glyphicon glyphicon-alert"></i> Tindakan</a>
                        <a class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
