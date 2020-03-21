@extends('layouts.app')

@section('content')
    <div class="container-">
        <div class="d-flex flex-column">
            <h3>Progression for block {{$id}}</h3>
            <div class="progress margin-bottom-small">
                <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" id="bar"></div>
            </div>
            <hr class="col-md-11 gray-border align-self-md-center">
            <div class="margin-bottom-small">
                <button type="button" onclick="window.location.href = '{{ route('getDashboardIndex') }}'" class="btn btn-sm btn-secondary">
                    Back to overview
                </button>
            </div>
            <div class="row col-md-12">
                <div class="list-group col-md-5">
                    <h5>Schoolyear {{\Carbon\Carbon::now()->year}}</h5>
                    <div class="btn-group margin-bottom" role="group">
                        @for($i = 1; $i<=4;$i++)
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop{{$i}}" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Period {{$i}}
                                </button>
                                <div class="dropdown-menu">
                                    <button type="button" class="btn dropdown-item" id="btn{{$i}}" onclick="window.location.href = '{{ route('getDashboardDetails', ['block' => $i]) }}'">Block {{$i}}</button>
                                    <button type="button" class="btn dropdown-item" id="btn{{$i+4}}" onclick="window.location.href = '{{ route('getDashboardDetails', ['block' => $i+4]) }}'">Block {{$i+4}}</button>
                                    <button type="button" class="btn dropdown-item" id="btn{{$i+8}}" onclick="window.location.href = '{{ route('getDashboardDetails', ['block' => $i+8]) }}'">Block {{$i+8}}</button>
                                </div>
                            </div>
                        @endfor
                    </div>
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
                <div class="col-md-4">
                    @if($maxEC != 0)
                        <h3>Block summary</h3>
                        <h4>Passed modules</h4>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Module</th>
                                <th scope="col">EC</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($guest->modules()->where('block_id', '=', $id)->get() as $module)
                                @if($module->is_finished)
                                    <tr>
                                        <th>{{$module->name}}</th>
                                        <th>{{$module->study_points}}</th>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                        <h4>Non-passed modules</h4>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Module</th>
                                <th scope="col">EC</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($guest->modules()->where('block_id', '=', $id)->get() as $module)
                                @if(!$module->is_finished)
                                    <tr>
                                        <th>{{$module->name}}</th>
                                        <th>{{$module->study_points}}</th>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                        <p>You have obtained {{$achievedEC}} out of the maximum of {{$maxEC}} studypoints</p>
                    @else
                        <h2>You did not sign in for any module this block!</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            @if($maxEC != 0)
            $('#bar').width({{$achievedEC/$maxEC*100}} +'%');
            $('#bar').text({{$achievedEC}} +" EC")
            @endif
        })
    </script>
@endpush
