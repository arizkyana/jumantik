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
                <div class="pull-right">
                    <div class="form-group">
                        <label for="tipe_pelapor">Tipe Pelapor</label>
                        <select name="tipe_pelapor" id="tipe_pelapor" class="form-control"
                                data-placeholder="Pilih Tipe Pelapor">
                            <option value=""></option>
                            <option value="all">All</option>

                            @foreach(\App\Role::all() as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="penyakit">Penyakit</label>
                        <select name="penyakit" id="penyakit" class="form-control" data-placeholder="Pilih Penyakit">
                            <option value=""></option>
                            <option value="all">All</option>

                            @foreach (\App\Penyakit::all() as $penyakit)
                                <option value="{{$penyakit->id}}">{{$penyakit->nama_penyakit}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </form>
        </div>
    </div>
    {{--/filter--}}
    <div class="ibox">
        <div class="ibox-title">
            <h5>Daftar Laporan Jumantik</h5>
            <div class="ibox-tools">
                <button type="button" onclick="refresh()" class="btn btn-sm btn-primary">
                    <i class="fa fa-refresh"></i>
                </button>
            </div>
        </div>
        <div class="ibox-content">

            <table id="table-laporan-jumantik" class="table table-condensed table-striped table-hover">
                <thead>
                <tr>
                    <th>Tanggal Lapor</th>
                    <th>Pelapor</th>
                    <th>Tipe Pelapor</th>
                    <th>Penyakit</th>
                    <th>Tindakan</th>
                    <th>Kecamatan</th>
                    <th>Kelurahan</th>
                    <th>Lokasi</th>
                    <th>Status</th>

                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

    </div>

@endsection
