@extends('layouts.app')

@section('content')
    <div class="container-">
        <div class="d-flex flex-column">
            <h3>Progression as of all the modules that are currently available to you</h3>
            @include('dashboard.partials.progressbar')
            <hr class="col-md-11 gray-border align-self-md-center">
            <div class="row col-md-12">
                <div class="list-group col-md-6">
                    <h3>Pick a block to look at!</h3>
                    @include('dashboard.partials.blockselection')
                </div>
                <div class="col-md-6">
                    @include('dashboard.partials.modules-all')
                </div>
            </div>
        </div>
    </div>
@endsection
