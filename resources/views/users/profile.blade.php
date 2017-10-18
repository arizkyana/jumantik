@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="widget-head-color-box navy-bg p-lg text-center">
                <div class="m-b-md">
                    <h2 class="font-bold no-margins">
                        {{ $users->name }}
                    </h2>
                    <small>{{ $users->role->name }}</small>
                </div>
                <img src="{{ asset('images/a4.jpg') }}" class="img-circle circle-border m-b-md" alt="profile">

            </div>
            <div class="widget-text-box">
                <h4 class="media-heading">{{ $users->name }}</h4>
                <p>{{ $users->email }} | {{ $users->role->name }}</p>

                <div class="text-right">
                    <a class="btn btn-danger btn-label" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form-profile').submit();">
                        <b>
                            <i class="fa fa-power-off"></i>
                        </b> Logout
                    </a>
                    <form id="logout-form-profile" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <form action="{{ action('UsersController@update', ['id' => $users->id]) }}" method="post">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Edit User</h5>
                    </div>
                    <div class="ibox-content">
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
                        <fieldset>
                            <legend>Client API</legend>
                            <div class="form-group">
                                <div class="row">
                                    <label for="client_name" class="col-md-3">Client Name</label>
                                    <div class="col-md-9">
                                        <input type="text" name="client_name" id="client_scope" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="client_scope" class="col-md-3">Scope</label>
                                    <div class="col-md-9">
                                        <select multiple name="client_scope" id="client_scope" class="form-control">
                                            <option value=""></option>
                                            <option value="*">All</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                    </div>
                    <div class="ibox-footer text-right">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ url()->previous() }}" class="btn btn-default">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection