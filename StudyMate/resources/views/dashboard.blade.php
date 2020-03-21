@extends('layouts.app')

@section('content')
    <div class="container-">
        <div class="d-flex flex-column">
            <h3>Progression as of all the modules that are currently available to you</h3>
            <div class="progress margin-bottom-small">
                <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" id="bar"></div>
            </div>
            <hr class="col-md-11 gray-border align-self-md-center">
            <div class="row col-md-12">
                <div class="list-group col-md-6">
                    <h3>Pick a block to look at!</h3>
                    <h5>Schoolyear {{\Carbon\Carbon::now()->year}}</h5>
                    <div class="btn-group margin-bottom" role="group">
                        @for($i = 1; $i<=4;$i++)
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop{{$i}}" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Period {{$i}}
                                </button>
                                <div class="dropdown-menu">
                                    <button type="button" class="btn dropdown-item" id="btn{{$i}}" onclick="window.location.href = '{{ route('dashboard_details', ['block' => $i]) }}'">Block {{$i}}</button>
                                    <button type="button" class="btn dropdown-item" id="btn{{$i+4}}" onclick="window.location.href = '{{ route('dashboard_details', ['block' => $i+4]) }}'">Block {{$i+4}}</button>
                                    <button type="button" class="btn dropdown-item" id="btn{{$i+8}}" onclick="window.location.href = '{{ route('dashboard_details', ['block' => $i+8]) }}'">Block {{$i+8}}</button>
                                </div>
                            </div>
                        @endfor
                    </div>
                    <div id="here_table"></div>
                </div>
                <div class="col-md-6">
                    <h3>All followed modules</h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Module</th>
                            <th scope="col">EC</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($guest->modules()->get() as $module)
                            <tr>
                                <th>{{$module->name}}</th>
                                <th>{{$module->study_points}}</th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('#bar').width({{$achieved/$potential*100}} + '%');
            $('#bar').text({{$achieved}} + " EC")
        })
    </script>
@endpush
