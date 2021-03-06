@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" dusk="header">Users</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Roles</th>
                                <th scope="col">Teacher Modules</th>
                                <th scope="col">Student Modules</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{$user->id}}</th>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{implode(', ', $user->roles()->get()->pluck('name')->toArray())}}</td>
                                    <td>{{implode(', ', $user->teacherModules()->get()->pluck('name')->toArray())}}</td>
                                    <td>{{implode(', ', $user->modules()->get()->pluck('name')->toArray())}}</td>
                                    <td>
                                        <div class="row min-double-btn-col-width">
                                            <a href="{{route('admin.users.edit', $user->id)}}">
                                                <button dusk="editUserBtn" type="button" class="btn btn-primary btnmargin">Edit</button>
                                            </a>
                                            <form dusk="deleteUserBtn" action="{{route('admin.users.destroy', $user)}}" method="POST">
                                                @csrf
                                                {{method_field('DELETE')}}
                                                <button type="submit" class="btn btn-danger btnmargin">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
