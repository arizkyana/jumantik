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
            <h5>Daftar Status</h5>
            <div class="ibox-tools">
                <a href="{{ route('status/create') }}" class="btn btn-primary">
                    <i class="glyphicon glyphicon-plus-sign"></i> Tambah Status
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
                @foreach($status as $index => $penyakit)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <a href="{{ route('status/edit', $penyakit)  }}" class="text-danger">
                                {{ $penyakit->nama_status }}
                            </a>
                        </td>
                        <td>{{ $penyakit->keterangan_status}}</td>
                        <td>
                            <a class="btn btn-sm btn-danger"
                               onclick="event.preventDefault();
                                       document.getElementById('delete-{{$penyakit->id_status}}').submit();">
                                <i class="glyphicon glyphicon-trash"></i>
                            </a>

                            <form id="delete-{{$penyakit->id_status}}"
                                  action="{{ action('Setting\StatusController@destroy', ['id' => $penyakit->id_status]) }}"
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