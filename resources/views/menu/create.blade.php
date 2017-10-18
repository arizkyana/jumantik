@extends('layouts.app')

@section('content')
    <form action="{{ action('MenuController@store') }}" method="post">
        <div class="ibox">

            <div class="ibox-title">
                <h5>Tambah Menu</h5>
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

                <div class="form-group">
                    <div class="row">
                        <label for="name" class="col-md-3">Nama
                            <small class="text-danger">*</small>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control" placeholder="Nama"
                            />
                            @if ($errors->has('name'))
                                <i class="text-danger">{{ $errors->first('name')  }}</i>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="url" class="col-md-3">URL
                            <small class="text-danger">*</small>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="url" class="form-control" placeholder="URL"
                            />
                            @if ($errors->has('url'))
                                <i class="text-danger">{{ $errors->first('url')  }}</i>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="icon" class="col-md-3">Icon
                            <small class="text-danger">*</small>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="icon" class="form-control" placeholder="Icon"
                            />
                            @if ($errors->has('icon'))
                                <i class="text-danger">{{ $errors->first('icon')  }}</i>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="parent" class="col-md-3">Parent</label>
                        <div class="col-md-9">

                            <select name="parent" class="form-control" id="">
                                <option value="0">-- Root --</option>
                                @foreach($parents as $parent)

                                    <option value="{{ $parent->id  }}">{{ $parent->name  }}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="show" class="col-md-3">&nbsp;</label>
                        <div class="col-md-9">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="show"/> Show at Sidebar?
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ibox-footer text-right">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('menu') }}" class="btn btn-default">Batal</a>
            </div>

        </div>
    </form>




@endsection
