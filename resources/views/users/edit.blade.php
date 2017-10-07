@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <form action="{{ action('UsersController@update', ['id' => $users->id]) }}" method="post">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Edit User</h3>
                </div>
                <div class="panel-body">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session('success') }}
                        </div>
                    @endif

                    <input type="hidden" name="id" value="{{ $users->id  }}"/>
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <div class="row">
                            <label for="name" class="col-md-3 ">Nama <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="name" value="{{ $users->name }}"
                                       required/>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="row">
                            <label for="email" class="col-md-3">Email <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="email" disabled class="form-control" name="email" value="{{ $users->email }}"
                                       required/>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="form-group {{ $errors->has('role') ? ' has-error' : '' }}">
                        <div class="row">
                            <label for="role" class="col-md-3">Role <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select name="role" id="role" class="form-control" required>
                                    @foreach($roles as $role)
                                        @if($role->id == $users->role_id)
                                            <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                        @else
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('role'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <fieldset>
                        <legend>Authentication</legend>
                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="row">
                                <label for="password" class="col-md-3">Password <span
                                            class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="password" required/>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('confirm_password') ? ' has-error' : '' }}">
                            <div class="row">
                                <label for="password" class="col-md-3">Confirm Password <span
                                            class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="confirm_password" required/>
                                    @if ($errors->has('confirm_password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('confirm_password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </fieldset>

                </div>
                <div class="panel-footer text-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('users') }}" class="btn btn-default">Batal</a>
                </div>
            </div>
        </form>
    </div>


@endsection