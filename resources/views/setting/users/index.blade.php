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
            <h5>Daftar Users</h5>
            <div class="ibox-tools">
                <a href="{{ route('users/create') }}" class="btn btn-primary">
                    <i class="glyphicon glyphicon-plus-sign"></i> Tambah User
                </a>
            </div>
        </div>
        <div class="ibox-content">

            <table id="table-users" class="table table-condensed table-striped table-hover">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>
                            <a href="{{ route('users/edit', $user)  }}" class="text-primary">
                                {{ $user->email }}
                            </a>

                        </td>

                        <td>{{ $user->role->name }}</td>
                        <td>

                            <form id="delete-{{$user->id}}"
                                  action="{{ action('Setting\UsersController@destroy', ['id' => $user->id]) }}" method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>

                            <a class="btn btn-sm btn-danger"
                               onclick="remove({{$user->id}})">
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
