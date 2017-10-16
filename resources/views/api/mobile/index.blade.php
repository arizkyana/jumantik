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
            <a href="{{ route('apiClient/create') }}" class="btn btn-primary">
                <i class="glyphicon glyphicon-plus-sign"></i> Tambah API Client
            </a>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Daftar Client</h3>
            </div>
            <div class="panel-body no-padding">

                <table id="table-api-client" class="table table-condensed table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Created At</th>
                        <th>User ID</th>
                        <th>Client Name</th>
                        <th>Client Secret</th>
                        <th>Redirect</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($apiClients as $apiClient)
                        <tr>
                            <td>{{ $apiClient->created_at }}</td>
                            <td>{{ $apiClient->user_id }}</td>
                            <td>
                                <a href="{{ route('apiClient/edit', $apiClient) }}"
                                   class="text-primary">{{ $apiClient->name }}</a>
                            </td>
                            <td>{{ $apiClient->secret }}</td>
                            <td>{{ $apiClient->redirect }}</td>
                            <td>
                                <a class="btn btn-sm btn-danger"
                                   onclick="event.preventDefault();
                                           document.getElementById('delete-{{$apiClient->id}}').submit();">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </a>

                                <form id="delete-{{$apiClient->id}}"
                                      action="{{ action('ApiClientController@destroy', ['id' => $apiClient->id]) }}"
                                      method="POST"
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
