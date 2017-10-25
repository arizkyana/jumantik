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
            <form class="form-inline">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" class="form-control" value="{{ \Carbon\Carbon::now() }}" name="tanggal_mulai"
                               id="tanggal_mulai"/>
                        <span class="input-group-addon"> - </span>
                        <input type="text" class="form-control" value="{{ \Carbon\Carbon::now() }}" name="tanggal_akhir"
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
                            <option value="1">Jumantik Petugas</option>
                            <option value="2">Jumantik Kader</option>
                            <option value="3">Puskesmas</option>
                            <option value="4">Rumah Sakit</option>
                            <option value="5">Dinkes</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="penyakit">Penyakit</label>
                        <select name="penyakit" id="penyakit" class="form-control" data-placeholder="Pilih Penyakit">
                            <option value=""></option>
                            <option value="all">All</option>
                            <option value="1">Demam Berdarah</option>
                            <option value="2">Cikungunya</option>
                            <option value="3">Malaria</option>
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


        </div>
        <div class="ibox-content no-padding">

            <table id="table-laporan-jumantik" class="table table-condensed table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tanggal Lapor</th>
                    <th>Pelapor</th>
                    <th>Tipe Pelapor</th>
                    <th>Penyakit</th>
                    <th>Tindakan</th>
                    <th>Status</th>
                    <th>Lokasi</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>
                        <a href="{{ route('penyakit/laporan/show', 2) }}" class="text-danger">{{ \Carbon\Carbon::now() }}</a>
                    </td>
                    <td>Joni</td>
                    <td>Kader (Dinkes)</td>
                    <td>Suspect DBD 100 Jiwa </td>
                    <td>Fogging</td>
                    <td>
                        <label class="label label-primary">Closed</label>
                    </td>
                    <td>
                        {{--lokasi langsung open gmaps--}}
                        <a href="{{ route('maps') }}" class="text-danger">Jl. Antapani</a>
                    </td>
                    <td class="text-center">

                        <a class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>
                        <a href="{{ route('penyakit/laporan/show', 2) }}" class="text-danger">{{ \Carbon\Carbon::now() }}</a>
                    </td>
                    <td>Jono</td>
                    <td>Sekolah</td>
                    <td>Malaria 0 Jiwa </td>
                    <td>Fogging</td>
                    <td>
                        <label class="label label-warning">On Going</label>
                    </td>
                    <td>
                        {{--lokasi langsung open gmaps--}}
                        <a href="{{ route('maps') }}" class="text-danger">Jl. Antapani</a>
                    </td>
                    <td class="text-center">

                        <a class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="ibox-footer no-overflow">
            <div class="pull-right">
                <form>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="1"/> Suspect DBD
                            </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
