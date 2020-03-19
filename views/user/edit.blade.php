@extends('layouts.app')
@section('content')
    <div class="container">
        <form method="POST" action="">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{$user->name}}" class="form-control" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" name="email" value="{{$user->email}}" class="form-control" placeholder="Email" disabled>
            </div>
            <div class="form-group">
                <label>Rule : </label>
                <select name="role[]" multiple='multiple'>
                    @foreach($roles as $role)
                        <option
                            {{$listRoleOfUser->contains($role->id) ? 'selected':''}}
                            value="{{$role->id}}">{{$role->display_name}}</option>
                    @endforeach
                </select>
            </div>
            {{ csrf_field()}}
            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>
@endsection
