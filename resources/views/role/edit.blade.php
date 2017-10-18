@extends('layouts.app')

@section('content')
    <form action="{{ action('RoleController@update', ['id' => $role->id]) }}" method="post">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Edit Role</h5>
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
                <input type="hidden" name="id" value="{{ $role->id  }}"/>
                <div class="form-group">
                    <div class="row">
                        <label for="name" class="col-md-3">Nama
                            <small class="text-danger">*</small>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control" placeholder="Nama"
                                   value="{{ $role->name }}"/>
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
                            <div class="checkbox">
                                <label>
                                    @if ($menu->selected == true)
                                        <input checked type="checkbox" name="menus[]"
                                               value="{{$menu->id}}"/> {{ $menu->name }}
                                    @else
                                        <input type="checkbox" name="menus[]" value="{{$menu->id}}"/> {{ $menu->name }}
                                    @endif
                                </label>
                            </div>
                        @else
                            <div class="padding-left-md checkbox">
                                <label>
                                    @if ($menu->selected == true)
                                        <input checked type="checkbox" name="menus[]"
                                               value="{{$menu->id}}"/> {{ $menu->name }}
                                    @else
                                        <input type="checkbox" name="menus[]" value="{{$menu->id}}"/> {{ $menu->name }}
                                    @endif
                                </label>
                            </div>
                        @endif
                    @endforeach

                </fieldset>

            </div>
            <div class="ibox-footer text-right">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('role') }}" class="btn btn-default">Batal</a>
            </div>
        </div>
    </form>
@endsection
