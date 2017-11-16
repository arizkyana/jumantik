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
            <h5>Daftar Profile Penyakit</h5>
            <div class="ibox-tools">
                <a href="{{ route('penyakit/create') }}" class="btn btn-primary">
                    <i class="glyphicon glyphicon-plus-sign"></i> Tambah Profile Penyakit
                </a>
            </div>
        </div>
        <div class="ibox-content ">

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
                @foreach($penyakit as $index => $penyakit)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <a href="{{ route('penyakit/edit', $penyakit)  }}" class="text-danger">
                                {{ $penyakit->nama_penyakit }}
                            </a>
                        </td>
                        <td>{{ $penyakit->keterangan_penyakit}}</td>
                        <td>

                            <form id="delete-{{$penyakit->id}}"
                                  action="{{ action('Setting\PenyakitController@destroy', ['id' => $penyakit->id]) }}"
                                  method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>

                            <a class="btn btn-sm btn-danger"
                               onclick="remove({{$penyakit->id}})">
                                <i class="glyphicon glyphicon-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
