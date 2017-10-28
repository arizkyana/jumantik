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
            <h5>Daftar Tindakan</h5>
            <div class="ibox-tools">
                <a href="{{ route('tindakan/create') }}" class="btn btn-primary">
                    <i class="glyphicon glyphicon-plus-sign"></i> Tambah Tindakan
                </a>
            </div>
        </div>
        <div class="ibox-content no-padding">

            <table id="table-users" class="table table-condensed table-striped table-hover">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tindakan as $index => $penyakit)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <a href="{{ route('tindakan/edit', $penyakit->id_tindakan)  }}" class="text-danger">
                                {{ $penyakit->nama_tindakan }}
                            </a>
                        </td>
                        <td>{{ $penyakit->keterangan_tindakan}}</td>
                        <td>
                            <a class="btn btn-sm btn-danger"
                               onclick="event.preventDefault();
                                       document.getElementById('delete-{{$penyakit->id_tindakan}}').submit();">
                                <i class="glyphicon glyphicon-trash"></i>
                            </a>

                            <form id="delete-{{$penyakit->id_tindakan}}"
                                  action="{{ action('Setting\TindakanController@destroy', ['id' => $penyakit->id_tindakan]) }}"
                                  method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
