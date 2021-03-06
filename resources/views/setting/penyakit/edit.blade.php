@extends('layouts.app')

@section('content')

        <form action="{{ action('Setting\PenyakitController@update', ['id' => $penyakit->id]) }}" method="post">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Edit Profile Penyakit</h5>
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

                    <input type="hidden" name="id" value="{{ $penyakit->id  }}"/>
                    <div class="form-group {{ $errors->has('nama') ? ' has-error' : '' }}">
                        <div class="row">
                            <label for="name" class="col-md-3 ">Nama <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="nama" value="{{ $penyakit->nama_penyakit }}"
                                       required/>
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
                                <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="10">{{ $penyakit->keterangan_penyakit }}</textarea>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="ibox-footer text-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('penyakit') }}" class="btn btn-default">Batal</a>
                </div>
            </div>
        </form>



@endsection
