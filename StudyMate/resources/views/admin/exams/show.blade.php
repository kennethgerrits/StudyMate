@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Exam</div>
                    <div class="card-body">
                        <div class="btn-group">
                            <button class="btn btn-secondary" id="exam">Exam</button>
                            <button class="btn btn-secondary" id="assessment">Assessment</button>
                            <button class="btn btn-secondary" id="assignment">Assignment</button>
                        </div>
                        <form action="{{ route('admin.exams.store') }}" method="POST" enctype="multipart/form-data" id="examform">
                            @csrf
                            <input type="hidden" name="examtype" value="exam"/>
                            Exam description:
                            <br/>
                            <input type="text" name="description"/>
                            <br/><br/>
                            Deadline:
                            <br/>
                            <input type="date" name="deadline"/>
                            <br/><br/>
                            <input type="submit" value=" Save"/>
                        </form>
                        <form action="{{ route('admin.exams.store') }}" method="POST" enctype="multipart/form-data" id="assessmentform">
                            @csrf
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
                            <input type="submit" value=" Save"/>
                        </form>

                        <form action="{{ route('admin.exams.store') }}" method="POST" enctype="multipart/form-data" id="assignmentform">
                            @csrf
                            <input type="hidden" name="examtype" value="assignment"/>
                            Assignment description:
                            <br/>
                            <input type="text" name="description"/>
                            <br/><br/>
                            Deadline:
                            <br/>
                            <input type="date" name="deadline"/>
                            <br/><br/>
                            <input type="submit" value=" Save"/>
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
            });
            $('#assessment').click(() => {
                $('#examform').hide();
                $('#assessmentform').show();
                $('#assignmentform').hide();
            });
            $('#assignment').click(() => {
                $('#examform').hide();
                $('#assessmentform').hide();
                $('#assignmentform').show();
            });

            $('#exam').click();
        })
    </script>

@endpush

