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
            <h5>Laporan</h5>

            <div class="ibox-tools">
                <strong>{{ $laporan['isi']->created_at }}</strong>
            </div>
        </div>
        <div class="ibox-content">
            {{--modal foto--}}
            <div class="modal inmodal fade" id="modal_foto" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span
                                        aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title">Foto Evidance</h4>

                        </div>
                        <div class="modal-body">
                            <div style="width: 300px;" class="center-block">
                                <img id="foto" class="img-responsive" alt="foto"/>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            {{--/modal foto--}}

            <div class="row">
                <div class="col-md-12">
                    <h1>{{ $laporan['isi']['title'] }}</h1>
                    <h2>{{ $laporan['isi']['sub_title'] }}</h2>
                </div>
            </div>

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

                </div>
                <div class="col-md-6">
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
            <div class="row">
                <div class="col-md-12">
                    <fieldset>
                        <legend>Laporan</legend>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="row">
                                        <label for="penyakit" class="col-md-4">Penyakit</label>
                                        <div class="col-md-8">
                                            {{ $laporan['penyakit']->nama_penyakit }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="suspect" class="col-md-4">Suspect</label>
                                        <div class="col-md-8">
                                            {{ $laporan['isi']->jumlah_suspect }} Jiwa
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="keterangan" class="col-md-4">Keterangan</label>
                                        <div class="col-md-8">
                                            <p class="text-justify">{{ $laporan['isi']->keterangan }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="row">
                                        <label for="intensitas_jentik" class="col-md-4">Intensitas Jentik</label>
                                        <div class="col-md-8">
                                            {{ $laporan['isi']->intensitas_jentik == 1 ? '> 10 %' : '< 10 %' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="Tindakan" class="col-md-4">Tindakan</label>
                                        <div class="col-md-8">
                                            {{ isset($laporan['tindakan']->nama_tindakan) ? $laporan['tindakan']->nama_tindakan : '-'  }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="Status" class="col-md-4">Status</label>
                                        <div class="col-md-8">
                                            {{ isset($laporan['status']) ? $laporan['status'] : '-' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>

            </div>
            <fieldset>
                <legend style="line-height: 3;">
                    Detail Laporan
                    <span class="pull-right" style="line-height: 3">
                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                data-target="#modal_add_detail_laporan">
                            <i class="fa fa-plus-circle"></i> Tambah Detail Laporan
                        </button>
                    </span>
                </legend>
                <table id="table-detail-laporan" class="table table-striped table-hover table-condensed">
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
                            <td>{{ \App\Status::alias($item->status) }}</td>
                            <td>
                                <button type="button" onclick="openFoto(this)"
                                        data-foto="{{ str_replace('uploads//', '/', $item->foto) }}"
                                        class="btn btn-sm btn-primary">
                                    <i class="fa fa-camera"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </fieldset>
            <fieldset>
                <legend>Foto Evidence</legend>

                @if (!empty($laporan['isi']['foto']))

                    <div class="carousel slide" id="carousel2">
                        <ol class="carousel-indicators">

                            @foreach (explode(',', $laporan['isi']['foto']) as $key => $foto)
                                <li data-slide-to="{{ $key }}" data-target="#carousel2"
                                    class="{{ $key == 0 ? 'active' : '' }}"></li>
                            @endforeach

                        </ol>
                        <div class="carousel-inner">

                            @foreach (explode(',', $laporan['isi']['foto']) as $key => $foto)
                                <div class="item {{ $key == 0 ? 'active' : '' }}">
                                    <img alt="image" class="img-responsive"
                                         src="{{ url('media/' . str_replace("uploads/", "", $foto)) }}">
                                    {{--<div class="carousel-caption">--}}
                                    {{--<p>This is simple caption 1</p>--}}
                                    {{--</div>--}}
                                </div>
                            @endforeach


                        </div>
                        <a data-slide="prev" href="#carousel2" class="left carousel-control">
                            <span class="icon-prev"></span>
                        </a>
                        <a data-slide="next" href="#carousel2" class="right carousel-control">
                            <span class="icon-next"></span>
                        </a>
                    </div>
                @else
                    <p>
                        Belum ada foto
                    </p>
                @endif

            </fieldset>
        </div>
        <div class="ibox-footer no-overflow">
            <div class="pull-left">


                <form id="delete-{{$laporan['isi']->id}}"
                      action="{{ action('Penyakit\LaporanController@destroy', ['id' => $laporan['isi']->id]) }}"
                      method="POST"
                      style="display: none;">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                </form>

                <a class="btn btn-sm btn-danger"
                   onclick="remove({{$laporan['isi']->id}})">
                    <i class="glyphicon glyphicon-trash"></i>
                </a>

                <button type="button" class="btn btn-primary"
                        onclick="event.preventDefault();
                                document.getElementById('selesai-{{$laporan['isi']->id}}').submit();">
                    <i class="fa fa-check"></i> Selesai
                </button>


                <form id="selesai-{{$laporan['isi']->id}}"
                      action="{{ action('Penyakit\LaporanController@selesai', ['id' => $laporan['isi']->id]) }}"
                      method="POST"
                      style="display: none;">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                </form>

            </div>
            <div class="pull-right">

                <a href="{{ route('penyakit/laporan') }}" class="btn btn-default">Kembali</a>

            </div>
        </div>
    </div>


@endsection
