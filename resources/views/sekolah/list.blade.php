@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar Siswa</h3>
                </div>
                <div class="panel-body">
                    <form action="" name="formFilter" id="formFilter">
                        <div class="form-group">
                            <div class="row">
                                <label for="kelas" class="col-md-3">Kelas</label>
                                <div class="col-md-9">
                                    <select name="" class="form-control" id="">
                                        <option value=""></option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                        <option value="">3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="kelas" class="col-md-3">Sub Kelas</label>
                                <div class="col-md-9">
                                    <select name="" class="form-control" id="">
                                        <option value=""></option>
                                        <option value="">IPA</option>
                                        <option value="">IPS</option>
                                        <option value="">Bahasa</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                    <table class="table table-condensed table-hover" id="table">
                        <thead>
                        <tr>
                            <th>No. Induk</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Usia</th>
                            <th></th>
                        </tr>
                        </thead>
                    </table>
                </div>

            </div>
        </div>
    </div>

@endsection
