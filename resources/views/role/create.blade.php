@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <form action="{{ action('RoleController@store') }}" method="post">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Tambah Role</h3>
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

                    <fieldset>
                        <legend>
                            Akses Menu
                        </legend>

                        @foreach($menus as $menu)

                            @if ($menu->parent == 0)
                                <div class="checkbox" data-content="parent">
                                    <label>
                                        <input type="checkbox" name="menus[]" value="{{$menu->id}}"/> {{ $menu->name }}
                                    </label>
                                </div>
                            @else
                                <div class="padding-left-md checkbox">
                                    <label>
                                        <input type="checkbox" name="menus[]" value="{{$menu->id}}"/> {{ $menu->name }}
                                    </label>
                                </div>
                            @endif
                        @endforeach

                    </fieldset>

                </div>
                <div class="panel-footer text-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('role') }}" class="btn btn-default">Batal</a>
                </div>
            </div>
        </form>
    </div>


@endsection
