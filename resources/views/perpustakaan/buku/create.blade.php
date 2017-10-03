@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <form action="{{ action('Perpustakaan\BukuController@store') }}" method="post">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Tambah Buku</h3>
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

                    {{--judul--}}
                    <div class="form-group">
                        <div class="row">
                            <label for="judul" class="col-md-3">Judul</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="judul" />
                            </div>
                        </div>
                    </div>
                    {{--/judul--}}

                    {{--kategori--}}
                    <div class="form-group">
                        <div class="row">
                            <label for="kategori" class="col-md-3">Kategori</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <select class="form-control" name="kategori" id="kategori">
                                        <option value="">Pilih Kategori</option>
                                    </select>
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-kategori">
                                            <i class="glyphicon glyphicon-plus"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--/kategori--}}

                    {{--penerbit--}}
                    <div class="form-group">
                        <div class="row">
                            <label for="penerbit" class="col-md-3">Penerbit</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <select class="form-control" name="penerbit" id="penerbit">
                                        <option value="">Pilih Penerbit</option>
                                    </select>
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-penerbit">
                                            <i class="glyphicon glyphicon-plus"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--/penerbit--}}

                    {{--penulis--}}
                    <div class="form-group">
                        <div class="row">
                            <label for="penulis" class="col-md-3">Penulis</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <select class="form-control" name="penulis" id="penulis">
                                        <option value="">Pilih Penulis</option>
                                    </select>
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-penulis">
                                            <i class="glyphicon glyphicon-plus"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--/penulis--}}

                    {{--tanggal terbit--}}
                    <div class="form-group">
                        <div class="row">
                            <label for="tanggal_terbit" class="col-md-3">Tanggal Terbit</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-calendar"></i>
                                </span>
                                    <input type="text" class="form-control" name="tanggal_terbit" />
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--/tanggal terbit--}}
                </div>
                <div class="panel-footer ">
                    <div class="row">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6 text-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('buku') }}" class="btn btn-default">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @include('perpustakaan.buku.modal.kategori')
    @include('perpustakaan.buku.modal.penerbit')
    @include('perpustakaan.buku.modal.penulis')

@endsection
