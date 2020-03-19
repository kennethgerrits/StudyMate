@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create a new Module') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.modules.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="overseer" class="col-md-4 col-form-label text-md-right">{{ __('Overseer') }}</label>

                                <div class="col-md-6">
                                    <input id="overseer" type="text" class="form-control @error('overseer') is-invalid @enderror" name="overseer" value="{{ old('overseer') }}" required autocomplete="overseer">

                                    @error('overseer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="taught_by" class="col-md-4 col-form-label text-md-right">{{ __('Taught by') }}</label>

                                <div class="col-md-6">
                                    <input id="taught_by" type="text" class="form-control @error('taught_by') is-invalid @enderror" name="taught_by" value="{{ old('taught_by') }}" required autocomplete="taught_by">

                                    @error('taught_by')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
