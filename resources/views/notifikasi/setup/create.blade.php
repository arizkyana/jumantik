@extends('layouts.app')

@section('content')

    <form action="{{ action('Notifikasi\SetupController@store') }}" method="post">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Tambah Notifikasi</h5>
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

                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                    <div class="row">
                        <label for="title" class="col-md-3 ">Title <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="title" required/>
                            @if ($errors->has('title'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="form-group {{ $errors->has('body') ? ' has-error' : '' }}">
                    <div class="row">
                        <label for="body" class="col-md-3">Body <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <textarea name="body" id="body" class="form-control" cols="30" rows="5"></textarea>
                            @if ($errors->has('body'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                </div>

                <fieldset>
                    <legend>Configuration</legend>
                    <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                        <div class="row">
                            <label class="col-md-3" for="type">Type <span class="text-danger">*</span></label>
                            <div class="col-md-9">

                                <div class="radio">
                                    <label>
                                        <input type="radio" name="type" value="1" /> Broadcast
                                    </label>
                                </div>

                                <div class="radio">
                                    <label>
                                        <input type="radio" name="type" value="2" /> Single
                                    </label>
                                </div>

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                </fieldset>

            </div>
            <div class="ibox-footer text-right">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('notifikasi/setup') }}" class="btn btn-default">Batal</a>
            </div>
        </div>
    </form>
@endsection
