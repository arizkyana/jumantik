@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('success') }}
            </div>
        @endif

        <div class="padding-bottom-md text-right">
            <label for="upload-excel" class="btn btn-success">
                <i class="glyphicon glyphicon-file"></i> Upload Excel
                <input type="file" name="upload_excel" id="upload-excel" class="hide" />
            </label>
            <a href="{{ route('buku/create') }}" class="btn btn-primary">
                <i class="glyphicon glyphicon-plus-sign"></i> Tambah Buku
            </a>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Daftar Buku</h3>
            </div>
            <div class="panel-body no-padding">

                <table id="table-menu" class="table table-condensed table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Kode Buku</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Penerbit</th>
                        <th>Penulis</th>
                        <th>Tanggal Terbit</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>


@endsection
