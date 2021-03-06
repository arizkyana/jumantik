@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <form action="{{ action('PeminjamanController@update', ['id' => $menu->id]) }}" method="post">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Edit Peminjaman</h3>
                </div>
                <div class="panel-body">
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
                    <input type="hidden" name="id" value="{{ $menu->id  }}" />
                    <div class="form-group">
                        <div class="row">
                            <label for="name" class="col-md-3">Nama <small class="text-danger">*</small></label>
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control" placeholder="Nama"
                                       value="{{ $menu->name }}"/>
                                @if ($errors->has('name'))
                                    <i class="text-danger">{{ $errors->first('name')  }}</i>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="url" class="col-md-3">URL <small class="text-danger">*</small></label>
                            <div class="col-md-9">
                                <input type="text" name="url" class="form-control" placeholder="URL"
                                       value="{{ $menu->url }}"/>
                                @if ($errors->has('url'))
                                    <i class="text-danger">{{ $errors->first('url')  }}</i>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="icon" class="col-md-3">Icon <small class="text-danger">*</small></label>
                            <div class="col-md-9">
                                <input type="text" name="icon" class="form-control" placeholder="Icon"
                                       value="{{ $menu->icon }}"/>
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
                                        @if ($parent->id == $menu->parent)
                                            <option value="{{ $parent->id  }}" selected>{{ $parent->name  }}</option>
                                        @else
                                            <option value="{{ $parent->id  }}">{{ $parent->name  }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('menu') }}" class="btn btn-default">Batal</a>
                </div>
            </div>
        </form>
    </div>


@endsection
