@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Users</div>
                    <div class="card-body">

                        <form action="{{route('postDeadlineManagerChanges')}}" method="POST">
                            <table class="table border border-bottom">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>

                                    <th scope="col" onclick="window.location.href = '{{route('getDeadlineManagerIndex', ['column' => 'name', 'order' => $order, 'table' => 'module'])}}'">Module</th>
                                    <th scope="col" onclick="window.location.href = '{{route('getDeadlineManagerIndex', ['column' => 'name', 'order' => $order, 'table' => 'module.teacher'])}}'">Teacher</th>
                                    <th scope="col">Description</th>
                                    <th scope="col" onclick="window.location.href = '{{route('getDeadlineManagerIndex', ['column' => 'type', 'order' => $order, 'table' => 'type'])}}'">Type</th>
                                    <th scope="col" onclick="window.location.href = '{{route('getDeadlineManagerIndex', ['column' => 'deadline_date', 'order' => $order])}}'">Deadline</th>
                                    <th scope="col">Tag</th>
                                    <th scope="col">Finished</th>
                                </tr>
                                </thead>
                                <tbody>

                                @csrf
                                <input type="hidden" name="exams" value="{{$exams}}"/>
                                @foreach($exams as $exam)
                                    <tr>
                                        <th scope="row">{{$exam->id}}</th>
                                        <td>
                                            <div>
                                                <div>
                                                    {{$exam->module()->first()->name}}
                                                </div>
                                                @foreach($exam->tags()->get() as $tag)
                                                <div class="badge badge-dark d-inline-block">
                                                    {{$tag->tag}}
                                                </div>
                                                    @endforeach
                                            </div>
                                        </td>
                                        <td>{{$exam->module()->first()->teacher()->first()->name}}</td>
                                        <td>{{$exam->description}}</td>
                                        <td>{{$exam->type()->first()->type}}</td>
                                        <td>{{$exam->deadline_date}}</td>
                                        <td>
                                            <select class="form-control" name="tags[]">
                                                <option></option>
                                                @foreach ($tags as $tag)
                                                    @if(!$exam->tags()->get()->contains($tag->id))
                                                        {{$tagarray = collect([$exam->id, $tag->id])}}
                                                        {{$tagarray->implode('[', ',', ']')}}
                                                        <option value="{{$tagarray}}">
                                                            {{ $tag->tag }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="btn btn-danger" name="finished[]" value="{{$exam->id}}"
                                                       @if($exam->is_finished) checked @endif/>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary float-right mt-3">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

