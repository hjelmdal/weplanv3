@extends("layouts.metronic.master")

@section("content")
    <ul>
        <router-link tag="li" to="/" exact>
            <a>Home</a>
        </router-link>

        <router-link tag="li" to="/activities">
            <a>Activities</a>
        </router-link>
        <router-link tag="li" to="/users">
            <a>Users</a>
        </router-link>

    </ul>
@endsection

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
