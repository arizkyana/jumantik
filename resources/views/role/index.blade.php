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
            <a href="{{ route('role/create') }}" class="btn btn-primary">
                <i class="glyphicon glyphicon-plus-sign"></i> Tambah Role
            </a>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Daftar Role</h3>
            </div>
            <div class="panel-body no-padding">

                <table id="table-role" class="table table-condensed table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>
                                <a href="{{ route('role/edit', $role)  }}" class="text-primary">
                                    {{ $role->name }}
                                </a>
                            </td>

                            <td>

                                <a class="btn btn-sm btn-danger"
                                   onclick="event.preventDefault();
                                           document.getElementById('delete-{{$role->id}}').submit();">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </a>

                                <form id="delete-{{$role->id}}"
                                      action="{{ action('RoleController@destroy', ['id' => $role->id]) }}" method="POST"
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
