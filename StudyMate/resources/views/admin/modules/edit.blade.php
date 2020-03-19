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


                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
