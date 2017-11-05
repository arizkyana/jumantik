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
            <h5>Daftar Notifikasi</h5>
            <div class="ibox-tools">
                <a href="{{ route('notifikasi/setup/create') }}" class="btn btn-primary">
                    <i class="glyphicon glyphicon-plus-sign"></i> Tambah Notifikasi
                </a>
            </div>
        </div>
        <div class="ibox-content ">

            <table id="table-dinkes" class="table table-condensed table-striped table-hover">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Created Date</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($notifications as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <a href="{{ route('notifikasi/setup/edit', $item) }}"
                               class="text-danger">{{ $item->title }}</a>
                        </td>
                        <td>
                            @if ($item->type == 1)
                                <label class="label label-info">Broadcast</label>
                            @else
                                <label class="label label-primary">Single</label>
                            @endif
                        </td>
                        <td>
                            <div class="text-right">
                                <a href="{{ route('notifikasi/setup/show' , $item) }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-paper-plane"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger"
                                        onclick="event.preventDefault();
                                                document.getElementById('delete-{{$item->id}}').submit();">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </button>

                                <form id="delete-{{$item->id}}"
                                      action="{{ action('Notifikasi\SetupController@destroy', ['id' => $item->id]) }}"
                                      method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
