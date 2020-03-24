@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Users</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Description</th>
                                <th scope="col">Type</th>
                                <th scope="col">Deadline</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($exams as $exam)
                                <tr>
                                    <th scope="row">{{$exam->id}}</th>
                                    <td>{{$exam->description}}</td>
                                    <td>{{$exam->type()->first()->type}}</td>
                                    <td>{{$exam->deadline_date}}</td>
                                    <td>
                                        <a href="{{route('admin.users.edit', $user->id)}}">
                                            <button type="button" class="btn btn-primary float-left">Edit</button>
                                        </a>
                                        <form action="{{route('admin.users.destroy', $user)}}" method="POST" class="float-left">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
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
