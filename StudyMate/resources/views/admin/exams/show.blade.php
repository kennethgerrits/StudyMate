@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Exam</div>
                    <div class="card-body">
                        <div class="btn-group margin-bottom-small">
                            @if($assessment == null)
                                <button class="btn btn-secondary" id="exam">Exam</button>
                            @endif
                            @if($exam == null)
                                <button class="btn btn-secondary" id="assessment">Assessment</button>
                            @endif
                            <button class="btn btn-secondary" id="assignment">Assignment</button>
                        </div>
                        <h5 id="infotext">Click an examtype to create or update an exam!</h5>
                        <form action="{{ route('admin.exams.store') }}" method="POST" enctype="multipart/form-data" id="examform">
                            @csrf
                            <input type="hidden" name="id" value="{{$moduleid}}"/>
                            <input type="hidden" name="examtype" value="exam"/>
                            Exam description:
                            <br/>
                            <input type="text" name="description" value="{{$exam->description ?? ''}}"/>
                            <br/><br/>
                            Deadline:
                            <br/>
                            <input type="date" name="deadline" value="{{$exam->deadline_date ?? ''}}"/>
                            <br/><br/>
                            <input type="submit" class="btn btn-success" value="Save"/>
                        </form>
                        <form action="{{ route('admin.exams.store') }}" method="POST" enctype="multipart/form-data" id="assessmentform">
                            @csrf
                            <input type="hidden" name="id" value="{{$moduleid}}"/>
                            <input type="hidden" name="examtype" value="assessment"/>
                            Assessment description:
                            <br/>
                            <input type="text" name="description" value="{{$assessment->description ?? ''}}"/>
                            <br/><br/>
                            Deadline:
                            <br/>
                            <input type="date" name="deadline" value="{{$assessment->deadline_date ?? ''}}"/>
                            <br/><br/>
                            Zipfile:
                            <br/>
                            Current file:
                            <br/>
                            {{$assessment->appendix ?? ''}}
                            <br/>
                            <input type="file" name="zipfile"/>
                            <br/><br/>
                            @if($assessment != null && $assessment->appendix != null)
                                <a href="{{route('admin.getAppendix', ['exam' => $assessment->id])}}" class="btn btn-primary">Download zipfile</a>
                                <a href="{{route('admin.getDestroyAppendix', ['exam' => $assessment->id])}}" class="btn btn-danger">Delete zipfile</a>
                            @endif
                            <input type="submit" class="btn btn-success" value="Save"/>
                        </form>

                        <form action="{{ route('admin.exams.store') }}" method="POST" enctype="multipart/form-data" id="assignmentform">
                            @csrf
                            <input type="hidden" name="id" value="{{$moduleid}}"/>
                            <input type="hidden" name="examtype" value="assignment"/>
                            Assignment description:
                            <br/>
                            <input type="text" name="description" value="{{$assignment->description ?? ''}}"/>
                            <br/><br/>
                            Deadline:
                            <br/>
                            <input type="date" name="deadline" value="{{$assignment->deadline_date ?? ''}}"/>
                            <br/><br/>
                            <input type="submit" class="btn btn-success" value="Save"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#exam').click(() => {
                $('#examform').show();
                $('#assessmentform').hide();
                $('#assignmentform').hide();
                $('#infotext').hide();
            });
            $('#assessment').click(() => {
                $('#examform').hide();
                $('#assessmentform').show();
                $('#assignmentform').hide();
                $('#infotext').hide();
            });
            $('#assignment').click(() => {
                $('#examform').hide();
                $('#assessmentform').hide();
                $('#assignmentform').show();
                $('#infotext').hide();

            });

            $('#examform').hide();
            $('#assessmentform').hide();
            $('#assignmentform').hide();
        })
    </script>

@endpush

