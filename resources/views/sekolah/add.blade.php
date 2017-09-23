@extends('layouts.app')

@section('content')
    <div class="col-md-12">

        {{ \Illuminate\Support\Facades\Auth::user() }}

        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Buat Sekolah Baru</h3>
                </div>
                <div class="panel-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3 text-right">
                                Foto
                            </div>
                            <div class="col-md-9">
                                <label for="foto" class="btn btn-default">
                                    <i class="glyphicon glyphicon-camera"></i> Upload
                                </label>
                                <input type="file" id="foto" name="foto" class="hide"/>

                                <img class="img-rounded img-responsive" style="margin-top: 15px;" id="foto-sekolah"
                                     alt="foto-sekolah"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="nama" class="col-md-3">Nama Sekolah</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control " name="nama" id="nama"/>
                                @if ($errors->has('nama'))
                                    <i class="text-danger">{{ $errors->first('nama')  }}</i>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="alamat" class="col-md-3">Alamat</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="alamat" id="alamat"/>
                                @if ($errors->has('alamat'))
                                    <i class="text-danger">{{ $errors->first('alamat')  }}</i>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>


@endsection
