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
            <h5>Daftar Ketua Warga</h5>
            <div class="ibox-tools">
                <a href="{{ route('master/ketua_warga/create') }}" class="btn btn-primary">
                    <i class="glyphicon glyphicon-plus-sign"></i> Tambah Ketua Warga
                </a>
            </div>
        </div>
        <div class="ibox-content ">

            <table id="table-dinkes" class="table table-condensed table-striped table-hover">
                <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Nama</th>
                    <th rowspan="2">Alamat</th>
                    <th rowspan="2">PIC</th>
                    <th class="text-center" colspan="2">Masa Bakti</th>
                    <th rowspan="2" class="text-center">Telepon</th>
                    <th class="text-center" rowspan="2">Action</th>
                </tr>
                <tr>
                    <th class="text-center">Mulai</th>
                    <th class="text-center">Akhir</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ketua_warga as $index=>$petugas)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <a href="{{ route('master/ketua_warga/edit', $petugas->id)  }}" class="text-danger">
                                {{ $petugas->nama }}
                            </a>
                        </td>
                        <td>{{ $petugas->alamat }}</td>
                        <td>{{ $petugas->pic_name }}</td>
                        <td>{{ $petugas->masa_bakti_mulai }}</td>
                        <td>{{ $petugas->masa_bakti_akhir }}</td>
                        <td>{{ $petugas->phone }}</td>
                        <td class="text-right">
                            <a class="btn btn-sm btn-danger"
                               onclick="event.preventDefault();
                                       document.getElementById('delete-{{$petugas->id}}').submit();">
                                <i class="glyphicon glyphicon-trash"></i>
                            </a>

                            <form id="delete-{{$petugas->id}}"
                                  action="{{ action('Master\KetuaWargaController@destroy', ['id' => $petugas->id]) }}"
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
