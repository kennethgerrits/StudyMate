<h5>Schoolyear {{\Carbon\Carbon::now()->year}}</h5>
<div class="btn-group margin-bottom" role="group">
    @for($i = 1; $i<=4;$i++)
        <div class="btn-group" role="group">
            <button id="btnGroupDrop{{$i}}" dusk="periodbtn{{$i}}" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Period {{$i}}
            </button>
            <div class="dropdown-menu">
                <a href="{{ route('getDashboardDetails', ['block' => $i]) }}" class="text-decoration-none" dusk="blockbtn{{$i}}">
                    <button type="button" class="btn dropdown-item" id="btn{{$i}}">Block {{$i}}</button>
                </a>
                <a href="{{ route('getDashboardDetails', ['block' => $i+4]) }}" class="text-decoration-none" dusk="blockbtn{{$i+4}}">
                    <button type="button" class="btn dropdown-item btn-info" id="btn{{$i+4}}">Block {{$i+4}}</button>
                </a>
                <a href="{{ route('getDashboardDetails', ['block' => $i+8]) }}" class="text-decoration-none" dusk="blockbtn{{$i+8}}">
                    <button type="button" class="btn dropdown-item btn-info" id="btn{{$i+8}}">Block {{$i+8}}</button>
                </a>
            </div>
        </div>
    @endfor
</div>
