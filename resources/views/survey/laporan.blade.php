@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <form action="{{ action('SurveyController@store') }}" method="post">


            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title">Buat Survey</h3>
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
                            <label class="col-md-3" for="petugas">Petugas</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <select name="petugas" class="form-control dropdown"></select>
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default">
                                            <i class="fa fa-plus-circle"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Jono
                                    <input type="hidden" name="id_petugas" />
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <fieldset>
                        <legend>Laporan</legend>
                        <div class="row">
                            <div class="col-md-4">
                                tes
                            </div>
                            <div class="col-md-8">
                                <div class="maps text-center ">
                                    <h1>Maps</h1>
                                    <h2><i class="fa fa-map-marker"></i></h2>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="panel-footer text-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-check"></i> Submit
                    </button>
                    <a href="{{ url()->previous() }}" class="btn btn-danger">
                        <i class="fa fa-close"></i> Batal
                    </a>
                </div>
            </div>
        </form>
    </div>




@endsection
