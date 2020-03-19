@extends('layouts.app')
@section('content')
    <div class="container">
        <form method="POST" action="">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" value="{{$role->name}}" name="name" class="form-control" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="dname">Display_name</label>
                <input type="text" value="{{$role->display_name}}" name="display_name" class="form-control" placeholder="Display Name">
            </div>
            @foreach($permissions as $permission)
                <div class="form-check">

                    <input type="checkbox" name="permission[]" class="form-check-input"{{$listPermissionOfRole->contains($permission->id)?'checked':''}} value="{{$permission->id}}">
                    <label class="form-check-label">

                        {{$permission->display_name}}

                    </label>

                </div>
            @endforeach
            {{ csrf_field()}}
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
