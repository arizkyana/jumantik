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
            <a href="{{ route('users/create') }}" class="btn btn-primary">
                <i class="glyphicon glyphicon-plus-sign"></i> Tambah User
            </a>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Daftar Users</h3>
            </div>
            <div class="panel-body no-padding">

                <table id="table-menu" class="table table-condensed table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                <a href="{{ route('users/edit', $user)  }}" class="text-primary">
                                    {{ $user->email }}
                                </a>

                            </td>

                            <td>{{ $user->role->name }}</td>
                            <td>
                                <a class="btn btn-sm btn-danger"
                                   onclick="event.preventDefault();
                                           document.getElementById('delete-{{$user->id}}').submit();">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </a>

                                <form id="delete-{{$user->id}}"
                                      action="{{ action('UsersController@destroy', ['id' => $user->id]) }}" method="POST"
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
