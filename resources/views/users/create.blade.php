@extends('layouts.app')

@section('content')

    <form action="{{ action('UsersController@store') }}" method="post">
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

                {{--detail informasi--}}
                <fieldset>
                    <legend>Detail Informasi</legend>
                    <div class="form-group {{ $errors->has('no_telepon') ? ' has-error' : '' }}">
                        <div class="row">
                            <label for="password" class="col-md-3">No Telpon <span
                                        class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="no_telepon"/>
                                @if ($errors->has('no_telepon'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('no_telepon') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('puskesmas') ? ' has-error' : '' }}">
                        <div class="row">
                            <label for="password" class="col-md-3">Puskesmas Terdekat <span
                                        class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select class="form-control" name="puskesmas" id="puskesmas">
                                    <option value=""></option>
                                </select>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('jenis_kelamin') ? ' has-error' : '' }}">
                        <div class="row">
                            <label for="password" class="col-md-3">Jenis Kelamin<span
                                        class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="jenis_kelamin" value="1"/> Laki - Laki
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="jenis_kelamin" value="2"/> Perempuan
                                    </label>
                                </div>
                                @if ($errors->has('jenis_kelamin'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jenis_kelamin') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('usia') ? ' has-error' : '' }}">
                        <div class="row">
                            <label for="password" class="col-md-3">Usia <span
                                        class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="number" class="form-control" name="usia" id="usia"/>
                                @if ($errors->has('usia'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('usia') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </fieldset>
                {{--/detail informasi--}}
            </div>
            <div class="ibox-footer text-right">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('users') }}" class="btn btn-default">Batal</a>
            </div>
        </div>
    </form>
@endsection
