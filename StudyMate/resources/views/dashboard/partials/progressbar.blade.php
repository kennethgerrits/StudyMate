<div class="progress margin-bottom-small">
    <div class="progress-bar {{$barwidth}}" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" id="bar"></div>
</div>
{{--@push('scripts')--}}
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            @if($maxEC != 0)--}}
{{--            $('#bar').width({{$achievedEC/$maxEC*100}} +'%');--}}
{{--            $('#bar').text({{$achievedEC}} +" EC")--}}
{{--            @endif--}}
{{--        })--}}
{{--    </script>--}}
{{--@endpush--}}
