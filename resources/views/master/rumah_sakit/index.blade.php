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
            <h5>Daftar Rumah Sakit</h5>
            <div class="ibox-tools">
                <a href="{{ route('master/rumah_sakit/create') }}" class="btn btn-primary">
                    <i class="glyphicon glyphicon-plus-sign"></i> Tambah Rumah Sakit
                </a>
            </div>
        </div>
        <div class="ibox-content ">

            <table id="table-dinkes" class="table table-condensed table-striped table-hover">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>PIC</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rumah_sakit as $index=>$rumah_sakit)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <a href="{{ route('master/rumah_sakit/edit', $rumah_sakit->id)  }}" class="text-danger">
                                {{ $rumah_sakit->nama }}
                            </a>
                        </td>
                        <td>{{ $rumah_sakit->alamat }}</td>
                        <td>{{ $rumah_sakit->pic_name }}</td>
                        <td class="text-right">


                            <form id="delete-{{$rumah_sakit->id}}"
                                  action="{{ action('Master\RumahSakitController@destroy', ['id' => $rumah_sakit->id]) }}"
                                  method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>

                            <a class="btn btn-sm btn-danger"
                               onclick="remove({{$rumah_sakit->id}})">
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
