@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Exam</div>
                    <div class="card-body">
                        <form action="{{ route('admin.exams.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            Exam title:
                            <br />
                            <input type="text" name="title" />
                            <br /><br />
                            Zipfile:
                            <br />
                            <input type="file" name="zipfile" />
                            <br /><br />
                            <input type="submit" value=" Save" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
