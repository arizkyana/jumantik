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

        <div class="panel panel-default">
            <div class="panel-heading">
                <strong class="panel-title">
                    <i class="glyphicon glyphicon-filter"></i> Filter
                </strong>
            </div>
            <div class="panel-body">
                <form name="form-filter" id="form-filter">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="row">
                                    <label for="penyakit" class="col-md-3">Penyakit</label>
                                    <div class="col-md-9">
                                        <select name="penyakit" id="penyakit" class="form-control">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="row">
                                    <label for="penyakit" class="col-md-3">Status Survey</label>
                                    <div class="col-md-9">
                                        <select name="status_survey" id="status_survey" class="form-control">
                                            <option value="">Sedang di Survey</option>
                                            <option value="">Selesai di Survey</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Peta Endemic Penyakit</h3>
            </div>
            <div class="panel-body no-padding">
                <div class="maps text-center">
                    <h1>Maps</h1>
                </div>
            </div>

        </div>
    </div>


@endsection
