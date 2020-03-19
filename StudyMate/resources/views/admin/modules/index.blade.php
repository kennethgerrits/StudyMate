@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Modules
                    <div class="float-right">
                        <a href="{{route('admin.modules.create')}}">
                            <button type="button" class="btn btn-primary float-left">New</button>
                        </a>
                    </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Overseer</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($modules as $module)
                                <tr>
                                    <th scope="row">{{$module->id}}</th>
                                    <td>{{$module->name}}</td>
                                    <td>{{$module->overseer}}</td>
                                    <td>
                                        <a href="{{route('admin.modules.edit', $module->id)}}">
                                            <button type="button" class="btn btn-primary float-left">Edit</button>
                                        </a>
                                        <form action="{{route('admin.modules.destroy', $module)}}" method="POST" class="float-left">
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
