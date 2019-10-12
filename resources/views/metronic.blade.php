@extends("layouts.metronic.master")



@section("scripts")
    <script src="/vuejs/app.js?v={{ Helpers::gitVersion()->getVersion() }}"></script>
@endsection
@section("content")
    {{ $_SERVER['QUERY_STRING'] }}
@endsection
@section("meta")
    <?php if(!isset($date)) {
        $date = date("Y-m-d");
    }
    ?>
    <meta name="start-date" content="{{ $date }}">

@endsection
