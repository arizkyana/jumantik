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
            <h5>Daftar Dinkes</h5>
            <div class="ibox-tools">
                <a href="{{ route('master/dinkes/create') }}" class="btn btn-primary">
                    <i class="glyphicon glyphicon-plus-sign"></i> Tambah Dinkes
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
                @foreach($dinkes as $index=>$dinkes)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <a href="{{ route('master/dinkes/edit', $dinkes->id)  }}" class="text-danger">
                                {{ $dinkes->nama }}
                            </a>
                        </td>
                        <td>{{ $dinkes->alamat }}</td>
                        <td>{{ $dinkes->pic_name }}</td>
                        <td class="text-right">


                            <form id="delete-{{$dinkes->id}}"
                                  action="{{ action('Master\DinkesController@destroy', ['id' => $dinkes->id]) }}"
                                  method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>

                            <a class="btn btn-sm btn-danger"
                               onclick="remove({{$dinkes->id}})">
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
