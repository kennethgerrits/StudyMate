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
