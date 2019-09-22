@extends("layouts.metronic.master")



@section("scripts")
    <script src="/vuejs/test.js"></script>
@endsection

@section("meta")
    <?php if(!isset($date)) {
        $date = date("Y-m-d");
    }
    ?>
    <meta name="start-date" content="{{ $date }}">
@endsection
