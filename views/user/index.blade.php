@extends('layouts.app')
@section('content')
<div class="container">
    <a type="button"  href="{{route('user.add')}}" class="btn btn-primary">Add</a>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($listUser as $user)
        <tr>
        <th scope="row">{{$user->id}}</th>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>
            <a type="button" href="{{route('user.edit',['id'=>$user->id])}}" class="btn btn-primary">Edit</a>
            <a type="button" href='{{route('user.destroy',['id'=>$user->id])}}' class="btn btn-danger">Delete</a>
        </td>
        </tr>
        @endforeach
    </tbody>
    </table>

</div>
@endsection
