@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('success') }}
            </div>
        @endif

        <div class="padding-bottom-md text-right">
            <a href="{{ route('menu/create') }}" class="btn btn-primary">
                <i class="glyphicon glyphicon-plus-sign"></i> Tambah Menu
            </a>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Daftar Menu</h3>
            </div>
            <div class="panel-body no-padding">

                <table id="table-menu" class="table table-condensed table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>URL</th>
                        <th>Icon</th>
                        <th>Parent</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($menus as $menu)
                        <tr>
                            <td>{{ $menu->id }}</td>
                            <td>
                                <a href="{{ route('menu/edit', $menu)  }}" class="text-primary">
                                    {{ $menu->name }}
                                </a>
                            </td>
                            <td>{{ $menu->url }}</td>
                            <td>{{ $menu->icon }}</td>
                            <td>{{ $menu->parent }}</td>
                            <td>

                                <a class="btn btn-sm btn-danger"
                                   onclick="event.preventDefault();
                                           document.getElementById('delete-{{$menu->id}}').submit();">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </a>

                                <form id="delete-{{$menu->id}}"
                                      action="{{ action('MenuController@destroy', ['id' => $menu->id]) }}" method="POST"
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
    </div>


@endsection
