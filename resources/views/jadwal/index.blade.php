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
            <h5>Daftar Jadwal</h5>
            <div class="ibox-tools">
                <a href="{{ route('jadwal/create') }}" class="btn btn-primary">
                    <i class="glyphicon glyphicon-plus-sign"></i> Tambah Jadwal
                </a>
            </div>
        </div>
        <div class="ibox-content ">

            <table id="table-jadwal" class="table table-condensed table-striped table-hover">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Keterangan</th>
                    <th>Mulai</th>
                    <th>Akhir</th>
                    <th>Jam</th>
                    <th>PIC</th>
                    <th>Supervisor</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($jadwal as $index => $jadwal)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <a href="{{ route('jadwal/edit', $jadwal->id)  }}" class="text-danger">
                                {{ $jadwal->title }}
                            </a>
                        </td>
                        <td>{{ $jadwal->keterangan }}</td>
                        <td>{{ $jadwal->mulai }}</td>
                        <td>{{ $jadwal->akhir }}</td>
                        <td>{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_akhir }}</td>
                        <td>{{ $jadwal->pic }}</td>
                        <td>{{ $jadwal->supervisor }}</td>
                        <td>

                            <form id="delete-{{$jadwal->id}}"
                                  action="{{ action('JadwalController@destroy', ['id' => $jadwal->id]) }}"
                                  method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>

                            <a class="btn btn-sm btn-danger"
                               onclick="remove({{$jadwal->id}})">
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
