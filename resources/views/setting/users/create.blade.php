@extends('layouts.app')

@section('content')

    <form action="{{ action('Setting\UsersController@store') }}" method="post">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Tambah User</h5>
            </div>

            <div class="ibox-content">
                {{ csrf_field() }}
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('success') }}
                    </div>
                @endif

                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                    <div class="row">
                        <label for="name" class="col-md-3 ">Nama <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="name" required/>
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
                            <input type="email" class="form-control" name="email" required/>
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
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
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

                {{--detail informasi--}}
                <fieldset>
                    <legend>Detail Informasi</legend>
                    <div class="form-group {{ $errors->has('nik') ? ' nik' : '' }}">
                        <div class="row">
                            <label for="nik" class="col-md-3">NIK <span
                                        class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="nik" required/>
                                @if ($errors->has('nik'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nik') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </fieldset>
                {{--/detail informasi--}}

                {{--authentication--}}
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
                {{--/authentication--}}



            </div>
            <div class="ibox-footer text-right">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('users') }}" class="btn btn-default">Batal</a>
            </div>
        </div>
    </form>
@endsection
