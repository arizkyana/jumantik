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

    <div class="ibox">
        <div class="ibox-title">
            <h5>Detail Laporan</h5>
            <div class="ibox-tools">
                <strong>{{ $laporan['isi']->created_at }}</strong>
            </div>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="row">
                            <label for="pelapor" class="col-md-3">Pelapor</label>
                            <div class="col-md-9">
                                {{ $laporan['pelapor']['pelapor']->name }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="pelapor" class="col-md-3">Tipe Pelapor</label>
                            <div class="col-md-9">
                                {{ $laporan['pelapor']['tipe_pelapor']->name }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <fieldset>
                <legend>Laporan</legend>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="row">
                                <label for="penyakit" class="col-md-3">Penyakit</label>
                                <div class="col-md-9">
                                    {{ $laporan['penyakit']->nama_penyakit }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="suspect" class="col-md-3">Suspect</label>
                                <div class="col-md-9">
                                    {{ $laporan['isi']->jumlah_suspect }} Jiwa
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="keterangan" class="col-md-3">Keterangan</label>
                                <div class="col-md-9">
                                    {{ $laporan['isi']->keterangan }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="row">
                                <label for="Tindakan" class="col-md-3">Tindakan</label>
                                <div class="col-md-9">
                                    {{ isset($laporan['tindakan']->nama_tindakan) ? $laporan['tindakan']->nama_tindakan : '-'  }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="Status" class="col-md-3">Status</label>
                                <div class="col-md-9">
                                    {{ isset($laporan['status']->nama_status) ? $laporan['status']->nama_status : '-' }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Detail Laporan</legend>
                <table class="table table-striped table-hover table-condensed">
                    <thead>
                    <tr>
                        <th>Tanggal Event</th>
                        <th>Keterangan</th>
                        <th>Tindakan</th>
                        <th>Status</th>
                        <th>Foto</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($detail_laporan as $item)
                        <tr>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>{{ $item->tindakan }}</td>
                            <td>{{ $item->status }}</td>
                            <td>
                                <a href="#" class="text-danger">Foto</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </fieldset>
        </div>
        <div class="ibox-footer no-overflow">
            <a href="{{ url()->previous() }}" class="btn btn-primary">
                <i class="fa fa-chevron-left"></i> Back
            </a>
        </div>
    </div>

@endsection
