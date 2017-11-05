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

    <form action="{{ action('Notifikasi\SetupController@send', $setup) }}" method="POST">
        {{ csrf_field() }}
        <div class="ibox">
            <div class="ibox-title">
                <h5>Notifikasi

                </h5>
                <div class="ibox-tools">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-paper-plane"></i> Send
                    </button>
                </div>
            </div>
            <div class="ibox-content no-overflow">
                <div class="pull-right">
                    {{ $setup->created_at }}
                </div>
                <h2>{{ $setup->title }}</h2>
                <blockquote>
                    <p>
                        {{ $setup->body }}
                    </p>
                    <footer>
                        Notification Type
                        @if ($setup->type == 1)
                            <label class="label label-info">Broadcast</label>
                        @else
                            <label class="label label-primary">Single</label>
                        @endif
                    </footer>
                </blockquote>

                <input type="hidden" name="id" value="{{ $setup->id }}" />

                {{--Single--}}
                @if ($setup->type == 2)
                    <table id="table-users" class="table table-condensed table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Select</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $index => $user)
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="users[]" value="{{ $user->id }}"/> Choose
                                        </label>
                                    </div>
                                </td>

                                <td>{{ $user->name }}</td>
                                <td>
                                    <a href="{{ route('users/edit', $user)  }}" class="text-primary">
                                        {{ $user->email }}
                                    </a>

                                </td>

                                <td>{{ $user->role->name }}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
            <div class="ibox-footer no-overflow">
                <div class="pull-right">
                    <a href="{{ route('notifikasi/setup') }}" class="btn btn-default">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </form>

@endsection
