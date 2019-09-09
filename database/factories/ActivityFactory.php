<?php
use Faker\Generator as Faker;
use App\Models\WePlan\WeActivity;

$factory->define(WeActivity::class, function (Faker $faker) {
    $start_date = $faker->dateTimeBetween("this week","+21 days");
    $start_hr = $faker->numberBetween(12,21);
    $start =  $start_hr .":00:00";
    $responsible_user = 1000;
    $end = $start_hr + 2;
    $end = $end . ":00:00";
    $res_time = $start_hr - 5;
    $res_time = $res_time . ":00:00";
    //$title = $faker->sentence(6, true);
    $type_id = $faker->numberBetween(1,4);
    if($type_id == 1) {
        $title = "Seniortræning for " . $faker->numberBetween(1, 3) . ". truppen";
    } if($type_id == 2) {
        $title = "Ekstratræning for alle senior spillere";
    } if($type_id == 3) {
        $title = "Holdkamp for alle turneringshold";
    } if($type_id == 4) {
        $title = "Afslutningsfest for turneringsafdelingen";
    }
    return [
        "title" => $title,
        "responsible_user" => $responsible_user,
        "start_date" => $start_date,
        "start" => $start,
        "end" => $end,
        "response_date" => $start_date,
        "response_time" => $res_time,
        "type_id" => $type_id

    ];
});
