@extends('layouts.app')

@section('content')

    <form action="{{ action('Master\PetugasController@update', ['id' => $petugas->id]) }}" method="post">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Edit Petugas</h5>
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

                <input type="hidden" name="id" value="{{ $petugas->id  }}"/>
                <input type="hidden" name="pic_id" value="{{ $pic->id  }}"/>

                <div class="form-group {{ $errors->has('nama') ? ' has-error' : '' }}">
                    <div class="row">
                        <label for="name" class="col-md-3 ">Nama <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nama" value="{{ $petugas->nama }}" required/>
                            @if ($errors->has('nama'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="form-group {{ $errors->has('alamat') ? ' has-error' : '' }}">
                    <div class="row">
                        <label for="alamat" class="col-md-3">Alamat <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <textarea name="alamat" id="alamat" class="form-control" cols="30"
                                      rows="5">{{$petugas->alamat}}</textarea>
                            @if ($errors->has('alamat'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('alamat') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group ">
                    <div class="row">
                        <label for="wilayah" class="col-md-3">&nbsp;</label>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="kecamatan">Kecamatan</label>
                                    <select class="form-control" data-placeholder="Pilih Kecamatan" name="kecamatan"
                                            id="kecamatan">
                                        <option value=""></option>
                                        @foreach ($kecamatan as $item)
                                            <option value="{{$item->kecamatan_id}}" {{ $item->kecamatan_id == $petugas->kecamatan ? 'selected' : '' }}>{{$item->nama_kecamatan}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('kecamatan'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('kecamatan') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="kelurahan">Kelurahan</label>
                                    <select name="kelurahan" data-placeholder="Pilih Kelurahan" class="form-control"
                                            id="kelurahan">
                                        <option value=""></option>
                                        @foreach ($kelurahan as $item)
                                            <option value="{{ $item->kelurahan_id }}" {{ $item->kelurahan_id == $petugas->kelurahan ? 'selected' : '' }}>{{$item->nama_kelurahan}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('kelurahan'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('kelurahan') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <fieldset>
                    <legend>PIC</legend>
                    <div class="form-group {{ $errors->has('pic_nik') ? ' has-error' : '' }}">
                        <div class="row">
                            <label class="col-md-3" for="pic_nik">NIK <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="pic_nik" id="pic_nik" value="{{ $pic->nik }}"/>
                                @if ($errors->has('pic_nik'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pic_nik') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('pic_nama') ? ' has-error' : '' }}">
                        <div class="row">
                            <label class="col-md-3" for="pic_nama">Nama <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="pic_nama" id="pic_nama" value="{{ $pic->name }}"/>
                                @if ($errors->has('pic_nama'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pic_nama') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="row">
                            <label class="col-md-3" for="email">Email <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="email" class="form-control" name="email" id="email" value="{{ $pic->email }}" />
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('pic_phone') ? ' has-error' : '' }}">
                        <div class="row">
                            <label class="col-md-3" for="pic_phone">Phone <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="pic_phone" id="pic_phone" value="{{ $pic->phone }}"/>
                                @if ($errors->has('pic_phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pic_phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>


                </fieldset>
                <fieldset>
                    <legend>Authentication</legend>
                    <div class="form-group {{ $errors->has('role') ? ' has-error' : '' }}">
                        <div class="row">
                            <label for="role" class="col-md-3">Role <strong class="text-danger">*</strong></label>
                            <div class="col-md-9">
                                <select name="role" data-placeholder="Pilih Role" id="role" class="form-control">
                                    <option value=""></option>
                                    @foreach ($roles as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="row">
                            <label for="password" class="col-md-3">Password <strong
                                        class="text-danger">*</strong></label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="password"/>
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
                            <label for="confirm_password" class="col-md-3">Confirm Password <strong class="text-danger">*</strong></label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="confirm_password"/>
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
            <div class="ibox-footer text-right">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('master/petugas') }}" class="btn btn-default">Batal</a>
            </div>
        </div>
    </form>



@endsection
