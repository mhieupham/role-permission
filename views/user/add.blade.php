@extends('layouts.app')
@section('content')
<div class="container">
    <form method="POST" action="">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" placeholder="Name">
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" name="email" class="form-control" placeholder="Email">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" placeholder="Password" name="password">
    </div>
    <div class="form-group">
        <label for="password">Re-Password</label>
        <input type="password" class="form-control" placeholder="Re-Password" name='comfim_password'>
    </div>
    <div class="form-group">
        <label>Rule : </label>
        <select name="role[]" multiple='multiple'>
            @foreach($roles as $role)
            <option value="{{$role->id}}">{{$role->name}}</option>
            @endforeach
        </select>
    </div>
    {{ csrf_field()}}
    <button type="submit" class="btn btn-primary">Submit</button>
    
    </form>
</div>
@endsection