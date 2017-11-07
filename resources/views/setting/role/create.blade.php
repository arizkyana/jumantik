@extends('layouts.app')

@section('content')

    <form action="{{ action('Setting\RoleController@store') }}" method="post">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Tambah Role</h5>
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

                <fieldset>
                    <legend>
                        Akses Menu
                    </legend>

                    <ul>
                        @php
                           function print_role_menu($menu, $is_child = FALSE){
                               $has_children = is_array($menu['children']) and isset($menu['children']);
                               if ($has_children) {
                                   echo "<li>";
                                   echo "<div class='checkbox'>";
                                   echo '<label><input type="checkbox" name="menus[]" value="'.$menu->id.'"/> '. $menu->name .'</label>';
                                   echo "</div>";
                                   echo "<ul>";
                                   foreach ($menu['children'] as $child){

                                       print_role_menu($child, TRUE);

                                   }
                                   echo "</ul>";
                                   echo "</li>";
                               } else {
                                   echo "<li>";
                                   echo "<div class='checkbox'>";
                                   echo '<label><input type="checkbox" name="menus[]" value="'.$menu->id.'"/> '. $menu->name .'</label>';
                                   echo "</div>";
                                   echo "</li>";

                               }
                           }
                        @endphp

                        @foreach($menus as $menu)
                            @php
                                print_role_menu($menu);
                            @endphp
                        @endforeach



                    </ul>

                </fieldset>

            </div>
            <div class="ibox-footer text-right">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('role') }}" class="btn btn-default">Batal</a>
            </div>
        </div>
    </form>

@endsection
