@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit module {{ $module->name }}</div>

                    <div class="card-body">
                        <form action="{{route('admin.modules.update', $module)}}" method="POST">
                            @csrf
                            {{ method_field('PUT') }}

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $module->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="overseer" class="col-md-2 col-form-label text-md-right">Overseer</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="overseer">
                                    <option value="{{$module->overseer}}">{{$module->overseer()->first()->name}}</option>

                                    @foreach ($teachers as $teacher)
                                        @if($teacher->id != $module->overseer)
                                            <option value="{{ $teacher->id}}">
                                                {{ $teacher->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                    </select>
                                    @error('overseer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="taught_by" class="col-md-2 col-form-label text-md-right">Taught by</label>

                                <div class="col-md-6 ">
                                    <select class="form-control" name="taught_by">

                                        <option value="{{$module->taught_by}}">{{$module->teacher()->first()->name}}</option>

                                        @foreach ($teachers as $teacher)
                                            @if($teacher->id != $module->taught_by)
                                            <option value="{{ $teacher->id}}">
                                                {{ $teacher->name }}
                                            </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('taught_by')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
