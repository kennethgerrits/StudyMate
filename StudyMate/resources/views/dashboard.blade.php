@extends('layouts.app')

@section('content')
    <div class="container-">
        <div class="d-flex flex-column">
            <div class="progress margin-bottom">
                <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" id="bar"></div>
            </div>
            <div class="row col-md-12">
                <div class="list-group col-md-5">
                    <input id="modules" type="hidden" value="{{ $guest->modules()->get()->toJson() }}">
                    <h5>Schoolyear {{\Carbon\Carbon::now()->year}}</h5>
                    <div class="btn-group margin-bottom" role="group">
                        @for($i = 1; $i<=4;$i++)
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop{{$i}}" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Period {{$i}}
                                </button>
                                <div class="dropdown-menu">
                                    <button type="button" class="btn dropdown-item" id="btn{{$i}}">Block {{$i}}</button>
                                    <button type="button" class="btn dropdown-item" id="btn{{$i+4}}">Block {{$i+4}}</button>
                                    <button type="button" class="btn dropdown-item" id="btn{{$i+8}}">Block {{$i+8}}</button>
                                </div>
                            </div>
                        @endfor
                    </div>
                    <div id="here_table"></div>
                </div>
                <div class="col-md-3">
                    <h3>All modules</h3>
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
                        @foreach($guest->modules()->get() as $module)
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
                        @foreach($guest->modules()->get() as $module)
                            @if(!$module->is_finished)
                                <tr>
                                    <th>{{$module->name}}</th>
                                    <th>{{$module->study_points}}</th>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    <p>You have obtained {{$achieved}} out of the maximum of {{$potential}} studypoints</p>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            let modules = $.parseJSON($('#modules').val());
            for(let i = 1; i <= 12; i++){
                $('#btn' + i).click(function () {
                    let added = 0;
                    let block = 'Blok ' + i;
                    let table = "<h3>" + block + "</h3><table class='table'><thead><tr> <th scope='col'>Module</th> <th scope='col'>EC</th> </tr></thead><tbody>";
                    $('#here_table').empty();
                    $.each(modules, function (counter, module ) {
                        if(module.block_id == i ){
                            table += '<tr><th>' + module.name + '</th><th>'  + module.study_points + '</th></tr>';
                            added++;
                        }
                    })
                    table += "</tbody></table>"
                    if(added > 0){
                        $('#here_table').append(table);
                    }
                });
            }
            // let finishedCount = 0;
            // $.each(modules, function (counter, module) {
            //     if(module.is_finished){
            //         finishedCount++;
            //     }
            // });
            $('#bar').width({{$achieved/$potential*100}} + '%');
            $('#bar').text({{$achieved}} + " EC")
        })
    </script>
@endpush
