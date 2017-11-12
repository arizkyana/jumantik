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

            {{--modal laporan pe--}}
            <div class="modal inmodal fade" id="modal_laporan_pe" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span
                                        aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title">Laporan PE</h4>

                        </div>
                        <div class="modal-body">
                            <div style="width: 500px; padding: 10px;" class="center-block border-left-right">
                                <h3>Laporan PE</h3>
                                <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum
                                </p>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            {{--/modal laporan pe--}}
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
                <div class="col-md-6">
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
                                            {{ $laporan['isi']->intensitas_jentik }}
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
                <div class="col-md-6">
                    <fieldset>
                        <legend>DBD</legend>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <label for="penyakit" class="col-md-4">KDRS</label>
                                        <div class="col-md-8">
                                           -
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="suspect" class="col-md-4">PE</label>
                                        <div class="col-md-8">
                                            <button type="button" data-toggle="modal" data-target="#modal_laporan_pe" class="btn btn-primary btn-sm btn-block">
                                                <i class="fa fa-eye"></i> Lihat Laporan
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </fieldset>
                </div>
            </div>
            <fieldset>
                <legend>Detail Laporan</legend>
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
                <legend>Lokasi</legend>
                <input type="hidden" id="lat" name="lat" value="{{ $laporan['isi']->lat }}" />
                <input type="hidden" id="lon" name="lon" value="{{ $laporan['isi']->lon }}" />
                <div id="map" class="google-map" style=" height: 500px !important;">

                </div>

            </fieldset>
        </div>
        <div class="ibox-footer no-overflow">
            <div class="pull-left">
                <button type="button" class="btn btn-danger"
                   onclick="event.preventDefault();
                           document.getElementById('delete-{{$laporan['isi']->id}}').submit();">
                    <i class="fa fa-trash-o"></i>
                </button>

                <form id="delete-{{$laporan['isi']->id}}"
                      action="{{ action('Penyakit\LaporanController@destroy', ['id' => $laporan['isi']->id]) }}" method="POST"
                      style="display: none;">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                </form>

                <button type="button" class="btn btn-primary"
                        onclick="event.preventDefault();
                                document.getElementById('selesai-{{$laporan['isi']->id}}').submit();">
                    <i class="fa fa-check"></i> Selesai
                </button>

                <form id="selesai-{{$laporan['isi']->id}}"
                      action="{{ action('Penyakit\LaporanController@selesai', ['id' => $laporan['isi']->id]) }}" method="POST"
                      style="display: none;">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                </form>

            </div>
            <div class="pull-right">

                <a href="{{ url()->previous() }}" class="btn btn-default">Kembali</a>

            </div>
        </div>
    </div>


@endsection
