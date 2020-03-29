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
                                    <select class="form-control" name="overseer">
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id}}">
                                                {{ $teacher->name }}
                                            </option>
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
                                <label for="taught_by" class="col-md-4 col-form-label text-md-right">{{ __('Taught by') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="taught_by">
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id}}">
                                                {{ $teacher->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('taught_by')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="block_id" class="col-md-4 col-form-label text-md-right">{{ __('Block') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="block_id">
                                        @foreach ($blocks as $block)
                                            <option value="{{ $block->id}}">
                                                {{ $block->id }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('block_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="study_points" class="col-md-4 col-form-label text-md-right">{{ __('Study points') }}</label>

                                <div class="col-md-6">
                                    <input id="study_points" type="number" class="form-control @error('study_points') is-invalid @enderror" name="study_points" value="{{ old('study_points') }}" required autocomplete="study_points" autofocus>

                                    @error('study_points')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ "$message" }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="is_finished" class="col-md-4 col-form-label text-md-right">{{ __('Is finished') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="is_finished">
                                        @for($i = 0; $i<2; $i++)
                                            <option value="{{ $i }}">
                                                @if($i == 0)
                                                    False
                                                @endif
                                                @if($i == 1)
                                                    True
                                                @endif
                                            </option>
                                        @endfor
                                    </select>

                                    @error('is_finished')
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
