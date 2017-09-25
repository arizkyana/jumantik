@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <form action="{{ action('Perpustakaan\PeminjamanController@store') }}" method="post">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Tambah Peminjaman</h3>
                </div>
                <div class="panel-body">
                    {{ csrf_field() }}
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
                            <label for="name" class="col-md-3">Anggota <small class="text-danger">*</small></label>
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control" placeholder="Cari Anggota"
                                />
                                @if ($errors->has('name'))
                                    <i class="text-danger">{{ $errors->first('name')  }}</i>
                                @endif
                            </div>
                        </div>
                    </div>

                    <fieldset>
                        <legend>
                            Buku
                        </legend>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="row">
                                        <label for="kategori" class="col-md-3">Kategori</label>
                                        <div class="col-md-9">
                                            <select name="kategori" id="kategori" class="form-control"></select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="judul" id="judul" placeholder="Cari Judul / Pengarang" />
                                        <span class="input-group-addon">
                                                    <i class="glyphicon glyphicon-search"></i>
                                                </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped table-condensed table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Buku</th>
                                            <th>Jumlah</th>
                                            <th>Pinjam</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <strong>PHP Laravel</strong>
                                                <p>
                                                    <small><i>Kategori</i></small>
                                                    <small><i>Pengarang</i></small>
                                                    <small><i>Penerbit</i></small>
                                                    <small><i>Tahun Terbit 2017</i></small>
                                                </p>
                                            </td>
                                            <td>3 Buku</td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="pinjam[]" />
                                                    <span class="input-group-addon">
                                                        buku
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="ambil[]" /> Pinjam
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <nav aria-label="...">
                                    <ul class="pager">
                                        <li><a href="#"><i class="glyphicon glyphicon-chevron-left"></i></a></li>
                                        <li><a href="#"><i class="glyphicon glyphicon-chevron-right"></i></a></li>

                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </fieldset>



                </div>
                <div class="panel-footer text-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('peminjaman') }}" class="btn btn-default">Batal</a>
                </div>
            </div>
        </form>
    </div>


@endsection
