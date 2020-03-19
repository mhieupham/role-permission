@extends('layouts.app')
@section('content')
    <div class="container">
        <form method="POST" action="">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="dname">Display_name</label>
                <input type="text" name="display_name" class="form-control" placeholder="Display Name">
            </div>
            @foreach($permissions as $permission)
            <div class="form-check">

                <input type="checkbox" name="permission[]" class="form-check-input" value="{{$permission->id}}" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">

                        {{$permission->display_name}}

                </label>

            </div>
            @endforeach
            {{ csrf_field()}}
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
