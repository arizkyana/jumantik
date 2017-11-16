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
            <h5>Daftar Menu</h5>
            <div class="ibox-tools">
                <a href="{{ route('menu/create') }}" class="btn btn-primary btn-labeled">
                    <b>
                        <i class="fa fa-plus"></i>
                    </b>
                    Tambah Menu
                </a>
            </div>
        </div>
        <div class="ibox-content">
            <table id="table-menu" class="table table-condensed table-striped table-hover">

                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>URL</th>
                    <th>Icon</th>
                    <th>Parent</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($menus as $index => $menu)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <a href="{{ route('menu/edit', $menu)  }}" class="text-primary">
                                {{ $menu->name }}
                            </a>
                        </td>
                        <td>{{ $menu->url }}</td>
                        <td>{{ $menu->icon }}</td>
                        <td>{{ $menu->parent }}</td>
                        <td>

                            <form id="delete-{{$menu->id}}"
                                  action="{{ action('Setting\MenuController@destroy', ['id' => $menu->id]) }}" method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>

                            <a class="btn btn-sm btn-danger"
                               onclick="remove({{$menu->id}})">
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
