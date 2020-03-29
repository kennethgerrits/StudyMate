@extends('layouts.app')

@section('content')
    <div class="container-">
        <div class="d-flex flex-column">
            <h3>Progression for block {{$id}}</h3>
            @include('dashboard.partials.progressbar')
            <hr class="col-md-11 gray-border align-self-md-center">
            <div class="margin-bottom-small">
                <a href="{{ route('getDashboardIndex') }}" class="text-decoration-none">
                    <button type="button" class="btn btn-sm btn-secondary">
                        Back to overview
                    </button>
                </a>
            </div>
            <div class="row col-md-12">
                <div class="list-group col-md-5">
                    @include('dashboard.partials.blockselection')
                    @if($modules->where('block_id', '=', $id)->count() != 0)
                        <h3>All block {{$id}} modules</h3>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Module</th>
                                <th scope="col">EC</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($modules->where('block_id', '=', $id) as $module)
                                <tr>
                                    <th>{{$module->name}}</th>
                                    <th>{{$module->study_points}}</th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <h4>We are sorry to tell you that there are currently no courses available for this block!</h4>
                    @endif
                </div>
                <div class="col-md-3">
                    @include('dashboard.partials.modules-all')
                </div>
                <div class="col-md-4">
                    @include('dashboard.partials.blocksummary')
                </div>
            </div>
        </div>
    </div>
@endsection
