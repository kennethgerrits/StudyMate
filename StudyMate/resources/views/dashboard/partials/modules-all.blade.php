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
