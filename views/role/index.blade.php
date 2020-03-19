@extends('layouts.app')
@section('content')
    <div class="container">
        <a type="button"  href="{{route('role.add')}}" class="btn btn-primary">Add</a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Display Name</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr>
                    <th scope="row">{{$role->id}}</th>
                    <td>{{$role->name}}</td>
                    <td>{{$role->display_name}}</td>
                    <td>
                        <a type="button" href="{{route('role.edit',['id'=>$role->id])}}" class="btn btn-primary">Edit</a>
                        <a type="button" href='{{route('role.destroy',['id'=>$role->id])}}' class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection
