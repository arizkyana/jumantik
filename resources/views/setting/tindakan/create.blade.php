@extends('layouts.app')

@section('content')

    <form action="{{ action('Setting\TindakanController@store') }}" method="post">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Tambah Profile Penyakit</h5>
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

                <div class="form-group {{ $errors->has('nama') ? ' has-error' : '' }}">
                    <div class="row">
                        <label for="name" class="col-md-3 ">Nama <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nama" required/>
                            @if ($errors->has('nama'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="keterangan" class="col-md-3">Keterangan</label>
                        <div class="col-md-9">
                            <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="ibox-footer text-right">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('tindakan') }}" class="btn btn-default">Batal</a>
            </div>
        </div>
    </form>
@endsection
