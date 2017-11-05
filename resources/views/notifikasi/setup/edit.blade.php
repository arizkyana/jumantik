@extends('layouts.app')

@section('content')

    <form action="{{ action('Notifikasi\SetupController@update', ['id' => $setup->id]) }}" method="post">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Edit Notifikasi</h5>
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

                <input type="hidden" name="id" value="{{ $setup->id  }}"/>


                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                    <div class="row">
                        <label for="title" class="col-md-3 ">Title <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="title" value="{{ $setup->title }}" required/>
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
                            <textarea name="body" id="body" class="form-control" cols="30" rows="5">
                                {{ trim($setup->body)}}
                            </textarea>
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
                                        <input type="radio" name="type" value="1" {{ $setup->type == 1 ? 'checked' : '' }} /> Broadcast
                                    </label>
                                </div>

                                <div class="radio">
                                    <label>
                                        <input type="radio" name="type" value="2" {{ $setup->type == 2 ? 'checked' : '' }} /> Single
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
