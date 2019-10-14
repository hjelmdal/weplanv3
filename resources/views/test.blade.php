<?php
/**
 * Created by PhpStorm.
 * User: impact
 * Date: 2019-04-17
 * Time: 11:03
 */
?>
<?php
use App\Helpers\BadmintonDanmark\PlayerParser;
/**
 * Created by PhpStorm.
 * User: impact
 * Date: 2019-03-30
 * Time: 16:50
 */

?>
@extends("metronic")
@section("scripts")
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.js" xmlns="http://www.w3.org/1999/html"></script>
    <script src="{{ route("index") }}/vuejs/test.js?v={{ Helpers::gitVersion()->getVersion() }}"></script>

@endsection
@section("styles")

@endsection
@section("meta")
@endsection
@section("content")
<table>
<?php

$parser = new PlayerParser();
$parser->getPlayers();
//$parser->parsePlayers();

?>
</table>
@endsection
@section("modal")
    @include("layouts.theme.blocks.modal1")
@endsection
