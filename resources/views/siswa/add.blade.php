@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Tambah Siswa</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3 text-right">
                                Foto
                            </div>
                            <div class="col-md-9">
                                <label for="foto" class="btn btn-default">
                                    <i class="glyphicon glyphicon-camera"></i> Upload
                                </label>
                                <input type="file" id="foto" name="foto" class="hide" />

                                <img class="img-rounded img-responsive" style="margin-top: 15px;" id="foto-siswa" alt="foto-siswa" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="nama" class="col-md-3">Nama</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="nama" id="nama" />
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
