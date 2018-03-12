<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(\App\Models\RollCall::class, function (Faker $faker) {
    $rollCallDate = $faker->dateTimeThisYear($max = 'now', $timezone = null)->format('Y-m-d');
    $startTime = Carbon::createFromFormat('Y-m-d H:i:s', $faker->dateTimeBetween($rollCallDate . ' 8:30:00', $rollCallDate . ' 10:00:00')->format('Y-m-d H:i:s'));
    $endTime = Carbon::createFromFormat('Y-m-d H:i:s', $faker->dateTimeBetween($rollCallDate . ' 16:00:00', $rollCallDate . ' 18:00:00')->format('Y-m-d H:i:s'));
    return [
        'start_time' => $startTime->toDateTimeString(),
        'end_time' => $endTime->toDateTimeString(),
        'day' => $rollCallDate,
        'total_time' => $endTime->diffInHours($startTime),
        'user_id' => function () {
            return factory(\App\Models\User::class)->create()->id;
        },
    ];
});
