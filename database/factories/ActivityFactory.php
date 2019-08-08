<?php
use Faker\Generator as Faker;
use App\Models\WePlan\WeActivity;

$factory->define(WeActivity::class, function (Faker $faker) {
    $start_date = $faker->dateTimeBetween("this week","+21 days");
    $start_hr = $faker->numberBetween(12,21);
    $start =  $start_hr .":00:00";
    $end = $start_hr + 2;
    $end = $end . ":00:00";
    $res_time = $start_hr - 5;
    $res_time = $res_time . ":00:00";
    $title = $faker->sentence(6, true);
    return [
        "title" => $title,
        "start_date" => $start_date,
        "start" => $start,
        "end" => $end,
        "response_date" => $start_date,
        "response_time" => $res_time,
        "type_id" => $faker->numberBetween(1,4)

    ];
});
