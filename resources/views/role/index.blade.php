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
                <h5>Daftar Role</h5>
                <div class="ibox-tools">
                    <a href="{{ route('role/create') }}" class="btn btn-primary btn-label">
                        <b>
                            <i class="fa fa-plus"></i>
                        </b>
                        Tambah Role
                    </a>
                </div>
            </div>
            <div class="ibox-content no-padding">
                <table id="table-role" class="table table-condensed table-striped table-hover">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $index => $role)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <a href="{{ route('role/edit', $role) }}" class="text-primary">{{ $role->name }}</a>
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

       



@endsection
